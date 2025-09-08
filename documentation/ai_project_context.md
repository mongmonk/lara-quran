# AI Project Context - MyQuran Laravel

## Project Overview
This document contains essential information about the MyQuran project for AI models to understand the context when working on future tasks.

## Project Structure
- Framework: Laravel
- Caching: File-based JSON caching
- APIs: Alquran.cloud, MyQuran.com, Equran.id, Telegram
- Views: Blade templates with AMP support

## Key Components

### Controllers
1. **QuranController** - Handles Quran-related functionality
   - Juz, Surah, Ayah, Ruku, Page views
   - Tafsir and search functionality
   - Prayer schedules

2. **HaditsController** - Handles Hadits collections
   - Bukhari, Muslim, Abu Daud, Ahmad, Darimi, Ibnu Majah, Malik, Nasai, Tirmidzi

3. **BotController** - Telegram bot functionality
   - Index, Ayah, Juz, Surah, Tafsir views

4. **WelcomeController** - Authentication and general pages

### Models
1. **QuranModel** - Main data model with methods for:
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

### Services
1. **CacheService** - File-based caching operations:
   - get($key, $default = null, $ttl = null)
   - put($key, $value)
   - forget($key)
   - has($key, $ttl = null)
   - flush()

## Data Storage
All data is stored as JSON files in `storage/app/cache/`:
- quran/ - Quran data
- hadits/ - Hadits collections
- prayers/ - Doa and Tahlil
- locations/ - Location data for prayer times

## Development Rules
1. Use file-based caching for all data operations
2. Implement proper error handling for API calls
3. Follow PSR-12 coding standards
4. Maintain AMP compatibility for views
5. Document all new classes and methods

## Caching Guidelines
- Quran data: 1 year TTL
- Hadits data: 1 year TTL
- Prayer schedules: 1 day TTL
- Metadata: 1 week TTL

## API Integration Points
1. Alquran.cloud - Quran text and translations
2. MyQuran.com - Prayer times
3. Equran.id - Tafsir data
4. Telegram - Bot functionality

This context information should be referenced by AI models when working on tasks related to this project.