<?php

namespace SpaceDB\Jobs\Astrometry;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Exception;
use SpaceDB\Astrometry\AstrometryInterface;
use SpaceDB\AstrometryJob;
use SpaceDB\Events\Astrometry\SubmissionError;
use SpaceDB\Events\Astrometry\SubmissionSuccessful;
use SpaceDB\Exceptions\AstrometryException;
use SpaceDB\Image;

class Submission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 20;

    /**
     * The astrometry job created for this submission.
     */
    public $astrometryJob;

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
     *
     * @param AstrometryInterface $astrometryInterface
     * @return void
     * @throws Exception
     */
    public function handle(AstrometryInterface $astrometryInterface)
    {
        Log::info('Astrometry image submission job started, try #' . $this->tries);
        // Try to submit the image to astrometry service
        try {
            $response = $astrometryInterface->uploadFromUrl($this->astrometryJob->image->plateSolveUrl());
        } catch (Exception $e) {
            Log::error('Failed to submit image to astrometry.net, error: ' . $e->getCode());
            $this->release(60);
            throw new AstrometryException('Failed to submit the image');
        }


        // The submission was successful, create a AstrometryJob model instance for it
        $this->astrometryJob->update([
            'submission_id' => $response->subid,
            'status' => 'submission_successful'
        ]);
        event(new SubmissionSuccessful($this->astrometryJob));
    }

    /**
     * The job failed to process.
     *
     * @param  AstrometryException $exception
     * @return void
     */
    public function failed(AstrometryException $exception)
    {
        // The submission failed, create a AstrometryJob model instance for it
        $this->astrometryJob->update([
            'status' => $exception->getMessage()
        ]);
        event(new SubmissionError($this->astrometryJob));
    }
}
