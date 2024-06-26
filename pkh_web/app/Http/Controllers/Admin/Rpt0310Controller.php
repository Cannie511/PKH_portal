<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Rpt0310Service;

/**
 * Rpt0310Controller
 */
class Rpt0310Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $rpt0310Service;

    /**
     * @param Rpt0310Service $rpt0310Service
     */
    public function __construct(Rpt0310Service $rpt0310Service)
    {
        $this->rpt0310Service = $rpt0310Service;
        //$this->middleware( 'permission:screen.rpt0310' );
    }

    /**
     * Search order
     *
     * @param Request $request
     * @return void
     */
//    public function postSearch(Request $request) {
    //        $param = $request->all();
    //        $data = $this->rpt0310Service->selectList($param);
    //
    //        $result = [
    //            'data' => $data
    //        ];
    //        return response()->success($result);
    //    }

}
