<?php

namespace App\Http\Controllers\Admin;

use Log;
use Illuminate\Http\Request;
use App\Services\StoreService;
use App\Services\Crm0250Service;
use App\Services\Crm0500Service;
use App\Services\ProductService;
use App\Services\Rpt0513Service;
use App\Services\Rpt0514Service;
use App\Services\Hrm0152Service;
/**
 * Rpt0514Controller
 */
class Rpt0514Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $rpt0514Service;
    /**
     * @var mixed
     */
    protected $storeService;
    /**
     * @var mixed
     */
    protected $productService;
    /**
     * @var mixed
     */
    protected $crm0500Service;

    /**
     * @var mixed
     */
    private $crm0250Service;
    /**
     * @var mixed
     */
    private $hrm0152Service;

    /**
     * @param Rpt0514Service $rpt0514Service
     * @param StoreService $storeService
     */
    public function __construct(
        Rpt0514Service $rpt0514Service,
        Rpt0513Service $rpt0513Service,
        ProductService $productService,
        Crm0500Service $crm0500Service,
        Crm0250Service $crm0250Service,
        Hrm0152Service $hrm0152Service,
        StoreService $storeService
    ) {
        $this->crm0250Service = $crm0250Service;
        $this->rpt0514Service = $rpt0514Service;
        $this->rpt0513Service = $rpt0513Service;
        $this->hrm0152Service = $hrm0152Service;
        $this->storeService   = $storeService;
        $this->productService = $productService;
        $this->crm0500Service = $crm0500Service;

        $this->middleware('permission:screen.rpt0514');
    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {
        $param = $request->all();

        $catList      = $this->productService->selectListCatForWeb();
        $handleList   = $this->productService->selectListProductHandle();
        $store        = $this->storeService->selectStoreById($param['store_id']);
        $month        = $this->rpt0514Service->selectMonth($param);
        $year         = $this->rpt0514Service->selectYear($param);
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

        $result = [
            'store'        => $store,
            'month'        => $month,
            'year'         => $year,
            'catList'      => $catList,
            'listViewMode' => $listViewMode,
            'handleList'   => $handleList,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postLoadOverview(Request $request)
    {
        $param = $request->all();

        $res = [];

        if (!isset($param['store_id'])) {
            return $res;
        }

        $param['year'] = 2020;

        $deliveryData = $this->rpt0514Service->loadStoreDelivery($param);

        $data = [
            "deliveryData" => $deliveryData,
        ];

        return response()->success($data);
    }

    /**
     * @param Request $request
     */
    public function postLoadData(Request $request)
    {
        $param = $request->all();

        $res = [];

        if (!isset($param['store_id'])) {
            return $res;
        }

        if (1 == $param["index"]) {
            // $res = $this->rpt0513Service->loadOverview($param);
            $data = $this->rpt0514Service->selectStoreTurnover($param);
            foreach ($data as $obj){
                if (!isset( $list[$obj->year] )){
                    $list[$obj->year]['total'] = $obj->amount;
                } else {
                    $list[$obj->year]['total'] += $obj->amount;
                }
                $list[$obj->year][$obj->month] = $obj->amount;
            }
            $list1 = null;
            // check in 
            $data = $this->rpt0514Service->selectStoreCheckin($param);
            foreach ($data as $obj){
                if (!isset( $list1[$obj->year] )){
                    $list1[$obj->year]['total'] = $obj->amount;
                } else {
                    $list1[$obj->year]['total'] += $obj->amount;
                }
                $list1[$obj->year][$obj->month] = $obj->amount;
            }
            $list2 = null;
            // CS
            // $list2 = null;
            $data = $this->rpt0514Service->selectStoreCS($param);
            foreach ($data as $obj){
                if (!isset( $list2[$obj->year] )){
                    $list2[$obj->year]['total'] = $obj->amount;
                } else {
                    $list2[$obj->year]['total'] += $obj->amount;
                }
                $list2[$obj->year][$obj->month] = $obj->amount;
            }
             // payment sts
            // $list2 = null;
            // $list1 = null;
            $data = $this->rpt0514Service->selectStorePaymentStatus($param);
            foreach ($data as $obj){
                if (!isset( $list3[$obj->year] )){
                    $list3[$obj->year]['total'] = $obj->amount/12;
                } else {
                    $list3[$obj->year]['total'] += $obj->amount/12;
                }
                $list3[$obj->year][$obj->month] = $obj->amount;
            }
            $list4 = null;
            $data = $this->rpt0514Service->selectStorePaymentCK($param);
            foreach ($data as $obj){
                if (!isset( $list4[$obj->year] )){
                    $list4[$obj->year]['total'] = $obj->amount/12;
                } else {
                    $list4[$obj->year]['total'] += $obj->amount/12;
                }
                $list4[$obj->year][$obj->month] = $obj->amount;
            }
            $res = [
                'turnover' => $list ,
                'checkin'  => $list1,
                'cs'       => $list2,
                'payment'  => $list3,
                'paymentck'=> $list4

            ];
        } elseif (2 == $param["index"]) {
            $param["tab"] = 3;
            $res          = $this->rpt0513Service->loadData($param);
        }

        Log::debug($res);

        return response()->success($res);
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {

        $param = $request->all();
        $res   = [];

        if (!isset($param['store_id'])) {
            return $res;
        }

        if (3 == $param['index']) {
            $data = $this->crm0500Service->selectList($param);
        } elseif (4 == $param["index"]) {
            $data = $this->crm0250Service->selectList($param);

        }elseif (5 == $param["index"]) {
          
            $checkins = $this->hrm0152Service->getList($param);
            $images   = $this->hrm0152Service->getImages($checkins);
    
            $data = [
                'data' => $checkins,
                'images'   => $images,
            ];
        }



        $res = [
            'data' => $data,
        ];

        return response()->success($res);
    }

}
