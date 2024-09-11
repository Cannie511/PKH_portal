<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Services\Bat4002Service;

class Bat4002Command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BAT4002';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cập nhật voucher cho các cửa hàng';

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
    public function handle(Bat4002Service $bat4002Service)
    {
        Log::info("Bắt đầu Bat4002");

        $currentDate = Carbon::now();
        $currentMonth = $currentDate->month;
        $quarter = ceil($currentMonth / 3); // Lấy quý
        $currentYear = $currentDate->year;

        // Gọi phương thức cập nhật voucher với year và quarter đã xác định
        $bat4002Service->updataVoucher($currentYear, $quarter);

        Log::info("Cập nhật thành công");
    }
}
