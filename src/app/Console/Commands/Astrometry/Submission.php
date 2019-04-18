<?php

namespace SpaceDB\Console\Commands\Astrometry;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use SpaceDB\Image;
use SpaceDB\Jobs\Astrometry\Submission as SubmissionJob;

class Submission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'astrometry:submit {image_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch a job for plate solving a provided image';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('New astrometry submission started by artisan command');

        try {
            $image = Image::findOrFail($this->argument('image_id'));
            $submissionJob = (new SubmissionJob($image));
            $submissionJob->onQueue('astrometry');
            dispatch($submissionJob);
            $this->info('New job dispatched to astrometry queue');
        } catch(Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
