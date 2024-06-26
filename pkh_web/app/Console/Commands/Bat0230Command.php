<?php

namespace App\Console\Commands;

use Log;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Services\Bat0230Service;
use App\Services\GoogeChatService;

class Bat0230Command extends BaseCommand
{
    /**
     * hủy hàng còn từ cuối tháng input trở về trước
     *          php artisan CRM0220
     *
     * @var string
     */
    protected $signature = 'BAT0230 {--month=}';

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
    public function __construct(GoogeChatService $googleChatService)
    {
        parent::__construct();
        $this->googleChat = $googleChatService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Bat0230Service $bat0230Service)
    {
        $month = date('Y-m');

        if ($this->hasOption('month')) {
            $pMonth = $this->option('month');

            if (isset($pMonth) && !empty($pMonth)) {
                $temp  = Carbon::parse($pMonth . '-01');
                $month = $temp->format('Y-m');
            }

        }

        Log::info('BAT0230: ' . $month);
        $this->googleChat->sendBatchLog("[BEGIN] " . date('Y-m-d H:i:s') . " BAT0230 $month");

        $bat0230Service->update($month);

        $this->googleChat->sendBatchLog("[END] " . date('Y-m-d H:i:s') . " BAT0230 $month");
    }

}
