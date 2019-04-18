<?php

namespace SpaceDB\Console\Commands;

use Illuminate\Console\Command;
use SpaceDB\Astrometry\AstrometryInterface;

class AstrometryGetKnownObjectsFromJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'astrometry:objects {jobId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Receive a list of known objects in a plate solved image';

    /*
     * The interface to the astrometry.net service
     *
     * @var AstrometryInterface
     */
    private $astrometryInterface;

    /**
     * Create a new command instance.
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
        $knownObjects = $this->astrometryInterface->getKnowObjects($this->argument('jobId'));
        dd($knownObjects);
    }
}
