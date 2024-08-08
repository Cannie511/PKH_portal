<?php

namespace App\Console\Commands;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use App\Services\Bat4001Service;
class Bat4001Command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BAT4001';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Bat4001Service $bat4001Service)
    {
        Log::info("Bat dau Bat4001");
        $currentDate = Carbon::now();
        $currentMonth = $currentDate->month;
        $quarter = ceil($currentMonth / 3);//lấy quý 
        $currentYear = $currentDate->year;
        $bat4001Service->updataRetention( $currentYear, $quarter);
        Log::info("Cap nhat thanh cong");
    }
}
