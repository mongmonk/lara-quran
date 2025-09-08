<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuranController;
use App\Http\Controllers\HaditsController;
use App\Http\Controllers\BotController;
use App\Http\Controllers\WelcomeController;

// Default route - Quran index
Route::get('/', [QuranController::class, 'index']);

// Welcome controller routes
Route::get('/login', [WelcomeController::class, 'index'])->name('login');
Route::get('/welcome/authorization', [WelcomeController::class, 'authorization']);
Route::get('/storage/{file}', [WelcomeController::class, 'image'])->where('file', '.*');

// Quran controller routes
Route::get('/jadwal/{masjid}', [QuranController::class, 'jadwalsholatharian']);
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
Route::get('/quran/jadwalsholatharian/{masjid?}', [QuranController::class, 'jadwalsholatharian'])->name('quran.jadwalsholatharian')->middleware('auth');
    Route::post('/quran/jadwalsholatharian', [QuranController::class, 'storeJadwalSholatHarian'])->middleware('auth');
        Route::post('/quran/editjadwal/{masjid}', [QuranController::class, 'updateJadwalSholatHarian'])->middleware('auth');
        Route::get('/quran/editjadwal/{masjid}', [QuranController::class, 'editjadwal'])->middleware('auth');
Route::get('/quran/tahlil', [QuranController::class, 'tahlil']);
Route::get('/quran/about', [QuranController::class, 'about']);
Route::get('/quran/privacy', [QuranController::class, 'privacy']);
Route::get('/quran/partnerapi', [QuranController::class, 'partnerapi']);
Route::get('/quran/contact', [QuranController::class, 'contact']);
Route::post('/quran/contact', [QuranController::class, 'contact']);
Route::get('/quran/search', [QuranController::class, 'search']);
Route::get('/quran/doa', [QuranController::class, 'doa']);
Route::get('/quran/masjid/{masjidid?}', [QuranController::class, 'masjid']);
Route::get('/quran/meta', [QuranController::class, 'meta']);

// Hadits controller routes
Route::get('/hadits/bukhari/{page?}', [HaditsController::class, 'bukhari'])->where('page', '[0-9]+');
Route::get('/hadits/muslim/{page?}', [HaditsController::class, 'muslim'])->where('page', '[0-9]+');
Route::get('/hadits/abudaud/{page?}', [HaditsController::class, 'abudaud'])->where('page', '[0-9]+');
Route::get('/hadits/ahmad/{page?}', [HaditsController::class, 'ahmad'])->where('page', '[0-9]+');
Route::get('/hadits/darimi/{page?}', [HaditsController::class, 'darimi'])->where('page', '[0-9]+');
Route::get('/hadits/ibnumajah/{page?}', [HaditsController::class, 'ibnumajah'])->where('page', '[0-9]+');
Route::get('/hadits/malik/{page?}', [HaditsController::class, 'malik'])->where('page', '[0-9]+');
Route::get('/hadits/nasai/{page?}', [HaditsController::class, 'nasai'])->where('page', '[0-9]+');
Route::get('/hadits/tirmidzi/{page?}', [HaditsController::class, 'tirmidzi'])->where('page', '[0-9]+');
Route::get('/hadits/search/{book}', [HaditsController::class, 'search']);

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
