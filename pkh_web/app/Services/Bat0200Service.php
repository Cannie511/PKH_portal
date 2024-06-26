<?php

namespace App\Services;

use DB;
use Carbon\Carbon;
use App\Models\TrnStoreOrder;

class Bat0200Service extends BaseService
{
    /**
     * Update completion percent of order
     *
     * @param [type] $params
     * @return void
     */
    public function updateOrderCompletionPercent()
    {
        ini_set('max_execution_time', '300');
        $date          = Carbon::now();
        $listOrderNeed = $this->selectListOrderNeedToCancleRemain($date);

        foreach ($listOrderNeed as $item) {

            if (0 == $item->sOrder) {
                $newPercent = 0;
            } else {
                $newPercent = $item->sDelivery / $item->sOrder;
            }

            if (1 == $newPercent) {
                TrnStoreOrder::where('store_order_id', $item->store_order_id)->update([
                    'order_sts'          => '4',
                    'completion_percent' => 1,
                ]);
            } else {
                TrnStoreOrder::where('store_order_id', $item->store_order_id)->update([
                    'order_sts'          => '2',
                    'completion_percent' => $newPercent,
                ]);
            }

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
            aa.store_order_id
            , aa.store_order_code
            , aa.sOrder
            , bb.sDelivery
            from
            (
                select
                a.store_order_id
                , a.order_date
                , a.store_order_code
                , sum(b.amount) as sOrder
                from
                trn_store_order a
                left join trn_store_order_detail b
                    on a.store_order_id = b.store_order_id
                where
                a.order_date <= ?
                and a.order_sts in ('2', '4')
                group by
                a.store_order_id
            ) aa
            left join (
                select
                a.store_order_id
                , a.order_date
                , a.store_order_code
                , sum(d.amount) as sDelivery
                from
                trn_store_order a
                left join trn_store_delivery c
                    on (
                    a.store_order_id = c.store_order_id
                    and c.delivery_sts in ('0', '1', '2', '3', '4')
                    )
                left join trn_store_delivery_detail d
                    on (c.store_delivery_id = d.store_delivery_id)
                where
                a.order_date <= ?
                and a.order_sts in ('2', '4')
                group by
                a.store_order_id
            ) bb
                on aa.store_order_id = bb.store_order_id
        ";
        $sqlParam = [
            $date,
            $date,
        ];

        return DB::select(DB::raw($sql), $sqlParam);
    }

}
