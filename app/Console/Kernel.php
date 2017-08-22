<?php

namespace App\Console;
use App\Models\BlogPost;
use Carbon\Carbon;
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
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
       $schedule->call(function () {
        $unpublished = BlogPost::where('published', 0)->get();

        foreach ($unpublished as $key) {
            if($key->schedule != NULL && $key->schedule <= Carbon::now()){
                $key->published = 1;
                $key->save();
                $key->created_at = Carbon::now();
            }
        }
       })->everyMinute();
 
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
