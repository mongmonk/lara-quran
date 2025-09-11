<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TelegramWebviewAuth
{
    public function handle(Request $request, Closure $next)
    {
        $initData = $request->query('_auth');

        if (!$initData && $request->hasHeader('X-Telegram-Init-Data')) {
            $initData = $request->header('X-Telegram-Init-Data');
        }

        if ($initData) {
            $data = $this->validateInitData($initData);

            if ($data) {
                $user = User::firstOrCreate(
                    ['chat_id' => $data['user']['id']],
                    [
                        'name' => trim($data['user']['first_name'] . ' ' . ($data['user']['last_name'] ?? '')),
                        'username' => $data['user']['username'] ?? null,
                        'password' => bcrypt(str()->random(16)),
                    ]
                );

                Auth::login($user);

                return $next($request);
            }
        }

        // Jika tidak ada initData atau tidak valid, tolak akses.
        return response('Forbidden: Invalid Telegram WebApp context.', 403);
    }

    private function validateInitData(string $initData): ?array
    {
        $data = [];
        parse_str($initData, $data);

        if (!isset($data['hash']) || !isset($data['user'])) {
            return null;
        }

        $hash = $data['hash'];
        unset($data['hash']);

        $data_check_string = collect($data)
            ->sortKeys()
            ->map(fn ($value, $key) => "$key=$value")
            ->implode("\n");

        $secret_key = hash_hmac('sha256', config('services.telegram.bot_token'), 'WebAppData', true);
        $calculated_hash = hash_hmac('sha256', $data_check_string, $secret_key);

        if (hash_equals($hash, $calculated_hash)) {
            $data['user'] = json_decode($data['user'], true);
            return $data;
        }

        return null;
    }
}