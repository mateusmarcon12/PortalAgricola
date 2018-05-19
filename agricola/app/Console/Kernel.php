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
        /*$schedule->command('inspire')
            ->hourly();*/
/*
        $schedule->call(function () {
            $posts = DB::table('negociacaos')->where('id','1')
                ->update(['situacao' => 'ativa']);
*/
            /*foreach($posts as $post)
            {
                DB::table('negociacaos')
                    ->where('situacao','inativa')
                    ->update(['situacao' => 'ativa']);
            }
        })->everyMinute();*/

     //   $schedule->command('statistics:user')->everyThirtyMinutes();

/*
        $schedule->command('send:welcome')
            ->everyMinute()->when(function(){
                return !is_null($this->users);

            });
*/

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
