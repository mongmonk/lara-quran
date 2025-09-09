# MyQur'an Laravel

## Deskripsi Proyek
MyQur'an adalah aplikasi web Al-Qur'an dan Hadits yang kaya fitur, yang awalnya dibangun dengan CodeIgniter dan sekarang telah di-refactor ke Laravel. Proyek ini dirancang untuk menyediakan akses mudah ke teks Al-Qur'an, terjemahan, tafsir, koleksi hadits, dan jadwal sholat. Salah satu fitur arsitektur utamanya adalah penggunaan sistem cache berbasis file JSON, yang menggantikan kebutuhan akan database tradisional untuk sebagian besar konten.

## Fitur Utama
*   **Penjelajahan Al-Qur'an:** Lihat Al-Qur'an berdasarkan Surah, Juz, Ruku', atau Halaman.
*   **Pencarian Lanjutan:** Cari di dalam teks Al-Qur'an dan koleksi Hadits.
*   **Koleksi Hadits:** Akses koleksi hadits dari para perawi besar seperti Bukhari, Muslim, Abu Daud, dan lainnya.
*   **Jadwal Sholat:** Dapatkan jadwal sholat yang akurat berdasarkan lokasi.
*   **Sumber Daya Islami:** Akses doa-doa harian dan bacaan Tahlil.
*   **Dukungan AMP:** Halaman yang dioptimalkan untuk seluler (Accelerated Mobile Pages) untuk pengalaman pengguna yang cepat di perangkat seluler.
*   **Integrasi Bot Telegram:** Berinteraksi dengan fungsionalitas Al-Qur'an melalui bot Telegram.
*   **Kustomisasi Masjid:** Pengguna dapat mendaftarkan masjid mereka dan menyesuaikan jadwal sholat.

## Teknologi yang Digunakan (Tech Stack)
*   **Framework:** Laravel 12.28.1
*   **Bahasa:** PHP 8.2.13
*   **Database:** SQLite (untuk sesi, cache, dan data relasional lainnya)
*   **Frontend:** Blade Templates, CSS, JavaScript
*   **Caching:** Sistem cache kustom berbasis file JSON
*   **Paket Utama:**
    *   `laravel/framework`: 12.28.1
    *   `laravel/prompts`: 0.3.6
    *   `laravel/pint`: 1.24.0
    *   `laravel/sail`: 1.45.0
    *   `phpunit/phpunit`: 11.5.36

## Panduan Instalasi dan Konfigurasi
1.  **Clone repositori:**
    ```bash
    git clone https://github.com/your-username/myquran-lara.git
    cd myquran-lara
    ```
2.  **Instal dependensi:**
    ```bash
    composer install
    npm install
    ```
3.  **Buat file `.env`:**
    Salin `.env.example` ke `.env` dan konfigurasikan variabel lingkungan Anda, terutama `APP_NAME`, `APP_URL`, dan `TELEGRAM_BOT_TOKEN`.
    ```bash
    cp .env.example .env
    ```
4.  **Hasilkan kunci aplikasi:**
    ```bash
    php artisan key:generate
    ```
5.  **Jalankan migrasi database:**
    Proyek ini menggunakan SQLite, jadi pastikan file `database/database.sqlite` ada.
    ```bash
    touch database/database.sqlite
    php artisan migrate
    ```
6.  **Jalankan server pengembangan:**
    ```bash
    php artisan serve
    ```

## Struktur Proyek
Proyek ini mengikuti struktur direktori standar Laravel, dengan beberapa penyesuaian penting:
*   `app/Http/Controllers`: Berisi controller utama untuk fungsionalitas Al-Qur'an, Hadits, Bot, dan halaman umum.
*   `app/Models`: Berisi model-model yang berinteraksi dengan data, termasuk `QuranModel` yang sekarang sudah tidak digunakan lagi dan digantikan oleh `CacheService`.
*   `app/Services`: Berisi `CacheService` untuk mengelola cache berbasis file dan `TelegramService` untuk integrasi bot.
*   `resources/views`: Berisi semua template Blade, dengan subdirektori untuk halaman AMP (`amp`) dan tampilan bot (`bot`).
*   `storage/app/cache`: Direktori utama untuk file cache JSON, diatur berdasarkan kategori (quran, hadits, prayers, locations).
*   `public/inc`: Berisi semua aset statis seperti gambar, font, audio, JS, dan CSS.

## Endpoint API
Aplikasi ini mengekspos beberapa endpoint untuk fungsionalitas intinya:
*   `/`: Halaman utama, menampilkan indeks Al-Qur'an.
*   `/surah/{surah}`: Menampilkan surah tertentu.
*   `/juz/{juz}`: Menampilkan juz tertentu.
*   `/hadits/{kitab}`: Menampilkan koleksi hadits dari kitab tertentu.
*   `/jadwal/{masjid}`: Menampilkan jadwal sholat untuk masjid tertentu.
*   `/bot/webhook`: Endpoint untuk webhook bot Telegram.

## Struktur Database
Meskipun sebagian besar data disajikan dari file JSON, database SQLite digunakan untuk tabel-tabel berikut:
*   `users`: Menyimpan informasi pengguna, termasuk detail Telegram untuk integrasi bot.
*   `sessions`: Menyimpan data sesi pengguna.
*   `cache` & `cache_locks`: Digunakan oleh sistem cache Laravel.
*   `jobs` & `failed_jobs`: Digunakan untuk antrian (queueing).
*   `jadwal_sholat_harian`: Menyimpan jadwal sholat yang dikustomisasi untuk masjid-masjid.

## Kontribusi
Saat ini, kontribusi tidak dibuka untuk proyek ini. Namun, Anda dapat melakukan fork pada repositori dan memodifikasinya sesuai kebutuhan Anda.
