<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createNews();
        $this->command->info('NewsSeeder        [OK]');
    }

    private function createNews() {
        DB::table('mst_news')->delete();

        $sql = "ALTER TABLE mst_news AUTO_INCREMENT = 1";
        DB::statement($sql);
        
        $items = [
            [
                'publish_date' => Carbon::create(2016,11,9),
                'slug' => 'phan-khang-home-tro-thanh-don-vi-phan-phoi-chinh-thuc-cua-watertec-tai-thi-truong-viet-nam',
                'title' => 'Phan Khang Home trở thành đơn vị phân phối chính thức của WATERTEC tại thị trường Việt Nam'
            ],
            [
                'publish_date' => Carbon::create(2016,11,27),
                'slug' => 'san-pham-moi-voi-ve-sinh-cao-cap',
                'title' => 'Ra mắt sản phẩm mới vòi vệ sinh cao cấp'
            ],
            [
                'publish_date' => Carbon::create(2016,12,02),
                'slug' => 'su-kien-ky-hop-dong-nha-phan-phoi-doc-quyen-voi-watertec',
                'title' => 'Sự kiện ký hợp đồng nhà phân phối độc quyền với Watertec'
            ],
            [
                'publish_date' => Carbon::create(2016,12,16),
                'slug' => 'watertec-malysia-dang-ky-so-hua-doc-quyen-kieu-dang-cong-nghiep-san-pham-voi-xit-va-khoa-van-tay',
                'title' => 'Watertec Malaysia đăng ký sở hữu độc quyền kiểu dáng công nghiệp sản phẩm vòi xịt và khóa vặn tay'
            ],
            [
                'publish_date' => Carbon::create(2016,12,31),
                'slug' => 'bo-san-pham-watetec-ban-chay-nam-2016',
                'title' => 'Bộ sản phẩm Watetec bán chạy năm 2016'
            ],
            [
                'publish_date' => Carbon::create(2017,1,1),
                'slug' => 'ra-mat-voi-ve-sinh-cao-cap-vitus-401',
                'title' => 'Ra mắt vòi vệ sinh cao cấp Vitus 401'
            ],
            [
                'publish_date' => Carbon::create(2017,1,24),
                'slug' => 'watertec-ra-mat-san-pham-moi-2017',
                'title' => 'Watertec ra mắt sản phẩm mới 2017'
            ],
            [
                'publish_date' => Carbon::create(2017,2,13),
                'slug' => 'dong-san-pham-katana-cao-cap',
                'title' => 'Dòng sản phẩm KATANA cao cấp'
            ],
            [
                'publish_date' => Carbon::create(2017,2,28),
                'slug' => 'ra-mat-dong-san-pham-nong-lanh-moi-2017',
                'title' => 'Ra mắt dòng sản phẩm nóng lạnh mới 2017'
            ],
            [
                'publish_date' => Carbon::create(2017,3,4),
                'slug' => 'thong-bao-thay-doi-gia-san-pham-watertec-tu-quy-2-2017',
                'title' => 'Thông báo thay đổi giá sản phẩm Watertec từ Quý 2 năm 2017'
            ],
            [
                'publish_date' => Carbon::create(2017,3,16),
                'slug' => 'dong-san-phan-watertec-don-bay-don-slt',
                'title' => 'Dòng sản phẩm Watertec đòn bẩy đơn SLT'
            ],
            [
                'publish_date' => Carbon::create(2017,3,27),
                'slug' => 'dong-san-pham-watertec-quatro-chrome',
                'title' => 'Dòng sản phẩm Watertec Quatro Chrome'
            ],
            [
                'publish_date' => Carbon::create(2017,4,13),
                'slug' => 'dong-san-pham-voi-xit-watertec-401-va-501',
                'title' => 'Dòng sản phẩm vòi xịt Watertec 401 và 501'
            ],
            [
                'publish_date' => Carbon::create(2017,4,24),
                'slug' => 'top-10-san-pham-ban-chay-quy-1-2017',
                'title' => 'Top 10 sản phẩm bán chạy Quý 1 - 2017'
            ],
            [
                'publish_date' => Carbon::create(2017,4,24),
                'slug' => 'chuong-trinh-khuyen-mai-hap-dan-thang-5-2017',
                'title' => 'Chương trình khuyến mãi hấp dẫn tháng 5/2017'
            ],
            [
                'publish_date' => Carbon::create(2017,4,27),
                'slug' => 'dong-san-pham-voi-xit-malaysia-401-301',
                'title' => 'Dòng sản phẩm vòi xịt Malaysia 401 & 301'
            ],
            [
                'publish_date' => Carbon::create(2017,5,12),
                'slug' => 'dong-san-pham-katana-se-co-mat-tai-viet-nam-vao-ngay-15-6',
                'title' => 'Dòng sản phẩm Katana sẽ có mặt tại Việt Nam vào ngày 15/6'
            ],
            [
                'publish_date' => Carbon::create(2017,5,25),
                'slug' => 'dong-san-pham-katana-se-co-mat-tai-viet-nam-vao-ngay-15-6_2',
                'title' => 'Dòng sản phẩm Katana sẽ có mặt tại Việt Nam vào ngày 15/6. Báo tuổi trẻ ngày 25/5/2017'
            ],
            [
                'publish_date' => Carbon::create(2017,5,30),
                'slug' => 'su-kien-vietbuild-2017',
                'title' => 'Sự kiện Vietbuild 2017'
            ],
            [
                'publish_date' => Carbon::create(2017,6,7),
                'slug' => 'dong-san-pham-moi-nong-lanh-mixer',
                'title' => 'Dòng sản phẩm mới nóng lạnh Mixer'
            ],
            [
                'publish_date' => Carbon::create(2017,6,8),
                'slug' => 'dong-san-pham-moi-nong-lanh-mixer-dang-bao-tuoi-tre-ngay-8-6-2017',
                'title' => 'Dòng sản phẩm mới nóng lạnh Mixer ngày 8/6/2017'
            ],
            [
                'publish_date' => Carbon::create(2017,6,27),
                'slug' => 'hinh-anh-ve-trien-lam-vietbuild-2017',
                'title' => 'Hình ảnh về triển lãm Vietbuild 2017'
            ],
            [
                'publish_date' => Carbon::create(2017,7,1),
                'slug' => 'chuong-trinh-ho-tro-dai-ly-mua-1-duoc-100',
                'title' => 'Chương trình hỗ trợ đại lý mua 1 được 100'
            ],
            [
                'publish_date' => Carbon::create(2017,7,12),
                'slug' => 'dong-san-pham-moi-katana-dang-bao-tuoi-tre-12-07-2017',
                'title' => 'Dòng sản phẩm mới Katana đăng báo Tuổi trẻ ngày 12-07-2017'
            ],
            [
                'publish_date' => Carbon::create(2017,7,26),
                'slug' => 'dong-san-pham-moi-katana-dang-bao-tuoi-tre-26-07-2017',
                'title' => 'Dòng sản phẩm mới Katana đăng báo Tuổi trẻ ngày 26-07-2017'
            ],
            [
                'publish_date' => Carbon::create(2017,8,1),
                'slug' => 'voi-xit-ve-sinh-vitus-2-2017',
                'title' => 'Vòi xịt vệ sinh Vitus 2 - 2017'
            ]
        ];

        foreach ($items as $item) {
            $item["created_at"] = \Carbon\Carbon::now()->toDateTimeString();
            $item["updated_at"] = \Carbon\Carbon::now()->toDateTimeString();

            DB::table('mst_news')->insert($item);
        }
    }
}
