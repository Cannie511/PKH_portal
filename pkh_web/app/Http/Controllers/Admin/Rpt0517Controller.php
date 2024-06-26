<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Rpt0517Service;

/**
 * Rpt0517Controller
 */
class Rpt0517Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $rpt0517Service;

    /**
     * @param Rpt0517Service $rpt0517Service
     */
    public function __construct(Rpt0517Service $rpt0517Service)
    {
        $this->rpt0517Service = $rpt0517Service;
        //$this->middleware( 'permission:screen.rpt0517' );
    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {
        $list   = $this->rpt0517Service->selectListUser();
        $result = [
            'userList' => $list,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();

        $list = $this->rpt0517Service->selectList($param);

        return response()->success($list);
    }

}
