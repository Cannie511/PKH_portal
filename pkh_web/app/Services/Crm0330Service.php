<?php

namespace App\Services;

// use App\Models\TrnStoreDeliveryDetail;

/**
 * Crm0330Service.
 * Phân cấp cửa hàng
 */
class Crm0330Service extends BaseService
{
    /**
     * @param $param
     * @return mixed
     */
    public function selectListStore($param)
    {
        $sqlParam = array();
        $sql      = "
            select
            a.id
            , a.store_id
            , a.salesman_id
            , a.working_time
            , a.notes
            , b.img_path
            , c.name as store_name
            , d.name as area1_name
            , e.name as area2_name
            , f.name as salesman_name
            from
            trn_store_working a
            left join trn_working_img b
                on a.id = b.working_id
            left join mst_store c
                on c.store_id = a.store_id
            left join mst_area d
                on c.area1 = d.area_id
            left join mst_area e
                on c.area2 = e.area_id
            left join users f
                on a.salesman_id = f.id
            where
            a.active_flg = '1'
        ";

        $sql .= $this->andWhereInt($param, 'store_id', 'a.store_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'sale_id', 'c.salesman_id', $sqlParam);
        $sql .= $this->andWhereString($param, 'name', 'c.name', $sqlParam);
        $sql .= $this->andWhereInt($param, 'salesman', 'a.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area1', 'c.area1', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area2', 'c.area2', $sqlParam);
        $sql .= $this->andWhereDateBetween($param, 'from_date', 'to_date', 'a.working_time', $sqlParam);
        $sql .= "
            order by a.working_time desc
        ";

        return $this->pagination($sql, $sqlParam, $param);
        // return DB::select(DB::raw($sql), $sqlParam);
    }

}
