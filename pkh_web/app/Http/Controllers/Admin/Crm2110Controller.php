<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Services\Crm2100Service;
use App\Services\Crm2110Service;
use App\Services\SalesmanService;

/**
 * Crm2110Controller
 */
class Crm2110Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2110Service;
    /**
     * @var mixed
     */
    private $crm2100Service;
    /**
     * @var mixed
     */
    protected $salesmanService;

    /**
     * @param Crm2110Service $crm2110Service
     * @param Crm2100Service $crm2100Service
     * @param SalesmanService $salesmanService
     */
    public function __construct(
        Crm2110Service $crm2110Service,
        Crm2100Service $crm2100Service
        ,
        SalesmanService $salesmanService
    ) {
        $this->crm2110Service  = $crm2110Service;
        $this->crm2100Service  = $crm2100Service;
        $this->salesmanService = $salesmanService;
        //$this->middleware( 'permission:screen.crm2110' );
    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {
        $salesmanList = $this->salesmanService->selectDropdown();
        $groupList    = $this->crm2100Service->selectGroupList();
        $param        = $request->all();
        $area         = null;

        if (isset($param['area_id'])) {
            $area = $this->crm2110Service->selectArea($param);
        }

        $result = [
            'groupList'    => $groupList,
            'salesmanList' => $salesmanList,
            'area'         => $area,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSave(Request $request)
    {
        $param = $request->all();
        $user  = Auth::user();
        $res   = $this->crm2110Service->saveArea($user, $param);

        return response()->success($res);
    }

}
