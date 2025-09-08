<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class CacheService
{
    /**
     * In-memory cache storage
     *
     * @var array
     */
    protected static $memoryCache = [];
    
    /**
     * Maximum number of retry attempts for file locking
     *
     * @var int
     */
    protected $maxRetries = 3;
    
    /**
     * Delay between retry attempts in microseconds
     *
     * @var int
     */
    protected $retryDelay = 100000; // 0.1 seconds
    
    /**
     * Get data from cache file
     *
     * @param string $key
     * @param mixed $default
     * @param int $ttl Time to live in seconds (optional)
     * @return mixed
     */
    public function get($key, $default = null, $ttl = null)
    {
        // Validate cache key
        if (!$this->isValidKey($key)) {
            Log::warning("Invalid cache key provided: " . $key);
            return $default;
        }
        
        // Check in-memory cache first
        $memoryKey = $this->getMemoryKey($key);
        if (isset(self::$memoryCache[$memoryKey])) {
            $cached = self::$memoryCache[$memoryKey];
            if ($ttl === null || (time() - $cached['time']) < $ttl) {
                return $cached['data'];
            } else {
                // Remove expired entry
                unset(self::$memoryCache[$memoryKey]);
            }
        }
        
        $filePath = $this->getCacheFilePath($key);
        
        // Check if file exists
        if (!File::exists($filePath)) {
            return $default;
        }
        
        // Check if cache is expired based on file modification time
        if ($ttl !== null && $this->isExpiredByModificationTime($filePath, $ttl)) {
            File::delete($filePath);
            return $default;
        }
        
        // Read and decode JSON data with file locking
        $data = $this->readWithLocking($filePath);
        if ($data !== false) {
            // Store in memory cache
            self::$memoryCache[$memoryKey] = [
                'data' => $data,
                'time' => time()
            ];
            return $data;
        }
        
        return $default;
    }
    
    /**
     * Put data to cache file
     *
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public function put($key, $value)
    {
        // Validate cache key
        if (!$this->isValidKey($key)) {
            Log::error("Invalid cache key provided: " . $key);
            return false;
        }
        
        $filePath = $this->getCacheFilePath($key);
        
        // Create directory if it doesn't exist
        $directory = dirname($filePath);
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }
        
        // Encode data to JSON
        $content = json_encode($value, JSON_PRETTY_PRINT);
        
        // Write to file with atomic operation and file locking
        $result = $this->writeWithLocking($filePath, $content);
        
        if ($result !== false) {
            // Update in-memory cache
            $memoryKey = $this->getMemoryKey($key);
            self::$memoryCache[$memoryKey] = [
                'data' => $value,
                'time' => time()
            ];
            return true;
        }
        
        return false;
    }
    
    /**
     * Check if cache file is expired based on modification time
     *
     * @param string $filePath
     * @param int $ttl Time to live in seconds
     * @return bool
     */
    protected function isExpiredByModificationTime($filePath, $ttl)
    {
        $fileTime = File::lastModified($filePath);
        $currentTime = time();
        return ($currentTime - $fileTime) > $ttl;
    }
    
    /**
     * Remove cache file
     *
     * @param string $key
     * @return bool
     */
    public function forget($key)
    {
        // Validate cache key
        if (!$this->isValidKey($key)) {
            Log::error("Invalid cache key provided: " . $key);
            return false;
        }
        
        $filePath = $this->getCacheFilePath($key);
        
        // Remove from in-memory cache
        $memoryKey = $this->getMemoryKey($key);
        unset(self::$memoryCache[$memoryKey]);
        
        if (File::exists($filePath)) {
            return File::delete($filePath);
        }
        
        return true;
    }
    
    /**
     * Check if cache key exists
     *
     * @param string $key
     * @param int $ttl Time to live in seconds (optional)
     * @return bool
     */
    public function has($key, $ttl = null)
    {
        // Validate cache key
        if (!$this->isValidKey($key)) {
            Log::warning("Invalid cache key provided: " . $key);
            return false;
        }
        
        // Check in-memory cache first
        $memoryKey = $this->getMemoryKey($key);
        if (isset(self::$memoryCache[$memoryKey])) {
            $cached = self::$memoryCache[$memoryKey];
            if ($ttl === null || (time() - $cached['time']) < $ttl) {
                return true;
            } else {
                // Remove expired entry
                unset(self::$memoryCache[$memoryKey]);
            }
        }
        
        $filePath = $this->getCacheFilePath($key);
        $exists = File::exists($filePath);
        
        if (!$exists) {
            return false;
        }
        
        // Check if cache is expired
        if ($ttl !== null && $this->isExpiredByModificationTime($filePath, $ttl)) {
            File::delete($filePath);
            return false;
        }
        
        return true;
    }
    
    /**
     * Get file path for cache key
     *
     * @param string $key
     * @return string
     */
    protected function getCacheFilePath($key)
    {
        // Convert key to file path
        $safeKey = str_replace(['/', '\\', '..'], '_', $key);
        return storage_path('app/cache/' . $safeKey . '.json');
    }
    
    /**
     * Flush all cache files
     *
     * @return bool
     */
    public function flush()
    {
        // Clear in-memory cache
        self::$memoryCache = [];
        
        $cacheDir = storage_path('app/cache');
        
        if (File::exists($cacheDir)) {
            return File::deleteDirectory($cacheDir);
        }
        
        return true;
    }
    
    /**
     * Read file content with file locking
     *
     * @param string $filePath
     * @return mixed
     */
    protected function readWithLocking($filePath)
    {
        $attempts = 0;
        
        while ($attempts < $this->maxRetries) {
            $file = fopen($filePath, 'r');
            if ($file === false) {
                return false;
            }
            
            // Try to acquire shared lock
            if (flock($file, LOCK_SH | LOCK_NB)) {
                $content = '';
                while (!feof($file)) {
                    $content .= fread($file, 8192);
                }
                
                flock($file, LOCK_UN);
                fclose($file);
                
                return json_decode($content, true);
            } else {
                fclose($file);
                $attempts++;
                if ($attempts < $this->maxRetries) {
                    usleep($this->retryDelay);
                }
            }
        }
        
        Log::warning("Failed to acquire read lock for file: " . $filePath);
        return false;
    }
    
    /**
     * Write content to file with atomic operation and file locking
     *
     * @param string $filePath
     * @param string $content
     * @return bool
     */
    protected function writeWithLocking($filePath, $content)
    {
        $attempts = 0;
        
        while ($attempts < $this->maxRetries) {
            // Create temporary file for atomic operation
            $tempPath = $filePath . '.tmp.' . uniqid();
            
            $file = fopen($tempPath, 'w');
            if ($file === false) {
                Log::error("Failed to create temporary file: " . $tempPath);
                return false;
            }
            
            // Try to acquire exclusive lock
            if (flock($file, LOCK_EX | LOCK_NB)) {
                $bytesWritten = fwrite($file, $content);
                fflush($file);
                flock($file, LOCK_UN);
                fclose($file);
                
                if ($bytesWritten !== false) {
                    // Atomically move temp file to target location
                    if (rename($tempPath, $filePath)) {
                        return true;
                    } else {
                        Log::error("Failed to rename temporary file: " . $tempPath);
                        unlink($tempPath);
                        return false;
                    }
                } else {
                    Log::error("Failed to write to temporary file: " . $tempPath);
                    fclose($file);
                    unlink($tempPath);
                    return false;
                }
            } else {
                fclose($file);
                unlink($tempPath);
                $attempts++;
                if ($attempts < $this->maxRetries) {
                    usleep($this->retryDelay);
                }
            }
        }
        
        Log::warning("Failed to acquire write lock for file: " . $filePath);
        return false;
    }
    
    /**
     * Validate cache key
     *
     * @param string $key
     * @return bool
     */
    protected function isValidKey($key)
    {
        // Key must be a non-empty string
        if (!is_string($key) || empty($key)) {
            return false;
        }
        
        // Key must not contain directory traversal sequences
        if (strpos($key, '..') !== false) {
            return false;
        }
        
        // Key must not be too long
        if (strlen($key) > 255) {
            return false;
        }
        
        return true;
    }
    
    /**
     * Generate memory cache key
     *
     * @param string $key
     * @return string
     */
    protected function getMemoryKey($key)
    {
        return md5($key);
    }
}