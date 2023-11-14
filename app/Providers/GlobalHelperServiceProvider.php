<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GlobalHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        require_once app_path().'/Helpers/Global_Helper.php';
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
