<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm0911Service;

/**
 * Crm0911Controller
 */
class Crm0911Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0911Service;

    /**
     * @param Crm0911Service $crm0911Service
     */
    public function __construct(Crm0911Service $crm0911Service)
    {
        $this->crm0911Service = $crm0911Service;
        //$this->middleware( 'permission:screen.crm0911' );
    }

    /**
     * Search order
     *
     * @param Request $request
     * @return void
     */
//    public function postSearch(Request $request) {
    //        $param = $request->all();
    //        $data = $this->crm0911Service->selectList($param);
    //
    //        $result = [
    //            'data' => $data
    //        ];
    //        return response()->success($result);
    //    }

}
