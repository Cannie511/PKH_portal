<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm1300Service;

/**
 * Crm1300Controller
 */
class Crm1300Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1300Service;

    /**
     * @param Crm1300Service $crm1300Service
     */
    public function __construct(Crm1300Service $crm1300Service)
    {
        $this->crm1300Service = $crm1300Service;
        $this->middleware('permission:screen.crm1300');
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $list  = $this->crm1300Service->selectList($param);

        return response()->success($list);
    }

}
