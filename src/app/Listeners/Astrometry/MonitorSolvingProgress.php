<?php

namespace SpaceDB\Listeners\Astrometry;

use Illuminate\Support\Facades\Log;
use SpaceDB\Events\Astrometry\DiscoveredSubmissionJobId;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use SpaceDB\Jobs\Astrometry\MonitorAstrometrySubmissionForSolvingSuccess;

class MonitorSolvingProgress
{
    /*
     * The delay before the first check is started, solving takes some minutes, so 60 seconds seems to be a good default.
     *
     * @var int
     */
    private $startDelay = 60;

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
     * @param  DiscoveredSubmissionJobId $event
     * @return void
     */
    public function handle(DiscoveredSubmissionJobId $event)
    {
        Log::info('The astrometry submission ' . $event->astrometryJob->submission_id . ' has received a job ID, starting job to monitor its solving progress');
        $submissionProgressMonitor = (new MonitorAstrometrySubmissionForSolvingSuccess($event->astrometryJob));
        $submissionProgressMonitor->onQueue('astrometry')->delay($this->startDelay);
        dispatch($submissionProgressMonitor);
    }
}
