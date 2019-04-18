<?php

namespace SpaceDB\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use SpaceDB\Astrometry\AstrometryInterface;

class AstrometryGetSubmissionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'astrometry:submission {submissionId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the status of a submission';

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
        $response = $this->astrometryInterface->getSubmissionStatus($this->argument('submissionId'));
        dd($response);
    }
}
