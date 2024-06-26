<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm2000Service;

/**
 * Crm2000Controller
 */
class Crm2000Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2000Service;

    /**
     * @param Crm2000Service $crm2000Service
     */
    public function __construct(Crm2000Service $crm2000Service)
    {
        $this->crm2000Service = $crm2000Service;

        //$this->middleware( 'permission:screen.crm2000' );
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();

        $list = $this->crm2000Service->selectList($param);

        return response()->success($list);
    }

}
