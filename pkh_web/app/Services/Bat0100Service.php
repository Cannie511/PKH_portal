<?php

namespace App\Services;

use DB;
use Log;
use Carbon\Carbon;

class Bat0100Service extends BaseService
{
    /**
     * Statistic revenue of store in month
     *
     * @param [type] $strMonth yyyy-MM
     * @return void
     */
    public function updateStoreRevenue($strMonth)
    {
        Log::info('BAT0100 Update Store Revenue: ' . $strMonth);
        $date = Carbon::parse($strMonth . '-01');

        $this->deleteDataInMonth($date);
        $this->insertData($date);
    }

    /**
     * Delete old data in month
     *
     * @param [type] $date
     * @return void
     */
    private function deleteDataInMonth($date)
    {
        $sql = "
            delete
            from
              trn_store_rank
            where
              year = ?
              and month = ?
        ";
        $sqlParam = [
            $date->year,
            $date->month,
        ];

        return DB::delete(DB::raw($sql), $sqlParam);
    }

    /**
     * Insert statistic data
     *
     * @param [type] $date
     * @return void
     */
    private function insertData($date)
    {
        $sqlParam = array();
        $sql      = "
           insert
           into trn_store_rank(
             store_id
             , year
             , month
             , store_rank
             , order_total
             , order_total_with_discount
             , delivery_total
             , delivery_total_with_discount
             , payment
             , active_flg
             , created_at
             , created_by
             , updated_at
             , updated_by
             , version_no
           )
           select
             temp.store_id
             , temp.year
             , temp.month
             , temp.store_rank
             , temp.order_total
             , temp.order_total_with_discount
             , temp.delivery_total
             , temp.delivery_total_with_discount
             , temp.payment
             , '1'
             , now()
             , 1
             , now()
             , 1
             , 1
           from
             (
               select
                 a.store_id
                 , a.year
                 , a.month
                 , case
                   when sum(a.order_total) >= 100000000
                   then 1
                   when sum(a.order_total) >= 50000000
                   then 2
                   when sum(a.order_total) >= 10000000
                   then 3
                   when sum(a.order_total) >= 1000000
                   then 4
                   else 5
                   end as store_rank
                 , sum(a.order_total) order_total
                 , sum(a.order_total_with_discount) order_total_with_discount
                 , sum(a.delivery_total) delivery_total
                 , sum(a.delivery_total_with_discount) delivery_total_with_discount
                 , sum(a.payment) payment
               from
                 (
                   select
                     a.store_id
                     , year (a.order_date) as year
                     , month (a.order_date) as month
                     , sum(a.total) as order_total
                     , sum(a.total_with_discount) as order_total_with_discount
                     , 0 as delivery_total
                     , 0 as delivery_total_with_discount
                     , 0 as payment
                   from
                     trn_store_order a
                   where
                    a.order_date between ? and ?
                    and a.active_flg = '1'
                    and a.order_sts in ('0', '1', '2', '4')
                   group by
                     a.store_id
                     , year (a.order_date)
                     , month (a.order_date)
                   union all
                   select
                     b.store_id
                     , year (a.delivery_date) as year
                     , month (a.delivery_date) as month
                     , 0 as order_total
                     , 0 as order_total_with_discount
                     , sum(a.total) as delivery_total
                     , sum(a.total_with_discount) as delivery_total_with_discount
                     , 0 as payment
                   from
                     trn_store_delivery a
                     left join trn_store_order b
                       on a.store_order_id = b.store_order_id
                   where
                    a.delivery_date between ? and ?
                    and a.active_flg = '1'
                    and a.delivery_sts in ('0', '1', '4')
                   group by
                     b.store_id
                     , year (a.delivery_date)
                     , month (a.delivery_date)
                  union all
                  select
                     a.store_id
                     , year (a.payment_date) as year
                     , month (a.payment_date) as month
                     , 0 as order_total
                     , 0 as order_total_with_discount
                     , 0 as delivery_total
                     , 0 as delivery_total_with_discount
                     , sum(a.payment_money) as payment
                   from
                     trn_payment a
                   where
                    a.payment_date between ? and ?
                    and a.active_flg = '1'
                   group by
                     a.store_id
                     , year (a.payment_date)
                     , month (a.payment_date)
                 ) a
               group by
                 a.store_id
                 , a.year
                 , a.month
             ) temp
        ";

        $startOfMonth = $date->startOfMonth()->format('Y-m-d');
        $endOfMonth   = $date->endOfMonth()->format('Y-m-d');

        $sqlParam = [
            $startOfMonth,
            $endOfMonth,
            $startOfMonth,
            $endOfMonth,
            $startOfMonth,
            $endOfMonth,
        ];

        return DB::insert(DB::raw($sql), $sqlParam);
    }

}
