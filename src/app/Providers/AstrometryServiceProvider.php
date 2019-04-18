<?php

namespace SpaceDB\Providers;

use Illuminate\Support\ServiceProvider;
use SpaceDB\Astrometry\AstrometryInterface;

class AstrometryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('SpaceDB\Astrometry\AstrometryInterface', function () {
            return new AstrometryInterface;
        });
    }
}
