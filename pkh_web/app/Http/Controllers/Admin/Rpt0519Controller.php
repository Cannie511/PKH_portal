<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Services\AreaService;
use App\Services\Rpt0100Service;
use App\Services\Rpt0519Service;
use App\Services\DownloadService;
use App\Services\SalesmanService;
use App\Services\SupplierService;
use Log;

/**
 * Rpt0517Controller
 */
class Rpt0519Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $rpt0519Service;
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
     * @param Rpt0519Service $rpt0517Service
     */
    public function __construct(
        Rpt0519Service $rpt0519Service
        ,
        Rpt0100Service $rpt0100Service,
        DownloadService $downloadService,
        SalesmanService $salesmanService,
        AreaService $areaService,
        SupplierService $supplierService
    ) {
        $this->rpt0519Service  = $rpt0519Service;
        $this->rpt0100Service  = $rpt0100Service;
        $this->areaService     = $areaService;
        $this->downloadService = $downloadService;
        $this->salesmanService = $salesmanService;
        $this->supplierService = $supplierService;
        // $this->middleware('permission:screen.rpt0519');
    }

    public function postInit()
    {
        // Get list year
     
        $salesmanList  = $this->rpt0519Service->selectSalesman();
        $productList = $this->rpt0519Service->selectProduct();
        $supplierList  = $this->supplierService->selectSupplierDropDown();
        $result = [
            'productList'   => $productList,
            'salesmanList'  => $salesmanList,
            'supplierList'  => $supplierList
        ];
        Log::debug("init data ");
        Log::debug($salesmanList );
        return response()->success($result);
    }

    public function prepare_data($param){
        // Doanh so giao hàng
        $data1 = $this->rpt0519Service->selectTurnover($param);
        foreach ($data1 as $obj){
            $list["turnover"]["name"]   =  "Doanh số giao";
            $list["turnover"][$obj->id] = $obj->amount;
        }

        // Số đơn giao
        foreach ($data1 as $obj){
            $list["count_del"]["name"]   =  "Số đơn giao";
            $list["count_del"][$obj->id] = $obj->count_del;
        }

         // số cửa hàng giao
         foreach ($data1 as $obj){
            $list["store_del"]["name"]   =  "Số cửa hàng giao";
            $list["store_del"][$obj->id] = $obj->store_del;
        }

        // So luowng san pham giao 
        // foreach ($data1 as $obj){
        //     $list["product_del"]["name"]   =  "Số sản phẩm giao";
        //     $list["product_del"][$obj->id] = $obj->product_del;
        // }

        // thowif gian xác nhận đơn
        foreach ($data1 as $obj){
            $list["confirm_time"]["name"]   =  "Thời gian xác nhận";
            $list["confirm_time"][$obj->id] = $obj->confirm_time;
        }

        // thowif gian xác nhận - vận chuyển
        foreach ($data1 as $obj){
            $list["shipping_time"]["name"]   =  "Thời gian giao";
            $list["shipping_time"][$obj->id] = $obj->shipping_time;
        }

       

        $data6 = $this->rpt0519Service->selectPayment($param);
        // tong thanh toan 
        foreach ($data6 as $obj){
            $list["payment"]["name"]   =  "Thanh toán";
            $list["payment"][$obj->id] = $obj->amount;
        }

         // tong thanh toan ck
         foreach ($data6 as $obj){
            $list["payment_ck"]["name"]   =  "Thanh toán CK";
            $list["payment_ck"][$obj->id] = $obj->ck;
        }

         // tong thanh toan cash 
         foreach ($data6 as $obj){
            $list["payment_cash"]["name"]   =  "Thanh toán TM";
            $list["payment_cash"][$obj->id] = $obj->cash;
        }

         // tong thanh toan tang  
         foreach ($data6 as $obj){
            $list["payment_inc"]["name"]   =  "Thanh toan +";
            $list["payment_inc"][$obj->id] = $obj->inc;
        }

        // tong thanh toán giảm  
        foreach ($data6 as $obj){
            $list["payment_decs"]["name"]   =  "Thanh toan -";
            $list["payment_decs"][$obj->id] = $obj->decs;
        }

        // so lan CK 
        foreach ($data6 as $obj){
            $list["count_ck"]["name"]   =  "Lần TT CK";
            $list["count_ck"][$obj->id] = $obj->count_ck;
        }

        // so lan TM
        foreach ($data6 as $obj){
            $list["count_cash"]["name"]   =  "Lần TT TM";
            $list["count_cash"][$obj->id] = $obj->count_cash;
        }

        $data7 = $this->rpt0519Service->selectPaymentStatus($param);
         // Coong no
         foreach ($data7 as $obj){
            $list["congno"]["name"]   =  "Công nợ";
            $list["congno"][$obj->id] = $obj->remain;
        }

        // Coong no
        foreach ($data7 as $obj){
            $list["delay"]["name"]   =  "Độ trễ thanh toán";
            $list["delay"][$obj->id] = $obj->delay;
        }

         $data3 = $this->rpt0519Service->selectStore($param);
         // tong so cua hang
         foreach ($data3 as $obj){
            $list["count_store"]["name"]   =  "Số cửa hàng";
            $list["count_store"][$obj->id] = $obj->count_store;
        }

        $data2 = $this->rpt0519Service->selectCheckin($param);
        // thowif gian xác nhận - vận chuyển
        foreach ($data2 as $obj){
           $list["count_checkin"]["name"]   =  "Số lần checkin";
           $list["count_checkin"][$obj->id] = $obj->count_checkin;
       }

        $data4 = $this->rpt0519Service->selectNewStore($param);
        // thowif gian xác nhận - vận chuyển
        foreach ($data4 as $obj){
           $list["count_new_store"]["name"]   =  "Số cửa hàng mới";
           $list["count_new_store"][$obj->id] = $obj->count_new_store;
       }

       $data5 = $this->rpt0519Service->selectOrderDay($param);
        //So cua hang <30 chua dat 
        foreach ($data5 as $obj){
           $list["under30"]["name"]   =  "CH < 30d";
           $list["under30"][$obj->id] = $obj->under30;
       }

        // So cua hang <60 chua dat 
        foreach ($data5 as $obj){
            $list["under60"]["name"]   =  "CH < 60d";
            $list["under60"][$obj->id] = $obj->under60;
        }

         // So cua hang <90 chua dat 
         foreach ($data5 as $obj){
            $list["under90"]["name"]   =  "CH < 90d";
            $list["under90"][$obj->id] = $obj->under90;
        }
 
        // So cua hang >90 chua dat 
        foreach ($data5 as $obj){
            $list["big90"]["name"]   =  "CH> 90d";
            if($list["count_store"][$obj->id]){
                $list["big90"][$obj->id] = $list["count_store"][$obj->id]- $obj->under90 -$obj->under60-$obj->under30;
            }
        }
 
        $listBig = [];
        foreach ($list as $item) {
            array_push($listBig, $item);
        }

        return $listBig;
    }

    public function prepare_data_product($param){
        $data = $this->rpt0519Service->selectSaleProduct($param);
        // $listBig = [];
        // tong thanh toan 
        foreach ($data as $obj){
            $list[$obj->salesman_id][$obj->product_id] = $obj->amount;
        }
        // $listBig = [];
        // foreach ($list as $item) {
        //     array_push($listBig, $item);
        // }

        return $list;
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $list = null;
        // if (1 == $param["index"]) {
        //     $list = $this->rpt0519Service->selectOverview($param);
        // } else {
        //     $list = $this->rpt0519Service->loadData($param, false);
        // }
        $listBig = $this->prepare_data($param);
        $listProduct = $this->prepare_data_product($param);

        $listBig2 = null;
        $to_date = null;
        $from_date = null;
        $diff_s = "";
        if (isset($param["to_date"]) && isset($param["from_date"])){
           
            $to_date=Carbon::createFromFormat('Y-m-d', $param["to_date"]);
            $from_date=Carbon::createFromFormat('Y-m-d', $param["from_date"]);

            $diff=date_diff($from_date,$to_date);
            $diff = $diff->format('%d') + 1;
            $diff_s = strval($diff).' days';
            $param2 = [];
           
            date_sub($to_date,date_interval_create_from_date_string($diff_s));
            
            date_sub($from_date,date_interval_create_from_date_string($diff_s));
            $param2["to_date"] = $to_date->format('Y-m-d');
            $param2["from_date"] = $from_date->format('Y-m-d');
            $param2["supplier_id"] = $param["supplier_id"];
            $listBig2 = $this->prepare_data($param2);
            $listProduct2 = $this->prepare_data_product($param2);

        }

        
       
        $result = [
            'data'   => $listBig,
            'data2'   => $listBig2,
            'data3'   => $listProduct,
            'data4'   => $listProduct2,
            'to_date' => $to_date,
            'from_date' => $from_date,
            'diff_s ' => $diff_s 
        ];
        Log::debug($result );
       
        return response()->success($result);
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
