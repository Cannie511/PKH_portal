<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm2100Service;
use App\Services\SalesmanService;

/**
 * Crm2100Controller
 */
class Crm2100Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2100Service;
    /**
     * @var mixed
     */
    protected $salesmanService;

    /**
     * @param Crm2100Service $crm2100Service
     * @param SalesmanService $salesmanService
     */
    public function __construct(
        Crm2100Service $crm2100Service
        ,
        SalesmanService $salesmanService
    ) {
        $this->crm2100Service  = $crm2100Service;
        $this->salesmanService = $salesmanService;
        //$this->middleware( 'permission:screen.crm2100' );
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();

        $list = $this->crm2100Service->selectAreaList($param);

        return response()->success($list);
    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {
        $salesmanList = $this->salesmanService->selectDropdown();
        $groupList    = $this->crm2100Service->selectGroupList();

        $result = [
            'groupList'    => $groupList,
            'salesmanList' => $salesmanList,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postAssign(Request $request)
    {
        $param = $request->all();

        $list = $this->crm2100Service->implementAssigmentForSale();

        return response()->success($list);
    }

}
