<?php namespace App\Services;

use DB;
use Log;
use Mail;
use Carbon\Carbon;
use App\Models\MstStore;
use App\Models\MstProduct;
use App\Models\TrnStoreOrder;
use App\Models\TrnStoreDelivery;
use App\Models\TrnWarehouseChange;
use App\Models\TrnStoreOrderDetail;

/**
 * Order Service
 */
class OrderService extends BaseService
{
    /**
     * Search store for sales
     * @param  [type] $param [description]
     * @return [type]        list product
     */
    public function selectOrderList($param)
    {

        $sqlParam = array();
        $sql      = "
			select
                a.store_order_id
                , a.store_order_code
                , a.store_id
                , b.name store_name
                , a.order_date
                , a.total
                , a.total_with_discount
                , a.order_sts
                , a.discount_1
                , a.discount_2
                , a.salesman_id
                , c.name as salesman_name
                , a.seq_no
                , b.address
              from
                trn_store_order a
                left join mst_store b
                  on b.store_id = a.store_id
                left join users c
                  on a.salesman_id = c.id
              where
                a.active_flg = '1'
			";

        $sql .= $this->andWhereString($param, 'store_order_code', 'a.store_order_code', $sqlParam);
        $sql .= $this->andWhereString($param, 'store_name', 'b.name', $sqlParam);
        $sql .= $this->andWhereString($param, 'order_sts', 'a.order_sts', $sqlParam, true);
        // $sql .= $this->andWhereDateInMonthOfDate($param, 'order_date', 'a.order_date', $sqlParam);
        $sql .= $this->andWhereDateBetween($param, 'from_date', 'to_date', 'a.order_date', $sqlParam);

        $sql .= $this->getOrderBy($param);

        return $this->pagination($sql, $sqlParam, $param);
    }

    /**
     * @param $orderId
     * @return mixed
     */
    public function selectOrder($orderId)
    {
        $sqlParam = array();
        $sql      = "
			select
			  a.store_order_id
			  , a.store_order_code
			  , a.store_id
			  , a.discount_1
			  , a.discount_2
			  , a.order_date
			  , a.total
			  , a.total_with_discount
			  , a.order_sts
			  , a.notes
              , a.notes_cancel
			  , a.version_no
              , b.name as create_user
			  , c.name as update_user
              , a.promotion_id
              , d.promotion_name
              , a.order_type
            , a.admin_time
            , a.warehouse_time
            , e.name as salesman_name
            ,a.created_at
            , a.updated_at
            , a.completion_percent
            , f.branch_name
            , a.confirm_time
            , a.expected_date
            , a.supplier_id
            , g.name as supplier_name
			from
			  trn_store_order a
              left join users b
                on a.created_by = b.id
              left join users c
                on a.updated_by = c.id
              left join mst_promotion d
                on a.promotion_id = d.promotion_id
              left join users e
                on e.id = a.salesman_id
              left join mst_branch f
                on a.branch_id = f.branch_id
              left join mst_supplier g
                on a.supplier_id = g.supplier_id
			where
			  a.store_order_id = ?
			  and a.active_flg = '1'
    	";

        $sqlParam[] = $orderId;

        $list = DB::select(DB::raw($sql), $sqlParam);

        if (count($list) == 0) {
            return array();
        }

        return $list[0];
    }

    /**
     * @param $orderId
     */
    public function selectSumOrderDetail($orderId)
    {
        $sqlParam = array();
        $sql      = "
            select
                sum(a.amount) as sum
            from
                trn_store_order_detail a
            where
                a.store_order_id = ?
    	";

        $sqlParam[] = $orderId;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $orderId
     */
    public function selectOrderDetail($orderId)
    {
        $sqlParam = array();
        $sql      = "
			select
			  a.store_order_id
			  , a.product_id
			  , a.amount
              , coalesce(bb.amount,0) out_amount
			  , a.unit_price
			  , a.version_no
			  , b.product_code
			  , b.name product_name
			  , c.product_cat_id
              , b.supplier_id
			  , c.name
              , b.standard_packing
              , b.stock_code
              , b.name_origin stock_name
              , f.length*f.width*f.height/1000000000 as volume
			from
			  trn_store_order_detail a
			  left join mst_product b
			    on a.product_id = b.product_id
			  left join mst_product_cat c
                on b.product_cat_id = c.product_cat_id
              left join mst_packaging f
                on f.packaging_id = b.packaging_id
              left join (
                    select
                    a.product_id
                    , sum(a.amount) amount
                    from
                    trn_store_delivery_detail a join trn_store_delivery b
                        on a.store_delivery_id = b.store_delivery_id
                        and b.delivery_sts in ('0', '1', '2', '3', '4', '6', '7', '8', '9')
                    where
                    b.store_order_id = ?
                    group by
                    a.product_id
                ) bb
               on a.product_id = bb.product_id
			where
			  a.store_order_id = ?
			  and a.active_flg = '1'
            order by a.seq_no
    	";

        $sqlParam[] = $orderId;
        $sqlParam[] = $orderId;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * Create order for customer
     * @param  [type]  $user        [description]
     * @param  [type]  $storeId     [description]
     * @param  [type]  $orderInfo   [description]
     * @param  boolean $blnSendMail [description]
     * @return [type]               [description]
     */
    public function createOrderForCustomer(
        $user,
        $storeId,
        $orderInfo,
        $blnSendMail = false
    ) {

        $listProduct     = array();
        $listOrderDetail = array();
        $total           = 0;
        $detailSeqNo     = 1;

        foreach ($orderInfo as $item) {
            // Log::debug($item);
            $product       = MstProduct::find($item['product_id']);
            $listProduct[] = [
                'product_code' => $product->product_code,
                'name'         => $product->name,
                'qty'          => $item['qty'],
            ];
            $total += $product->standard_packing * $product->selling_price * intval($item['qty']);

            $orderDetail                 = new TrnStoreOrderDetail();
            $orderDetail->store_order_id = 0;
            $orderDetail->seq_no         = $detailSeqNo++;
            $orderDetail->product_id     = $product->product_id;
            $orderDetail->amount         = $product->standard_packing * $item['qty'];
            $orderDetail->unit_price     = $product->selling_price;
            $this->updateRecordHeader($orderDetail, $user, true);
            $listOrderDetail[] = $orderDetail;
        }

        // Create order
        $order                   = new TrnStoreOrder();
        $order->store_order_code = '000000';
        $order->store_id         = $storeId;
        $order->discount_1       = ah_get_discount_order($total);
        $order->discount_2       = 0;
        $order->total            = $total;
        $order->order_sts        = 0;
        $order->order_date       = Carbon::today();
        $this->updateRecordHeader($order, $user, true);

        DB::transaction(function () use ($order, $listOrderDetail) {

            $order->save();
            $order->store_order_code = ah_gen_order_code($order->store_id, $order->store_order_id, true);
            $order->save();

            foreach ($listOrderDetail as $detail) {
                $detail->store_order_id = $order->store_order_id;
                $detail->save();
            }

        });

        if (true == $blnSendMail) {
            $store = MstStore::find($storeId);

            $that      = $this;
            $mailParam = [
                'store'       => $store,
                'user'        => $user,
                'listProduct' => $listProduct,
                'order'       => $order,
            ];

            Mail::queue('admin.emails.store_order', ['param' => $mailParam], function ($m) use ($that, $mailParam) {
                $m->from('no-reply@phankhangco.com', 'PKH Automation');

                $m->to(env('MAIL_ORDER_TO', 'cuong.nguyen@phankhangco.com'), '[PKH-INFO]')->subject('[ORDER] ' . date('Y-m-d H:i:s') . ' ' . $mailParam['order']['store_order_code'] . ' ' . $mailParam['store']['name'] . ' BY ' . $mailParam['user']->email);
            });
        }

    }

    /**
     * Create customer for sales
     * @param  [type] $user        [description]
     * @param  [type] $storeId     [description]
     * @param  [type] $order       [description]
     *                [order] => Array
     *                (
     *                    [store_order_id] => 46
     *                    [store_id] => 1231
     *                    [discount_1] => 20
     *                    [discount_2] => 0
     *                    [notes] =>
     *                    [version_no] => 1
     * @param  [type] $orderDetail [description]
     *                [orderDetail] => Array
     *                (
     *                    [0] => Array
     *                        (
     *                            [product_id] => 2
     *                            [amount] => 120
     *                        )
     *
     *                    [1] => Array
     *                        (
     *                            [product_id] => 11
     *                            [amount] => 300
     *                        )
     *                )
     * @return [type]              [description]
     */
    public function createOrderForSales(
        $user,
        $order,
        $orderDetail
    ) {
        $entityOrder  = null;
        $isUpdateMode = false;

        $total           = 0;
        $listOrderDetail = array();
        $detailSeqNo     = 1;

        foreach ($orderDetail as $item) {
            $product = MstProduct::find($item['product_id']);
            $total += $product->selling_price * intval($item['amount']);

            $orderDetail                 = new TrnStoreOrderDetail();
            $orderDetail->store_order_id = 0;
            $orderDetail->product_id     = $product->product_id;
            $orderDetail->seq_no         = $detailSeqNo++;
            $orderDetail->amount         = $item['amount'];
            $orderDetail->unit_price     = $product->selling_price;
            $this->updateRecordHeader($orderDetail, $user, true);
            $listOrderDetail[] = $orderDetail;
        }

        $totalWithDiscount = round($total - ($total * (intval($order['discount_1']) + intval($order['discount_2'])) / 100), 0);

        if (isset($order['store_order_id']) && $order['store_order_id'] > 0) {
            // Update
            $isUpdateMode = true;

            $entityOrder = TrnStoreOrder::find($order['store_order_id']);
            $this->updateRecordHeader($entityOrder, $user, false);
        } else {
            // Create
            $isUpdateMode = false;

            $entityOrder                   = new TrnStoreOrder();
            $entityOrder->store_order_code = date('YmdHis') . $user->id;
            $entityOrder->store_id         = $order['store_id'];
            $entityOrder->order_sts        = 0;
            $entityOrder->order_date       = Carbon::today();
            $this->updateRecordHeader($entityOrder, $user, true);
        }

        // Thiet lap doanh so don hang cho sales
        $store = MstStore::find($order['store_id']);

        if (isset($store) && null != $store->salesman_id) {
            $entityOrder->salesman_id = $store->salesman_id;
        }

        $entityOrder->discount_1          = $order['discount_1'];
        $entityOrder->discount_2          = $order['discount_2'];
        $entityOrder->total               = $total;
        $entityOrder->notes               = $order['notes'];
        $entityOrder->total_with_discount = $totalWithDiscount;

        DB::transaction(function () use ($entityOrder, $order, $listOrderDetail, $isUpdateMode) {
            $entityOrder->save();

            if (false == $isUpdateMode) {
                $entityOrder->store_order_code = ah_gen_order_code($order['store_id'], $entityOrder->store_order_id, true);
                $entityOrder->save();
            }

            TrnStoreOrderDetail::where('store_order_id', $order['store_order_id'])->delete();

            foreach ($listOrderDetail as $detail) {
                $detail->store_order_id = $entityOrder->store_order_id;
                $detail->save();
            }

        });

        return $entityOrder->store_order_id;
    }

    /**
     * Get summary of order
     * - Total order all time
     * - Total order of this month
     * @param  [type] $storeId [description]
     * @return [type]          [description]
     */
    public function selectSummaryOrderOfStore($storeId)
    {
        $sqlParam = [];
        $sql      = "
            select
                COALESCE((select sum(total) from trn_store_order where store_order_id = ?),0) as total_order,
                COALESCE((select sum(total) from trn_store_order where store_order_id = ? and month (order_date) = ?),0) as total_order_this_month,
                COALESCE((select sum(total) from trn_store_delivery where store_order_id = ?),0) as total_delivery,
                COALESCE((select sum(total) from trn_store_delivery where store_order_id = ? and month (delivery_date) = ?),0) as total_delivery_this_month
        ";

        $sqlParam = [
            $storeId,
            $storeId,
            intval(date('m')),
            $storeId,
            $storeId,
            intval(date('m')),
        ];

        $result = DB::select(DB::raw($sql), $sqlParam);
        Log::debug($result);
        $result = $result[0];
        //Log::debug($result);
        $result->total_order               = intval($result->total_order);
        $result->total_order_this_month    = intval($result->total_order_this_month);
        $result->total_delivery            = intval($result->total_delivery);
        $result->total_delivery_this_month = intval($result->total_delivery_this_month);

        return $result;
    }

    /**
     * Update time & count print check order report
     * @param  [type] $orderId [description]
     * @return [type]          [description]
     */
    public function updatePrintCheckOrderReport($orderId)
    {
        $order = TrnStoreOrder::find($orderId);

        if (isset($order)) {
            $order->count_print           = $order->count_print + 1;
            $order->last_print_check_time = Carbon::now();

            if ('0' == $order->order_sts) {
                $order->order_sts = "1";
            }

            $order->save();
        }

    }

// /**

//  * Create store delivery

//  * @param  [type] $user           [description]

//  * @param  [type] $delivery       [description]

//  * @param  [type] $deliveryDetail [description]

//  * @return [type]                 [description]

//  */

// public function createStoreDelivery($user, $delivery, $deliveryDetail) {

//     $entityDelivery = null;

//     $isUpdateMode = false;

//     $total = 0;

//     $listDeliveryDetail = array();

//     $listOrderDetail = array();

//     $listWhChange = array();

//     $detailSeqNo = 1;

//     foreach ($deliveryDetail as $item) {

//         $product = MstProduct::find($item['product_id']);

//         $total += $product->selling_price * intval($item['amount']);

//         $orderDetail                    = new TrnStoreDeliveryDetail();

//         $orderDetail->store_delivery_id = 0;

//         $orderDetail->product_id        = $product->product_id;

//         $orderDetail->seq_no            = $detailSeqNo++;

//         $orderDetail->amount            = $item['amount'];

//         $orderDetail->unit_price        = $product->selling_price;

//         $this->updateRecordHeader($orderDetail, $user, true);

//         $listOrderDetail[] = $orderDetail;

//         if( $item['amount'] > 0 ) {

//             $whChange                       = new TrnWarehouseChange();

//             $whChange->warehouse_change_type = 2;

//             $whChange->product_id        = $product->product_id;

//             $whChange->amount            = $item['amount'];

//             $this->updateRecordHeader($whChange, $user, true);

//             $listWhChange[]              = $whChange;

//         }

//     }

//     $orderEntity = TrnStoreOrder::find($delivery['store_order_id']);

//     // $totalWithDiscount = round($total - ($total *  ($orderEntity->discount_1 + $orderEntity->discount_2) / 100 ));

//     if( isset($delivery['store_delivery_id']) && $delivery['store_delivery_id'] > 0 ) {

//         // Update

//         $isUpdateMode            = true;

//         $entityDelivery          = TrnStoreDelivery::find($delivery['store_delivery_id']);

//         $this->updateRecordHeader($entityDelivery, $user, false);

//     } else {

//         // Create

//         $isUpdateMode                     = false;

//         $entityDelivery                   = new TrnStoreDelivery();

//         $entityDelivery->store_order_id   = $delivery['store_order_id'];

//         $entityDelivery->discount_1       = $orderEntity->discount_1;

//         $entityDelivery->discount_2       = $orderEntity->discount_2;

//         $entityDelivery->delivery_sts     = '0';

//         $entityDelivery->delivery_date    = Carbon::today();

//         $this->updateRecordHeader($entityDelivery, $user, true);

//     }

//     // $totalWithDiscount = round($total - ($total *  ($entityDelivery->discount_1 + $entityDelivery->discount_2) / 100 ));

//     $totalWithDiscount = $total * ($entityDelivery->discount_1 + $entityDelivery->discount_2) / 100;

//     $totalWithDiscount = floor($totalWithDiscount / 1000) * 1000;

//     $totalWithDiscount = $total - $totalWithDiscount;

//     $entityDelivery->total      = $total;

//     $entityDelivery->total_with_discount      = $totalWithDiscount;

//     $entityDelivery->notes      = $delivery['notes'] . '';

//     DB::transaction(function () use ($entityDelivery, $delivery, $listOrderDetail, $isUpdateMode, $listWhChange) {

//         $entityDelivery->save();

//         // Update status of order

//         TrnStoreOrder::where('store_order_id', $delivery['store_order_id'])

//             ->update([

//                 'order_sts' => '2',

//                 'updated_by' => Auth::user()->id,

//                 'updated_at' => Carbon::now()

//             ]);

//         if ( isset($delivery['store_delivery_id'])) {

//             // Delete TrnStoreDeliveryDetail

//             TrnStoreDeliveryDetail::where('store_delivery_id', $delivery['store_delivery_id'])->delete();

//             // Delete trn_warehouse_change

//             TrnWarehouseChange::where('store_delivery_id', $delivery['store_delivery_id'] )->delete();

//         }

//         // Create detail

//         foreach( $listOrderDetail as $detail ) {

//             $detail->store_delivery_id = $entityDelivery->store_delivery_id;

//             $detail->save();

//         }

//         // Create warehouse change

//         foreach( $listWhChange as $whChange ) {

//             $whChange->store_delivery_id = $entityDelivery->store_delivery_id;

//             $whChange->changed_date = $entityDelivery->delivery_date;

//             $whChange->save();

//         }

//     });

//     return $entityDelivery->store_delivery_id;

// }

    /**
     * Select store delivery info
     * @param  [type] $storeDeliveryId [description]
     * @return [type]                  [description]
     */
    public function selectStoreDelivery($storeDeliveryId)
    {
        $sqlParam = array();
        $sql      = "
            select
              a.store_delivery_id
              , a.store_delivery_code
              , a.warehouse_id
              , a.store_order_id
              , a.store_id
              , a.branch_id
              , a.delivery_date
              , a.discount_1
              , a.discount_2
              , a.total
              , a.total_with_discount
              , a.delivery_sts
              , a.notes
              , a.notes_cancel
                , a.created_at
                ,a.updated_at
                , b.name as create_by
                , c.name as update_by
                , d.name as salesman_name
                , e.branch_name
                , a.packing_time
                , a.confirm_time
                , a.delivery_time
                , a.shipping_time
                , a.receive_time
                , a.finish_time
                , a.volume
                , timediff(a.packing_time, a.created_at)  as create_pack
                , timediff(a.confirm_time, a.packing_time)  as pack_conf
                , timediff(a.delivery_time, a.confirm_time) as conf_del
                , timediff(a.shipping_time, a.delivery_time) as del_ship
                , timediff(a.receive_time, a.shipping_time) as ship_rec
                , timediff(a.shipping_time, f.created_at) as ship_order
                , timediff(a.delivery_time, f.created_at) as del_order
                , g.name as supplier_name
            from
                trn_store_delivery a
                    left join users b on
                a.created_by = b.id left join users c
                on c.id = a.updated_by left join users d
                on d.id = a.salesman_id
                left join mst_branch e
                    on e.branch_id = a.branch_id
                left join trn_store_order f
                    on a.store_order_id = f.store_order_id
                left join mst_supplier g
                    on a.supplier_id = g.supplier_id
            where
              a.store_delivery_id = ?
              and a.active_flg = '1'
        ";

        $sqlParam[] = $storeDeliveryId;

        $list = DB::select(DB::raw($sql), $sqlParam);
        if (count($list) == 0) {
            return array();
        }

        return $list[0];
    }

    /**
     * Select store delivery detail
     * @param  [type] $storeDeliveryId [description]
     * @return [type]                  [description]
     */
    public function selectDeliveryExportDetail($storeOrderId)
    {
        $sqlParam = array();
        $sql      = "
           select
                a.product_id
                , sum(a.amount)  as amount
            from
                trn_store_delivery_detail a
                left join trn_store_delivery d
                    on a.store_delivery_id = d.store_delivery_id
            where
                d.store_order_id = ?
                and a.active_flg = '1'
                and d.delivery_sts in ('1','8', '9', '4')
            group by
                    a.product_id
        ";

        $sqlParam[] = $storeOrderId;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * Select store delivery detail
     * @param  [type] $storeDeliveryId [description]
     * @return [type]                  [description]
     */
    public function selectDeliveryExportDetail2($storeOrderId)
    {
        $sqlParam = array();
        $sql      = "
           select
                a.product_id
                , sum(a.amount)  as amount
            from
                trn_store_delivery_detail a
                left join trn_store_delivery d
                    on a.store_delivery_id = d.store_delivery_id
            where
                d.store_order_id = ?
                and a.active_flg = '1'
                and d.delivery_sts in ('0','6','7','1','8', '9', '4')
            group by
                    a.product_id
        ";

        $sqlParam[] = $storeOrderId;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * Select store delivery detail
     * @param  [type] $storeDeliveryId [description]
     * @return [type]                  [description]
     */
    public function selectStoreDeliveryDetail($storeDeliveryId)
    {
        $sqlParam = array();
        $sql      = "
            select
              a.store_delivery_id
              , a.product_id
              , a.amount
              , b.accountant_price
              , a.unit_price
              , a.version_no
              , b.product_code
              , b.name product_name
              , c.product_cat_id
              , c.name
              , b.standard_packing
              , b.stock_code
              , b.name_origin stock_name
              , d.store_order_id
              , e.store_id
              , f.length*f.width*f.height/1000000000 as volume
              , a.amount/b.standard_packing as carton
            from
              trn_store_delivery_detail a
              left join mst_product b
                on a.product_id = b.product_id
              left join mst_product_cat c
                on b.product_cat_id = c.product_cat_id
              left join trn_store_delivery d
                on a.store_delivery_id = d.store_delivery_id
              left join trn_store_order e
                on d.store_order_id = e.store_order_id
              left join mst_packaging f
                on f.packaging_id = b.packaging_id
            where
              a.store_delivery_id = ?
              and a.active_flg = '1'
            order by
              a.seq_no
        ";

        $sqlParam[] = $storeDeliveryId;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * Select delivery list
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function selectDeliveryList($param)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.store_delivery_id
                , a.warehouse_id
                , aa.name as warehouse_name
                , a.delivery_time
                , a.delivery_date
                , a.delivery_sts
                , a.store_order_id
                , b.store_order_code
                , a.store_delivery_code
                , b.store_id
                , c.name store_name
                , a.discount_1
                , a.discount_2
                , b.order_date
                , e.promotion_name
                , a.total
                , a.total_with_discount
                , a.salesman_id
                , d.name as salesman_name
                , cc.name as current_salesman_name
                , a.order_type
                , a.updated_at
                , f.name as updated_by
                , g.branch_name
                , a.created_at
                , dd.name as created_by
                , a.packing_time
                , a.confirm_time
                , a.shipping_time
                , a.receive_time
                , c.address
                , c.level
                , c1.name as address2
                , CONCAT(c2.name,'-',c3.name) as address1
                , ff.delivery_vendor_name
                , ee.price as delivery_cost
                , ee.delivery_date as transport_date
                , a.volume
                , a.carton
                , timediff(now(), b.created_at)  as pending_hour
                , timediff(a.delivery_time, b.created_at)  as del_cre
                , timediff(a.shipping_time, b.created_at)  as ship_cre
                , gg.supplier_code
                , gg.name as supplier_name
                , c.contact_mobile1
                , c.review_sts
                , c.review_expired_date
                from
                trn_store_delivery a
                left join trn_store_order b
                    on a.store_order_id = b.store_order_id
                left join mst_store c
                    on b.store_id = c.store_id
                left join mst_area c1
                    on c.area2 = c1.area_id
                left join mst_area c2
                    on c.area1 = c2.area_id
                left join mst_area_group c3
                    on c2.area_group_id = c3.area_group_id
                left join users d
                    on a.salesman_id = d.id
                left join mst_promotion e
                    on b.promotion_id = e.promotion_id
                left join users f
                    on f.id = a.updated_by
                left join mst_branch g
                    on g.branch_id = a.branch_id
                left join users cc
                   on c.salesman_id = cc.id
                left join users dd
                    on a.created_by = dd.id
                left join mst_warehouse aa
                    on aa.warehouse_id = a.warehouse_id
                left join trn_delivery ee
                    on a.shipping_id = ee.id
                left join mst_delivery_vendor ff
                     on  ee.delivery_vendor_id=ff.id
                left join mst_supplier gg 
                    on a.supplier_id = gg.supplier_id
            where
                a.active_flg = '1' ";

        $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'store_id', 'a.store_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'level', 'c.level', $sqlParam);
        $sql .= $this->andWhereInt($param, 'warehouse_id', 'a.warehouse_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'promotion_id', 'b.promotion_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'salesman_id', 'a.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'order_type', 'a.order_type', $sqlParam);
        $sql .= $this->andWhereInt($param, 'branch_id', 'a.branch_id', $sqlParam);
        $sql .= $this->andWhereString($param, 'store_delivery_code', 'a.store_delivery_code', $sqlParam);
        $sql .= $this->andWhereString($param, 'store_name', 'c.name', $sqlParam);
        $sql .= $this->andWhereString($param, 'delivery_sts', 'a.delivery_sts', $sqlParam, true);
        $sql .= $this->andWhereDateBetween($param, 'from_date', 'to_date', 'date(a.delivery_time)', $sqlParam);
        $sql .= $this->andWhereInt($param, 'sale_id', 'c.salesman_id', $sqlParam);
        $sql .= $this->getOrderBy($param);

        if (isset($param['down']) && 1 == $param['down']) {
            return DB::select(DB::raw($sql), $sqlParam);
        }

        return $this->pagination($sql, $sqlParam, $param);
    }

    /**
     * Select delivery list
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function selectDeliveryDetailList($param)
    {
        $sqlParam = array();
        $sql      = "
            SELECT
                i.product_id 
                , i.seq_no
                , i.amount
                , i.unit_price
                , j.product_code
                , j.stock_code
                , j.name product_name
                , a.store_delivery_id
                , a.warehouse_id
                , a.delivery_time
                , a.delivery_date
                , a.delivery_sts
                , a.store_order_id
                , b.store_order_code
                , a.store_delivery_code
                , b.store_id
                , c.name store_name
                , a.discount_1
                , a.discount_2
                , b.order_date
                , a.total
                , a.total_with_discount
                , a.salesman_id
                , d.name AS salesman_name
                , a.order_type
                , a.updated_at
                , f.name AS updated_by
                , a.created_at
                , c.address
                , c.level
                , c1.name AS address2
                , CONCAT(c2.name, '-', c3.name) AS address1
                , a.volume
                , a.carton
            FROM
                trn_store_delivery_detail i
            JOIN trn_store_delivery a ON
                i.store_delivery_id = a.store_delivery_id
            LEFT JOIN trn_store_order b ON
                a.store_order_id = b.store_order_id
            LEFT JOIN mst_store c ON
                b.store_id = c.store_id
            LEFT JOIN mst_area c1 ON
                c.area2 = c1.area_id
            LEFT JOIN mst_area c2 ON
                c.area1 = c2.area_id
            LEFT JOIN mst_area_group c3 ON
                c2.area_group_id = c3.area_group_id
            LEFT JOIN users d ON
                a.salesman_id = d.id
            LEFT JOIN users f ON
                f.id = a.updated_by
            LEFT JOIN mst_product j ON
                j.product_id = i.product_id
            WHERE
                a.active_flg = '1'
                AND i.active_flg = '1'
        ";

        $sql .= $this->andWhereInt($param, 'store_id', 'a.store_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'level', 'c.level', $sqlParam);
        $sql .= $this->andWhereInt($param, 'warehouse_id', 'a.warehouse_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'promotion_id', 'b.promotion_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'salesman_id', 'a.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'order_type', 'a.order_type', $sqlParam);
        $sql .= $this->andWhereInt($param, 'branch_id', 'a.branch_id', $sqlParam);
        $sql .= $this->andWhereString($param, 'store_delivery_code', 'a.store_delivery_code', $sqlParam);
        $sql .= $this->andWhereString($param, 'store_name', 'c.name', $sqlParam);
        $sql .= $this->andWhereString($param, 'delivery_sts', 'a.delivery_sts', $sqlParam, true);
        $sql .= $this->andWhereDateBetween($param, 'from_date', 'to_date', 'date(a.delivery_time)', $sqlParam);
        $sql .= $this->andWhereInt($param, 'sale_id', 'c.salesman_id', $sqlParam);
        // $sql .= $this->getOrderBy($param);
        $sql .= ' ORDER BY a.updated_at DESC, a.store_delivery_id, i.seq_no ';

        if (isset($param['down']) && 1 == $param['down']) {
            return DB::select(DB::raw($sql), $sqlParam);
        }

        return $this->pagination($sql, $sqlParam, $param);
    }

    /**
     * Cancel order
     * @param  [type] $param
     *             store_order_id: id
     *             notes: result
     * @return [type]
     *             rtnCd: 0: ok 1: NG
     *             msg
     */
    public function cancelOrder($param)
    {
        $order = TrnStoreOrder::find($param["store_order_id"]);

        if (isset($order)) {
            $countDelivery =
            TrnStoreDelivery::where('store_order_id', $param["store_order_id"])
                ->where('delivery_sts', '!=', '5')->count();

            if ($countDelivery > 0) {
                return [
                    "rtnCd" => false,
                    "msg"   => "Đơn hàng đã giao không thể hủy",
                ];
            }

            $order->order_sts    = "5";
            $order->notes_cancel = $param["notes"];
            $order->cancel_time  = Carbon::now();
            $order->save();

            return [
                "rtnCd" => true,
                "msg"   => "Đã hủy đơn hàng #" . $order->store_order_code,
            ];
        }

        return [
            "rtnCd" => false,
            "msg"   => "Đơn đặt hàng không tồn tại.",
        ];
    }

    /**
     * Cancel delivery
     * @param  [type] $param
     *             store_delivery_id: id
     *             notes: result
     * @return [type]
     *             rtnCd: 0: ok 1: NG
     *             msg
     */
    public function cancelDelivery($param)
    {
        $delivery = TrnStoreDelivery::find($param["store_delivery_id"]);

        if (isset($delivery)) {

            $delivery->delivery_sts = "5";
            $delivery->notes_cancel = $param["notes"];
            $delivery->cancel_time  = Carbon::now();
            $delivery->save();

            // Delete trn_warehouse_change
            TrnWarehouseChange::where('store_delivery_id', $delivery->store_delivery_id)->delete();

            return [
                "rtnCd" => true,
                "msg"   => "Đã hủy phiếu xuất #" . $delivery->store_delivery_id,
            ];
        }

        return [
            "rtnCd" => false,
            "msg"   => "Phiếu xuất không tồn tại.",
        ];
    }

    /**
     * Select delivery list by order
     * @param  [type] $orderId [description]
     * @return [type]          [description]
     */
    public function selectDeliveryListByOrder($orderId)
    {
        $result = TrnStoreDelivery::where('store_order_id', $orderId)
            ->where('active_flg', '1')
            ->orderBy('store_order_id', 'asc')->get();

        return $result;
    }

    public function selectBranchList()
    {
        $sqlParam = array();
        $sql      = "
            select
            a.branch_id
            , a.branch_code
            , a.branch_name
            , a.branch_address
            , a.branch_contact
            , a.started_date
            , a.active_flg
            from
            mst_branch a
            where
            a.active_flg = '1'
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @return mixed
     */
    public function selectReportStatus($param)
    {
        $sqlParam = array();
        $sql      = "
          select
            count(*) as count
            , sum(a.total_with_discount) as total_with_discount
            , sum(a.total) as total
            , a.order_sts
          from
            trn_store_order a
            left join mst_store b
                on a.store_id = b.store_id
        where
            a.active_flg = '1' ";
        $sql .= $this->andWhereInt($param, 'sale_id', 'b.salesman_id', $sqlParam);
        $sql .= "  group by
            a.order_sts;
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @return mixed
     */
    public function selectReportDeliveryStatus($param)
    {
        $sqlParam = array();
        $sql      = "
          select
            count(*) as count
            , sum(a.total_with_discount) as total_with_discount
            , sum(a.total) as total
            , a.delivery_sts
          from
            trn_store_delivery a
            left join mst_store b
            on a.store_id = b.store_id
          where
            a.active_flg = '1' ";
        $sql .= $this->andWhereInt($param, 'sale_id', 'b.salesman_id', $sqlParam);
        $sql .= "
          group by
            a.delivery_sts;
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

}
