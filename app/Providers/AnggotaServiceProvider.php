<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AnggotaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        require_once app_path().'/Helpers/Anggota.php';
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
