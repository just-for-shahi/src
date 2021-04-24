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
        'App\Console\Commands\PingApiServer',
        'App\Console\Commands\StopMovedAccounts',
        'App\Console\Commands\StopDisabledAccounts',
        'App\Console\Commands\StopRemovedAccounts',
        'App\Console\Commands\ReloadAccounts',
        'App\Console\Commands\VerifyAccounts',
        'App\Console\Commands\PingAccounts',
        'App\Console\Commands\CheckAccountsTradable',
        'App\Console\Commands\UploadUpdatedBrokerServers',
        'App\Console\Commands\RefreshUserBrokerServers',
        'App\Console\Commands\UploadUpdatedFiles',
        'App\Console\Commands\RemoveOldTradeErrors',
        'App\Console\Commands\RemoveExpiredExpertSubscriptions',
        'App\Console\Commands\BuildEquity',
        'App\Console\Commands\MT4Manager\UsersRefresh',
        'App\Console\Commands\RestartInvalidAccounts',
        'App\Console\Commands\RecalcPortfolioStat',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('apiserver:ping')
            ->everyMinute();

        $schedule->command('accounts:stopmoved')
            ->everyMinute();

        $schedule->command('accounts:stopdisabled')
            ->everyMinute();

        $schedule->command('accounts:stopremoved')
            ->everyMinute();

        $schedule->command('accounts:reload')
            ->everyMinute();

        $schedule->command('accounts:verify')
            ->everyMinute();

        $schedule->command('accounts:ping')
            ->everyMinute();

        $schedule->command('accounts:check_tradable')
            ->hourly();

        $schedule->command('brokerservers:upload')
            ->everyMinute();

        $schedule->command('brokers:refresh')
            ->everyMinute();

        $mins = config('copier.restart_invalid_every_minutes');
        if( $mins && $mins != 0 ) {
            $schedule->command('accounts:restart_invalid')
                ->cron("*/$mins * * * *");
        }

        $schedule->command('portfolio:recalc_stat')
            ->everyFiveMinutes();

//        $schedule->command('files:upload')
//            ->everyMinute();

        $schedule->command('experts:cleanup')
            ->daily();

        $schedule->command('equity:build')
            ->daily();

        //$schedule->command('trades:cleanup')
            //->daily();
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
