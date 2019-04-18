<?php

namespace SpaceDB\Jobs\Astrometry;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use SpaceDB\Astrometry\AstrometryInterface;
use SpaceDB\AstrometryJob;
use SpaceDB\Events\Astrometry\DiscoveredSubmissionJobId;
use SpaceDB\Exceptions\AstrometryException;

class MonitorAstrometrySubmissionForJobId implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * The time between discovery attempts.
     *
     * @var int
     */
    private $releaseTime = 30;

    /*
     * The astrometryJob that needs monitoring.
     *
     * @var AstrometryJob
     */
    private $astrometryJob;

    /**
     * Initialize job.
     *
     * @param AstrometryJob $astrometryJob
     */
    public function __construct(AstrometryJob $astrometryJob)
    {
        $this->astrometryJob = $astrometryJob;
    }

    /**
     * Execute the job.
     * @param AstrometryInterface $astrometryInterface
     * @return void
     * @throws Exception
     */
    public function handle(AstrometryInterface $astrometryInterface)
    {
        Log::info('Astrometry job ID discovery job started, try #' . $this->tries);

        $submissionId = $this->astrometryJob->submission_id;
        $response = $astrometryInterface->getSubmissionStatus($submissionId);

        if (count($response->jobs) == 0 || strlen($response->jobs[0] == 0)) {
            $this->release($this->releaseTime);
            throw new AstrometryException('No job ID was found for submission ' . $submissionId);
        } else {
            // Found the job ID, update the astrometry job and emit the event
            $jobId = $response->jobs[0];
            Log::info('Found the job ID ' . $jobId . ' for submission ' . $submissionId);
            $this->astrometryJob->update([
                'job_id' => $jobId,
                'status' => 'job_found'
            ]);
            event(new DiscoveredSubmissionJobId($this->astrometryJob));
        }
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        // The job id could not be discovered, this should not happen normally, but we will set the astrometry jobs status accordingly
        $this->astrometryJob->update([
            'status' => 'job_discovery_error'
        ]);
        # TODO: event(new AstrometryJobDiscoveryError($this->astrometryJob))
    }
}
