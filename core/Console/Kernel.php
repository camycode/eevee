<?php

namespace Core\Console;

use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Permission\Generate::class,
        Commands\Permission\Checkout::class,
        Commands\Resource\Make::class,
        Commands\Model\Make::class,
        Commands\Controller\Make::class,
        Commands\Route\Make::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}
