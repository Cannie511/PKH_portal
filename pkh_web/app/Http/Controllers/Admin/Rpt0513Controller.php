<?php

namespace App\Http\Controllers\Admin;

use Log;
use Illuminate\Http\Request;
use App\Services\AreaService;
use App\Services\ProductService;
use App\Services\Rpt0512Service;
use App\Services\Rpt0513Service;
use App\Services\SalesmanService;
use App\Services\SupplierService;

/**
 * Rpt0513Controller
 */
class Rpt0513Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $rpt0513Service;
    /**
     * @var mixed
     */
    protected $productService;
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
     * @param Rpt0513Service $rpt0513Service
     * @param Rpt0512Service $rpt0512Service
     */
    public function __construct(
        Rpt0513Service $rpt0513Service,
        Rpt0512Service $rpt0512Service,
        ProductService $productService,
        SalesmanService $salesmanService,
        AreaService $areaService,
        SupplierService $supplierService
    ) {
        $this->rpt0513Service  = $rpt0513Service;
        $this->rpt0512Service  = $rpt0512Service;
        $this->productService  = $productService;
        $this->areaService     = $areaService;
        $this->salesmanService = $salesmanService;
        $this->supplierService = $supplierService;

        $this->middleware('permission:screen.rpt0513');
    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {

        $catList    = $this->productService->selectListCatForWeb();
        $handleList = $this->productService->selectListProductHandle();

        $listAreaGroup = $this->areaService->selectListAreaGroup();
        $listArea1     = $this->areaService->selectListArea1();
        $salesmanList  = $this->salesmanService->select4SalemanDropdown();
        $supplierList  = $this->supplierService->selectSupplierDropDown();
        $listViewMode = [[
            'id'   => 1,
            'name' => 'Xem theo sản phẩm',
        ],
            [
                'id'   => 2,
                'name' => 'Xem theo loại sản phẩm',
            ],
            [
                'id'   => 3,
                'name' => 'Xem theo handle',
            ],
        ];
        $listDataType = [
            [
                'id'   => 1,
                'name' => 'Số lượng',
            ],
            [
                'id'   => 2,
                'name' => 'Số tiền chưa CK (1.000 VND)',
            ],
            [
                'id'   => 5,
                'name' => 'Số cửa hàng',
            ],
            [
                'id'   => 6,
                'name' => 'Số tỉnh/thành',
            ],
        ];
        $result = [
            'listAreaGroup' => $listAreaGroup,
            'listArea1'     => $listArea1,
            'catList'       => $catList,
            'listDataType'  => $listDataType,
            'listViewMode'  => $listViewMode,
            'salesmanList'  => $salesmanList,
            'handleList'    => $handleList,
            'supplierList'  => $supplierList
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postLoadData(Request $request)
    {
        $param = $request->all();

Log::debug('ahihihi load part 1');

Log::debug($param);
        if (1 == $param["index"]) {
            $res = $this->rpt0513Service->loadOverview($param);

        } elseif (7 == $param["index"]) {
            $res = $this->rpt0513Service->loadPriceList($param);
        } else {
            $res = $this->rpt0513Service->loadData($param);
        }

        Log::debug($res);

        return response()->success($res);
    }

    /**
     * sản phẩm theo khu vực
     */
    public function postCompare(Request $request)
    {
        $param = $request->all();
        $res   = $this->rpt0513Service->getData($param, true);

        return response()->success($res['data']);
    }

    /**
     * @param Request $request
     */
    public function postDownload(Request $request)
    {
        //$this->requirePermission('screen.crm0910.download');

        $param  = $request->all();
        $result = $this->rpt0513Service->download($param);

        return response()->success($result);
    }

}
