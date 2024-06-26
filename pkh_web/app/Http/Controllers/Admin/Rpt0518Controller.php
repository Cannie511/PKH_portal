<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\AreaService;
use App\Services\Rpt0100Service;
use App\Services\Rpt0518Service;
use App\Services\DownloadService;
use App\Services\SalesmanService;
use App\Services\SupplierService;
/**
 * Rpt0517Controller
 */
class Rpt0518Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $rpt0518Service;
    /**
     * @var mixed
     */
    protected $rpt0100Service;
    /**
     * @var mixed
     */
    protected $areaService;
    /**
     * @var mixed
     */
    protected $salesmanService;
/**
     * @var mixed
     */
    protected $supplierService;
    /**
     * @param Rpt0518Service $rpt0517Service
     */
    public function __construct(
        Rpt0518Service $rpt0518Service
        ,
        Rpt0100Service $rpt0100Service,
        DownloadService $downloadService,
        SalesmanService $salesmanService,
        AreaService $areaService,
        SupplierService $supplierService
    ) {
        $this->rpt0518Service  = $rpt0518Service;
        $this->rpt0100Service  = $rpt0100Service;
        $this->areaService     = $areaService;
        $this->downloadService = $downloadService;
        $this->salesmanService = $salesmanService;
        $this->supplierService = $supplierService;
        $this->middleware('permission:screen.rpt0518');
    }

    public function postInit()
    {
        // Get list year
        $listYear      = $this->rpt0100Service->selectListYear();
        $listAreaGroup = $this->areaService->selectListAreaGroup();
        $listArea1     = $this->areaService->selectListArea1();
        $salesmanList  = $this->salesmanService->select4SalemanDropdown();
        $supplierList  = $this->supplierService->selectSupplierDropDown();

        $listDataType = [[
            'id'   => 1,
            'name' => 'Doanh số chiết khấu (1.000 VND)',
        ],
            [
                'id'   => 2,
                'name' => 'Doanh số chưa chiết khấu (1.000 VND)',
            ],
            [
                'id'   => 3,
                'name' => 'Số đơn',
            ],
            [
                'id'   => 4,
                'name' => 'Trung bình chiết khấu (%)',
            ],
        ];
        $result = [
            'listYear'      => $listYear,
            'listArea1'     => $listArea1,
            'listAreaGroup' => $listAreaGroup,
            'listDataType'  => $listDataType,
            'salesmanList'  => $salesmanList,
            'supplierList'  => $supplierList
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();

        if (1 == $param["index"]) {
            $list = $this->rpt0518Service->selectOverview($param);
        } else {
            $list = $this->rpt0518Service->loadData($param, false);
        }

        return response()->success($list);
    }

    /**
     * @param Request $request
     */
    public function postDownload(Request $request)
    {
        //$this->requirePermission('screen.crm0910.download');
        $param = $request->all();
        $this->requirePermission('screen.rpt0518.download');

        if (1 == $param["index"]) {
            $list = $this->rpt0518Service->selectOverview($param);
            $name = "Store_Overview";
            $file = "rpt0518-list-overview";
        } elseif
        (2 == $param["index"]) {
            $list = $this->rpt0518Service->selectByMonth($param);
            $name = "Store_Bymonth";
            $file = "rpt0518-list-bymonth";
        } elseif
        (3 == $param["index"]) {
            $list = $this->rpt0518Service->selectComparison($param);
            $name = "Store_ByComparison";
            $file = "rpt0518-list-comparison";
        }

        $paramDownload = [
            "data"      => $list,
            "file_name" => $name,
            "view"      => $file,
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postCompare(Request $request)
    {
        $param = $request->all();
        $res   = $this->rpt0518Service->getData($param, true);

        return response()->success($res['data']);
    }

}
