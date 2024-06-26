<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\ETestService;
use App\Services\OrderService;
use App\Services\StoreService;
use App\Services\StatusService;
use App\Services\Das0100Service;
use App\Services\ProductService;
use App\Services\DownloadService;
use App\Services\FuncConfService;
use App\Services\Hrm1020Service;
use App\Services\SupplierService;
use App\Services\WarehouseService; 
use Log;
/**
 * Dashboard
 */
class Das0100Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    protected $funcConfService;
    /**
     * @var mixed
     */
    protected $orderService;
    /**
     * @var mixed
     */
    protected $productService;
    /**
     * @var mixed
     */
    protected $storeService;
    /**
     * @var mixed
     */
    protected $eTestService;
    /**
     * @var mixed
     */
    protected $downloadService;
    /**
     * @var mixed
     */
    private $statusService;
     /**
     * @var mixed
     */
    protected $supplierService;
      /**
     * @var mixed
     */
    protected $warehouseService;

    const ORDER_STATUS_TYPE    = 1;
    const DELIVERY_STATUS_TYPE = 2;
    /**
     * Constructor
     *
     * @param FuncConfService $funcConfService
     * @param OrderService $orderService
     * @param ProductService $productService
     * @param StoreService $storeService
     * @param ETestService $eTestService
     * @param Das0100Service $das0100Service
     */
    public function __construct(
        FuncConfService $funcConfService
        ,
        OrderService $orderService
        ,
        ProductService $productService
        ,
        StoreService $storeService
        ,
        ETestService $eTestService
        ,
        Das0100Service $das0100Service
        ,
        DownloadService $downloadService
        ,
        StatusService $statusService
        ,
        Hrm1020Service $hrm1020Service,
        SupplierService $supplierService
        ,
        WarehouseService $warehouseService
    ) {
        $this->funcConfService = $funcConfService;
        $this->orderService    = $orderService;
        $this->productService  = $productService;
        $this->storeService    = $storeService;
        $this->eTestService    = $eTestService;
        $this->das0100Service  = $das0100Service;
        $this->downloadService = $downloadService;
        $this->statusService   = $statusService;
        $this->hrm1020Service  = $hrm1020Service;
        $this->supplierService = $supplierService;
        $this->warehouseService = $warehouseService;
    }

//     public function postInitData()
//     {
//         $param            = [];
//         $param["sale_id"] = $this->getRoleSaleMan();
//         // Order Today
//         $orderToday = $this->das0100Service->selectOrderToday($param);
//         // Delivery Today
//         $deliveryToday = $this->das0100Service->selectDeliveryToday($param);
//         $supplierList  = $this->supplierService->selectSupplierDropDown();
// // Etest todo

// // $eTestTodo = $this->eTestService->getETestTodo();

// // Statistic order

// // $statisticOrder = $this->das0100Service->getStatisticsOrder();
//         // Statistic delivery
//         $p = [];
//         $statisticDelivery = $this->das0100Service->getStatisticsDelivery($p);
//         // Payment Today
//         $paymentToday = $this->das0100Service->selectPaymentToday($param);
//         // Import Today
//         $importToday = $this->das0100Service->selectImportToday();
//         // Get warehouse
//         $warehouse = $this->das0100Service->selectListProductInWarehouse();

//         $warehouse_list =  $this->warehouseService->selectWarehouseList();
//         $warehouse_no = [] ;
//         foreach ($warehouse_list as $item){
//             Log::debug("---warehouse check----");
//             Log::debug($item->warehouse_id);
//             $warehouse_no[$item->warehouse_id] = $this->das0100Service->selectListProductInWarehouse_specific($item->warehouse_id) ;
//         }
//         // // Get warehouse
//         // $warehouse_1 = $this->das0100Service->selectListProductInWarehouse_specific(1);
//         // // Get warehouse
//         // $warehouse_2 = $this->das0100Service->selectListProductInWarehouse_specific(2);
//         // // Get warehouse
//         // $warehouse_3 = $this->das0100Service->selectListProductInWarehouse_specific(3);
//         // // Get warehouse
//         // $warehouse_4 = $this->das0100Service->selectListProductInWarehouse_specific(4);
//         // // Get warehouse
//         // $warehouse_5 = $this->das0100Service->selectListProductInWarehouse_specific(5);
//         // Get preorder 
//         $preorder    = $this->das0100Service->selectPreOrder($param);
//         // Get Customer service today
//         $csToday = $this->das0100Service->selectCSToday($param);
//         // Get news
//         $news = $this->hrm1020Service->selectList([
//             'page_size' => 3
//         ]);
//         $param1  = [];
//         #SO2
//         $param1['sale_id'] = 30;
//         $so2Turnover       = $this->das0100Service->getStatisticsSalesman($param1);
//         #SO4
//         $param1['sale_id'] = 32;
//         $so4Turnover       = $this->das0100Service->getStatisticsSalesman($param1);
//         #SO3
//         $param1['sale_id'] = 33;
//         $so3Turnover       = $this->das0100Service->getStatisticsSalesman($param1);
//         #SO1
//         $param1['sale_id'] = 41;
//         $so1Turnover       = $this->das0100Service->getStatisticsSalesman($param1);
//         $index             = 0 ;
//         // Log::debug($warehouse);
//         foreach ($warehouse as $item) {
//             $index +=1 ;
//             foreach ($warehouse_no as $key=>$warehouse_item){
                
//                 foreach ($warehouse_item as $item_no) {
//                     if ($item->product_id == $item_no->product_id) {
//                         $var = "amount_".$key;
//                         $item->$var = $item_no->amount;
//                     }
//                 }
//             }
//             // foreach ($warehouse_1 as $item_1) {
//             //     if ($item->product_id == $item_1->product_id) {
//             //         $item->amount_1 = $item_1->amount;
//             //     }

//             // }

//             // foreach ($warehouse_2 as $item_2) {
//             //     if ($item->product_id == $item_2->product_id) {
//             //         $item->amount_2 = $item_2->amount;
//             //     }

//             // }

//             // foreach ($warehouse_3 as $item_3) {
//             //     if ($item->product_id == $item_3->product_id) {
//             //         $item->amount_3 = $item_3->amount;
//             //     }
//             // }

//             // foreach ($warehouse_4 as $item_4) {
//             //     if ($item->product_id == $item_4->product_id) {
//             //         $item->amount_4 = $item_4->amount;
//             //     }
//             // }

//             // foreach ($warehouse_5 as $item_5) {
//             //     if ($item->product_id == $item_5->product_id) {
//             //         $item->amount_5 = $item_5->amount;
//             //     }
//             // }

//             foreach ($preorder as $item_pre) {
//                 if ($item->product_id == $item_pre->product_id) {
//                     $item->amount_pre = $item_pre->amount;
//                 }
//             }
//         }

//         Log::debug("------ check item -----");
//         Log::debug($warehouse);
// // order web

// // $orderWebToday = $this->das0100Service->selectOrderWebToday();
//         // status order
//         $statusOrderList = $this->statusService->getStatus(SELF::ORDER_STATUS_TYPE);
//         // status delivery
//         $statusDeliveryList = $this->statusService->getStatus(SELF::DELIVERY_STATUS_TYPE);

//         $storeNeedOrder = $this->das0100Service->selectListStoreNeedOrder($param);

//         $needToPay = $this->das0100Service->getNeedToPay($param);
//         $result    = [
//             'storeNeedOrder' => $storeNeedOrder,
//             // 'orderWebToday'      => $orderWebToday,
//             'paymentToday'   => $paymentToday,
//             'importToday'    => $importToday,
//             'orderToday'     => $orderToday,
//             'deliveryToday'  => $deliveryToday,

// // 'eTestTodo'          => $eTestTodo,
//             // 'statisticOrder'     => $statisticOrder,
//             'statisticDelivery'  => $statisticDelivery,
//             'warehouse'          => $warehouse,
//             'statusOrderList'    => $statusOrderList,
//             'statusDeliveryList' => $statusDeliveryList,
//             'needToPay'          => $needToPay,
//             'csToday'            => $csToday,
//             'so1Turnover'        => $so1Turnover,
//             'so2Turnover'        => $so2Turnover,
//             'so3Turnover'        => $so3Turnover,
//             'so4Turnover'        => $so4Turnover,
//             'news'               => $news,
//             'supplierList'       => $supplierList,
//             'warehouseList'      => $warehouse_list,
//         ];

//         return response()->success($result);
//     }

    public function postSearchReport(Request $request){
        $param1 = $request->all();
        $statisticDelivery = $this->das0100Service->getStatisticsDelivery($param1);
        #SO2
        $param1['sale_id'] = 30;
        $so2Turnover       = $this->das0100Service->getStatisticsSalesman($param1);
        #SO4
        $param1['sale_id'] = 32;
        $so4Turnover       = $this->das0100Service->getStatisticsSalesman($param1);
        #SO3
        $param1['sale_id'] = 33;
        $so3Turnover       = $this->das0100Service->getStatisticsSalesman($param1);
        #SO1
        $param1['sale_id'] = 41;
        $so1Turnover       = $this->das0100Service->getStatisticsSalesman($param1);
        $result    = [
            'statisticDelivery'  => $statisticDelivery,
            'so1Turnover'        => $so1Turnover,
            'so2Turnover'        => $so2Turnover,
            'so3Turnover'        => $so3Turnover,
            'so4Turnover'        => $so4Turnover
        ];
        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postDownload(Request $request)
    {
        //$result = $this->das0100Service->downloadWarehouse();
        $warehouse = $this->das0100Service->selectListProductInWarehouse();
        // Get warehouse
        $warehouse_1 = $this->das0100Service->selectListProductInWarehouse_specific(1);
        // Get warehouse
        $warehouse_2 = $this->das0100Service->selectListProductInWarehouse_specific(2);
        // Get warehouse
        $warehouse_3 = $this->das0100Service->selectListProductInWarehouse_specific(3);
        // Get warehouse
        $warehouse_4 = $this->das0100Service->selectListProductInWarehouse_specific(4);

        foreach ($warehouse as $item) {
            $item->amount_1 = 0;

            foreach ($warehouse_1 as $item_1) {

                if ($item->product_id == $item_1->product_id) {
                    $item->amount_1 = $item_1->amount;
                }

            }

            $item->amount_2 = 0;

            foreach ($warehouse_2 as $item_2) {

                if ($item->product_id == $item_2->product_id) {
                    $item->amount_2 = $item_2->amount;
                }

            }
            $item->amount_3 = 0;

            foreach ($warehouse_3 as $item_3) {

                if ($item->product_id == $item_3->product_id) {
                    $item->amount_3 = $item_3->amount;
                }

            }
            $item->amount_4 = 0;

            foreach ($warehouse_4 as $item_4) {

                if ($item->product_id == $item_4->product_id) {
                    $item->amount_4 = $item_4->amount;
                }

            }

        }

        $paramDownload = [
            "data"      => $warehouse,
            "file_name" => "TonKho",
            "view"      => "das0100-warehouse",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

}
