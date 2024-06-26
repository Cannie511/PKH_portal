<?php

namespace App\Services;

use DB;
use Carbon\Carbon;
use App\Models\TrnStoreDelivery;
use App\Services\StatusService;
use App\Services\DownloadService;
use App\Services\OrderService;
use App\Services\ESMS\Esms;

class Crm0400Service extends BaseService
{

    const DELIVERY_STATUS_TYPE = 2;
    protected $esms;
    /**
     * @param StatusService $statusService
     * @param DownloadService $downloadService
     */
    public function __construct(
        StatusService $statusService,
        DownloadService $downloadService,
        OrderService $orderService,
        Esms $esms
    ) {
        $this->statusService   = $statusService;
        $this->downloadService = $downloadService;
        $this->orderService    = $orderService;
        $this->esms            = $esms;
    }

    /**
     * @param $param
     * @param $user
     */
    public function updateShipping(
        $param,
        $user
    ) {
        $delivery = TrnStoreDelivery::find($param['store_delivery_id']);
    
        if ($delivery) {

            // Update  status of delivery 
            if (isset($param["shipping_id"])) {
                $delivery->shipping_id = $param["shipping_id"];
            } else {
                return false;
            }

            $delivery->shipping_time = Carbon::now();
            $delivery->shipping_by   = $user->name;
            $delivery->delivery_sts  = '8';
            $this->updateRecordHeader($delivery, $user, false);

            DB::transaction(function () use ($delivery) {
                $delivery->save();
            });
            $this->notifyViaESMS($param);
           
            return true;
        }

        return false;

    }

    public function notifyViaESMS($param){
             // Send ZNS to customer
             $item     = $param['item'];
             $delivery_code      =  explode("_", $item["store_delivery_code"]);
             $amount   = number_format($item["total_with_discount"],0)." VND";
             $new_delivery_code  =  $delivery_code[1]. "_". $delivery_code[2] . "_" .strval($param['store_delivery_id']);
             $id = "don-hang?orderId=".$new_delivery_code;
             $data = [substr($item["store_name"],0,30)
                     ,substr($item["address"],0,80)
                     ,Carbon::now()->format('Y-m-d')
                     ,$new_delivery_code 
                     ,$item["supplier_name"]
                     , $amount
                     ,"Vận chuyển"
                     , $id ];
             $key = "217669";
             $phone = $item["contact_mobile1"];
             $this->esms->post($key, $phone, $item["store_id"], $data);

    }

    /**
     * @param $param
     * @param $user
     */
    public function updateReceive(
        $param,
        $user
    ) {
        $delivery = TrnStoreDelivery::find($param['store_delivery_id']);

        if ($delivery) {
            $this->updateRecordHeader($delivery, $user, false);
            $delivery->receive_time = Carbon::now();
            $delivery->receive_by   = $user->name;
            $delivery->delivery_sts = '9';
            DB::transaction(function () use ($delivery) {
                $delivery->save();
            });
            $this->notifyViaESMSRating($param);
            return true;
        }

        return false;

    }

    public function notifyViaESMSRating($param){
        // Send ZNS to customer
        $item     = $param['item'];
        $delivery_code      =  explode("_", $item["store_delivery_code"]);
        $new_delivery_code  =  $delivery_code[1]. "_". $delivery_code[2] . "_" .strval($param['store_delivery_id']);
        $data = [
                $new_delivery_code 
                 ];
        $key = "217316";
        $phone = $item["contact_mobile1"];
        $this->esms->post($key, $phone, $item["store_id"], $data);

    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectDeliveryStats($param)
    {
        $sqlParam = array();
        $sql      = "
        select
                date(a.delivery_time) as date_time
                , dayname(a.delivery_time)  as day_name
                , sum(a.total_with_discount)  as selling_amount
                , sum(a.volume) as volume
                , sum(a.carton) as carton
                , count( distinct a.store_id) as store_numb
                , count(a.store_delivery_id) as delivery_numb
                , cc.product_numb
                , count( distinct a.warehouse_id) as wh_numb
                , COALESCE(sum(b.price),0) as trans_amount
                , count(b.id) as trans_numb
                , count( distinct b.delivery_vendor_id) as trans_man
            from
                trn_store_delivery a
                left join trn_delivery b
                on a.shipping_id = b.id
                left join
                (
                select
                    c.store_delivery_id
                    , count(distinct c.product_id) as product_numb
                from
                    trn_store_delivery_detail c
                group by
                    c.store_delivery_id
                ) cc
                    on a.store_delivery_id = cc.store_delivery_id
                where
                    a.active_flg = '1'
            ";

        $sql .= $this->andWhereInt($param, 'sale_id', 'a.salesman_id', $sqlParam);
        $sql .= $this->andWhereDateBetween($param, 'from_date', 'to_date', 'date(a.delivery_time)', $sqlParam);
        $sql .= "
        group by
            date(a.delivery_time)
        order by
            date(a.delivery_time) desc

        ";

// $sql .= $this->getOrderBy($param);

        if (isset($param['down']) && 1 == $param['down']) {
            return DB::select(DB::raw($sql), $sqlParam);
        }

        return $this->pagination($sql, $sqlParam, $param);
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectMapData($param)
    {
        $sqlParam = array();
        $sql      = "
        select
            a.store_id
            , c.chanh_id
            , b.name
            , b.address
            , b.gps_lat
            , b.gps_long
            , d.name as salesman_name
            , c.gps_lat as gps_lat_c
            , c.gps_long as gps_long_c
            , c.name as chanh_name
            , sum(a.total_with_discount) as amount
            , sum(a.carton) as carton
            , sum(a.volume) as volume
            , count(a.store_delivery_id) as del_numb
            , e.name as area2
            , f.name as area1
            , ee.name as area2_c
            , ff.name as area1_c
            ,  avg(TIME_TO_SEC(timediff(now(), a.created_at) )  )/3600 as pending
        from
            trn_store_delivery a  left join
            mst_store b on a.store_id = b.store_id
            left join mst_chanh c on
            b.chanh_id = c.chanh_id
            left join users d on a.salesman_id = d.id
            left join mst_area e on b.area2 = e.area_id
            left join mst_area f on b.area1 = f.area_id
            left join mst_area ee on c.area2 = ee.area_id
            left join mst_area ff on c.area1 = ff.area_id
        where
            a.delivery_sts in ('0','6','7','1')
        group by
            a.store_id
        ";

// $sql .= $this->getOrderBy($param);

        if (isset($param['down']) && 1 == $param['down']) {
            return DB::select(DB::raw($sql), $sqlParam);
        }

        return $this->pagination($sql, $sqlParam, $param);
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectMapDataOrder($param)
    {
        $sqlParam = array();
        $sql      = "
        select
            a.store_id
            , b.name
            , b.address
            , b.gps_lat
            , b.gps_long
            , c.chanh_id
            , d.name as salesman_name
            , c.gps_lat as gps_lat_c
            , c.gps_long as gps_long_c
            , sum(a.total_with_discount) as amount
            , sum(a.carton) as carton
            , sum(a.volume) as volume
            , e.name as area2
            , f.name as area1
            , ee.name as area2_c
            , ff.name as area1_c
            ,  avg(TIME_TO_SEC(timediff(now(), a.created_at) )  )/3600 as pending
        from
            trn_store_order a  left join
            mst_store b on a.store_id = b.store_id
            left join mst_chanh c on
            b.chanh_id = c.chanh_id
            left join users d on a.salesman_id = d.id
            left join mst_area e on b.area2 = e.area_id
            left join mst_area f on b.area1 = f.area_id
            left join mst_area ee on c.area2 = ee.area_id
            left join mst_area ff on c.area1 = ff.area_id
        where
            a.order_sts in ('0')
        group by
            a.store_id
        ";

        if (isset($param['down']) && 1 == $param['down']) {
            return DB::select(DB::raw($sql), $sqlParam);
        }

        return $this->pagination($sql, $sqlParam, $param);
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectDeliveryVendor($param)
    {
        $sqlParam = array();
        $sql      = "
        select
            bb.id
            , bb.delivery_vendor_name as name
            , bb.contact_mobile1 as phone
            , max(volume) as max_vol
            , avg(volume) as avg_vol
            , max(carton) as max_cart
            , avg(carton) as avg_cart
            from
                (
                select
                    b.id
                    , b.delivery_vendor_id
                    , b.delivery_date
                    , sum(a.volume) as volume
                    , sum(a.carton) as carton
                from
                    trn_store_delivery a
                    left join  trn_delivery b
                    on a.shipping_id = b.id
                where
                    b.delivery_vendor_id  is not null
                group by
                    b.id
                ) aa left join mst_delivery_vendor bb
                on aa.delivery_vendor_id = bb.id
            where
                not( aa.delivery_date = '2019-12-27' and aa.volume = 19.21) and aa.volume !=0 and aa.carton!=0
            group by
            bb.id
        ";

        if (isset($param['down']) && 1 == $param['down']) {
            return DB::select(DB::raw($sql), $sqlParam);
        }

        return $this->pagination($sql, $sqlParam, $param);
    }

    public function downloadList($param)
    {
        $sts              = ['0', '6', '7', '1', '8', '9', '4', '5'];

        if ($param["index"] < 10) {
            $param["delivery_sts"]  = $sts[$param["index"] - 2];
            $listDelivery           = $this->orderService->selectDeliveryList($param);
            $listDeliveryDetail     = $this->orderService->selectDeliveryDetailList($param);
        } elseif (10 == $param["index"]) {
            $listDelivery           = $this->selectDeliveryStats($param);
        }

        $listStatus       = $this->statusService->getStatus(SELF::DELIVERY_STATUS_TYPE);

        // $listOrder        = $this->selectOrderList($param);
        // $listOrderDetails = $this->selectOrderDetailList($param);
        // $listStatus       = $this->statusService->getStatus(
        //     self::ORDER_STATUS_TYPE
        // );

        // $sts              = ['0', '6', '7', '1', '8', '9', '4', '5'];
        // $param            = Input::all();
        // $param["sale_id"] = $this->getRoleSaleMan();

        // if ($param["index"] < 10) {
        //     $param["delivery_sts"] = $sts[$param["index"] - 2];
        //     $list                  = $this->orderService->selectDeliveryList($param);
        // } elseif (10 == $param["index"]) {
        //     $list = $this->crm0400Service->selectDeliveryStats($param);
        // }
        
        // Create list delivery 
        $sheets[] = [
            "name" => 'DELIVERIES',
            "data" => [
                'list' => $listDelivery,
                'status' => $listStatus
            ],
            "view" => "crm0400-list-delivery",
        ];

        // Create list detail
        $sheets[] = [
            "name" => 'PRODUCTS',
            "data" => [
                'list' => $listDeliveryDetail,
                'status' => $listStatus
            ],
            "view" => "crm0400-list-product",
        ];

        $paramDownload = [
            "file_name" => "DELIVERY",
            "view"      => "crm0400",
            "sheets"    => $sheets,
        ];

        $result = $this->downloadService->downloadExcelFileMultiSheets($paramDownload);

        return $result;
    }

}
