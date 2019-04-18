<?php

namespace SpaceDB\Console\Commands;

use Illuminate\Console\Command;
use SpaceDB\Astrometry\AstrometryInterface;
use SpaceDB\AstrometryJob;
use SpaceDB\Jobs\SubmitImage;

class AstrometrySubmitByURL extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'astrometry:uploadUrl {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch a job for plate solving a provided image';

    /*
     * The interface to the astrometry.net service
     *
     * @var AstrometryInterface
     */
    private $astrometryInterface;

    /**
     * Create a new command instance.
     * @internal param AstrometryInterface $astrometryInterface
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
        $submissionJob = (new SubmitImage($this->argument('url')));
        $submissionJob->onQueue('astrometry');
        $dispatched = dispatch($submissionJob);
        dd($dispatched);
    }
}
