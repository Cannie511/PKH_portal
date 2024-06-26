<?php

namespace App\Services;

use DB;
use Carbon\Carbon;
use App\Models\TrnStoreOrder;
use App\Services\Crm0210Service;

class Bat0230Service extends BaseService
{
    /**
     * @param Crm0210Service $crm0210Service
     */
    public function __construct(Crm0210Service $crm0210Service)
    {
        $this->crm0210Service = $crm0210Service;
    }

    /**
     * @param $month
     */
    public function update($month)
    {
        $date          = Carbon::parse($month . '-01');
        $listOrderNeed = $this->selectListOrderNeedToCancleRemain($date);

//Log::info("BAT0230 execute ".$date);
        foreach ($listOrderNeed as $item) {
            $this->cancleRemainOrder($item->store_order_id);
        }

        //Log::debug($listOrderNeed);
    }

    /**
     * @param $orderID
     */
    private function cancleRemainOrder($orderID)
    {
        $order = TrnStoreOrder::find($orderID);

        if (isset($order)) {
            // Không cancle TH giao > dat
            $this->crm0210Service->splitOrder($order);

            return [
                "rtnCd" => true,
                "msg"   => "Đã hủy đơn hàng #" . $order->store_order_code,
            ];

        } else {
            return [
                "rtnCd" => false,
                "msg"   => "Đơn đặt hàng không tồn tại.",
            ];
        }

    }

    /**
     * @param $date
     */
    public function selectListOrderNeedToCancleRemain($date)
    {
        // chỉ tính những đơn order có trạng thái đang giao và hoàn tất
        $sql = "
            select
                a.store_order_id
                , a.order_date
                , a.store_order_code
                , sum(b.amount) as sOrder
                , sum(d.amount) as sDelivery
            from
                trn_store_order a
                left join trn_store_order_detail b
                    on a.store_order_id = b.store_order_id
                left join trn_store_delivery c
                    on (
                    a.store_order_id = c.store_order_id
                    and c.delivery_sts in ('0', '1', '2', '3', '4')
                    )
                left join trn_store_delivery_detail d
                    on (c.store_delivery_id = d.store_delivery_id)
            where
                a.order_date < ?
                and a.order_sts in ('2', '4')
            group by
                a.store_order_id
            having
                sum(b.amount) - sum(d.amount) > 0
        ";
        $sqlParam = [
            $date,
        ];

        return DB::select(DB::raw($sql), $sqlParam);
    }

}
