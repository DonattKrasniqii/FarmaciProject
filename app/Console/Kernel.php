<?php

namespace App\Console;

use App\Console\Commands\DeleteBuriedData;
use App\Console\Commands\DeleteunacceptedDrugs;
use App\Console\Commands\SendNotificationDaily;
use App\Console\Commands\SendSlackInfo;
use App\Jobs\SendNotification;
use App\Jobs\TestJob;
use App\Models\User;
use Dotenv\Util\Str;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use PHPUnit\Util\Test;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        DeleteunacceptedDrugs::class,
        DeleteBuriedData::class,
        SendSlackInfo::class

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {



        $schedule->job(new SendSlackInfo())->daily();

        $schedule->job(new DeleteunacceptedDrugs())
            ->cron('0 */12 * * *');




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
