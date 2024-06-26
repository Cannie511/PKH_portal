<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\AreaService;
use App\Services\Crm0330Service;
use App\Services\SalesmanService;

/**
 * Crm0330Controller
 * Theo dõi cửa hàng
 */
class Crm0330Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0330Service;

    /**
     * @param Crm0330Service $crm0330Service
     * @param SalesmanService $salesmanService
     * @param AreaService $areaService
     */
    public function __construct(
        Crm0330Service $crm0330Service,
        SalesmanService $salesmanService,
        AreaService $areaService
    ) {
        //$this->middleware( 'role.sale' );
        $this->salesmanService = $salesmanService;
        $this->areaService     = $areaService;
        $this->crm0330Service  = $crm0330Service;
    }

    /**
     * @param Request $request
     */
    public function postInit(Request $request)
    {
        $listSalesman = $this->salesmanService->selectDropdown();
        // $listAreaGroup = $this->areaService->selectListAreaGroup();
        $listArea1 = $this->areaService->selectListArea1();
        $listArea2 = $this->areaService->selectListArea2();

        $result = [
            'listSalesman' => $listSalesman,
            // 'listAreaGroup' => $listAreaGroup,
            'listArea1'    => $listArea1,
            'listArea2'    => $listArea2,
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
        $list             = $this->crm0330Service->selectListStore($param);

        return response()->success($list);
    }
}
