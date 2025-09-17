<?php

namespace App\Providers;

use App\Models\QuranModel;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register the QuranModel as a singleton with the 'quran' alias
        $this->app->singleton('quran', function ($app) {
            return new QuranModel;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
