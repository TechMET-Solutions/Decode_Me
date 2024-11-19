<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected $commands = [
        Commands\IndividualTaskMail::class,
        Commands\WorkshopFeedbackMail::class,
        Commands\GroupTaskMail::class,
        Commands\DMSessiomMail::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('users:taskmail')->everyMinute();
        $schedule->command('users:workshopmail')->everyMinute();
        $schedule->command('users:grouptaskmail')->everyMinute();
        $schedule->command('users:sessionmail')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
