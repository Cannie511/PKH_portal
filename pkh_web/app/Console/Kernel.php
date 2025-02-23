<?php

namespace App\Console;

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
        Commands\Bat0100Command::class,
        Commands\Bat0110Command::class,
        Commands\Bat0131Command::class,
        Commands\Bat0132Command::class,
        Commands\Bat0210Command::class,
        Commands\Bat0220Command::class,
        Commands\Bat0230Command::class,
        Commands\Bat0240Command::class,
        Commands\Bat0913Command::class,
        Commands\Bat0310Command::class,
        Commands\Bat0250Command::class,
        Commands\Bat0200Command::class,
        Commands\Bat0410Command::class,
        Commands\Bat0420Command::class,
        Commands\Bat2100Command::class,
        Commands\Bat0912Command::class,
        Commands\Bat9999Command::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $today           = Carbon::today();
        $thisMonthString = $today->format('Y-m');

        // Tính toán doanh số cửa hàng mỗi ngày
        $schedule->command("BAT0100 --month=$thisMonthString")
            ->dailyAt('00:00');

        $schedule->command('BAT0230')
            ->dailyAt('00:05');

        $schedule->command('BAT0100')
            ->monthlyOn(1, '00:10');

        // Tinh timeline
        // $schedule->command('BAT0110')
        //     ->dailyAt('01:00');
        $schedule->command('BAT0110')
            ->twiceDaily(1, 12);

        // Tinh gio lam viec hang nay
        // $schedule->command('BAT0410')
        //     ->dailyAt('01:05');
        $schedule->command('BAT0420')
            ->dailyAt('01:05');

        // Tinh gio lam viec hang thang
        // $schedule->command('BAT0410 --mode=2')
        //     ->monthlyOn(1, '01:10');
    }
}
