<?php

namespace App\Services;

use Carbon\Carbon;

// use App\Models\TrnStoreDeliveryDetail;

/**
 * Crm0320Service.
 * Phân cấp cửa hàng
 */
class Crm0320Service extends BaseService
{
    /**
     * @param $param
     * @return mixed
     */
    public function selectListStore($param)
    {
        $sqlParam = [];
        $sql      = "
             select
               a.store_id
               , a.year
               , a.month
               , a.store_rank
               , a.order_total
               , a.order_total_with_discount
               , a.delivery_total
               , a.delivery_total_with_discount
               , a.payment
               , b.name store_name
               , b.address
               , e.name area_group_name
               , c.name area1_name
               , d.name area2_name
               , f.name salesman_name
             from
               trn_store_rank a
               join mst_store b
                 on a.store_id = b.store_id
               left join mst_area c
                 on b.area1 = c.area_id
               left join mst_area d
                 on d.area_id = b.area2
               left join mst_area_group e
                 on e.area_group_id = c.area_group_id
               left join users f
                 on f.id = b.salesman_id
             where
               a.active_flg = '1'
			 ";

        if (isset($param["month"]) && !empty($param["month"])) {
            $date = Carbon::parse($param["month"] . "-01");

            $param["year"]   = $date->year;
            $param["imonth"] = $date->month;
            $sql .= $this->andWhereInt($param, 'year', 'a.year', $sqlParam);
            $sql .= $this->andWhereInt($param, 'imonth', 'a.month', $sqlParam);
        }

        $sql .= $this->andWhereInt($param, 'sale_id', 'b.salesman_id', $sqlParam);
        $sql .= $this->andWhereString($param, 'name', 'b.name', $sqlParam);
        $sql .= $this->andWhereInt($param, 'areaGroup', 'e.area_group_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area1', 'b.area1', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area2', 'b.area2', $sqlParam);
        $sql .= $this->andWhereInt($param, 'rank', 'a.store_rank', $sqlParam);
        $sql .= $this->andWhereInt($param, 'salesman', 'b.salesman_id', $sqlParam);

        $orderBy = $this->getOrderBy($param, [
            'year_month' => [
                "asc"  => " a.year, a.month ",
                "desc" => " a.year desc, a.month desc ",
            ],
            'salesman'   => [
                "asc"  => " b.salesman_id, a.store_id, a.year , a.month  ",
                "desc" => " b.salesman_id desc, a.store_id desc, a.year, a.month ",
            ],
            'store_name' => [
                "asc"  => " b.name, a.year desc , a.month desc ",
                "desc" => " b.name desc, a.year desc , a.month desc ",
            ],
        ]);
        if (!empty($orderBy)) {
            $sql .= $orderBy;
        } else {
            $sql .= "
            order by
                  a.year desc
                  , a.month desc
                  , c.area_group_id
                  , b.area1
                  , b.area2
                  , a.store_rank
            ";
        }

        return $this->pagination($sql, $sqlParam, $param);
    }

}
