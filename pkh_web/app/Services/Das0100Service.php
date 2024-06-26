<?php

namespace App\Services;

use DB;
use File;
use Cache;
use Excel;
use Carbon\Carbon;

class Das0100Service extends BaseService
{
    /**
     * Select order today
     *
     * @return List
     */
    // public function selectOrderToday($param)
    // {
    //     $sqlParam = array();
    //     $sql      = "
    //         select
    //             a.store_order_id
    //             , a.store_order_code
    //             , a.store_id
    //             , b.name store_name
    //             , a.order_date
    //             , a.total
    //             , a.total_with_discount
    //             , a.order_sts
    //             , a.discount_1
    //             , a.discount_2
    //             , a.salesman_id
    //             , c.name as salesman_name
    //             , a.seq_no
    //             , b.address
		// 						, a.notes
		// 						, a.notes_cancel
		// 						, a.order_type
		// 						 , a.promotion_id
    //           , d.promotion_name
		// 						, a.completion_percent
		// 						, f.branch_name
    //             , g.supplier_code
    //             , b.review_sts
    //             , b.review_expired_date
    //           from
    //             trn_store_order a
    //             left join mst_store b
    //               on b.store_id = a.store_id
    //             left join users c
    //               on a.salesman_id = c.id
		// 						  left join mst_promotion d
    //             on a.promotion_id = d.promotion_id
		// 							left join mst_branch f
		// 								on f.branch_id = a.branch_id
    //             left join mst_supplier g 
    //               on a.supplier_id = g.supplier_id
    //           where
    //             a.active_flg = '1' ";
    //     $sql .= $this->andWhereInt($param, 'sale_id', 'b.salesman_id', $sqlParam);
    //     $sql .= "
    //             and a.order_date = ?
    //         ";

    //     $sqlParam[] = Carbon::today();
    //     // $sqlParam[] = Carbon::create(2016, 11, 17, 0, 0, 0);

    //     $sql .= "
    //         order by a.store_order_id desc
    //       ";

    //     return DB::select(DB::raw($sql), $sqlParam);
    // }

    // /**
    //  * Select delivery today
    //  *
    //  * @return List
    //  */
    // public function selectDeliveryToday($param)
    // {
    //     $sqlParam = array();
    //     $sql      = "
    //         select
    //             a.store_delivery_id
    //             , d.store_order_id
    //             , d.store_order_code
		// 						, a.store_delivery_code
    //             , d.store_id
    //             , b.name store_name
    //             , a.total
    //             , a.total_with_discount
    //             , a.delivery_sts
    //             , a.discount_1
    //             , a.discount_2
    //             , c.name as salesman_name
    //             , a.seq_no
    //             , b.address
		// 						, a.notes
		// 						, a.notes_cancel
		// 						, a.order_type
		// 						, e.promotion_name
		// 						, f.branch_name
    //             , a.delivery_time
    //             , g.name as warehouse_name
    //             , h.supplier_code
    //             , b.review_sts
    //             , b.review_expired_date
    //           from
    //             trn_store_delivery a
		// 						join trn_store_order d
		// 							on d.store_order_id = a.store_order_id
    //             left join mst_store b
    //               on b.store_id = d.store_id
    //             left join users c
    //               on a.salesman_id = c.id
		// 						 left join mst_promotion e
    //                 on d.promotion_id = e.promotion_id
		// 						left join mst_branch f
    //                 on f.branch_id = a.branch_id
    //             left join mst_warehouse g
    //               on a.warehouse_id = g.warehouse_id
    //             left join mst_supplier h
    //               on a.supplier_id = h.supplier_id
    //           where
    //             a.active_flg = '1' ";

    //     $sql .= $this->andWhereInt($param, 'sale_id', 'b.salesman_id', $sqlParam);
    //     $sql .= "
    //             and date(a.delivery_time) = ?
    //         ";

    //     $sqlParam[] = Carbon::today();
    //     // $sqlParam[] = Carbon::create(2016, 11, 17, 0, 0, 0);

    //     $sql .= "
    //         order by a.store_delivery_id desc
    //       ";

    //     return DB::select(DB::raw($sql), $sqlParam);
    // }

    // public function selectOrderWebToday()
    // {
    //     $sqlParam = array();
    //     $sql      = "
    //        select
		// 					a.web_order_id
		// 					, a.total
		// 					, a.order_sts
		// 					, b.name
		// 					, b.phone_number
		// 					, a.created_at
		// 					, a.updated_at
		// 					, a.notes
		// 			from
		// 					trn_web_order a
		// 					left join users_web b
		// 							on a.user_web_id = b.id
		// 			where
		// 					a.active_flg = 1
		// 					and a.created_at >= ?
    //         ";
    //     $sqlParam[] = Carbon::today();
    //     $sql .= "
    //         order by a.created_at desc
    //       ";

    //     return DB::select(DB::raw($sql), $sqlParam);
    // }

    // /**
    //  * Select payment today
    //  *
    //  * @return List
    //  */
    // public function selectPaymentToday($param)
    // {
    //     $sqlParam = array();
    //     $sql      = "
    //        select
		// 					a.payment_id
		// 					, a.salesman_id
		// 					, a.store_id
		// 					, b.name as store_name
    //           , b.address as store_address
    //           , b.level
		// 					, c.name as salesman_name
		// 					, a.payment_date
		// 					, a.payment_type
		// 					, a.payment_money
		// 					, a.bank_account_id
		// 					, a.notes
		// 					, a.active_flg
		// 					, a.created_at
		// 					, a.created_by
		// 					, a.updated_at
		// 					, a.updated_by
		// 					, a.version_no
		// 				from
		// 					trn_payment a
		// 					left join mst_store b
		// 						on a.store_id = b.store_id
		// 					left join users c
		// 						on a.salesman_id = c.id
		// 				where
    //           a.active_flg = 1 ";

    //     $sql .= $this->andWhereInt($param, 'sale_id', 'b.salesman_id', $sqlParam);
    //     $sql .= "
		// 					and a.payment_date = ?
    //         ";

    //     $sqlParam[] = Carbon::today();

    //     $sql .= "
    //         order by a.created_at desc
    //       ";

    //     return DB::select(DB::raw($sql), $sqlParam);
    // }

    // /**
    //  * Select import today
    //  *
    //  * @return List
    //  */
    // public function selectImportToday()
    // {
    //     $sqlParam = array();
    //     $sql      = "
    //    			select
    //             a.import_wh_store_id
    //             , a.import_type
    //             , a.import_sts
    //             , a.store_id
    //             , a.import_date
    //             , a.total
    //             , a.notes
    //             , a.salesman_id
    //             , c.name as store_name
    //             , c.address as store_address
    //             , b.name as salesman_name
    //             , a.updated_at
    //             , d.name updated_by
    //         from
    //             trn_import_wh_store a
    //             left join users b
    //                 on a.salesman_id = b.id
    //             left join mst_store c
    //                 on a.store_id = c.store_id
    //             left join users d
    //                 on a.updated_by = d.id
    //         where
    //             a.active_flg = 1
		// 					and a.import_date = ?
    //         ";

    //     $sqlParam[] = Carbon::today();

    //     $sql .= "
    //         order by a.created_at desc
    //       ";

    //     return DB::select(DB::raw($sql), $sqlParam);
    // }

    // /**
    //  * Get todo etest of user
    //  * @param  [type] $param [description]
    //  * @return [type]        [description]
    //  */
    // public function getStatisticsOrder()
    // {
    //     $sqlParam = [];
    //     $sql      = "
		// 	select
		// 	  DATE_FORMAT(order_date, '%Y-%m') yearmonth
		// 	  , sum(total) total
		// 	  , sum(total_with_discount) total_with_discount
		// 	from
		// 	  trn_store_order
		// 	where
		// 	  order_sts in (0, 4, 5)
		// 	group by
		// 	  DATE_FORMAT(order_date, '%Y-%m')
		// 	order by
		// 	  order_date
		// 	limit
		// 	  12
		// 	 ";

    //     return DB::select(DB::raw($sql), $sqlParam);
    // }

    // /**
    //  * @param $param
    //  */
    // public function selectListStoreNeedOrder($param)
    // {
    //     $sqlParam = [];
    //     $sql      = "
    //   select
    //   aa.store_id
    //   , cc.name as store_name
    //   , cc.address
    //   , cc.level
    //   , cc.contact_tel
    //   , cc.contact_mobile1
    //   , dd.name as salesman_name
    //   , aa.order_date
    //   , aa.order_day
    //   , DATE (bb.delivery_date) as delivery_date
    //   , bb.delivery_day
    //   , ee.name  as area1_name
    //   , ff.name as area2_name
    // from
    //   (
    //     select
    //       a.store_id
    //       , max(a.order_date) order_date
    //       , DATEDIFF(NOW(), max(a.order_date)) as order_day
    //     from
    //       trn_store_order a
    //     where
    //       a.order_sts != '5'
    //     group by
    //       a.store_id
    //   ) aa
    //   left join (
    //     select
    //       b.store_id
    //       , max(b.delivery_time) delivery_date
    //       , DATEDIFF(NOW(), max(b.delivery_time)) as delivery_day
    //     from
    //       trn_store_delivery b
    //     where
    //       b.delivery_sts != '5'
    //     group by
    //       b.store_id
    //   ) bb
    //     on aa.store_id = bb.store_id
    //   left join mst_store cc
    //     on aa.store_id = cc.store_id
    //   left join users dd
    //     on cc.salesman_id = dd.id
    //   left join mst_area ee
    //     on cc.area1 = ee.area_id
    //   left join mst_area ff
    //     on cc.area2 = ff.area_id
    //   where
    //     cc.active_flg = '1' and  bb.delivery_day >20 ";
    //     $sql .= $this->andWhereInt($param, 'sale_id', 'cc.salesman_id', $sqlParam);
    //     $sql .= "
    //   order by
    //     bb.delivery_day asc
    //     ";

    //     return DB::select(DB::raw($sql), $sqlParam);
    // }

    // /**
    //  * Get todo etest of user
    //  * @param  [type] $param [description]
    //  * @return [type]        [description]
    //  */
    // public function getStatisticsDelivery($param)
    // {
    //     $sqlParam = [];
    //     $sql      = "
		// 	select
		// 	  DATE_FORMAT(delivery_time, '%Y-%m') yearmonth
		// 	  , sum(total) total
		// 	  , sum(total_with_discount) total_with_discount
		// 	from
		// 	  trn_store_delivery 
		// 	where
		// 	  delivery_sts in ('1', '8', '9', '4') and year(delivery_time) = year(now()) and order_type =1 ";
    //   $sql .= $this->andWhereInt($param, 'supplier_id', 'supplier_id', $sqlParam);
		// 	$sql .= "group by
		// 	  DATE_FORMAT(delivery_time, '%Y-%m')
		// 	order by
		// 	  delivery_time
		// 	 ";

    //     return DB::select(DB::raw($sql), $sqlParam);
    // }

    // /**
    //  * @param $param
    //  */
    // public function getStatisticsSalesman($param)
    // {
    //     $sqlParam = [];
    //     $sql      = "
    //   select
    //     aa.yearmonth
    //     , coalesce(bb.total,0) as total
    //     , coalesce(bb.total_special,0) as  total_special
    //   from
    //     (
    //     select
    //       case
    //         when a.id<10 then
    //           concat(year(now()),'-0', a.id)
    //         else
    //           concat(year(now()),'-', a.id)
    //       end as yearmonth
    //     from
    //       users a
    //     where
    //       a.id between 1 and 12
    //     ) aa
    //     left join
    //   (select
    //     a.yearmonth
    //     , a.total_with_discount_a + b. total_with_discount_b*0.5 as total
    //     , b. total_with_discount_b*0.5 as total_special
    //   from
    //   (
    //   select
    //     DATE_FORMAT(delivery_time, '%Y-%m') yearmonth
    //     , sum(total_with_discount) total_with_discount_a
    //   from
    //   trn_store_delivery a left join mst_store b
    //   on a.store_id = b.store_id
    //   where
    //   a.discount_1 = b.discount
    //    and a.order_type = 1
    //    and a.delivery_sts in ('9', '1', '4', '8')
    //    and year(a.delivery_time) = year(now())
    //    ";
    //     $sql .= $this->andWhereInt($param, 'sale_id', 'a.salesman_id', $sqlParam);
    //     $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);


    //     $sql .= "

    //   group by
    //   DATE_FORMAT(delivery_time, '%Y-%m')
    //   order by
    //     delivery_time )a
    //     left  join
    //   (
    //   select
    //     DATE_FORMAT(delivery_time, '%Y-%m') yearmonth
    //     , sum(total_with_discount) total_with_discount_b
    //   from
    //     trn_store_delivery a left join mst_store b
    //     on a.store_id = b.store_id
    //   where
    //     a.discount_1 != b.discount
    //     and a.order_type = 1
    //     and a.delivery_sts in ('9', '1', '4', '8')
    //     and year(a.delivery_time) = year(now()) ";
    //     $sql .= $this->andWhereInt($param, 'sale_id', 'a.salesman_id', $sqlParam);
    //     $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);
    //     $sql .= "
    //     group by
    //     DATE_FORMAT(delivery_time, '%Y-%m')
    //     order by
    //       delivery_time ) b  on a.yearmonth = b.yearmonth
    //       ) bb on aa.yearmonth =  bb.yearmonth
		// 	 ";

    //     return DB::select(DB::raw($sql), $sqlParam);
    // }

    // /**
    //  * @param $param
    //  */
    // public function getNeedToPay($param)
    // {
    //     $sqlParam = [];
    //     $sql      = "
    //     select
    //     e.name as group_area_name
    //     , e.payment_day
    //     , coalesce(c.name, '') area1
    //     , coalesce(d.name, '') area2
    //     , b.store_id
    //     , b.name as store_name
    //     , b.address as store_address
    //     , b.level
    //     , f.order_date
    //     , f.store_order_code
    //     , f.store_order_id
    //     , h.store_delivery_id
    //     , a.delivery_date
    //     , DATE_ADD(a.delivery_date, interval coalesce(e.payment_day,3) day) delivery_date_deadline
    //     , h.total_with_discount
    //     , h.delivery_sts
    //     , h.salesman_id
    //     , h.store_delivery_code
    //     , g.name salesman_name
    //     , a.payment_start
    //     , a.payment_end
    //     , a.payment_date
    //     , a.remain_amount
    //     , a.sts
    //     , DATEDIFF( coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day as delay
    //     , DATEDIFF( coalesce(a.payment_date, CURDATE()), a.delivery_date ) days
    //   from
    //     trn_store_payment_status a
    //     left join mst_store b
    //       on a.store_id = b.store_id
    //     left join mst_area c
    //       on b.area1 = c.area_id
    //     left join mst_area d
    //       on b.area2 = d.area_id
    //     left join mst_area_group e
    //       on c.area_group_id = e.area_group_id
    //     left join trn_store_delivery h
    //       on h.store_delivery_id = a.store_delivery_id
    //     left join trn_store_order f
    //       on h.store_order_id = f.store_order_id
    //     left join users g
    //       on h.salesman_id = g.id
    //     where
    //       h.delivery_sts != '5' and
    //       DATEDIFF(coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day > 0
    //       and a.sts = '0'  ";
    //     $sql .= $this->andWhereInt($param, 'sale_id', 'b.salesman_id', $sqlParam);
    //     $sql .= "
    //     order by
    //     DATEDIFF(coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day desc

		// 	 ";

    //     return DB::select(DB::raw($sql), $sqlParam);
    // }

    // /**
    //  * Select list in warehouse
    //  *
    //  * @param [type] $param
    //  * @return void
    //  */
    // public function selectListProductInWarehouse()
    // {
    //     $sqlParam = array();
    //     $sql      = "
		// 		select
		// 		  a.product_id
    //       , a.product_code
		// 		  , a.product_cat_id
		// 		  , a.stock_code
		// 		  , a.name
		// 		  , a.name_origin
		// 		  , a.color
		// 		  , a.standard_packing
		// 		  , a.selling_price
    //       , a.supplier_id
		// 		  , b.product_cat_code
		// 		  , b.name product_cat_name
		// 		  , c.supplier_code
		// 		  , c.name supplier_name
		// 		  , (
    //         d.in_num + d.in_num_edit + d.in_num_warehouse - d.out_num - d.out_num_edit - d.out_num_warehouse
    //       ) as amount
    //       , e.length*e.width*e.height/1000000000 as volume
		// 		from
		// 		  mst_product a
		// 		  left join mst_product_cat b
		// 		    on a.product_cat_id = b.product_cat_id
		// 		  left join mst_supplier c
		// 		    on a.supplier_id = c.supplier_id join (
		// 		      select
		// 		        a.product_id
		// 		        , sum(
		// 		          case
		// 		            when a.warehouse_change_type in (1,5,6)
		// 		            then amount
		// 		            else 0
		// 		            end
		// 		        ) in_num
		// 		        , sum(
		// 		          case
		// 		            when a.warehouse_change_type = 2
		// 		            then amount
		// 		            else 0
		// 		            end
		// 		        ) out_num
		// 		        , sum(
		// 		          case
		// 		            when a.warehouse_change_type = 3
		// 		            then amount
		// 		            else 0
		// 		            end
		// 		        ) in_num_edit
		// 		        , sum(
		// 		          case
		// 		            when a.warehouse_change_type = 4
		// 		            then amount
		// 		            else 0
		// 		            end
    //             ) out_num_edit
    //             , sum(
    //               case
    //                 when a.warehouse_change_type = 7
    //                 then amount
    //                 else 0
    //                 end
    //               ) in_num_warehouse
    //               , sum(
    //               case
    //                 when a.warehouse_change_type = 8
    //                 then amount
    //                 else 0
    //                 end
    //               ) out_num_warehouse
		// 		      from
    //             trn_warehouse_change a
    //           where
    //              a.active_flg = '1'
		// 		      group by
		// 		        a.product_id
		// 		    ) d
    //         on a.product_id = d.product_id
    //         left join mst_packaging e
    //         on e.packaging_id = a.packaging_id
		// 		where
		// 		  a.active_flg = '1'
    //       and (
    //         d.in_num + d.in_num_edit + d.in_num_warehouse - d.out_num - d.out_num_edit - d.out_num_warehouse
    //       ) <> 0
		// 		order by
		// 		  (
		// 		    d.in_num + d.in_num_edit + d.in_num_warehouse - d.out_num - d.out_num_edit - d.out_num_warehouse
		// 		  ) desc

		// 	";

    //     return DB::select(DB::raw($sql), $sqlParam);
    // }

    // /**
    //  * @param $warehouse_id
    //  */
    // public function selectListProductInWarehouse_specific($warehouse_id)
    // {
    //     $sqlParam = array();
    //     $sql      = "
		// 		select
		// 		  a.product_id
    //       , a.product_code
		// 		  , a.product_cat_id
		// 		  , a.stock_code
		// 		  , a.name
		// 		  , a.name_origin
		// 		  , a.color
		// 		  , a.standard_packing
		// 		  , a.selling_price
		// 		  , b.product_cat_code
		// 		  , b.name product_cat_name
		// 		  , c.supplier_code
		// 		  , c.name supplier_name
		// 		  , (
		// 		    d.in_num + d.in_num_edit + d.in_num_warehouse - d.out_num - d.out_num_edit - d.out_num_warehouse
		// 		  ) as amount
		// 		from
		// 		  mst_product a
		// 		  left join mst_product_cat b
		// 		    on a.product_cat_id = b.product_cat_id
		// 		  left join mst_supplier c
		// 		    on a.supplier_id = c.supplier_id join (
		// 		      select
    //             a.product_id
    //             , a.warehouse_id
		// 		        , sum(
		// 		          case
		// 		            when a.warehouse_change_type in (1,5,6)
		// 		            then amount
		// 		            else 0
		// 		            end
		// 		        ) in_num
		// 		        , sum(
		// 		          case
		// 		            when a.warehouse_change_type = 2
		// 		            then amount
		// 		            else 0
		// 		            end
		// 		        ) out_num
		// 		        , sum(
		// 		          case
		// 		            when a.warehouse_change_type = 3
		// 		            then amount
		// 		            else 0
		// 		            end
		// 		        ) in_num_edit
		// 		        , sum(
		// 		          case
		// 		            when a.warehouse_change_type = 4
		// 		            then amount
		// 		            else 0
		// 		            end
    //             ) out_num_edit
    //             , sum(
    //               case
    //                 when a.warehouse_change_type = 7
    //                 then amount
    //                 else 0
    //                 end
    //               ) in_num_warehouse
    //               , sum(
    //               case
    //                 when a.warehouse_change_type = 8
    //                 then amount
    //                 else 0
    //                 end
    //               ) out_num_warehouse
		// 		      from
    //             trn_warehouse_change a
    //           where
    //             a.warehouse_id = ?    and a.active_flg = '1'
		// 		      group by
		// 		        a.product_id
		// 		    ) d
		// 		    on a.product_id = d.product_id
		// 		where
		// 		  a.active_flg = '1'

		// 		order by
		// 		  (
		// 		    d.in_num + d.in_num_edit + d.in_num_warehouse - d.out_num - d.out_num_edit - d.out_num_warehouse
		// 		  ) desc

		// 	";
    //     $sqlParam[] = $warehouse_id;

    //     return DB::select(DB::raw($sql), $sqlParam);
    // }

    // /**
    //  * @param $param
    //  */
    // public function selectCSToday($param)
    // {
    //     $sqlParam = array();
    //     $sql      = "
    //       select
    //           b.name as store_name
    //           , d.name as area1
    //           , e.name as area2
    //           , c.name as created_by
    //           , f.name as salesman_name
    //           , a.created_at
    //           , a.cus_rating
    //           , a.status
    //           , a.cus_review
    //           , a.com_resolve
    //           , b.store_id
    //       from
    //           trn_cs_notes a left join mst_store b
    //           on a.store_id = b.store_id
    //           left join users c
    //           on a.created_by = c.id
    //           left join mst_area d
    //           on b.area1 = d.area_id
    //           left join mst_area e
    //           on b.area2 = e.area_id
    //           left join users f
    //               on b.salesman_id = f.id
    //       where
    //           a.active_flg = '1'  and a.status = 0 ";
    //     $sql .= $this->andWhereInt($param, 'sale_id', 'b.salesman_id', $sqlParam);
    //     $sql .= "
    //           and date(a.created_at) = ?
    //       ";

    //     $sqlParam[] = Carbon::today();
    //     // $sqlParam[] = Carbon::create(2016, 11, 17, 0, 0, 0);

    //     $sql .= "
    //           order by a.created_at desc
    //         ";

    //     return DB::select(DB::raw($sql), $sqlParam);
    // }

    //   /**
    //  * @param $param
    //  */
    // public function selectPreOrder($param)
    // {
    //     $sqlParam = array();
    //     $sql      = "
    //       select 
    //         a.product_id 
    //         , sum(a.amount) as amount
    //       from 
    //         trn_store_order_detail a 
    //         left join trn_store_order b 
    //         on a.store_order_id = b.store_order_id
    //       where 
    //         b.order_sts in ('0','2','8')
    //       group by 
    //         a.product_id 
    //        ";
       
    //     // $sqlParam[] = Carbon::create(2016, 11, 17, 0, 0, 0)

    //     return DB::select(DB::raw($sql), $sqlParam);
    // }

    // /**
    //  * Download warehouse
    //  *
    //  * @return void
    //  */
    // public function downloadWarehouse()
    // {
    //     $data = $this->selectListProductInWarehouse();

    //     // Create path if not exist
    //     $path = config('constants.DOWNLOAD_DIR');
    //     $path = storage_path($path);

    //     if (!File::exists($path)) {
    //         File::makeDirectory($path, 0755, true, true);
    //     }

    //     $fileName = "TonKho_" . date('ymdhis');
    //     $ext      = "xlsx";

    //     Excel::create($fileName, function ($excel) use ($data) {
    //         $excel->sheet('Tonkho', function ($sheet) use ($data) {
    //             $sheet->loadView('admin.excels.das0100-warehouse')
    //                 ->with('data', $data);
    //         });
    //     })->store($ext, $path);

    //     $fullPath = $path . '/' . $fileName . '.' . $ext;
    //     $key      = $fileName . '.' . $ext;
    //     Cache::put($key, $fullPath, config('constants.DOWNLOAD_EXPIRE_MIN'));

    //     $result = [
    //         'rtnCd' => 0,
    //         'file'  => $key,
    //         'test'  => Cache::get($key),
    //     ];

    //     return $result;
    // }

}
