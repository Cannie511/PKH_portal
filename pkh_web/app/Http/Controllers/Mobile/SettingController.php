<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;

/**
 * SettingController
 */
class SettingController extends MobileBaseController
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
            "gps_tracking" => [
                "enabled"    => 1,
                "start_time" => "07:00",
                "end_time"   => "18:00",
            ],
        ];

        return response()->success($param);
    }

}
