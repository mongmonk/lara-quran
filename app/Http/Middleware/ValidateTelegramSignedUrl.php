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
        $user = User::where('chat_id', $chatId)->first();

        if ($user) {
            Auth::login($user);
            return $next($request);
        }

        // Optional: Create user if not exists, similar to old logic
        // For now, we'll just deny access if user is not found from a webhook interaction.
        abort(404, 'User not found.');
    }
}