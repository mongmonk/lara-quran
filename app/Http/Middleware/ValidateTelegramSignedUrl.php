<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ValidateTelegramSignedUrl
{
    public function handle(Request $request, Closure $next)
    {
        if (! $this->isValidTelegramRequest($request)) {
            abort(403, 'Invalid Telegram signature.');
        }

        return $next($request);
    }

    private function isValidTelegramRequest(Request $request): bool
    {
        $initData = $request->query('_auth');

        if (! $initData) {
            return false;
        }

        parse_str($initData, $data);

        if (! isset($data['hash'])) {
            return false;
        }

        $hash = $data['hash'];
        unset($data['hash']);
        ksort($data);

        $dataCheckString = implode("\n", array_map(fn ($key, $value) => "$key=$value", array_keys($data), $data));

        $botToken = env('TELEGRAM_BOT_TOKEN');
        if (! $botToken) {
            Log::error('TELEGRAM_BOT_TOKEN is not set in .env file.');

            return false;
        }

        $secretKey = hash_hmac('sha256', $botToken, 'WebAppData', true);
        $calculatedHash = hash_hmac('sha256', $dataCheckString, $secretKey);

        if (hash_equals($calculatedHash, $hash)) {
            $userData = json_decode($data['user'], true);
            $chatId = $userData['id'] ?? null;

            if (! $chatId) {
                return false;
            }

            $user = User::firstOrCreate(
                ['chat_id' => $chatId],
                [
                    'name' => trim(($userData['first_name'] ?? '').' '.($userData['last_name'] ?? '')),
                    'username' => $userData['username'] ?? null,
                    'password' => bcrypt(str()->random(16)),
                ]
            );

            Auth::login($user);

            return true;
        }

        return false;
    }
}
