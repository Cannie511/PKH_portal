<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm1820Service;

/**
 * Crm1820Controller
 */
class Crm1820Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1820Service;

    /**
     * @param Crm1820Service $crm1820Service
     */
    public function __construct(Crm1820Service $crm1820Service)
    {
        $this->crm1820Service = $crm1820Service;
        $this->middleware('permission:screen.crm1820');
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $list  = $this->crm1820Service->selectList($param);

        return response()->success($list);
    }

}
