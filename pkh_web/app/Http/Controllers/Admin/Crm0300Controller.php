<?php

namespace App\Http\Controllers\Admin;

use App\Services\Crm3000Service;
use Illuminate\Http\Request;
use App\Services\AreaService;
use App\Services\Crm0300Service;
use App\Services\Rpt0511Service;
use App\Services\DownloadService;
use App\Services\SalesmanService;

/**
 * Crm0300Controller
 * Danh sách cửa hàng
 */
class Crm0300Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    protected $salesmanService;
    /**
     * @var mixed
     */
    protected $crm0300Service;
    /**
     * @var mixed
     */
    protected $crm3000Service;
    /**
     * @var mixed
     */
    protected $areaService;

    /**
     * @param SalesmanService $salesmanService
     * @param Rpt0511Service $rpt0511Service
     * @param Crm0300Service $crm0300Service
     * @param AreaService $areaService
     * @param DownloadService $downloadService
     */
    public function __construct(
        SalesmanService $salesmanService
        ,
        Rpt0511Service $rpt0511Service
        ,
        Crm0300Service $crm0300Service
        ,
        Crm3000Service $crm3000Service
        ,
        AreaService $areaService
        ,
        DownloadService $downloadService

    ) {
        $this->salesmanService = $salesmanService;
        $this->crm0300Service  = $crm0300Service;
        $this->crm3000Service  = $crm3000Service;
        $this->rpt0511Service  = $rpt0511Service;
        $this->areaService     = $areaService;
        $this->downloadService = $downloadService;
        //$this->middleware( 'role.sale' );
        //$this->middleware('permission:screen.crm0300');
    }

    /**
     * Get init data
     *
     * @param Request $request
     * @return void
     */
    public function postInit(Request $request)
    {
        $listSalesman  = $this->salesmanService->selectDropdownWithAllAndNone();
        $listAreaGroup = $this->areaService->selectListAreaGroup();
        $listArea1     = $this->areaService->selectListArea1();
        $listArea2     = $this->areaService->selectListArea2();
        $list          = $this->salesmanService->selectDropdown();
        $result = [
            'listSalesman'  => $listSalesman,
            'listAreaGroup' => $listAreaGroup,
            'listArea1'     => $listArea1,
            'listArea2'     => $listArea2,
            'salesman'      => $list,
        ];

        return response()->success($result);
    }

    /**
     * Get all users.
     *
     * @return JSON
     */
    public function postSearch(Request $request)
    {
        $param            = $request->all();
        $param["sale_id"] = $this->getRoleSaleMan();
        $list             = $this->crm0300Service->selectStoreList($param);
        foreach($list as $v){
            $v->scorecard = $this->crm3000Service->getTotalScore($param, $v->store_id);
        }
        return response()->success($list);
    }

    /**
     * @param Request $request
     */
    public function postUpdateSale(Request $request)
    {
        $this->requirePermission('screen.crm0300.assign');
        $param = $request->all();
        $list  = $this->crm0300Service->updateSaleForStore($param);

        return response()->success($list);
    }

    /**
     * @param Request $request
     */
    public function postDownload(Request $request)
    {
        $this->requirePermission('screen.crm0300.download');
        $param = $request->all();
        $param['down'] = 1;

        $data = $this->crm0300Service->selectStoreList($param);

        $paramDownload = [
            "data"      => $data,
            "file_name" => "CuaHang",
            "view"      => "crm0300-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postUpdateZalo(Request $request)
    {
        $this->requirePermission('screen.crm0300.update_zalo');
        // $param = $request->all();
        $result = $this->crm0300Service->updateZalo();

        return response()->success($result);
    }
}
