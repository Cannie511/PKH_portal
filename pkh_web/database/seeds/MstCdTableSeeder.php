<?php

use Illuminate\Database\Seeder;

class MstCdTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('MstCdTableSeeder');
        
        DB::table('mst_cd')->truncate();

        $items = [
            "store_sts"  => [
                    [ "code_cd"    => "1", "code_name"  => "Lead", "code_value" => null ],
                    [ "code_cd"    => "2", "code_name"  => "Contact", "code_value" => null ],
                    [ "code_cd"    => "3", "code_name"  => "Pending", "code_value" => null ],
                    [ "code_cd"    => "4", "code_name"  => "Closed", "code_value" => null ],
                    [ "code_cd"    => "5", "code_name"  => "Black list", "code_value" => null ],
                ],
            "order_sts" => [
                [ "code_cd"    => "0", "code_name"  => "Mới", "code_value" => null ],
                [ "code_cd"    => "1", "code_name"  => "Đang soạn", "code_value" => null ],
                [ "code_cd"    => "2", "code_name"  => "Đã giao", "code_value" => null ],
                [ "code_cd"    => "4", "code_name"  => "Hoàn tất", "code_value" => null ],
                [ "code_cd"    => "5", "code_name"  => "Hủy", "code_value" => null ],
            ],
            "delivery_sts" => [
                [ "code_cd"    => "0", "code_name"  => "Mới", "code_value" => null ],
                [ "code_cd"    => "1", "code_name"  => "Đã giao", "code_value" => null ],
                [ "code_cd"    => "4", "code_name"  => "Hoàn tất", "code_value" => null ],
                [ "code_cd"    => "5", "code_name"  => "Hủy", "code_value" => null ],
            ]
        ];

        foreach ($items as $keyGroup => $group) {
            $itemIndex = 1;
            foreach ($group as $groupItem) {
                $groupItem["group_id"] = $keyGroup;
                $groupItem["display_order"] = $itemIndex;
                $groupItem["active_flg"] = '1';

                $groupItem["created_at"] = \Carbon\Carbon::now()->toDateTimeString();
                $groupItem["updated_at"] = \Carbon\Carbon::now()->toDateTimeString();

                $itemIndex++;

                DB::table('mst_cd')->insert($groupItem);
            }
        }
    }
}
