<?php

namespace App\Console\Commands;

use Log;
use Illuminate\Console\Command;
use App\Services\Bat0210Service;
use App\Services\GoogeChatService;

class Bat0210Command extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BAT0210 {storeOrderId} {productId} {--price=}  {--amount=}';

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
    public function handle(Bat0210Service $bat0210Service)
    {
        $storeDeliveryId = $this->argument('storeDeliveryId');
        $productId       = $this->argument('productId');
        $price           = -1;
        $amount          = -1;

        if ($this->hasOption('price')) {
            $price = $this->option('price');
        }

        if ($this->hasOption('amount')) {
            $amount = $this->option('amount');
        }

        Log::info("BAT0210: $storeDeliveryId $productId $price $amount");
        $this->googleChat->sendBatchLog("[BEGIN] " . date('Y-m-d H:i:s') . " BAT0210 $storeDeliveryId $productId $price $amount");

        $params = [
            "storeDeliveryId" => $storeDeliveryId,
            "productId"       => $productId,
            "price"           => $price,
            "amount"          => $amount,
        ];

        $bat0210Service->updateStoreDeliveryProduct($params);

        $this->googleChat->sendBatchLog("[END] " . date('Y-m-d H:i:s') . " BAT0210 $storeDeliveryId $productId $price $amount");
    }

}
