<?php

namespace App\Services;

class Crm0500Service extends BaseService
{
    /**
     * @param $param
     * @return mixed
     */
    public function selectList($param)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.id as cs_id
                , b.name as store_name
                , d.name as area1
                , e.name as area2
                , c.name as created_by
                , g.name as updated_by
                , f.name as salesman_name
                , a.created_at
                , a.updated_at
                , a.cus_rating
                , a.status
                , a.cus_review
                , a.com_resolve
                , a.completed_time
                , a.deadline
                , hour(timediff(now(), a.created_at) ) as pending_hour
				, hour(timediff(a.completed_time, a.created_at) ) as complete_hour
				, timediff(a.completed_time, a.deadline) as delay_hour
            from
                trn_cs_notes a left join mst_store b
                on a.store_id = b.store_id
                left join users c
                on a.created_by = c.id
                left join mst_area d
                on b.area1 = d.area_id
                left join mst_area e
                on b.area2 = e.area_id
                left join users f
                    on b.salesman_id = f.id
                left join users g
                    on a.updated_by = g.id
            where
                a.active_flg = '1'
        ";
        $sql .= $this->andWhereInt($param, 'store_id', 'b.store_id', $sqlParam);

        $sql .= $this->andWhereInt($param, 'salesman_id', 'b.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'areaGroup', 'd.area_group_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'status', 'a.status', $sqlParam);

        $sql .= $this->andWhereInt($param, 'area1', 'd.area_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area2', 'e.area_id', $sqlParam);
        $sql .= $this->andWhereString($param, 'store_name', 'b.name', $sqlParam);
        $sql .= $this->andWhereDateBetween($param, 'from_date', 'to_date', 'a.created_at', $sqlParam);

        $sql .= "
            order by
                a.created_at desc ";

        return $this->pagination($sql, $sqlParam, $param);
    }

}
