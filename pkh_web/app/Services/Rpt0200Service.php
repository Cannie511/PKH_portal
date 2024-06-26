<?php

namespace App\Services;

use DB;

class Rpt0200Service extends BaseService
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
     * getOrder
     *      Param:
     *          - year
     */
    public function getOrder($param)
    {
        $sqlParam = array();
        $sql      = "
				select
				  year (a.order_date) as year
				  , month (a.order_date) as month
				  , sum(a.total) total
				  , sum(a.total_with_discount) total_with_discount
				from
				  trn_store_order a join mst_store b
				    on a.store_id = b.store_id
				where
				  year (a.order_date) = ?
          and a.order_sts != '6'
          and a.order_sts != '5'
          and a.order_type = 1 ";
        if (isset($param['year'])) {
            $sqlParam[] = $param['year'];
        } else {
            $sqlParam[] = date('Y');
        }

        $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);
  
				$sql .= "group by
					year (a.order_date)
				  , month (a.order_date)
            ";

       
        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

//Hang bao hanh hang mau
    /**
     * @param $param
     * @return mixed
     */
    public function getSpecialOrder($param)
    {
        $sqlParam = array();
        $sql      = "
				select
				  year (a.order_date) as year
				  , month (a.order_date) as month
				  , sum(a.total) total
				  , sum(a.total_with_discount) total_with_discount
				from
				  trn_store_order a join mst_store b
				    on a.store_id = b.store_id
				where
				  year (a.order_date) = ?
          and a.order_sts != '6'
          and a.order_sts != '5'
          and a.order_type != 1 ";
          if (isset($param['year'])) {
            $sqlParam[] = $param['year'];
        } else {
            $sqlParam[] = date('Y');
        }

        $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);
          
				$sql.="group by
					year (a.order_date)
				  , month (a.order_date)
            ";

       
        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getCancleOrder($param)
    {
        $sqlParam = array();
        $sql      = "
				select
				  year (a.order_date) as year
				  , month (a.order_date) as month
				  , sum(a.total) total
				  , sum(a.total_with_discount) total_with_discount
				from
				  trn_store_order a join mst_store b
				    on a.store_id = b.store_id
				where
				  year (a.order_date) = ?
          and a.order_sts = '5' ";
          if (isset($param['year'])) {
            $sqlParam[] = $param['year'];
        } else {
            $sqlParam[] = date('Y');
        }
        $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);

				$sql .= " group by
					year (a.order_date)
				  , month (a.order_date)
            ";

        

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getCancleRemainOrder($param)
    {
        $sqlParam = array();
        $sql      = "
				select
				  year (a.order_date) as year
				  , month (a.order_date) as month
				  , sum(a.total) total
				  , sum(a.total_with_discount) total_with_discount
				from
				  trn_store_order a join mst_store b
				    on a.store_id = b.store_id
				where
				  year (a.order_date) = ?
          and a.order_sts = '6' ";
          if (isset($param['year'])) {
            $sqlParam[] = $param['year'];
        } else {
            $sqlParam[] = date('Y');
        }
        $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);
				$sql .= "group by
					year (a.order_date)
				  , month (a.order_date)
            ";

        

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * getOrder
     *      Param:
     *          - year
     */
    public function getDelivery($param)
    {
        $sqlParam = array();
        $sql      = "

			select
			  year (a.delivery_time) as year
			  , month (a.delivery_time) as month
			  , sum(a.total) total
			  , sum(a.total_with_discount) total_with_discount
			from
			  trn_store_delivery a
			where
			  year (a.delivery_time) = ?
			  and a.order_type = 1
			  and a.delivery_sts in ('1','4','8','9') ";
         // and c.inner_flg = 0
         $sqlParam[] = $param['year'];
      $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);
			$sql .=" group by
			  year (a.delivery_time)
			  , month (a.delivery_time)
            ";
       

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getCancleDelivery($param)
    {
        $sqlParam = array();
        $sql      = "

			select
			  year (a.delivery_time) as year
			  , month (a.delivery_time) as month
			  , sum(a.total) total
			  , sum(a.total_with_discount) total_with_discount
			from
			  trn_store_delivery a
			where
			  year (a.delivery_time) = ?
			  and a.delivery_sts = '5' ";
        // and c.inner_flg = 0
        $sqlParam[] = $param['year'];
      $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);
			$sql .= "group by
			  year (a.delivery_time)
			  , month (a.delivery_time)
            ";
        

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getSpecialDelivery($param)
    {
        $sqlParam = array();
        $sql      = "

			select
			  year (a.delivery_time) as year
			  , month (a.delivery_time) as month
			  , sum(a.total) total
			  , sum(a.total_with_discount) total_with_discount
			from
			  trn_store_delivery a
			where
			  year (a.delivery_time) = ?
			  and a.order_type != 1
			  and a.delivery_sts != '5' ";
           // and c.inner_flg = 0
           $sqlParam[] = $param['year'];

      $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);
			$sql .= "group by
			  year (a.delivery_time)
			  , month (a.delivery_time)
            ";
     
        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getPayment($param)
    {
        $sqlParam = array();
        $sql      = "
            select
              year (a.payment_date) as year
              , month (a.payment_date) as month
              , sum(a.payment_money) total
            from
              trn_payment a
            where
              year (a.payment_date) = ?
            group by
              year (a.payment_date)
              , month (a.payment_date)
            ";
        $sqlParam[] = $param['year'];

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

     /**
     * @param $param
     * @return mixed
     */
    public function getPurchasing($param)
    {
        $sqlParam = array();
        $sql = "
            select
                year(a.import_date ) as year 
                  , month(a.import_date ) as month
                  , sum(c.total) as total 
                  , count(*) as count
                  , a.notes
                  ,a.active_flg
              from
                  trn_import_wh_factory a
                  left join trn_supplier_delivery c
                      on a.supplier_id = c.supplier_delivery_id
              where
                  a.active_flg >= 0 and  year (a.import_date ) = ?
        ";
        $sqlParam[] = $param['year'];
        $sql .= $this->andWhereInt($param, 'supplier_id', 'c.supplier_id', $sqlParam);

        $sql .= "
        group by 
            year(a.import_date )
              , month(a.import_date ) 
      ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }


    /**
     * @param $param
     * @return mixed
     */
    public function getImport($param)
    {
        $sqlParam = array();
        //Xuat ra gia von = total_duty* 110% + landed_cost + freight_cost+ insurance_cost
        $sql = "
            select
              year (a.comming_pkh_date) as year
              , month (a.comming_pkh_date) as month
              , sum(a.total_duty_vi)*1.1 + sum(a.frieght_cost)+ sum(a.landed_cost)+ sum(a.insurance_cost) total
            from
              trn_supplier_delivery a
            where
              year (a.comming_pkh_date) = ? ";
              $sqlParam[] = $param['year'];
            $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);

            $sql .= " group by
              year (a.comming_pkh_date)
              , month (a.comming_pkh_date)
            ";
       

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getCostTransit($param)
    {
        $sqlParam = array();
        $sql      = "
            select
              year (a.delivery_date) as year
              , month (a.delivery_date) as month
              , sum(a.price) total
            from
              trn_delivery a
            where
              year (a.delivery_date) = ?
            group by
              year (a.delivery_date)
              , month (a.delivery_date)
            ";
        $sqlParam[] = $param['year'];

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getCost($param)
    {
        $sqlParam = array();
        $sql      = "
          select
            year (a.cost_date) as year
            , month (a.cost_date) as month
            , sum(a.amount) total
          from
            trn_cost a
          where
            year (a.cost_date) = ?
          group by
            year (a.cost_date)
            , month (a.cost_date)
          ";
        $sqlParam[] = $param['year'];

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

}
