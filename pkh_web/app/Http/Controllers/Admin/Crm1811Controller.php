<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Services\Crm1811Service;

/**
 * Crm1811Controller
 */
class Crm1811Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1811Service;

    /**
     * @param Crm1811Service $crm1811Service
     */
    public function __construct(Crm1811Service $crm1811Service)
    {
        $this->crm1811Service = $crm1811Service;
        //$this->middleware( 'permission:screen.crm1811' );
    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {
        $param  = $request->all();
        $data   = $this->crm1811Service->selectCostCat($param);
        $result = [
            'cost_cat' => $data,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSave(Request $request)
    {
        $param  = $request->all();
        $user   = Auth::user();
        $result = $this->crm1811Service->saveCostCat($user, $param);

        return response()->success($result);
    }

}
