# Project Overview - MyQuran Laravel Refactor

## Project Description
This document provides an overview of the MyQuran project, which is a refactor from CodeIgniter 3 to Laravel while preserving all functionality and replacing database operations with file-based caching using JSON files.

## Architecture Overview

### System Components
- **Controllers**: QuranController, HaditsController, BotController, WelcomeController
- **Models**: QuranModel for data operations
- **Services**: CacheService for file-based caching
- **Views**: Blade templates with AMP support
- **Routing**: Web routes mapping URLs to controller methods

### Directory Structure
```
myquran-lara/
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   ├── Services/
├── resources/views/
│   ├── amp/
│   ├── bot/
├── storage/app/cache/
│   ├── quran/
│   ├── hadits/
│   ├── prayers/
│   └── locations/
└── public/inc/
    ├── audio/
    ├── css/
    ├── fonts/
    └── images/
```

## Key Features
1. File-based caching with JSON files instead of database
2. Integration with external APIs (Alquran.cloud, MyQuran.com, Equran.id, Telegram)
3. AMP (Accelerated Mobile Pages) support for mobile optimization
4. Comprehensive Quran and Hadits content
5. Prayer schedules and Islamic resources

## Data Sources
- Quran data stored in `storage/app/cache/quran/`
- Hadits data stored in `storage/app/cache/hadits/`
- Prayer data stored in `storage/app/cache/prayers/`
- Location data stored in `storage/app/cache/locations/`

## Caching Strategy
- File-based caching with TTL (Time To Live) settings
- Cache keys follow the format: `{category}_{identifier}`
- Different TTL values based on data type:
  - Quran data: 1 year
  - Hadits data: 1 year
  - Prayer schedules: 1 day
  - Metadata: 1 week

## API Integrations
- Alquran.cloud API for Quran text and translations
- MyQuran.com API for prayer times
- Equran.id API for tafsir data
- Telegram API for bot functionality

## Performance Considerations
- Efficient file-based caching with automatic expiration
- JSON file indexing for faster data retrieval
- Optimized data loading for large collections

## Development Guidelines
1. All data operations must use file-based caching
2. External API calls must have fallback mechanisms
3. Proper error handling is required for all methods
4. Code must follow PSR-12 coding standards
5. All classes and methods must have clear documentation

This overview can be used by AI models to understand the project structure and implementation approach for future development tasks.