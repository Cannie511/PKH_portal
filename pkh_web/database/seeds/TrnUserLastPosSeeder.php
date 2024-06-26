<?php

use Illuminate\Database\Seeder;

class TrnUserLastPosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create();
        $this->command->info('TrnUserLastPosSeeder        [OK]');
    }

    private function create() {
        DB::table('trn_user_last_pos')->delete();

        $sql = "ALTER TABLE trn_user_last_pos AUTO_INCREMENT = 1";
        DB::statement($sql);
        
        for ( $index = 1; $index < 10; $index++ ) {
            $item = [];

            $item["user_id"] = $index++;
            $item["track_time"] = \Carbon\Carbon::now()->subHour(rand(1, 10))->subMinute(rand(1, 60));
            $item["gps_lat"] = 10.737462 + rand(1,100000) / 100000; 
            $item["gps_long"] = 106.711953 + rand(1,100000) / 100000; 

            $item["active_flg"] = 1;
            $item["created_by"] = 1;
            $item["updated_by"] = 1;
            $item["version_no"] = 1;
            $item["created_at"] = \Carbon\Carbon::now()->toDateTimeString();
            $item["updated_at"] = \Carbon\Carbon::now()->toDateTimeString();

            DB::table('trn_user_last_pos')->insert($item);
        }

    }
}
