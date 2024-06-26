<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm1930Service;

/**
 * Crm1930Controller
 */
class Crm1930Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1930Service;

    /**
     * @param Crm1930Service $crm1930Service
     */
    public function __construct(Crm1930Service $crm1930Service)
    {
        $this->crm1930Service = $crm1930Service;
        //$this->middleware( 'permission:screen.crm1930' );
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
//    public function postSearch(Request $request) {
    //        $param = $request->all();
    //        $data = $this->crm1930Service->selectList($param);
    //
    //        $result = [
    //            'data' => $data
    //        ];
    //        return response()->success($result);
    //    }

//    public function postSample(Request $request) {
    //        $this->requirePermission('screen.crm1930.sample');
    //
    //        $data = $this->crm1930Service->selectList($param);
    //        $result = [
    //            'data' => $data
    //        ];
    //        return response()->success($result);
    //    }

}
