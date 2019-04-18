<?php

namespace SpaceDB\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // Astrometry Events
        'SpaceDB\Events\Astrometry\SubmissionSuccessful' => [
            'SpaceDB\Listeners\Astrometry\DiscoverJobId',
        ],
        'SpaceDB\Events\Astrometry\SubmissionError' => [
            //
        ],
        'SpaceDB\Events\Astrometry\DiscoveredSubmissionJobId' => [
            'SpaceDB\Listeners\Astrometry\MonitorSolvingProgress',
        ],

        // Image Events
        'SpaceDB\Events\Image\ImageUploaded' => [
            'SpaceDB\Listeners\Astrometry\SubmitImage',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        # ...
    }
}
