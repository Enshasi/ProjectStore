<?php

namespace App\Console;

use App\Jobs\DeleteExpiredOrders;
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
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // Delete all orders that are pending and older than 7 days
        //حذف جميع الطلبات التي تحتاج إلى الموافقة وأقدم من 7 أيام
        $schedule->job(new DeleteExpiredOrders)->everyMinute(); //بشكل يومي
        // $schedule->job(new DeleteExpiredOrders)->everyMinute(); //بشكل دقيقة
        // $schedule->job(new DeleteExpiredOrders)->everyFiveMinutes(); //بشكل 5 دقائق
       // $schedule->job(new DeleteExpiredOrders)->hourlyAt('03:00'); //بشكل 10 دقائق
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
