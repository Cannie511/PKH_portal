<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Services\SalaryService;

class Bat9999Command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BAT9999';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'TEST';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SalaryService $salaryService)
    {
        parent::__construct();
        $this->salaryService = $salaryService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $temp = $this->salaryService->calculatePIT(76369000 - 11000000);
    }
}
