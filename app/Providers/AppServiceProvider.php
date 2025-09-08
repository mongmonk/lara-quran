<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\QuranModel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register the QuranModel as a singleton with the 'quran' alias
        $this->app->singleton('quran', function ($app) {
            return new QuranModel();
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
