<?php

namespace App\Http\Controllers\Admin;

use Log;
use Illuminate\Http\Request;
use App\Services\AreaService;
use App\Services\Crm2400Service;
use App\Services\SalesmanService;

/**
 * Crm2400Controller
 */
class Crm2400Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2400Service;
    /**
     * @var mixed
     */
    protected $salesmanService;

    /**
     * @param Crm2400Service $crm2400Service
     * @param AreaService $areaService
     * @param SalesmanService $salesmanService
     */
    public function __construct(
        Crm2400Service $crm2400Service
        ,
        AreaService $areaService
        ,
        SalesmanService $salesmanService
    ) {
        $this->crm2400Service  = $crm2400Service;
        $this->salesmanService = $salesmanService;
        $this->areaService     = $areaService;
        //$this->middleware( 'permission:screen.crm2400' );
    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {

        $salesmanList = $this->salesmanService->selectDropdown();
        $listArea1    = $this->areaService->selectListArea1();
        $listArea2    = $this->areaService->selectListArea2();
        $result       = [
            'listArea1'    => $listArea1,
            'listArea2'    => $listArea2,
            'salesmanList' => $salesmanList,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param            = $request->all();
        $param["sale_id"] = $this->getRoleSaleMan();
        $list             = $this->crm2400Service->selectList($param);
        Log::debug('----------------check store list-----------');
        Log::debug($list);

        return response()->success($list);
    }

}
