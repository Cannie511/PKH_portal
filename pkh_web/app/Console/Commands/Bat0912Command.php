<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Log;
use Illuminate\Console\Command;
use App\Services\Bat0912Service;
use App\Services\GoogeChatService;

class Bat0912Command extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BAT0912 {mode} ';

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
    public function handle(Bat0912Service $bat0912Service)
    {
        $mode = $this->argument('mode');
       
        $res= $bat0912Service->findDuplicate();
        $res2 = $bat0912Service->findDuplicate2();
        $res3 = $bat0912Service->findDuplicate3();
        $bat0912Service->fixDuplicate();
        Log::debug($res);
        Log::debug($res2);
        Log::debug($res3);

        $this->googleChat->sendBatchLog("[BEGIN] " . date('Y-m-d H:i:s') . " BAT0912");

        $this->googleChat->sendBatchLog($res);
        $this->googleChat->sendBatchLog($res2);

        $this->googleChat->sendBatchLog("[END] " . date('Y-m-d H:i:s') . " BAT0912");
    }

}
