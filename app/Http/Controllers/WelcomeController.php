<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authorization(Request $request)
    {
        // Get chat_id from the request
        $chat_id = $request->input('id');

        // Check if chat_id exists
        if (! $chat_id) {
            return redirect('/login')->with('error', 'ID Pengguna tidak ditemukan.');
        }

        // Find the user by chat_id
        $user = User::where('chat_id', $chat_id)->first();

        // If user doesn't exist, create one (optional, but good for robustness)
        if (! $user) {
            // This part is a fallback, as BotController should have created the user.
            // We might not have first_name, etc., so we create a minimal user.
            $user = User::create([
                'chat_id' => $chat_id,
                'name' => 'Telegram User '.$chat_id,
                'username' => 'telegram_'.$chat_id,
                'email' => $chat_id.'@telegram.user', // Placeholder email
                'password' => Hash::make(Str::random(20)), // Dummy password
            ]);
        }

        // Log the user in
        Auth::login($user, true); // true for "remember me"

        Log::info('User logged in successfully via Telegram link', ['user_id' => $user->id]);

        // Redirect to the intended page, or a default
        return redirect()->intended(route('quran.jadwalsholatharian'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function image($file)
    {
        $path = storage_path('app/public/'.$file);

        if (! File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = response($file, 200);
        $response->header('Content-Type', $type);

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
