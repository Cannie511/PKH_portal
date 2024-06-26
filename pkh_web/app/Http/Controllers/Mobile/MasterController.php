<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;

/**
 * MasterController
 */
class MasterController extends MobileBaseController
{
    public function __construct()
    {
        //$this->middleware( 'permission:screen.cms0210' );
    }

    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        $param = [
            // 0: draft
            // 1: dang xuat hang -> khong cho sua
            // 2: dang giao hang
            // 4: Finish
            // 5: cancel
            "order_sts"    => [
                ["code" => "1", "name" => "Mới", "color" => "#00a65a"],
                ["code" => "2", "name" => "Đang xử lý", "color" => "#f39c12"],
                ["code" => "3", "name" => "Đang xử lý", "color" => "#f39c12"],
                ["code" => "4", "name" => "Hoàn tất", "color" => "#00c0ef"],
                ["code" => "5", "name" => "Hủy", "color" => "#d2d6de"],
                ["code" => "6", "name" => "Hủy còn lại", "color" => "#d2d6de"],
            ],
            "delivery_sts" => [
                ["code" => "1", "name" => "Mới", "color" => "#00a65a"],
                ["code" => "2", "name" => "Đóng gói", "color" => "#f39c12"],
                ["code" => "3", "name" => "Xuất kho", "color" => "#f39c12"],
                ["code" => "4", "name" => "Khách nhận", "color" => "#f39c12"],
                ["code" => "5", "name" => "Hoàn tất", "color" => "#00c0ef"],
                ["code" => "6", "name" => "Hủy", "color" => "#d2d6de"],
            ],
        ];

        return response()->success($param);
    }

}
