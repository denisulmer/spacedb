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
use SpaceDB\Events\Astrometry\SolvedSuccessful;
use SpaceDB\Exceptions\AstrometryException;
use SpaceDB\Object;

class MonitorAstrometrySubmissionForSolvingSuccess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 10;

    /**
     * Intervals between status updates in seconds.
     *
     * @var int
     */
    private $releaseTime = 60;

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
     * @throws AstrometryException
     */
    public function handle(AstrometryInterface $astrometryInterface)
    {
        Log::info('Monitor astrometry solving progress job started, try #' . $this->tries);

        // Request details about the jobs progress
        $response = $astrometryInterface->getJobInfo($this->astrometryJob->job_id);

        if ($response->status == 'solving' || $response->status == 'processing') {
            $this->astrometryJob->update(['status' => $response->status]);
            $this->release($this->releaseTime);
            Log::info('The current astrometry status for job ID ' . $this->astrometryJob->job_id . ' is ' . $response->status);
            throw new AstrometryException('The current astrometry status for job ID ' . $this->astrometryJob->job_Id . ' is ' . $response->status);
        } elseif ($response->status == 'success') {

            // Update the astrometry job
            $this->astrometryJob->update([
                'status' => 'solved',
                'ra' => $response->calibration->ra,
                'dec' => $response->calibration->dec,
                'pixel_scale' => $response->calibration->pixscale,
                'orientation' => $response->calibration->orientation,
                'radius' => $response->calibration->radius,
            ]);

            // Process found objects
            foreach($response->objects_in_field as $i => $objectName) {
                $object = Object::firstOrCreate(['name' => $objectName, 'slug' => str_slug($objectName)]);
                $this->astrometryJob->image->objects()->attach($object);
            }

            event(new SolvedSuccessful($this->astrometryJob));
            Log::info('The astrometry job ' . $this->astrometryJob->job_id . ' has been solved successfully');

        } elseif ($response->status == 'error' || starts_with($response->status, 'fail')) {
            $this->fail(new AstrometryException($response->status));
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
            'status' => 'failed'
        ]);
        # TODO: event(new AstrometrySolvingError($this->astrometryJob))
    }
}
