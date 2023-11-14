<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    // public const HOME = '/home';
    public const ADMIN = '/admin/dashboard';
    public const KASI_PEMBIAYAAN = '/kasi-pembiayaan/dashboard';
    public const KASI_KEUANGAN = '/kasi-keuangan/dashboard';
    public const STAFF_LAPANGAN = '/staff-lapangan/dashboard';
    public const KEPALA_CABANG = '/kepala-cabang/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

                // Admin
            Route::middleware('web')
                ->group(base_path('routes/admin.php'));

            // Kasi Pembiayaan
            Route::middleware('web')
            ->group(base_path('routes/kasi_pembiayaan.php'));
        });
    }
}