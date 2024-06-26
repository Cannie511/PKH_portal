<?php

namespace App\Services;

use DB;

/**
 * Crm2400Service class
 */
class Crm2400Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectList($param)
    {
        $sqlParam = array();
        $sql      = "
			   select
          aa.store_id
          , cc.name as store_name
          , cc.address
          , cc.level
          , dd.name as salesman_name
          , aa.order_date
          , aa.order_day
          , DATE (bb.delivery_date) as delivery_date
          , bb.delivery_day
          , ee.name  as area1_name
          , ff.name as area2_name
        from
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
          left join (
            select
              b.store_id
              , max(b.delivery_time) delivery_date
              , DATEDIFF(NOW(), max(b.delivery_time)) as delivery_day
            from
              trn_store_delivery b
            where
              b.delivery_sts != '5'
            group by
              b.store_id
          ) bb
            on aa.store_id = bb.store_id
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
			";

        $sql .= $this->andWhereInt($param, 'level', 'cc.level', $sqlParam);
        $sql .= $this->andWhereInt($param, 'salesman_id', 'cc.salesman_id', $sqlParam);
        $sql .= $this->andWhereString($param, 'store_name', 'cc.name', $sqlParam);
        $sql .= $this->andWhereInt($param, 'sale_id', 'cc.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area1', 'cc.area1', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area2', 'cc.area2', $sqlParam);

        $sql .= $this->getOrderBy($param);

        if (isset($param['down']) && 1 == $param['down']) {
            return DB::select(DB::raw($sql), $sqlParam);
        }

        return $this->pagination($sql, $sqlParam, $param);
    }

}
