<?php

namespace App\Console\Commands;

use Log;
use Illuminate\Console\Command;
use App\Services\Bat0220Service;
use App\Services\GoogeChatService;

class Bat0220Command extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BAT0220 {storeOrderId} {productId} {price}';

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
    public function handle(Bat0220Service $bat0220Service)
    {
        $storeOrderId = $this->argument('storeOrderId');
        $productId    = $this->argument('productId');
        $price        = $this->argument('price');

        if ($price <= 0) {
            return;
        }

        Log::info("BAT0220: $storeOrderId $productId $price");
        $this->googleChat->sendBatchLog("[BEGIN] " . date('Y-m-d H:i:s') . " BAT0220 $storeOrderId $productId $price");

        $params = [
            "storeOrderId" => $storeOrderId,
            "productId"    => $productId,
            "price"        => $price,
        ];

        $bat0220Service->updateStoreOrderProduct($params);

        $this->googleChat->sendBatchLog("[END] " . date('Y-m-d H:i:s') . " BAT0220 $storeOrderId $productId $price");
    }

}
