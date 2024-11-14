<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $locale = session('locale', config('app.locale'));  // Configuración predeterminada en config/app.php
        app()->setLocale($locale);
    }
    
}
