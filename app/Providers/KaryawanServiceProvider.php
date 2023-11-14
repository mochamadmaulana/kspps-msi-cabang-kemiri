<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class KaryawanServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        require_once app_path().'/Helpers/Karyawan.php';
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
