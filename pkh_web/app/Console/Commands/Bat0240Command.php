<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Bat0240Service;
use App\Services\GoogeChatService;

class Bat0240Command extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BAT0240 {storeOrderId} {newId}';

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
    public function handle(Bat0240Service $bat0240Service)
    {
        $storeOrderId = $this->argument('storeOrderId');
        $newId        = $this->argument('newId');

        //Log::info("BAT0210: $storeDeliveryId $productId $price $amount");
        //echo "BAT0210: $storeDeliveryId $productId $price $amount";
        $this->googleChat->sendBatchLog("[BEGIN] " . date('Y-m-d H:i:s') . " BAT0240 $storeOrderId $newId");

        $params = [
            "storeOrderId" => $storeOrderId,
            "newId"        => $newId,
        ];

        $bat0240Service->updateStoreOrderSalesman($params);

        $this->googleChat->sendBatchLog("[END] " . date('Y-m-d H:i:s') . " BAT0240 $storeOrderId $newId");
    }
}
