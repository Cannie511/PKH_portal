<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm2330Service;

/**
 * Crm2330Controller
 */
class Crm2330Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2330Service;

    /**
     * @param Crm2330Service $crm2330Service
     */
    public function __construct(Crm2330Service $crm2330Service)
    {
        $this->crm2330Service = $crm2330Service;
        //$this->middleware( 'permission:screen.crm2330' );
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param  = $request->all();
        $result = $this->crm2330Service->selectBranchImport($param);

        return response()->success($result);
    }

}
