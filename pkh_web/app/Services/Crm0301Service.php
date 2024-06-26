<?php

namespace App\Services;

use DB;

/**
 * Crm0301Service class
 */
class Crm0301Service extends BaseService
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
          a.store_id
          , a.name
          , a.address
          , c.name as area1_name
          , d.name as area2_name
          , a.gps_lat
          , a.gps_long
          , a.salesman_id
          , b.name as salesman_name
          , a.first_order
        from
          mst_store a
          left join users b
            on b.id = a.salesman_id
          left join mst_area c
            on c.area_id = a.area1
          left join mst_area d
            on d.area_id = a.area2
        where
          a.active_flg = 1
          and a.first_order is not null
          and a.gps_lat <> 0
        ";

        // $result = array();
        //$result =  $this->pagination($sql, $sqlParam, $param);

        // return $result;

        return DB::select(DB::raw($sql), $sqlParam);
    }

}
