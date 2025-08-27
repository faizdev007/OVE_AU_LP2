<?php

namespace App\Providers;

use App\Services\Helper;
use App\Services\LandingPagePatch;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(LandingPagePatch::class, function ($app) {
            return new LandingPagePatch();
        });

        $this->app->singleton(Helper::class, function () {
            return new Helper();
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
