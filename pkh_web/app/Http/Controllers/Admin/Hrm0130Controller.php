<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Hrm0130Service;

/**
 * Hrm0130Controller
 */
class Hrm0130Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0130Service;
    /**
     * @param Hrm0130Service $hrm0130Service
     */
    public function __construct(Hrm0130Service $hrm0130Service)
    {
        $this->hrm0130Service = $hrm0130Service;
        //$this->middleware( 'permission:screen.hrm0130' );
    }

    public function postInit()
    {
        $listYear = $this->hrm0130Service->selectListYear();
        $result   = [
            'listYear' => $listYear,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param  = $request->all();
        $list_1 = $this->hrm0130Service->selectList($param);
        $list_2 = $this->hrm0130Service->selectListForSales($param);
        $list_3 = $this->hrm0130Service->selectListForCheckin($param);
        // Log::debug($list);
        $data = [
            'data_1' => $list_1,
            'data_2' => $list_2,
            'data_3' => $list_3,
        ];

        return response()->success($data);
    }

}
