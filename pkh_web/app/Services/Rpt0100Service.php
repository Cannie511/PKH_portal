<?php

namespace App\Services;

use DB;

class Rpt0100Service extends BaseService
{
    /**
     * @return mixed
     */
    public function selectListYear()
    {
        $sql = "
				select distinct
				  year (a.order_date) as year
				from
				  trn_store_order a
				order by
				  year (a.order_date) desc
            ";

        $result = DB::select(DB::raw($sql));

        return $result;
    }

    /**
     * Search
     *      Param:
     *          - year
     */
    public function searchOrder($param)
    {
        $sqlParam = array();
        $sql      = "
                select
				  a.salesman_id
				  , year (a.order_date) as year
				  , month (a.order_date) as month
				  , c.name
				  , sum(a.total) total
				  , sum(a.total_with_discount) total_with_discount
				from
				  trn_store_order a join mst_store b
				    on a.store_id = b.store_id
				  left join users c
				    on a.salesman_id = c.id
				  join (select user_id from role_user where role_id = 5) d
				    on a.salesman_id = d.user_id
				where
				  a.salesman_id is not null
				  and a.salesman_id in (30,31,32,33)
				  and year (a.order_date) = ?
				  and b.inner_flg = 0
          		 and a.order_sts in ('0','2','4')
					and a.order_type = 1
				group by
				  a.salesman_id
				  , year (a.order_date)
				  , month (a.order_date)
            ";
        $sqlParam[] = $param['year'];

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * Search
     *      Param:
     *          - year
     */
    public function searchDelivery($param)
    {
        $sqlParam = array();
        $sql      = "
						select
						  a.salesman_id
						  , year (a.delivery_time) as year
						  , month (a.delivery_time) as month
						  , c.name
						  , sum(a.total) total
						  , sum(a.total_with_discount) total_with_discount
						from
						  trn_store_delivery a join mst_store b
						    on a.store_id = b.store_id
						  left join users c
						    on a.salesman_id = c.id join (select user_id from role_user where role_id = 5) d
						    on a.salesman_id = d.user_id
						where
						  a.salesman_id is not null
						  and a.salesman_id in (30,31,32,33)
						  and year (a.delivery_time) = ?
						  and b.inner_flg = 0
						  and a.delivery_sts in ('1','4','8','9')
							and a.order_type = 1
						group by
						  a.salesman_id
						  , year (a.delivery_time)
						  , month (a.delivery_time)
            ";
        $sqlParam[] = $param['year'];

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * Search
     *      Param:
     *          - year
     */
    public function searchPayment($param)
    {
        $sqlParam = array();
        $sql      = "
						select
							a.salesman_id
							, year (a.payment_date) as year
							, month (a.payment_date) as month
							, c.name
							, sum(a.payment_money) total
						from
							trn_payment a
							left join users c
								on a.salesman_id = c.id join (select user_id from role_user where role_id = 5) d
								on a.salesman_id = d.user_id
						where
							a.salesman_id is not null
							and year (a.payment_date) = ?
						group by
							a.salesman_id
							, year (a.payment_date)
							, month (a.payment_date)
            ";
        $sqlParam[] = $param['year'];

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

}
