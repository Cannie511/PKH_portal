<?php

use Illuminate\Database\Seeder;

class MstProductMarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create();
        $this->command->info('MstProductMarketSeeder        [OK]');
    }

    private function create() {
        DB::table('mst_product_market')->delete();

        $sql = "ALTER TABLE mst_product_market AUTO_INCREMENT = 1";
        DB::statement($sql);

        $slotTime = 2;
        $num = 100;
        $trackTime = \Carbon\Carbon::now()->subHour(24 * 3);
        for ( $index = 1; $index < $num; $index++ ) {
            $item = [];

            $item["type"] = $index % 2 ? 1: 2;
            $item["name"] = "Item " . $index;
            $item["description"] = "description " . $index;
            $item["active_flg"] = 1;
            $item["created_by"] = 1;
            $item["updated_by"] = 1;
            $item["version_no"] = 1;
            $item["created_at"] = \Carbon\Carbon::now()->toDateTimeString();
            $item["updated_at"] = \Carbon\Carbon::now()->toDateTimeString();

            DB::table('mst_product_market')->insert($item);
        }

    }
}
