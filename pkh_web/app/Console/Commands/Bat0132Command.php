<?php

namespace App\Console\Commands;

use Log;
use Illuminate\Console\Command;
use App\Services\Bat0132Service;
use App\Services\GoogeChatService;

class Bat0132Command extends BaseCommand
{
    /**
     * Set location for store
     * - store_ids: list of store id
     *      Ex: 1,2,3
     * - limit: limit store
     *      Ex: 100
     *
     * @var string
     */
    protected $signature = 'BAT0132 {--store_ids=} {--limit=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get location of store';

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
    public function handle(Bat0132Service $bat0132Service)
    {
        $storeIds = $this->getArrayOption("store_ids", []);
        $limit    = $this->getIntOption("limit", 100);

        Log::info("Get location of store: " . print_r($storeIds, true) . " Limit: " . $limit);
        $this->googleChat->sendBatchLog("[BEGIN] " . date('Y-m-d H:i:s') . " BAT0132 --store_ids=" . print_r($storeIds, true) . " --limit=" . $limit);

        $bat0132Service->updateLocation($storeIds, $limit);

        $this->googleChat->sendBatchLog("[END] " . date('Y-m-d H:i:s') . " BAT0132 --store_ids=" . print_r($storeIds, true) . " --limit=" . $limit);
    }
}
