<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\PostPublishCommand::class,
        Commands\DatabaseBackup::class,
        Commands\MediaBackup::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('post:publish')->dailyAt('10:00')->after(function () {
          //post publish
        });
        $schedule->command('databasebackup:cron')->daily();
        $schedule->command('mediaBackup:cron')->daily();

        
        // $schedule->command('post:publish')->everyMinute();
        // $schedule->command('databasebackup:cron')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
