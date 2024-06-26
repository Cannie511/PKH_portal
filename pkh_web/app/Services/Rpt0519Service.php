<?php

namespace App\Services;

use DB;

/**
 * Rpt0519Service class
 */
class Rpt0519Service extends BaseService
{
    public function selectSalesman(
        
    ) {
        $sqlParam = array();
        $sql      = "
            select 
                b.id
                , b.name
                from 
                 users b
                left join role_user c
                on b.id = c.user_id
            where 
                b.email_verified = '1' and c.role_id in (5,3) ";
        

        return DB::select(DB::raw($sql), $sqlParam);
    }

    public function selectProduct(
        
        ) {
            $sqlParam = array();
            $sql      = "
            select 
            aa.product_id
            ,  left(b.product_code,6) as name
           
           from 
           ( 
           select 
           a.product_id 
           , sum(a.amount) as amount
           from 
           trn_store_delivery_detail a 
           group by 
           a.product_id 
           ) aa left join mst_product b
           on aa.product_id = b.product_id 
           order by
                       aa.amount desc ";
            
    
            return DB::select(DB::raw($sql), $sqlParam);
        }

        public function selectSaleProduct(
        $param
            ) {
                $sqlParam = array();
                $sql      = "
                select 
                    a.salesman_id
                    , d.product_id
                    , sum(d.amount) as amount
                from 
                    trn_store_delivery a left join users b
                    on a.salesman_id = b.id 
                    left join role_user c
                    on b.id = c.user_id
                    left join trn_store_delivery_detail d
                    on a.store_delivery_id = d.store_delivery_id
                where 
                    a.delivery_sts in ('9','4','1','8') and a.order_type = 1  and b.email_verified = '1' and c.role_id in (5,3) ";
                $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);
        
                $sql .= $this->andWhereDateBetween($param, 'from_date', 'to_date', 'date(a.delivery_time)', $sqlParam);

                $sql  .=   " group by 
                a.salesman_id
                , d.product_id  ";
        
                return DB::select(DB::raw($sql), $sqlParam);
            }
    
            
    
          /**
         * @param $param
         * @param $flag
         * @param $time_mode
         */
        public function selectTurnover(
            $param
        ) {
            $sqlParam = array();
            $sql      = "
                select 
                    a.salesman_id as id
                    , b.name
                    , sum(a.total_with_discount) as amount
                    , count(a.store_delivery_id) as count_del
                    , avg(datediff( d.confirm_time,d.created_at)) as confirm_time
                    , avg(datediff( a.shipping_time,d.confirm_time)) as shipping_time
                    ,  count(distinct a.store_id) as store_del
                    from 
                    trn_store_delivery a left join users b
                    on a.salesman_id = b.id 
                    left join role_user c
                    on b.id = c.user_id
                    left join trn_store_order d
                    on a.store_order_id = d.store_order_id
                where 
                    a.delivery_sts in ('9','4','1','8') and a.order_type = 1  and b.email_verified = '1' and c.role_id in (5,3) ";
            $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);
            $sql .= $this->andWhereDateBetween($param, 'from_date', 'to_date', 'date(a.delivery_time)', $sqlParam);
    
            $sql  .=   " group by 
                    a.salesman_id  ";
    
            return DB::select(DB::raw($sql), $sqlParam);
    
        }
    
          /**
         * @param $param
         * @param $flag
         * @param $time_mode
         */
        public function selectCheckin(
            $param
        ) {
            $sqlParam = array();
            $sql      = "
                select 
                    a.salesman_id as id 
                    , count(a.id) as count_checkin
                from 
                trn_store_check_in a 
                where 
                a.active_flg = '1' 
               ";
            
            $sql .= $this->andWhereDateBetween($param, 'from_date', 'to_date', 'date(a.created_at)', $sqlParam);
    
            $sql  .=   " group by 
                    a.salesman_id  ";
    
            return DB::select(DB::raw($sql), $sqlParam);
    
        }

    

      /**
     * @param $param
     * @param $flag
     * @param $time_mode
     */
    public function selectStore(
        $param
    ) {
        $sqlParam = array();
        $sql      = "
                select 
                a.salesman_id as id 
                , count(a.store_id) as count_store
                from 
                mst_store a
                where 
                a.first_order is not null
        
           ";
        
        // $sql .= $this->andWhereDateBetween($param, 'from_date', 'to_date', 'date(a.created_at)', $sqlParam);

        $sql  .=   " group by 
                a.salesman_id  ";

        return DB::select(DB::raw($sql), $sqlParam);

    }

       /**
     * @param $param
     * @param $flag
     * @param $time_mode
     */
    public function selectNewStore(
        $param
    ) {
        $sqlParam = array();
        $sql      = "
                select 
                a.salesman_id as id 
                , count(a.store_id) as count_new_store
                from 
                mst_store a
                where 
                a.first_order is not null
        
           ";
        
        $sql .= $this->andWhereDateBetween($param, 'from_date', 'to_date', 'date(a.first_order)', $sqlParam);

        $sql  .=   " group by 
                a.salesman_id  ";

        return DB::select(DB::raw($sql), $sqlParam);

    }

        /**
     * @param $param
     * @param $flag
     * @param $time_mode
     */
    public function selectPayment(
        $param
    ) {
        $sqlParam = array();
        $sql      = "
        select 
        a.salesman_id as id
        , sum(a.payment_money) as amount
        , sum(case when a.payment_type = 1 then a.payment_money else 0 end) as ck
        , sum(case when a.payment_type = 0 then a.payment_money else 0 end) as cash
        ,  sum(case when a.payment_type = 3 then a.payment_money else 0 end) as inc
        , sum(case when a.payment_type = 4 then a.payment_money else 0 end) as decs
        , sum(case when a.payment_type = 1 then 1 else 0 end) as count_ck
        , sum(case when a.payment_type = 0 then 1 else 0 end) as count_cash
        from 
        trn_payment a 
        left join users b on a.salesman_id = b.id
        left join role_user c on b.id = c.user_id
        where 
            b.email_verified = '1' and c.role_id in (5,3)
        
           ";   
        $sql .= $this->andWhereDateBetween($param, 'from_date', 'to_date', 'a.created_at', $sqlParam);

        $sql  .=   " group by 
                a.salesman_id  ";

        return DB::select(DB::raw($sql), $sqlParam);

    }

        /**
     * @param $param
     * @param $flag
     * @param $time_mode
     */
    public function selectPaymentStatus(
        $param
    ) {
        $sqlParam = array();
        $sql      = "
        select 
        b.salesman_id as id
        , avg(DATEDIFF( coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day) as delay
        , sum(a.remain_amount) as remain
        from 
        trn_store_payment_status a
          left join mst_store b
            on a.store_id = b.store_id
          left join mst_area c
            on b.area1 = c.area_id
          left join mst_area d
            on b.area2 = d.area_id
          left join mst_area_group e
            on c.area_group_id = e.area_group_id
         left join users f on b.salesman_id = f.id
                left join role_user g on f.id = g.user_id
        where 
            f.email_verified = '1' and g.role_id in (5,3)
        
           ";   
        $sql .= $this->andWhereDateBetween($param, 'from_date', 'to_date', 'a.delivery_date', $sqlParam);

        $sql  .=   " group by 
                b.salesman_id  ";

        return DB::select(DB::raw($sql), $sqlParam);

    }

       /**
     * @param $param
     * @param $flag
     * @param $time_mode
     */
    public function selectOrderDay(
        $param
    ) {
        $sqlParam = array();
        if (isset($param["to_date"])){
           
            $sql_a = "
            (
                select
                    a.store_id
                    , max(a.order_date) order_date
                    , DATEDIFF('" . strval($param["to_date"]) ."', max(a.order_date)) as order_day
                from
                    trn_store_order a
                where
                    a.order_sts != '5' and a.order_date <= ?
                group by
                    a.store_id
                ) aa
            ";
            $sqlParam[] = $param["to_date"];
        } else {
            $sql_a = "
            (
                select
                    a.store_id
                    , max(a.order_date) order_date
                    , DATEDIFF(NOW(), max(a.order_date)) as order_day
                from
                    trn_store_order a
                where
                    a.order_sts != '5' 
                group by
                    a.store_id
                ) aa
            ";
        }
        
        $sql      = "
        select
                cc.salesman_id as id
                , sum(
                    case
                    when aa.order_day < 30 then 1 else 0
                    end
                ) as under30
                , sum(
                    case
                    when (aa.order_day < 60) and  (aa.order_day >=30) then 1 else 0
                    end
                ) as under60
                , sum(
                    case
                    when (aa.order_day < 90) and  (aa.order_day >=60) then 1 else 0
                    end
                ) as under90
                , sum(
                    case
                    when (aa.order_day >=90)  then 1 else 0
                    end
                ) as big90
        from" .$sql_a 
            . "
            left join mst_store cc
            on aa.store_id = cc.store_id
            left join users dd
            on cc.salesman_id = dd.id
                    left join mst_area ee
                    on cc.area1 = ee.area_id
                    left join mst_area ff
                    on cc.area2 = ff.area_id
                    where
                    cc.active_flg = '1'  
            group by 
                cc.salesman_id 
        
           ";
        
        // $sql .= $this->andWhereDateBetween($param, 'from_date', 'to_date', 'date(a.first_order)', $sqlParam);

        

        return DB::select(DB::raw($sql), $sqlParam);

    }
}