<?php

use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createAreaGroup();
        $this->command->info('AreaSeeder        [OK]');
    }

    private function createAreaGroup() {
        DB::table('mst_area_group')->delete();

        $sql = "ALTER TABLE mst_area_group AUTO_INCREMENT = 1";
        DB::statement($sql);
        
        $items = [
            ['name' => 'TP.HCM', 'payment_day' => 3],
            ['name' => 'Tây Nguyên', 'payment_day' => 5],
            ['name' => 'Miền Đông', 'payment_day' => 5],
            ['name' => 'Miền Tây', 'payment_day' => 4],
            ['name' => 'Bắc Trung Bộ', 'payment_day' => 5],
            ['name' => 'Nam Trung Bộ', 'payment_day' => 5],
            ['name' => 'Miền Bắc', 'payment_day' => 7],
            ['name' => 'Hà Nội', 'payment_day' => 7],
        ];

        $i = 1;
        foreach ($items as $item) {
            $item["area_group_id"] = $i++;
            $item["created_at"] = \Carbon\Carbon::now()->toDateTimeString();
            $item["updated_at"] = \Carbon\Carbon::now()->toDateTimeString();

            DB::table('mst_area_group')->insert($item);
        }
    }
}
