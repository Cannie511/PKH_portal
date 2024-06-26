<?php

namespace App\Services;

use DB;

/**
 * Hrm0152Service class
 */
class Hrm0152Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function getList($param)
    {
        $sqlParam = array();
        $sql      = "
          select
            a.id
            , a.working_time
            , a.store_id
            , a.salesman_id
            , a.notes
            , a.gps_lat
            , a.gps_long
            , b.name as salesman_name
            , c.gps_lat as store_gps_lat
            , c.gps_long as store_gps_long
            , c.name as store_name
            , c.address as store_address
            , d.name as store_area1_name
            , e.name as store_area2_name
          from
            trn_store_check_in a
            join users b
              on b.id = a.salesman_id
            left join mst_store c
              on c.store_id = a.store_id
            left join mst_area d
              on d.area_id = c.area1
            left join mst_area e
              on e.area_id = c.area2
          where
            a.active_flg = 1
        ";

        $sql .= $this->andWhereInt($param, 'store_id', 'a.store_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'user_id', 'b.id', $sqlParam);
        $sql .= $this->andWhereDateBetween($param, 'dateFrom', 'dateTo', 'a.working_time', $sqlParam);
        $sql .= $this->andWhereString($param, 'store_name', 'c.name', $sqlParam);

        $sql .= " order by a.working_time desc";

        $result = $this->pagination($sql, $sqlParam, $param);

        return $result;
    }

    /**
     * @param $listCheckin
     * @return mixed
     */
    public function getImages($listCheckin)
    {
        $ids   = [];
        $items = $listCheckin->toArray()["data"];

        foreach ($items as $row) {
            $ids[] = $row->id;
        }

        $strIds = implode(",", $ids);

        $sql = "
        select
          a.id
          , a.check_in_id
          , a.img_path
        from
          trn_store_check_in_images a
        where
          a.active_flg = 1 ";

        if (count($ids) > 0) {
            $sql .= " and a.check_in_id in ($strIds) ";
        }

        $sql .= " order by
          check_in_id
          , id
        ";

        $result = DB::select(DB::raw($sql));

        return $result;
    }

}
