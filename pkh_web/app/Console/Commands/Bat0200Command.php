<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Bat0200Service;
use App\Services\GoogeChatService;

class Bat0200Command extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BAT0200';

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
    public function handle(Bat0200Service $bat0200Service)
    {
        $this->googleChat->sendBatchLog("[BEGIN] " . date('Y-m-d H:i:s') . " BAT0200");

        $bat0200Service->updateOrderCompletionPercent();

        $this->googleChat->sendBatchLog("[END] " . date('Y-m-d H:i:s') . " BAT0200");
    }
}
