<?php

namespace App\Console;

use App\BookingModel\TemporaryReservedSeats;
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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $date = new \DateTime();
            $date->modify('-10 minutes');
            $formatted_date = $date->format('Y-m-d H:i:s');
            $dataIds = TemporaryReservedSeats::where('created_at', '<=', $formatted_date)->pluck('id');
            foreach ($dataIds as $id) {
                TemporaryReservedSeats::find($id)->delete();
            }
        })->everyMinute();
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
