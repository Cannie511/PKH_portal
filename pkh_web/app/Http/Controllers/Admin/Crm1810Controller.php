<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm1810Service;

/**
 * Crm1810Controller
 */
class Crm1810Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1810Service;

    /**
     * @param Crm1810Service $crm1810Service
     */
    public function __construct(Crm1810Service $crm1810Service)
    {
        $this->crm1810Service = $crm1810Service;
        $this->middleware('permission:screen.crm1810');
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $list  = $this->crm1810Service->selectList($param);

        return response()->success($list);
    }
}
