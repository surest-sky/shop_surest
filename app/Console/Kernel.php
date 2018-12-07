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
     * 命令调度
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        # 调度清除缓存+重新计算活跃用户， 每隔五天
        $schedule->command('install:clear')
                 ->weekly()
                 ->weekdays()
                 ->at('23.00')
                 ->after(function (){
                     (new \App\Models\Adminer())->notify(new \App\Notifications\MsgToMailNotification('清除所有缓存的命令'));
                 });

        $schedule->command('me:subSend')
            ->dailyAt('9.00')
//            ->everyMinute()
            ->after(function (){
                (new \App\Models\Adminer())->notify(new \App\Notifications\MsgToMailNotification('给用户发送了订阅信息'));
            });

//        异步触发每三分钟更新商品的数据
        $schedule->command('update:category')
            ->everyFiveMinutes();
    }

    /**
     * Register the commands for the application
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
