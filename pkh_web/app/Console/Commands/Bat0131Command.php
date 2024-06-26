<?php

namespace App\Console\Commands;

use Log;
use Illuminate\Console\Command;
use App\Services\Bat0131Service;
use App\Services\GoogeChatService;

class Bat0131Command extends BaseCommand
{
    /**
     * The name and signature of the console command.
     * - number: max number of ip
     *      Ex: 10
     *
     * @var string
     */
    protected $signature = 'BAT0131 {--num=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get login IP information';

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
    public function handle(Bat0131Service $bat0131Service)
    {
        $num = 5;

        if ($this->hasOption('num')) {
            $temp = $this->option('num');
            $num  = intval($temp);
        }

        Log::info("Get ip information: " . $num);
        $this->googleChat->sendBatchLog("[BEGIN] " . date('Y-m-d H:i:s') . " BAT0131 --num=" . $num);

        $bat0131Service->updateIp($num);

        $this->googleChat->sendBatchLog("[END] " . date('Y-m-d H:i:s') . " BAT0131 --num=" . $num);
    }

}
