<?php

use App\Http\Controllers\BotController;
use App\Http\Controllers\HaditsController;
use App\Http\Controllers\QuranController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// Default route - Quran index
Route::get('/', [QuranController::class, 'index']);

// Welcome controller routes
Route::get('/login', [WelcomeController::class, 'index'])->name('login');
Route::get('/welcome/authorization', [WelcomeController::class, 'authorization']);
Route::post('/logout', [WelcomeController::class, 'logout'])->name('logout');
Route::get('/storage/{file}', [WelcomeController::class, 'image'])->where('file', '.*');

// Quran controller routes
Route::get('/jadwal/{masjid}', [QuranController::class, 'showJadwal']);
Route::get('/juz/{juz}', [QuranController::class, 'juz']);
Route::get('/surah/{surah}', [QuranController::class, 'surah']);
Route::get('/ruku/{ruku}', [QuranController::class, 'ruku']);
Route::get('/ayah/{ayah}', [QuranController::class, 'ayah']);

// Additional Quran routes
Route::get('/quran/page/{page?}', [QuranController::class, 'page'])->where('page', '[0-9]+');
Route::get('/quran/daftarjuz', [QuranController::class, 'daftarjuz']);
Route::get('/quran/daftarsurah', [QuranController::class, 'daftarsurah']);
Route::get('/quran/daftartafsir', [QuranController::class, 'daftartafsir']);
Route::get('/quran/daftarruku', [QuranController::class, 'daftarruku']);
Route::get('/quran/daftarayat', [QuranController::class, 'daftarayat']);
Route::get('/quran/daftarsajdah', [QuranController::class, 'daftarsajdah']);
Route::get('/quran/tafsir/{surah}', [QuranController::class, 'tafsir']);
Route::get('/quran/jadwalsholat', [QuranController::class, 'jadwalsholat']);
Route::get('/quran/jadwalsholatharian', [QuranController::class, 'jadwalsholatharian']);
Route::get('/quran/tahlil', [QuranController::class, 'tahlil']);
Route::get('/quran/about', [QuranController::class, 'about']);
Route::get('/quran/privacy', [QuranController::class, 'privacy']);
Route::get('/quran/partnerapi', [QuranController::class, 'partnerapi']);
Route::get('/quran/contact', [QuranController::class, 'contact']);
Route::post('/quran/contact', [QuranController::class, 'contact']);
Route::get('/quran/doa', [QuranController::class, 'doa']);
Route::get('/quran/masjid/{masjidid?}', [QuranController::class, 'masjid']);
Route::get('/quran/meta', [QuranController::class, 'meta']);

// Hadits controller routes
Route::get('/hadits/{book}/{page?}', [HaditsController::class, 'search'])->where('page', '[0-9]+');

// Bot controller routes
Route::get('/bot', [BotController::class, 'index']);
Route::get('/bot/juz', [BotController::class, 'juz']);
Route::get('/bot/surah', [BotController::class, 'surah']);
Route::get('/bot/ayah', [BotController::class, 'ayah']);
Route::get('/bot/updatecounter', [BotController::class, 'updatecounter']);
Route::get('/bot/tafsir', [BotController::class, 'tafsir']);
Route::get('/bot/persurah', [BotController::class, 'persurah']);
Route::get('/bot/perjuz', [BotController::class, 'perjuz']);
Route::post('/bot/webhook', [BotController::class, 'handleWebhook']);
Route::get('/bot/set-webhook', [BotController::class, 'setWebhook']);

// bot webview
// This is the secure entry point for the webview. It validates the user and logs them in.
Route::get('/bot/jadwalsholat/auth', [\App\Http\Controllers\BotController::class, 'jadwalSholatEntry'])
    ->middleware('web', 'telegram.signed')
    ->name('bot.jadwalsholat.entry');

// Once authenticated via the entry route, the user has a session and can access these routes.
Route::prefix('bot/jadwalsholat')->middleware('web', 'auth')->group(function () {
    Route::get('/', [\App\Http\Controllers\Bot\JadwalSholatController::class, 'index'])->name('bot.jadwalsholat.index');
    Route::get('/create', [\App\Http\Controllers\Bot\JadwalSholatController::class, 'create'])->name('bot.jadwalsholat.create');
    Route::post('/create', [\App\Http\Controllers\Bot\JadwalSholatController::class, 'store'])->name('bot.jadwalsholat.store');
    Route::get('/{masjid}/edit', [\App\Http\Controllers\Bot\JadwalSholatController::class, 'edit'])->name('bot.jadwalsholat.edit');
    Route::post('/{masjid}/edit', [\App\Http\Controllers\Bot\JadwalSholatController::class, 'update'])->name('bot.jadwalsholat.update');
});
