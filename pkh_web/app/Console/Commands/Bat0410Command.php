<?php

namespace App\Console\Commands;

use Log;
use Carbon\Carbon;
use App\Services\Bat0410Service;
use App\Services\GoogeChatService;

class Bat0410Command extends BaseCommand
{
    /**
     * Calculate working hours
     * - fromDate: yyyyMMdd Default today
     * - toDate: yyyyMMdd Default today
     *      Ex: BAT0410 --fromDate=2018-10-01 --toDate=2018-10-30
     * - mode:
     *      + 1: this month
     *      + 2: last month
     *
     * @var string
     */
    protected $signature = 'BAT0410 {--fromDate=} {--toDate=} {--mode=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate working hours';

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
    public function handle(Bat0410Service $bat0410Service)
    {
        $this->writeStartLog();
        $fromDate = $this->getDateOptionAsString('fromDate', Carbon::today()->addDay(-30)->format('Y-m-d'), 'Y-m-d');
        $toDate   = $this->getDateOptionAsString('toDate', Carbon::today()->format('Y-m-d'), 'Y-m-d');


        $mode     = $this->getIntOption('mode', 1);
        $today    = Carbon::today();
        if ($mode == 2 ) {
            // get last month
            $lastmonth = $today->addMonths(-1);
            $fromDate  = $lastmonth->format('Y-m-01');
            $toDate    = $today->format('Y-m-d');
        }

        Log::info("Calculate working hours: " . $fromDate . " - " . $toDate);
        $this->googleChat->sendBatchLog("[BEGIN] " . date('Y-m-d H:i:s') . " BAT0410 $fromDate $toDate");
        $bat0410Service->updateTime($fromDate, $toDate);
        $this->googleChat->sendBatchLog("[END] " . date('Y-m-d H:i:s') . " BAT0410 $fromDate $toDate");
        $this->writeEndLog(" BAT0410 $fromDate $toDate");
    }
}
