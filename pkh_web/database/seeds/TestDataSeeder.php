<?php

use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('TestDataSeeder');

        $this->createStore();
    }

    private function createStore() {
    	$this->command->info('Create Store');	

    	DB::table('mst_dealer')->truncate();
    	DB::table('mst_store')->truncate();

    	factory(App\Models\MstDealer::class, 30)->create()->each(function($item) {
	        $numOfStore = rand(1, 30);

	        for( $i = 0; $i < $numOfStore; $i++) {
	        	$store = factory(App\Models\MstStore::class)->make();
		        $store->dealer_id = $item->dealer_id;
		        $store->save();	
	        }
	        
	    });
    }
}
