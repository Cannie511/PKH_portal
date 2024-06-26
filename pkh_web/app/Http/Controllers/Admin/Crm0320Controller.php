<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\AreaService;
use App\Services\Crm0320Service;
use App\Services\SalesmanService;

/**
 * Crm0320Controller
 * Phân cấp cửa hàng
 */
class Crm0320Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0320Service;

    /**
     * @param Crm0320Service $crm0320Service
     * @param SalesmanService $salesmanService
     * @param AreaService $areaService
     */
    public function __construct(
        Crm0320Service $crm0320Service,
        SalesmanService $salesmanService,
        AreaService $areaService
    ) {
        //$this->middleware( 'role.sale' );
        $this->salesmanService = $salesmanService;
        $this->areaService     = $areaService;
        $this->crm0320Service  = $crm0320Service;
    }

    /**
     * Get init data
     *
     * @param Request $request
     * @return void
     */
    public function postInit(Request $request)
    {
        $listSalesman  = $this->salesmanService->selectDropdown();
        $listAreaGroup = $this->areaService->selectListAreaGroup();
        $listArea1     = $this->areaService->selectListArea1();
        $listArea2     = $this->areaService->selectListArea2();

        $result = [
            'listSalesman'  => $listSalesman,
            'listAreaGroup' => $listAreaGroup,
            'listArea1'     => $listArea1,
            'listArea2'     => $listArea2,
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
        $list             = $this->crm0320Service->selectListStore($param);

        return response()->success($list);
    }
}
