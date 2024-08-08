<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Services\eSmsService;
use App\Services\Crm4000Service;
use App\Services\Bat0000Service;

class Bat0000Command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BAT0000';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var eSmsService
     */
    private $esmsService;

    /**
     * @var Crm4000Service
     */
    private $crm4000Service;

    /**
     * @param eSmsService $esmsService
     * @param Crm4000Service $crm4000Service
     */
    public function __construct(eSmsService $esmsService, Crm4000Service $crm4000Service)
    {
        parent::__construct();
        $this->esmsService = $esmsService;
        $this->crm4000Service = $crm4000Service;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Bat0000Service $bat0000Service)
    {
        $currentDate = Carbon::now();
        $currentMonth = $currentDate->month;
        $quarter = ceil($currentMonth / 3);
        $currentYear = $currentDate->year;
        Log::info('Bat0000Command: ' . $currentMonth);
        $bat0000Service->sendSMSScoreCard($quarter, $currentYear);
        Log::info("Tin nhan duoc gui");
        
    }
}
