<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Das0110Service;

/**
 * Das0110Controller
 */
class Das0110Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $das0110Service;

    /**
     * @param Das0110Service $das0110Service
     */
    public function __construct(Das0110Service $das0110Service)
    {
        $this->das0110Service = $das0110Service;
        //$this->middleware( 'permission:screen.das0110' );
    }

    /**
     * Search order
     *
     * @param Request $request
     * @return void
     */
//    public function postSearch(Request $request) {
    //        $param = $request->all();
    //        $data = $this->das0110Service->selectList($param);
    //
    //        $result = [
    //            'data' => $data
    //        ];
    //        return response()->success($result);
    //    }

}
