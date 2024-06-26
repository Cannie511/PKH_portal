<?php

namespace App\Services\Mobile;

use App\Models\TrnStoreOrder;
use App\Services\BaseService;
use App\Models\TrnStoreDelivery;
use App\Models\TrnStoreOrderDetail;
use App\Models\TrnStoreDeliveryDetail;

/**
 * OrderService class
 */
class OrderService extends BaseService
{
    /**
     * @param $params
     * @return mixed
     */
    public function selectList($params)
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
                , b.area1
                , b.area2
                , d.name as area1_name
                , e.name as area2_name
              from
                trn_store_order a
                left join mst_store b
                  on b.store_id = a.store_id
                left join users c
                  on a.salesman_id = c.id
                left join mst_area d
                  on d.area_id = b.area1
                left join mst_area e
                  on e.area_id = b.area2
              where
                a.active_flg = '1'
			";

        $sql .= $this->andWhereString($params, 'store_order_code', 'a.store_order_code', $sqlParam);
        $sql .= $this->andWhereString($params, 'store_name', 'b.name', $sqlParam);
        $sql .= $this->andWhereString($params, 'order_sts', 'a.order_sts', $sqlParam, true);
        $sql .= $this->andWhereDateInMonthOfDate($params, 'order_date', 'a.order_date', $sqlParam);

        $sql .= "
  			order by a.order_date desc, a.store_order_code desc
          ";

        return $this->pagination($sql, $sqlParam, $params);
    }

    /**
     * @param $id
     */
    public function getDetail($id)
    {

        $order   = TrnStoreOrder::find($id);
        $details = TrnStoreOrderDetail::where('store_order_id', $id)
            ->select(["store_order_id", "product_id", "seq_no", "amount", "unit_price"])
            ->orderBy("seq_no")
            ->get();

        return [
            "order"   => $order,
            "details" => $details,
        ];
    }

    /**
     * @param $id
     */
    public function selectDeliveries($id)
    {

        $deliveries = TrnStoreDelivery::where('store_order_id', $id)->get();

        foreach ($deliveries as $delivery) {
            $details = TrnStoreDeliveryDetail::where('store_delivery_id', $delivery["store_delivery_id"])
                ->select(["store_delivery_id", "product_id", "seq_no", "amount", "unit_price"])
                ->orderBy("seq_no")->get();
            $delivery->details = $details;
        }

        return [
            "deliveries" => $deliveries,
        ];
    }

}
