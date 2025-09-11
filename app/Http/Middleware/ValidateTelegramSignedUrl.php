<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ValidateTelegramSignedUrl
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->hasValidSignature()) {
            abort(403, 'Invalid signature.');
        }

        $chatId = $request->route('chat_id');
        
        // Find the user or create a new one if they don't exist.
        $user = User::firstOrCreate(
            ['chat_id' => $chatId],
            [
                // We don't have name/username here, so we'll use placeholders.
                // The webhook handler can update these details later.
                'name' => 'Telegram User ' . $chatId,
                'password' => bcrypt(str()->random(16)),
            ]
        );

        Auth::login($user);
        
        return $next($request);
    }
}