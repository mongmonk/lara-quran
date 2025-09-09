<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuranModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use App\Services\TelegramService;
use Illuminate\Support\Str;

class BotController extends Controller
{
    protected $quran;
    protected $telegram;
    
    public function __construct(TelegramService $telegram)
    {
        $this->quran = new QuranModel();
        $this->telegram = $telegram;
    }
    
    public function index()
    {
        $page = request()->get('page', 1);
        $quranData = $this->quran->getPage((int)$page);
        $data['title'] = 'My QUR`AN Bot';
        $data['data'] = $quranData;
        return view('bot.index', $data);
    }
    
    public function juz()
    {
        $juz = request()->get('juz', 1);
        $quranData = $this->quran->getJuzStatis((int)$juz);
        $data['title'] = 'Daftar Juz Bot ~ My QUR`AN';
        $data['data'] = $quranData;
        $data['currentJuz'] = $juz;
        return view('bot.juz', $data);
    }
    
    public function surah()
    {
        $get = $this->quran->surahListStatis();
        $data['data'] = $get;
        $data['title'] = 'Daftar Surah Bot ~ My QUR`AN';
        return view('bot.surah', $data);
    }
    
    public function ayah()
    {
        $number = request()->get('number', 1);
        $get = $this->quran->getAyah((int)$number);
        $data['data'] = $get;
        $data['title'] = 'Ayat Bot ~ My QUR`AN';
        return view('bot.ayah', $data);
    }
    
    public function updatecounter()
    {
        $userid = request()->get('id');
        // In a real implementation with file-based storage, you would update a counter file
        // For now, we'll just return a JSON response
        return response()->json(['status' => 'success', 'message' => 'Counter updated for user ' . $userid]);
    }
    
    public function tafsir()
    {
        $userid = request()->get('id');
        $surah = request()->get('surah', 1);
        $get = $this->quran->tafsirSurah($surah);
        $data['data'] = $get;
        $data['title'] = 'Tafsir Bot ~ My QUR`AN';
        
        // Update tafsir counter for user
        // In a real implementation with file-based storage, you would update a counter file
        // For now, we'll just return the view
        return view('bot.tafsir', $data);
    }
    
    public function persurah()
    {
        $userid = request()->get('id');
        $surah = request()->get('surah', 1);
        $get = $this->quran->getSurah($surah);
        $data['data'] = $get;
        $data['title'] = 'Per Surah Bot ~ My QUR`AN';
        
        // Update persurah counter for user
        // In a real implementation with file-based storage, you would update a counter file
        // For now, we'll just return the view
        return view('bot.surah', $data);
    }
    
    public function perjuz()
    {
        $userid = request()->get('id');
        $juz = request()->get('juz', 1);
        $get = $this->quran->getJuzStatis($juz);
        $data['data'] = $get;
        $data['title'] = 'Per Juz Bot ~ My QUR`AN';
        
        // Update perjuz counter for user
        // In a real implementation with file-based storage, you would update a counter file
        // For now, we'll just return the view
        return view('bot.juz', $data);
    }

    public function handleWebhook(Request $request)
    {
        Log::info('Telegram webhook received:', $request->all());

        $chat_id = $request->input('message.chat.id');
        $message = $request->input('message.text');
        $contact = $request->input('message.contact');
        $location = $request->input('message.location');

        if ($chat_id) {
            $this->processUser($request);
        }

        if ($contact) {
            $this->handleContact($chat_id, $contact);
            return response('OK', Response::HTTP_OK);
        }

        if ($location) {
            $this->handleLocation($chat_id, $location);
            return response('OK', Response::HTTP_OK);
        }

        switch ($message) {
            case '/start':
                $this->handleStartCommand($chat_id);
                break;
        }

        return response('OK', Response::HTTP_OK);
    }

    private function handleStartCommand($chat_id)
    {
        $websiteUrl = config('app.url');
        $text = "<b>بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ</b>\n\nLife is so short. Let's make Al-Qur`an Kareem and Sunnah the leader of our life.\n\nWebsite: {$websiteUrl}\n\nThis bot developed by @cemonggaul\n\nDonate: https://paypal.me/cemonggaul";

        $buttons = $this->getWebAppButtons($chat_id);

        $this->telegram->sendMessage($chat_id, $text, json_encode($buttons));
    }

    private function processUser(Request $request)
    {
        $chat_id = $request->input('message.chat.id');
        $username = $request->input('message.chat.username');
        $firstName = $request->input('message.chat.first_name');
        $lastName = $request->input('message.chat.last_name');

        $user = \App\Models\User::firstOrCreate(
            ['chat_id' => $chat_id],
            [
                'name' => trim($firstName . ' ' . $lastName),
                'username' => $username,
                'password' => bcrypt(Str::random(16)) // Dummy password
            ]
        );

        return $user;
    }

    private function handleContact($chat_id, $contact)
    {
        $phone_number = ltrim($contact['phone_number'], '+');
        // Basic phone number formatting, you might need a more robust solution
        if (substr($phone_number, 0, 2) === '62') {
            $phone_number = '0' . substr($phone_number, 2);
        }

        $user = \App\Models\User::where('chat_id', $chat_id)->first();
        if ($user) {
            $user->update(['phone' => $phone_number]);
        }

        $text = "Yang kedua\nUntuk meminimalisir buyer BID and RUN, silahkan share lokasi Anda dengan klik tombol <b><em>KIRIM LOKASI</em></b> di bawah ini lalu pilih OK dan ijinkan kami untuk mengakses lokasi Anda saat ini. 🙏🏻";
        $button2 = '{"keyboard":[[{"text":"🗺🗺🗺 KIRIM LOKASI 🗺🗺🗺","request_location":true}]],"resize_keyboard":true,"one_time_keyboard":true}';

        $this->telegram->sendMessage($chat_id, $text, $button2);
    }

    private function handleLocation($chat_id, $location)
    {
        $user = \App\Models\User::where('chat_id', $chat_id)->first();
        if ($user) {
            $user->update([
                'latitude' => $location['latitude'],
                'longitude' => $location['longitude'],
            ]);
        }

        $this->telegram->removeKeyboard($chat_id, "<b>Terima kasih sudah mengikuti step by step pendaftaran dan\nSelamat datang di GO KOI Marketplace</b>");

        $text = "Klik tombol dibawah ini untuk melihat lapak para seller kami\n\nHappy shopping 🤗";
        $buttons = $this->getWebAppButtons($chat_id);

        $this->telegram->sendMessage($chat_id, $text, json_encode($buttons));
    }

    private function getWebAppButtons($chat_id)
    {
        return [
            "inline_keyboard" => [
                [
                    [
                        "text" => "🕌🕌🕋🕋🕋 READ QUR`AN 🕋🕋🕋🕌🕌",
                        "web_app" => ["url" => url('/bot')]
                    ]
                ],
                [
                    [
                        "text" => "🕌🕋 ID TRANSLATE PER JUZ 🕋🕌",
                        "web_app" => ["url" => url('/bot/juz')]
                    ]
                ],
                [
                    [
                        "text" => "🕌🕋 ID TRANSLATE PER SURAH 🕋🕌",
                        "web_app" => ["url" => url('/bot/surah')]
                    ]
                ],
                [
                    [
                        "text" => "🕌🕋 ID, EN TRANSLATE AND TAFSIR 🕋🕌",
                        "web_app" => ["url" => url('/bot/ayah')]
                    ]
                ],
                [
                    [
                        "text" => "🕌🕋 SETTING PRAYING TIME 🗝🗝",
                        "url" => url("/welcome/authorization?id=$chat_id")
                    ]
                ]
            ]
        ];
    }
}