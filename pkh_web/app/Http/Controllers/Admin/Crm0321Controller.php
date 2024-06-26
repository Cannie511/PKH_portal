<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\AreaService;
use App\Services\Crm0321Service;
use App\Services\SalesmanService;

/**
 * Crm0321Controller
 * Theo dõi cửa hàng
 */
class Crm0321Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $Crm0321Service;

    /**
     * @param Crm0321Service $Crm0321Service
     * @param SalesmanService $salesmanService
     * @param AreaService $areaService
     */
    public function __construct(
        Crm0321Service $Crm0321Service,
        SalesmanService $salesmanService,
        AreaService $areaService
    ) {
        //$this->middleware( 'role.sale' );
        $this->salesmanService = $salesmanService;
        $this->areaService     = $areaService;
        $this->Crm0321Service  = $Crm0321Service;
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
        $list             = $this->Crm0321Service->selectListStore($param);

        return response()->success($list);
    }
}
