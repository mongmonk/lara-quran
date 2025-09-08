# MyQuran Laravel Implementation Plan

## File Migration Strategy

### JSON Data Files (to be moved to storage/app/cache/)
1. ../myquran/inc/quran.json → storage/app/cache/quran/data.json
2. ../myquran/inc/doa.json → storage/app/cache/prayers/doa.json
3. ../myquran/inc/tahlil.json → storage/app/cache/prayers/tahlil.json
4. ../myquran/inc/lokasi.json → storage/app/cache/locations/lokasi.json
5. ../myquran/inc/books/*.json → storage/app/cache/hadits/*.json

### Static Assets (to be moved to public/inc/)
1. All image files (alquran.png, background.avif, etc.)
2. All font files (aldhabi.ttf, LPMQ.ttf)
3. All audio files (adzan/*.mp3)
4. All JavaScript files (bootstrap-multiselect.js, jquery.surah.js, etc.)
5. All CSS files (stylemasjid.css)

### Third-party Libraries
1. ../myquran/inc/books/ - Hadits data files
2. ../myquran/inc/log/ - Log files (may need special handling)

## Detailed Implementation Steps

### Phase 1: Environment Setup
1. Configure Laravel storage directory for cache files
2. Set up public directory for static assets
3. Configure file permissions for cache directory
4. Set up environment variables for API keys if needed

### Phase 2: Cache Management System
1. Create CacheService class in app/Services/
2. Implement JSON file reading/writing methods
3. Add caching with file modification time checks
4. Create directory structure in storage/app/cache/

### Phase 3: Data Models
1. Create QuranModel in app/Models/
2. Implement methods for:
   - getQuranStatis()
   - surahListStatis()
   - getJuzStatis($juz)
   - getSurah($surah)
   - getRuku($ruku)
   - getPage($page)
   - getAllRukuStatis()
   - getSajdah()
   - getAyah($number)
   - searchQuran($search)
   - getMeta()
   - tafsirSurah($surah)
   - getHadits($book, $num=false)
   - searchHadits($book, $search)
   - getDoa()
   - getTahlil()
   - getKota()
   - getJadwal($kota, $hari=false)
   - numConverter($num)

### Phase 4: Controllers
1. Create QuranController in app/Http/Controllers/
2. Create HaditsController in app/Http/Controllers/
3. Create BotController in app/Http/Controllers/
4. Create WelcomeController in app/Http/Controllers/
5. Implement all methods from original CodeIgniter controllers

### Phase 5: Routing
1. Set up routes in routes/web.php to match CodeIgniter routes
2. Implement URL patterns:
   - / (default - Quran index)
   - /login (Welcome controller)
   - /image/{file} (Welcome controller)
   - /jadwal/{masjid} (Quran controller)
   - /juz/{juz} (Quran controller)
   - /surah/{surah} (Quran controller)
   - /ruku/{ruku} (Quran controller)
   - /ayah/{ayah} (Quran controller)
   - /hadits/bukhari (Hadits controller)
   - /hadits/muslim (Hadits controller)
   - etc.

### Phase 6: Views
1. Create Blade templates in resources/views/
2. Migrate all AMP views to resources/views/amp/
3. Migrate bot views to resources/views/bot/
4. Maintain existing design and functionality
5. Implement responsive design principles

### Phase 7: API Integration
1. Implement external API calls for:
   - Alquran.cloud API for Quran data
   - MyQuran.com API for prayer times
   - Equran.id API for tafsir data
   - Telegram API for bot functionality
2. Add proper error handling and fallbacks
3. Implement caching for API responses

### Phase 8: Search Functionality
1. Implement search across Quran text
2. Implement search across Hadits text
3. Optimize search performance with indexing

### Phase 9: Testing
1. Test all routes and functionality
2. Verify data integrity
3. Test performance with caching
4. Validate responsive design
5. Check cross-browser compatibility

### Phase 10: Optimization
1. Optimize caching mechanisms
2. Implement lazy loading for large data sets
3. Optimize JSON file reading
4. Add proper error handling
5. Implement logging where needed

## Directory Structure Implementation

```
myquran-lara/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── QuranController.php
│   │   │   ├── HaditsController.php
│   │   │   ├── BotController.php
│   │   │   └── WelcomeController.php
│   │   └── routes/
│   ├── Models/
│   │   └── QuranModel.php
│   ├── Services/
│   │   └── CacheService.php
│   └── Helpers/
├── resources/
│   ├── views/
│   │   ├── amp/
│   │   ├── bot/
│   │   └── layouts/
│   └── assets/
├── storage/
│   └── app/
│       └── cache/
│           ├── quran/
│           │   ├── data.json
│           │   ├── metadata.json
│           │   └── index/
│           ├── hadits/
│           │   ├── bukhari.json
│           │   ├── muslim.json
│           │   └── ...
│           ├── prayers/
│           │   ├── doa.json
│           │   └── tahlil.json
│           └── locations/
│               └── lokasi.json
└── public/
    └── inc/
        ├── images/
        ├── fonts/
        ├── audio/
        ├── js/
        └── css/
```

## Key Classes to Implement

### CacheService
```php
class CacheService 
{
    public function get($key, $default = null);
    public function put($key, $value, $ttl = null);
    public function forget($key);
    public function flush();
    public function has($key);
}
```

### QuranModel
```php
class QuranModel 
{
    // All methods from original CodeIgniter model
    public function getQuranStatis();
    public function surahListStatis();
    // ... etc
}
```

### Controllers
- QuranController (all Quran-related methods)
- HaditsController (all Hadits-related methods)
- BotController (Telegram bot functionality)
- WelcomeController (authentication and general pages)

## API Integration Points

1. Alquran.cloud API - Quran text and translations
2. MyQuran.com API - Prayer times
3. Equran.id API - Tafsir data
4. Telegram API - Bot functionality

## Performance Considerations

1. File-based caching with proper TTL
2. JSON file indexing for faster searches
3. Lazy loading for large data sets
4. Memory-efficient JSON parsing
5. CDN for static assets