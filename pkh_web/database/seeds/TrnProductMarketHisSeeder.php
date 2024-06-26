<?php

use Illuminate\Database\Seeder;

class TrnProductMarketHisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('TrnProductMarketHisSeeder        [Started]');

        $this->create();
    
        $this->command->info('TrnProductMarketHisSeeder        [Done]');
    }

    private function create() {

    	DB::table('trn_product_market_his')->truncate();

    	factory(App\Models\TrnProductMarketHis::class, 100)->create()->each(function($item) {
	        $item->save();        
	    });
    }
}
