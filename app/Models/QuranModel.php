<?php

namespace App\Models;

use App\Services\CacheService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class QuranModel extends Model
{
    protected $cacheService;

    public function __construct()
    {
        $this->cacheService = new CacheService;
    }

    /**
     * Get Quran data from cache or API
     *
     * @param  string  $type
     * @return mixed
     */
    public function getQuran($type = 'quran-uthmani')
    {
        $cacheKey = "quran_{$type}";

        // Try to get from cache first
        $data = $this->cacheService->get($cacheKey, null, 60 * 60 * 24 * 365); // 1 year cache

        if ($data !== null) {
            return $data;
        }

        // If not in cache, fetch from API
        try {
            \Log::info("Attempting to fetch Quran data from API: https://api.alquran.cloud/v1/quran/{$type}");
            // Using HTTP client with SSL verification options
            $response = Http::withOptions([
                'verify' => true, // Ensure SSL verification is enabled
                'timeout' => 30,  // Set timeout to 30 seconds
            ])->get("https://api.alquran.cloud/v1/quran/{$type}");

            if ($response->successful()) {
                $data = $response->json();
                \Log::info('Successfully fetched Quran data from API');
                // Cache the data
                $this->cacheService->put($cacheKey, $data);

                return $data;
            } else {
                \Log::error('Failed to fetch Quran data from API. Status: '.$response->status());

                return null;
            }
        } catch (\Exception $e) {
            \Log::error('Exception occurred while fetching Quran data from API: '.$e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString(),
            ]);

            // Fallback: Try with SSL verification disabled (only for development)
            if (app()->environment('local')) {
                \Log::warning('Retrying with SSL verification disabled (development only)');
                try {
                    $response = Http::withOptions([
                        'verify' => false, // Disable SSL verification for development
                        'timeout' => 30,
                    ])->get("https://api.alquran.cloud/v1/quran/{$type}");

                    if ($response->successful()) {
                        $data = $response->json();
                        \Log::info('Successfully fetched Quran data from API (SSL disabled)');
                        // Cache the data
                        $this->cacheService->put($cacheKey, $data);

                        return $data;
                    }
                } catch (\Exception $e2) {
                    \Log::error('Exception occurred even with SSL verification disabled: '.$e2->getMessage(), [
                        'exception' => $e2,
                        'trace' => $e2->getTraceAsString(),
                    ]);
                }
            }

            return null;
        }
    }

    /**
     * Get Quran data from API
     *
     * @param  int  $surat
     * @return mixed
     */
    public function getQuranApi($surat)
    {
        $cacheKey = "quran_api_{$surat}";

        // Try to get from cache first
        $data = $this->cacheService->get($cacheKey, null, 60 * 60 * 24 * 365); // 1 year cache

        if ($data !== null) {
            return $data;
        }

        // If not in cache, fetch from API
        $response = Http::get("https://quranapi.idn.sch.id/surah/{$surat}");

        if ($response->successful()) {
            $data = $response->json();
            // Cache the data
            $this->cacheService->put($cacheKey, $data);

            return $data;
        }

        return null;
    }

    /**
     * Get static Quran data from file
     *
     * @return mixed
     */
    public function getQuranStatis()
    {
        $cacheKey = 'quran_statis';

        // Try to get from cache first
        $data = $this->cacheService->get($cacheKey, null, 60 * 60 * 24 * 365); // 1 year cache

        if ($data !== null) {
            return $data;
        }

        // If not in cache, read from file
        $filePath = storage_path('app/cache/quran/data.json');
        if (File::exists($filePath)) {
            $content = File::get($filePath);
            $data = json_decode($content, true);
            // Cache the data
            $this->cacheService->put($cacheKey, $data);

            return $data;
        }

        return null;
    }

    /**
     * Get surah list from static data
     *
     * @return array
     */
    public function surahListStatis()
    {
        $data = $this->getQuranStatis();

        return $this->uniqueGroup($data, 'surahNum');
    }

    /**
     * Get juz data from static data
     *
     * @param  int  $juz
     * @return array
     */
    public function getJuzStatis($juz)
    {
        $data = $this->getQuranStatis();

        return $this->listGroup($data, 'juz', $juz);
    }

    /**
     * Get surah data from static data
     *
     * @param  int  $surah
     * @return array
     */
    public function getSurah($surah)
    {
        $data = $this->getQuranStatis();

        return $this->listGroup($data, 'surahNum', $surah);
    }

    /**
     * Get ruku data from static data
     *
     * @param  int  $ruku
     * @return array
     */
    public function getRuku($ruku)
    {
        $data = $this->getQuranStatis();

        return $this->listGroup($data, 'ruku', $ruku);
    }

    /**
     * Get page data from static data
     *
     * @param  int  $page
     * @return array
     */
    public function getPage($page)
    {
        $data = $this->getQuranStatis();

        return $this->listGroup($data, 'page', $page);
    }

    /**
     * Get all ruku data from static data
     *
     * @return array
     */
    public function getAllRukuStatis()
    {
        $data = $this->getQuranStatis();

        return $this->uniqueGroup($data, 'ruku');
    }

    /**
     * Get sajdah data from static data
     *
     * @return array
     */
    public function getSajdah()
    {
        $data = $this->getQuranStatis();
        $result = [];
        foreach ($data as $key => $value) {
            if (! empty($value['sajdah'])) {
                $result[] = $value;
            }
        }

        return $result;
    }

    /**
     * Get ayah data from static data
     *
     * @param  int  $number
     * @return array
     */
    public function getAyah($number)
    {
        $data = $this->getQuranStatis();

        return $this->listGroup($data, 'numList', $number);
    }

    /**
     * Search Quran text
     *
     * @param  string  $search
     * @return array
     */
    public function searchQuran($search)
    {
        $data = [];
        $json = $this->getQuranStatis();
        foreach ($json as $key => $value) {
            if (strpos($value['id'], $search) !== false) {
                $data[] = $value;
            }
        }

        return $data;
    }

    /**
     * Get metadata from API
     *
     * @return mixed
     */
    public function getMeta()
    {
        $cacheKey = 'quran_meta';

        // Try to get from cache first
        $data = $this->cacheService->get($cacheKey, null, 60 * 60 * 24 * 365); // 1 year cache

        if ($data !== null) {
            return $data;
        }

        // If not in cache, fetch from API
        $response = Http::get('http://api.alquran.cloud/v1/meta');

        if ($response->successful()) {
            $data = $response->json();
            // Cache the data
            $this->cacheService->put($cacheKey, $data);

            return $data;
        }

        return null;
    }

    /**
     * Get juz ayah mapping
     *
     * @param  int  $juz
     * @return int
     */
    public function getJuzAyah($juz)
    {
        $list = [
            1 => 1, 2 => 22, 3 => 42, 4 => 62, 5 => 82, 6 => 102, 7 => 121, 8 => 142, 9 => 162, 10 => 182,
            11 => 201, 12 => 222, 13 => 242, 14 => 262, 15 => 282, 16 => 302, 17 => 322, 18 => 342, 19 => 362, 20 => 382,
            21 => 402, 22 => 422, 23 => 442, 24 => 462, 25 => 482, 26 => 502, 27 => 522, 28 => 542, 29 => 562, 30 => 582,
        ];

        return $list[$juz];
    }

    /**
     * Get surat ayah mapping
     *
     * @param  int  $ayat
     * @return int
     */
    public function getSuratAyah($ayat)
    {
        $list = [
            1 => 1, 2 => 2, 3 => 50, 4 => 77,  5 => 106, 6 => 128, 7 => 151, 8 => 177, 9 => 187, 10 => 208,
            11 => 221, 12 => 235, 13 => 249, 14 => 255, 15 => 262, 16 => 267, 17 => 282, 18 => 293, 19 => 305, 20 => 312,
            21 => 322, 22 => 332, 23 => 342, 24 => 350, 25 => 359, 26 => 367, 27 => 377, 28 => 385, 29 => 396, 30 => 404,
            31 => 411, 32 => 415, 33 => 418, 34 => 428, 35 => 434, 36 => 440, 37 => 446, 38 => 453, 39 => 458, 40 => 467,
            41 => 477, 42 => 483, 43 => 489, 44 => 496, 45 => 499, 46 => 502, 47 => 507, 48 => 511, 49 => 515, 50 => 518,
            51 => 520, 52 => 523, 53 => 526, 54 => 528, 55 => 531, 56 => 534, 57 => 537, 58 => 542, 59 => 545, 60 => 549,
            61 => 551, 62 => 553, 63 => 554, 64 => 556, 65 => 558, 66 => 560, 67 => 562, 68 => 564, 69 => 566, 70 => 568,
            71 => 570, 72 => 572, 73 => 574, 74 => 575, 75 => 577, 76 => 578, 77 => 580, 78 => 582, 79 => 583, 80 => 585,
            81 => 586, 82 => 587, 83 => 587, 84 => 589, 85 => 590, 86 => 591, 87 => 591, 88 => 592, 89 => 593, 90 => 594,
            91 => 595, 92 => 595, 93 => 596, 94 => 596, 95 => 597, 96 => 597, 97 => 598, 98 => 598, 99 => 599, 100 => 599,
            101 => 600, 102 => 600, 103 => 601, 104 => 601, 105 => 601, 106 => 602, 107 => 602, 108 => 602, 109 => 603, 110 => 603,
            111 => 603, 112 => 604, 113 => 604, 114 => 604,
        ];

        return $list[$ayat];
    }

    /**
     * Get tafsir data from API
     *
     * @param  int  $surah
     * @return mixed
     */
    public function tafsirSurah($surah)
    {
        $cacheKey = "tafsir_surah_{$surah}";

        // Try to get from cache first
        $data = $this->cacheService->get($cacheKey, null, 60 * 60 * 24 * 365); // 1 year cache

        if ($data !== null) {
            return $data;
        }

        // If not in cache, fetch from API
        $response = Http::get("https://equran.id/api/tafsir/{$surah}");

        if ($response->successful()) {
            $data = $response->json();
            // Cache the data
            $this->cacheService->put($cacheKey, $data);

            return $data;
        }

        return null;
    }

    /**
     * Get hadits data from file
     *
     * @param  string  $book
     * @param  bool|int  $num
     * @return mixed
     */
    public function getHadits($book, $num = false)
    {
        $book = str_ireplace(['abudaud', 'ibnumajah'], ['abu-daud', 'ibnu-majah'], $book);
        $filePath = storage_path("app/cache/hadits/{$book}.json");

        if (File::exists($filePath)) {
            $content = File::get($filePath);
            $json = json_decode($content, true);

            if ($num !== false) {
                $chunk = array_chunk($json, 25);

                return $chunk[$num] ?? [];
            }

            return count($json);
        }

        return 0;
    }

    /**
     * Search hadits text
     *
     * @param  string  $book
     * @param  string  $search
     * @return array
     */
    public function searchHadits($book, $search)
    {
        $book = str_ireplace(['abudaud', 'ibnumajah'], ['abu-daud', 'ibnu-majah'], $book);
        $filePath = storage_path("app/cache/hadits/{$book}.json");

        if (File::exists($filePath)) {
            $content = File::get($filePath);
            $json = json_decode($content, true);
            $data = [];
            foreach ($json as $key => $value) {
                if (strpos($value['id'], $search) !== false) {
                    $data[] = $value;
                }
            }

            return $data;
        }

        return [];
    }

    /**
     * Get doa data from file
     *
     * @return mixed
     */
    public function getDoa()
    {
        $filePath = storage_path('app/cache/prayers/doa.json');

        if (File::exists($filePath)) {
            $content = File::get($filePath);

            return json_decode($content, true);
        }

        return [];
    }

    /**
     * Get tahlil data from file
     *
     * @return mixed
     */
    public function getTahlil()
    {
        $filePath = storage_path('app/cache/prayers/tahlil.json');

        if (File::exists($filePath)) {
            $content = File::get($filePath);

            return json_decode($content, true);
        }

        return [];
    }

    /**
     * Get kota data from file
     *
     * @return mixed
     */
    public function getKota()
    {
        $filePath = storage_path('app/cache/locations/lokasi.json');

        if (File::exists($filePath)) {
            $content = File::get($filePath);

            return json_decode($content, true);
        }

        return [];
    }

    /**
     * Get jadwal data from API
     *
     * @param  int  $kota
     * @param  bool|int  $hari
     * @return mixed
     */
    public function getJadwal($kota, $hari = false)
    {
        // Get tahun and bulan from request or use current
        $tahun = request()->get('tahun', date('Y'));
        $bulan = request()->get('bulan', date('m'));

        $cacheKey = "jadwal_{$kota}_{$tahun}_{$bulan}";

        // Try to get from cache first
        $data = $this->cacheService->get($cacheKey, null, 60 * 60 * 24); // 1 day cache

        if ($data !== null) {
            if ($hari) {
                return $this->processJadwalForDay($data, $tahun, $bulan, $hari);
            }

            return $data;
        }

        // If not in cache, fetch from API
        $response = Http::get("https://api.myquran.com/v2/sholat/jadwal/{$kota}/{$tahun}/{$bulan}");

        if ($response->successful()) {
            $data = $response->json();
            // Cache the data
            $this->cacheService->put($cacheKey, $data);

            if ($hari) {
                return $this->processJadwalForDay($data, $tahun, $bulan, $hari);
            }

            return $data;
        }

        return null;
    }

    /**
     * Process jadwal data for a specific day
     *
     * @param  array  $data
     * @param  int  $tahun
     * @param  int  $bulan
     * @param  int  $hari
     * @return string|null
     */
    protected function processJadwalForDay($data, $tahun, $bulan, $hari)
    {
        $asli = ['january', 'february', 'march', 'may', 'june', 'July', 'august', 'october', 'december', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
        $ganti = ['Januari', 'Februari', 'Maret', 'Mei', 'Juni', 'Juli', 'Agustus', 'Oktober', 'Desember', 'Ahad', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum`at', 'Sabtu'];

        foreach ($data['data']['jadwal'] as $key => $get) {
            if ($get['date'] === "{$tahun}-{$bulan}-{$hari}") {
                // For now, we'll just return the raw data for the day
                // In a real implementation, you would process the hijri date here
                $result = [
                    'date' => $get['date'],
                    'tanggal' => str_ireplace($asli, $ganti, date('l, d F Y', strtotime($get['date']))),
                    // 'hijriyah' => $hijriyah, // This would require the hijri class
                    'lokasi' => ucwords(strtolower($data['data']['lokasi'])),
                    'daerah' => ucwords(strtolower($data['data']['daerah'])),
                    'imsak' => $get['imsak'],
                    'subuh' => $get['subuh'],
                    'terbit' => $get['terbit'],
                    'dhuha' => $get['dhuha'],
                    'dzuhur' => $get['dzuhur'],
                    'ashar' => $get['ashar'],
                    'maghrib' => $get['maghrib'],
                    'isya' => $get['isya'],
                ];

                return $result;
            }
        }

        return null;
    }

    /**
     * Convert numbers to Eastern Arabic numerals
     *
     * @param  int|string  $num
     * @return string
     */
    public function numConverter($num)
    {
        $western_arabic = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $eastern_arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];

        $str = str_replace($western_arabic, $eastern_arabic, $num);

        return $str;
    }

    /**
     * Group array by unique element
     *
     * @param  array  $array
     * @param  string  $elm
     * @return array
     */
    public function uniqueGroup($array, $elm)
    {
        $unique_array = [];
        foreach ($array as $element) {
            $hash = $element[$elm];
            $unique_array[$hash] = $element;
        }
        $result = array_values($unique_array);

        return $result;
    }

    /**
     * Group array by element value
     *
     * @param  array  $array
     * @param  string  $elm
     * @param  mixed  $val
     * @return array
     */
    public function listGroup($array, $elm, $val)
    {
        $result = [];
        foreach ($array as $key => $value) {
            if ($value[$elm] === $val) {
                $result[] = $value;
            }
        }

        return $result;
    }

    /**
     * Get jadwal sholat harian by URL
     *
     * @param  string  $url
     * @return mixed
     */
    public function getJadwalSholatHarian($url)
    {
        return JadwalSholatHarian::where('url', $url)->first();
    }

    /**
     * Get all jadwal sholat harian
     *
     * @return mixed
     */
    public function getAllJadwalSholatHarian()
    {
        return JadwalSholatHarian::all();
    }

    /**
     * Create new jadwal sholat harian
     *
     * @param  array  $data
     * @return mixed
     */
    public function createJadwalSholatHarian($data)
    {
        return JadwalSholatHarian::create($data);
    }

    /**
     * Update jadwal sholat harian by URL
     *
     * @param  string  $url
     * @param  array  $data
     * @return mixed
     */
    public function updateJadwalSholatHarian($url, $data)
    {
        $jadwal = JadwalSholatHarian::where('url', $url)->first();
        if ($jadwal) {
            $jadwal->update($data);

            return $jadwal;
        }

        return null;
    }
}
