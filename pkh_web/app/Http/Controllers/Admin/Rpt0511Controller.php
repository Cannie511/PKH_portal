<?php

namespace App\Http\Controllers\Admin;

use Log;
use Illuminate\Http\Request;
use App\Services\AreaService;
use App\Services\Crm0250Service;
use App\Services\ProductService;
use App\Services\Rpt0511Service;
use App\Services\Rpt0512Service;
use App\Services\Rpt0513Service;
use App\Services\Rpt0518Service;
use App\Services\SalesmanService;

/**
 * Rpt0511Controller
 */
class Rpt0511Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $rpt0511Service;
    /**
     * @var mixed
     */
    private $rpt0512Service;
    /**
     * @var mixed
     */
    private $rpt0513Service;
    /**
     * @var mixed
     */
    private $rpt0518Service;
    /**
     * @var mixed
     */
    private $crm0250Service;

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
     * @param Rpt0511Service $rpt0511Service
     */
    public function __construct(Rpt0511Service $rpt0511Service,
        Rpt0513Service $rpt0513Service,
        Rpt0512Service $rpt0512Service,
        Rpt0518Service $rpt0518Service,
        ProductService $productService,
        Crm0250Service $crm0250Service,
        SalesmanService $salesmanService,
        AreaService $areaService) {
        $this->rpt0511Service  = $rpt0511Service;
        $this->rpt0513Service  = $rpt0513Service;
        $this->rpt0512Service  = $rpt0512Service;
        $this->rpt0518Service  = $rpt0518Service;
        $this->productService  = $productService;
        $this->crm0250Service  = $crm0250Service;
        $this->salesmanService = $salesmanService;

        $this->areaService = $areaService;
        // $this->middleware('permission:screen.rpt0511');
    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {
        $catList       = $this->productService->selectListCatForWeb();
        $listAreaGroup = $this->areaService->selectListAreaGroup();
        $listArea1     = $this->areaService->selectListArea1();
        $salesmanList  = $this->salesmanService->select4SalemanDropdown();
        $sale_id       = $this->getRoleSaleMan();
        $is_sale       = 0;
        $listDataType  = [[
            'id'   => 1,
            'name' => 'Doanh số chiết khấu',
        ],
            [
                'id'   => 2,
                'name' => 'Doanh số chưa chiết khấu',
            ],
            [
                'id'   => 3,
                'name' => 'Số đơn',
            ],
            [
                'id'   => 4,
                'name' => 'Trung bình chiết khấu',
            ],
        ];

        if (null != $sale_id) {
            $is_sale = 1;
        }

        $result = [
            'listAreaGroup' => $listAreaGroup,
            'listArea1'     => $listArea1,
            'salesmanList'  => $salesmanList,
            'catList'       => $catList,
            'isSale'        => $is_sale,
            'listDataType'  => $listDataType,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postLoadData(Request $request)
    {
        $param   = $request->all();
        $sale_id = $this->getRoleSaleMan();

        if (null != $sale_id) {
            $param["salesman_id"] = $sale_id;
        }

        Log::debug('test tab 1111----------');

        switch ($param["index"]) {
            case 1:
                $param["down"] = 1;
                // $param["data_type"]="2";
                $param["index"] = 2;
                $res            = $this->rpt0518Service->loadData($param, false);

                return response()->success($res);

            case 2:
                $newParam          = $param;
                $newParam["index"] = 1;
                $res               = $this->rpt0512Service->loadData($newParam);

                return response()->success($res);

            case 3:
                $newParam          = $param;
                $newParam["index"] = 2;
                $res               = $this->rpt0513Service->loadData($newParam);

                return response()->success($res);

            case 4:
                $param['down'] = 1;
                $res           = $this->crm0250Service->selectListStore($param);

                return response()->success($res);
            default:
                return null;
        }

        return response()->success($res);
    }

}
