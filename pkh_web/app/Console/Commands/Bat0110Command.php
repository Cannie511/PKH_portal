<?php

namespace App\Console\Commands;

use Log;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Services\Bat0110Service;
use App\Services\GoogeChatService;

class Bat0110Command extends BaseCommand
{
    /**
     * The name and signature of the console command.
     * - fromDate: yyyyMMdd Default today
     *      Ex: 20171231
     *
     * @var string
     */
    protected $signature = 'BAT0110 {--fromDate=}';

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
    public function handle(Bat0110Service $bat0110Service)
    {
        $this->writeStartLog();
        $fromDate = null;

        if ($this->hasOption('fromDate')) {
            $pDate = $this->option('fromDate');

            if (isset($pDate) && !empty($pDate)) {
                $temp     = Carbon::parse($pDate);
                $fromDate = $temp->format('Y-m-d');
            }

        }

        Log::info("Cong no Excute from date: " . $fromDate);

        $this->googleChat->sendBatchLog("[BEGIN] " . date('Y-m-d H:i:s') . " BAT0110 --fromDate=" . $fromDate);

        $bat0110Service->updateProductTimeline($fromDate);

        $this->googleChat->sendBatchLog("[END] " . date('Y-m-d H:i:s') . " BAT0110 --fromDate=" . $fromDate);
        $this->writeEndLog();
    }

}
