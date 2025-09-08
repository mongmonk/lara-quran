<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('login');
    }
    
    public function authorization(Request $request)
    {
        // Get all request parameters
        $auth_data = $request->all();
        
        // Check if required parameters exist
        if (!isset($auth_data['id']) || !isset($auth_data['hash']) || !isset($auth_data['auth_date'])) {
            return redirect('/login')->with('error', 'Autentikasi tidak valid.');
        }
        
        // Check if auth_date is not too old (5 minutes)
        if (time() - (int)$auth_data['auth_date'] > 300) {
            return redirect('/login')->with('error', 'Autentikasi telah kedaluwarsa.');
        }
        
        // Validate Telegram authorization
        $bot_token = env('TELEGRAM_BOT_TOKEN');
        
        // Check if bot token is set
        if (empty($bot_token)) {
            return redirect('/login')->with('error', 'Token bot Telegram belum diatur. Silakan hubungi administrator.');
        }
        
        // Create data check string
        $data_check_arr = [];
        foreach ($auth_data as $key => $value) {
            if ($key !== 'hash') {
                $data_check_arr[] = $key . '=' . $value;
            }
        }
        sort($data_check_arr);
        $data_check_string = implode("\n", $data_check_arr);
        
        // Generate secret key
        $secret_key = hash('sha256', $bot_token, true);
        
        // Generate hash
        $hash = hash_hmac('sha256', $data_check_string, $secret_key);
        
        // Validate hash
        if ($hash !== $auth_data['hash']) {
            Log::error('Telegram Authentication Failed: Hash mismatch.');
            return redirect('/login')->with('error', 'Autentikasi tidak valid. Token bot mungkin tidak sesuai.');
        }
        
        Log::info('Telegram Authentication Success', $auth_data);

        // Find or create the user
        $user = User::updateOrCreate(
            ['id' => $auth_data['id']],
            [
                'name' => trim(($auth_data['first_name'] ?? '') . ' ' . ($auth_data['last_name'] ?? '')),
                'email' => $auth_data['id'] . '@telegram.user', // Placeholder email
                'password' => Hash::make(Str::random(20)) // Dummy password
            ]
        );

        // Log the user in
        Auth::login($user, true); // true for "remember me"

        Log::info('User logged in successfully', ['user_id' => $user->id]);

        // Redirect to jadwalsholatharian page after login
        return redirect()->intended(route('quran.jadwalsholatharian'));
    }
    
    public function logout()
    {
        // Clear all user session data
        Session::forget([
            'user_logged',
            'user_id',
            'user_first_name',
            'user_last_name',
            'user_username',
            'user_photo_url',
            'login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'
        ]);
        return redirect('/');
    }
    
    public function image($file)
    {
        $path = storage_path('app/public/' . $file);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = response($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
    
    public function migrate()
    {
        // In a real implementation, you would handle migration logic
        // For now, we'll just return a placeholder response
        return response()->json(['status' => 'success', 'message' => 'Migration endpoint']);
    }
    
    /**
     * Get Telegram user data
     */
    public function getTelegramUserData()
    {
        // In a real implementation, you would get Telegram user data
        // For now, we'll just return a placeholder response
        return response()->json(['message' => 'Telegram user data endpoint']);
    }
    
    /**
     * Check Telegram authorization
     */
    public function checkTelegramAuthorization($auth_data)
    {
        // In a real implementation, you would check Telegram authorization
        // For now, we'll just return a placeholder response
        return response()->json(['auth_data' => $auth_data, 'message' => 'Check Telegram authorization endpoint']);
    }
    
    /**
     * Save Telegram user data
     */
    public function saveTelegramUserData($auth_data)
    {
        // In a real implementation, you would save Telegram user data
        // For now, we'll just return a placeholder response
        return response()->json(['auth_data' => $auth_data, 'message' => 'Save Telegram user data endpoint']);
    }
}