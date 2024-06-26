<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Services\Bat0913Service;
use App\Services\GoogeChatService;

class Bat0913Command extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BAT0913 {warehouse_id} {date} ';

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
    public function handle(Bat0913Service $bat0913Service)
    {
        $warehouse_id = $this->argument('warehouse_id');
        $pDate = $this->argument('date');
        if ($warehouse_id == null){
            return;
        }

        if (isset($pDate) && !empty($pDate)) {
            $temp     = Carbon::parse($pDate);
            $fromDate = $temp->format('Y-m-d');
        }

        $this->googleChat->sendBatchLog("[BEGIN] " . date('Y-m-d H:i:s') . " BAT0913 $fromDate");

        $bat0913Service->deleteChange($warehouse_id, $fromDate);

        $this->googleChat->sendBatchLog("[END] " . date('Y-m-d H:i:s') . " BAT0913 $fromDate");
    }

}
