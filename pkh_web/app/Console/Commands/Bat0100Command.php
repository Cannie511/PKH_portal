<?php

namespace App\Console\Commands;

use Log;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Services\Bat0100Service;
use App\Services\GoogeChatService;

class Bat0100Command extends BaseCommand
{
    /**
     * The name and signature of the console command.
     * - month: yyyy-MM Default current
     *      Ex: 2017-01
     *          php artisan BAT0100 --month=2016-11
     *
     * @var string
     */
    protected $signature = 'BAT0100 {--month=}';

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
    public function handle(Bat0100Service $bat0100Service)
    {
        $this->writeStartLog();
        $today    = Carbon::today();
        $lastmonth = $today->addMonths(-1);
        $month = $lastmonth->format('Y-m');

        if ($this->hasOption('month')) {
            $pMonth = $this->option('month');

            if (isset($pMonth) && !empty($pMonth)) {
                $temp  = Carbon::parse($pMonth . '-01');
                $month = $temp->format('Y-m');
            }

        }

        Log::info('Bat0100Command: ' . $month);

        $this->googleChat->sendBatchLog("[BEGIN] " . date('Y-m-d H:i:s') . " BAT0100 --month=" . $month);

        $bat0100Service->updateStoreRevenue($month);
        
        $this->googleChat->sendBatchLog("[END] " . date('Y-m-d H:i:s') . " BAT0100 --month=" . $month);
        $this->writeEndLog();
    }

}
