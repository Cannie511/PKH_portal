<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\User;

class InitDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('InitDataSeeder');
        // DB::unprepared(File::get('database\seeds\sql\init_data.sql'));
        // DB::unprepared(File::get('database\seeds\sql\init_data_trn.sql'));
        // DB::unprepared(File::get('database\seeds\sql\supplier.sql'));

        // Create data
        // $files = File::allFiles('database\\seeds\\sql\data\\');
        // foreach($files as $file) {
        //     if( ends_with($file, '.sql')) {
        //         $this->importFile($file);
        //     }
        // }

        $this->createFuncConf();
    }

    private function createFuncConf() {

        DB::table('mst_func_conf')->delete();

        $items = [
            [
                'func_key' => 'CMS_HOME_MARQUEE',
                'txt_val' => 'WaterTec Vietnam thông báo, các đại lý vui lòng nộp lại Bảng đăng ký làm đại lý phân phối WaterTec trước ngày 1/4/2017 để Phan Khang Home có cơ sở áp dụng các chính sách và hưởng các quyền lợi liên quan. mọi thắc mắc liên hệ cs@phankhangco.com hoặc hotline 0906 610 116 và bộ phận nhân viên kinh doanh phụ trách khu vực để lấy mẫu đăng ký. ( hoặc Đại lý nào cần gửi qua email, liên hệ công ty để lấy mẫu).Trân trọng thông báo.'
            ],
            [
                'func_key' => 'CMS_HOME_MARQUEE_2',
                'txt_val' => 'Phan Khang Home - thông báo tiếp nhận đơn hàng tháng 6/2017. Thời gian nhận đặt hàng từ 28/3 đến 31/3/2017 với chiết khấu tối thiểu 15%. Mọi thông tin liên hệ cs@phankhangco.com hoặc hotline 0906 610 116.'
            ]
        ];

        foreach ($items as $item) {
            $item["created_at"] = \Carbon\Carbon::now()->toDateTimeString();
            $item["updated_at"] = \Carbon\Carbon::now()->toDateTimeString();

            DB::table('mst_func_conf')->insert($item);
        }
    }

    private function importFile($name) {
        $this->command->info('-----> Import ' . $name);
        try {
            DB::unprepared(File::get($name));
        }
        catch(Exception $e) {
             $this->command->error('-----> importFile error ' . $name);
             $this->command->error('Caught exception: ' .  $e->getMessage() ."\n");
        }

        $pathinfo = pathinfo($name);
        $tableName = $pathinfo['filename'];

        if( $tableName != 'reset_password') {
            $sql = "select count(1) as count from " . $tableName;
            $count = DB::select(DB::raw($sql))[0]->count;
            $this->command->info('           Count ' . $tableName . ": " . $count);
        }        
    }
}
