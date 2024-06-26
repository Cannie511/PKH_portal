<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Bat0250Service;
use App\Services\GoogeChatService;

class Bat0250Command extends BaseCommand
{
    /**
     * The name and signature of the console command.
     * - fromDate: yyyyMMdd Default today
     *      Ex: 20171231
     *
     * @var string
     */
    protected $signature = 'BAT0250 {--fromDate=}';

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
    public function handle(Bat0250Service $bat0250Service)
    {
        $this->googleChat->sendBatchLog("[BEGIN] " . date('Y-m-d H:i:s') . " BAT0250");

        $bat0250Service->updateStoreDebt();

        $this->googleChat->sendBatchLog("[END] " . date('Y-m-d H:i:s') . " BAT0240");
    }

}
