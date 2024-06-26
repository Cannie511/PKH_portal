<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm0120Service;

/**
 * Crm0120Controller
 */
class Crm0120Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0120Service;

    /**
     * @param Crm0120Service $crm0120Service
     */
    public function __construct(Crm0120Service $crm0120Service)
    {
        $this->crm0120Service = $crm0120Service;
        //$this->middleware( 'permission:screen.crm0120' );
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $list  = $this->crm0120Service->selectListCat($param);

        return response()->success(["data" => $list]);
    }

}
