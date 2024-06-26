<?php

namespace App\Console\Commands;

use Log;
use Illuminate\Console\Command;
use App\Services\Bat0310Service;
use App\Services\GoogeChatService;

class Bat0310Command extends BaseCommand
{
    /**
     * Tính số ngày công nợ
     *          php artisan BAT0310
     *
     * @var string
     */
    protected $signature = 'BAT0310';

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
    public function handle(Bat0310Service $bat0310Service)
    {
        Log::info("BAT0310");
        $this->googleChat->sendBatchLog("[BEGIN] " . date('Y-m-d H:i:s') . " BAT0310");
        $bat0310Service->calc();
        $this->googleChat->sendBatchLog("[END] " . date('Y-m-d H:i:s') . " BAT0310");
    }
}
