<?php

use Illuminate\Database\Seeder;
use App\Models\TrnAttendance;

class TrnAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(TrnAttendance::class, 1000)->create()->each(function($item) {
	        $item->save();        
	    });
    }
}
