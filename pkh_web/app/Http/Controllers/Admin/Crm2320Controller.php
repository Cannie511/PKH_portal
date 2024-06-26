<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm2320Service;

/**
 * Crm2320Controller
 */
class Crm2320Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2320Service;

    /**
     * @param Crm2320Service $crm2320Service
     */
    public function __construct(Crm2320Service $crm2320Service)
    {
        $this->crm2320Service = $crm2320Service;
        //$this->middleware( 'permission:screen.crm2320' );
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
//    public function postSearch(Request $request) {
    //        $param = $request->all();
    //        $data = $this->crm2320Service->selectList($param);
    //
    //        $result = [
    //            'data' => $data
    //        ];
    //        return response()->success($result);
    //    }

//    public function postSample(Request $request) {
    //        $this->requirePermission('screen.crm2320.sample');
    //
    //        $data = $this->crm2320Service->selectList($param);
    //        $result = [
    //            'data' => $data
    //        ];
    //        return response()->success($result);
    //    }

}
