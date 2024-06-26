<?php

namespace App\Services;

use DB;
use Log;
use Carbon\Carbon;
use App\Models\MstProduct;
use App\Models\TrnSupplierOrder;
use App\Models\TrnSupplierOrderDetail;
use App\Models\TrnWarehouseChange;

/**
 * Crm1310Service class
 */
class Crm1310Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function createSupplierOrder(
        $user,
        $param
    ) {
        $orderDetailX    = $param['orderDetail'];
        $detailSeqNo     = 1;
        $listOrderDetail = array();
        Log::debug('save supplier ---------------------');
        Log::debug($param);

        foreach ($orderDetailX as $item) {
            $product = MstProduct::find($item['product_id']);

            $orderDetail             = new TrnSupplierOrderDetail();
            $orderDetail->product_id = $product->product_id;
            $productID= $product->product_id;
           
            $orderDetail->amount     = $item['amount'];
            $orderDetail->unit_price = $item['unit_price'];
            $orderDetail->pakaging   = $item['pakaging'];
            $orderDetail->pakaging_type   = $item['pakaging_type'];
            $orderDetail->describes   = $item['describes'];
            $this->updateRecordHeader($orderDetail, $user, true);
            $listOrderDetail[] = $orderDetail;


            $whChange                        = new TrnWarehouseChange();
            $whChange->warehouse_change_type = 1;
            $whChange->changed_date      = Carbon::today();
            $whChange->product_id            = $productID;
            $whChange->amount                = $item['amount'];
            $this->updateRecordHeader($whChange, $user, true);
            DB::transaction(function () use ($whChange) {
                $whChange->save();
            });
        
        }

        if (isset($param['supplier_order_id']) && null != $param['supplier_order_id']) {
            // Update
            $entityOrder = TrnSupplierOrder::find($param['supplier_order_id']);
            $this->updateRecordHeader($entityOrder, $user, false);

        } else {
            $entityOrder             = new TrnSupplierOrder();
            $entityOrder->order_date = Carbon::today();
           
           
            $this->updateRecordHeader($entityOrder, $user, true);
        }

        $entityOrder->supplier_id = $param['supplier_id'];
        $entityOrder->total       = $param['total'];
        $entityOrder->total_with_discount       = $param['total_with_discount'];
        $entityOrder->discount       = $param['discount'];
        
        

        DB::transaction(function () use ($entityOrder, $listOrderDetail, $param) {

            $entityOrder->save();

           
            foreach ($listOrderDetail as $detail) {
                $detail->supplier_order_id = $entityOrder->supplier_order_id;
                $detail->save();
            }

        });

        return $entityOrder->supplier_order_id;
    }

    public function selectSupplier()
    {
        $sqlParam = array();
        $sql      = "
            select
                a.supplier_id
                , a.name
                , a.supplier_code
                , a.contact_name
                , a.contact_email
                , a.contact_tel
                , a.contact_fax
                , a.contact_mobile1
                , a.contact_mobile2
            from
                mst_supplier a
        ";

        $result = array();
        //$result =  $this->pagination($sql, $sqlParam, $param);

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectProductListForOrder($param)
    {
        $sqlParam = array();
        $sql      = "
            	select
                    a.product_id
                    , a.supplier_id
             
                    , a.product_code
                    
                    , a.product_name
                  
                    , a.color
                    , a.pakaging
                    , a.describes
                    , a.selling_price
                    , a.pakagingType
                    , a.describes
                   
                   
                from
                    mst_product a
                   
                where
                    a.active_flg = '1'
        ";

        $sql .= $this->andWhereString($param, 'product_code', 'a.product_code', $sqlParam);
        $sql .= $this->andWhereString($param, 'product_name', 'a.name', $sqlParam);
        $sql .= $this->andWhereString($param, 'supplier_code', 'a.stock_code', $sqlParam);
        $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);
        $sql .= "
    			order by  a.product_name
    	";
        $productList = DB::select(DB::raw($sql), $sqlParam);

        foreach ($productList as $product) {

            if (file_exists(public_path() . '/img/product/' . $product->product_code . '.png')) {
                $product->noImage = 0;
            } else {
                $product->noImage = 1;
            }

        }

        return $productList;
    }

    /**
     * @param $supplierOrderId
     */
    public function selectOrderDetail($supplierOrderId)
    {
        $sqlParam = array();
        $sql      = "
           select
                a.supplier_order_id
                
                , a.product_id
                , a.amount
                , a.unit_price
                , a.pakaging_type
                , a.pakaging
                , b.product_name as product_name
                , b.product_code
                , a.describes

               
            from
                trn_supplier_order_detail a
                left join mst_product b
                    on a.product_id = b.product_id
               
            where
                a.supplier_order_id = ?
                and a.active_flg = '1'
           
        ";

        $sqlParam[] = $supplierOrderId;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $supplierOrderId
     */
    public function selectOrder($supplierOrderId)
    {
        $sqlParam = array();
        $sql      = "
          select
            a.supplier_order_id
            , a.supplier_id
            , a.order_date
            , a.total
            , a.notes
            , a.discount

        from
            trn_supplier_order a
        where
            a.supplier_order_id = ?
        ";

        $sqlParam[] = $supplierOrderId;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $supplierOrderId
     */
    public function selectExactSupplier($id)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.supplier_id
                , a.name
                , a.supplier_code
                , a.contact_name
                , a.contact_email
                , a.contact_tel
                , a.contact_fax
                , a.contact_mobile1
                , a.contact_mobile2
                , a.address
            from
                mst_supplier a
            where 
                a.supplier_id = ?
        ";
        $sqlParam[] = $id;
        $result = DB::select(DB::raw($sql), $sqlParam);
        // Log::debug($result);
        if (isset($result) && count($result) > 0) {
            return $result[0];
        }

        return $result;
    }

    /**
     * @param $user
     * @param $supplierOrderId
     * @return mixed
     */
    public function updateSendPoDate(
        $user,
        $supplierOrderId
    ) {

        if (null != $supplierOrderId) {
            $today = Carbon::now();
            TrnSupplierOrder::where('supplier_order_id', $supplierOrderId)
                ->update([
                    'send_po_date' => $today
                    , 'order_sts' => 1
                    , 'updated_at' => $today
                    , 'updated_by' => $user->id]);

            return $today;
        }

    }

}
