<?php

namespace SpaceDB\Listeners\Astrometry;

use Illuminate\Support\Facades\Log;
use SpaceDB\Events\Astrometry\SubmissionSuccessful;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use SpaceDB\Jobs\Astrometry\MonitorAstrometrySubmissionForJobId;

class DiscoverJobId
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
     * @param  SubmissionSuccessful  $event
     * @return void
     */
    public function handle(SubmissionSuccessful $event)
    {
        Log::info('Successful astrometry submission detected, starting job to discover its job ID');
        $submissionMonitor = (new MonitorAstrometrySubmissionForJobId($event->astrometryJob));
        $submissionMonitor->onQueue('astrometry')->delay(30);
        dispatch($submissionMonitor);
    }
}
