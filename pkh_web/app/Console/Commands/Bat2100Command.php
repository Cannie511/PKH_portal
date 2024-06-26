<?php

namespace App\Console\Commands;

use Log;
use Carbon\Carbon;
use App\Services\Bat2100Service;
use App\Services\GoogeChatService;


class Bat2100Command extends BaseCommand
{
    /**
     *  Assign area for saleman
     *  Ex: BAT2100 area=1 saleman_id=1
     *
     * @var string
     */
    protected $signature = 'BAT2100 {mode} {id} {saleman_id}';

  
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
    public function handle(Bat2100Service $bat2100Service)
    {
        /*
        Mode = 1: update saleman_id by area
        Mode = 2: update saleman_id by store

        */
        $mode = $this->argument('mode');

        $id = $this->argument('id');
        $saleman_id       = $this->argument('saleman_id');
        
        if ($id == null || $saleman_id == null){
            return;
        }

        $this->googleChat->sendBatchLog("[BEGIN] " . date('Y-m-d H:i:s') . " BAT2100 $mode $id $saleman_id ");
        if ($mode == 1){
            $bat2100Service->updateAreaSaleman($id, $saleman_id);
        } else if ($mode == 2) {
            $bat2100Service->updateStoreSaleman($id, $saleman_id);
        }
        
        $this->googleChat->sendBatchLog("[END] " . date('Y-m-d H:i:s') . " BAT2100 $mode $id $saleman_id ");
    }
}
