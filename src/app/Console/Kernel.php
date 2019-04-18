<?php

namespace SpaceDB\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use SpaceDB\Console\Commands\AstrometryGetJobStatus;
use SpaceDB\Console\Commands\AstrometryGetKnownObjectsFromJob;
use SpaceDB\Console\Commands\AstrometryGetSubmissionStatus;
use SpaceDB\Console\Commands\AstrometryStatus;
use SpaceDB\Console\Commands\AstrometrySubmitByFile;
use SpaceDB\Console\Commands\Astrometry\Submission;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        AstrometryGetJobStatus::class,
        AstrometryGetSubmissionStatus::class,
        AstrometryGetKnownObjectsFromJob::class,
        Submission::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
