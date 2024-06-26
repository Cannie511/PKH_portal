<?php

use Illuminate\Database\Seeder;

class TrnUserPosHisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create();
        $this->command->info('TrnUserPosHisSeeder        [OK]');
    }

    private function create() {
        DB::table('trn_user_pos_his')->delete();

        $sql = "ALTER TABLE trn_user_pos_his AUTO_INCREMENT = 1";
        DB::statement($sql);

        $slotTime = 2;
        $num = 24 * 3 * (60 / $slotTime);
        $trackTime = \Carbon\Carbon::now()->subHour(24 * 3);
        for ( $index = 1; $index < $num; $index++ ) {
            $item = [];

            $item["user_id"] = 1;
            $item["track_time"] = $trackTime->addMinute($slotTime)->subSecond(rand(1, 60));
            $item["gps_lat"] = 10.737462 + rand(1,100000) / 100000; 
            $item["gps_long"] = 106.711953 + rand(1,100000) / 100000; 
            $item["active_flg"] = 1;
            $item["created_by"] = 1;
            $item["updated_by"] = 1;
            $item["version_no"] = 1;
            $item["created_at"] = \Carbon\Carbon::now()->toDateTimeString();
            $item["updated_at"] = \Carbon\Carbon::now()->toDateTimeString();

            DB::table('trn_user_pos_his')->insert($item);

            if( $index % 100 == 0) {
                $this->command->info("--> trn_user_pos_his: $index/$num");
            }
        }

    }
}
