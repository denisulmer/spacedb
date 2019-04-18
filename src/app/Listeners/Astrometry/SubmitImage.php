<?php

namespace SpaceDB\Listeners\Astrometry;

use Illuminate\Support\Facades\Log;
use SpaceDB\Events\Image\ImageUploaded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use SpaceDB\Jobs\Astrometry\Submission;

class SubmitImage
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ImageUploaded  $event
     * @return void
     */
    public function handle(ImageUploaded $event)
    {
        Log::debug('Image was uploaded, starting plate solving');
        $plateSolvingJob = (new Submission($event->astrometryJob));
        $plateSolvingJob->onQueue('astrometry');
        dispatch($plateSolvingJob);
    }
}
