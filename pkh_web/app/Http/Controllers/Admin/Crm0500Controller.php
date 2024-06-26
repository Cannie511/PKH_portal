<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\AreaService;
use App\Services\Crm0500Service;
use App\Services\DownloadService;
use App\Services\SalesmanService;

class Crm0500Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    protected $crm0500Service;
    /**
     * @var mixed
     */
    protected $salesmanService;

    /**
     * @param Crm0500Service $crm0500Service
     * @param SalesmanService $salesmanService
     * @param DownloadService $downloadService
     * @param AreaService $areaService
     */
    public function __construct(
        Crm0500Service $crm0500Service,
        SalesmanService $salesmanService,
        DownloadService $downloadService,
        AreaService $areaService
    ) {
        $this->crm0500Service  = $crm0500Service;
        $this->salesmanService = $salesmanService;
        $this->areaService     = $areaService;

        // $this->middleware('permission:screen.crm0700');
        // $this->middleware( 'role.sale' );
    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {
        $listAreaGroup = $this->areaService->selectListAreaGroup();
        $salesmanList  = $this->salesmanService->select4SalemanDropdown();
        $listArea1     = $this->areaService->selectListArea1();
        $listArea2     = $this->areaService->selectListArea2();

        $result = [
            'listAreaGroup' => $listAreaGroup,
            'listArea1'     => $listArea1,
            'listArea2'     => $listArea2,
            'salesmanList'  => $salesmanList,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $sts = ['0', '1', '2'];

        $param = $request->all();

        $param["sale_id"] = $this->getRoleSaleMan();
        $param["status"]  = $sts[$param["index"] - 1];

        $data = $this->crm0500Service->selectList($param);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

}
