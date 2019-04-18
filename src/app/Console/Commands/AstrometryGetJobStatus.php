<?php

namespace SpaceDB\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use SpaceDB\Astrometry\AstrometryInterface;

class AstrometryGetJobStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'astrometry:status {jobId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the processing status of a astrometry job.';

    /*
     * Interface to the nova astrometry service.
     *
     * @var AstrometryInterface
     */
    private $astrometryInterface;

    /**
     * Create a new command instance.
     *
     * @param AstrometryInterface $astrometryInterface
     */
    public function __construct(AstrometryInterface $astrometryInterface)
    {
        $this->astrometryInterface = $astrometryInterface;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $jobStatus = $this->astrometryInterface->getJobInfo($this->argument('jobId'));
        dd($jobStatus);
    }
}
