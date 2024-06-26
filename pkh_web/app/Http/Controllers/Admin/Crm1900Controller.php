<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm1900Service;

/**
 * Crm1900Controller
 */
class Crm1900Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1900Service;

    /**
     * @param Crm1900Service $crm1900Service
     */
    public function __construct(Crm1900Service $crm1900Service)
    {
        $this->crm1900Service = $crm1900Service;
        //$this->middleware( 'permission:screen.crm1900' );
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $list  = $this->crm1900Service->selectUserWeb($param);

        return response()->success(["data" => $list]);
    }
}
