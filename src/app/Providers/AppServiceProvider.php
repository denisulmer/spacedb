<?php

namespace SpaceDB\Providers;

use Illuminate\Support\ServiceProvider;
use SpaceDB\Astrometry\AstrometryInterface;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('GuzzleHttp\Client', function () {
            return new Client;
        });
        $this->app->bind('SpaceDB\Astrometry\AstrometryInterface', function () {
            return new AstrometryInterface;
        });
    }
}
