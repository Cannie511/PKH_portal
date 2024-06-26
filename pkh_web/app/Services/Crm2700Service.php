<?php

namespace App\Services;

use DB;

/**
 * Crm2700Service class
 */
class Crm2700Service extends BaseService
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
        SELECT
            a.id,
            a.product_id,
            a.area1,
            a.area2,
            a.name,
            a.email,
            a.tel,
            a.store,
            a.purchase_date,
            a.ip,
            a.agent,
            a.ip_as,
            a.ip_city,
            a.ip_country,
            a.ip_country_code,
            a.ip_isp,
            a.ip_lat,
            a.ip_lon,
            a.ip_org,
            a.ip_region,
            a.ip_region_name,
            a.ip_timezone,
            a.ip_zip,
            a.created_at,
            b.name area1_name,
            c.name area2_name,
            d.product_code
         FROM `trn_guarantee` a
         left join mst_area b on a.area1 = b.area_id
         left join mst_area c on a.area2 = c.area_id
         left join mst_product d on a.product_id = d.product_id
         WHERE 1 = 1
        ";

        $sql .= $this->andWhereString($param, 'email', 'a.email', $sqlParam);
        $sql .= $this->andWhereString($param, 'tel', 'a.tel', $sqlParam);

        $sql .= "
            order by
            a.created_at desc
        ";

        $result = [];

        if (isset($param['export']) && true == $param['export']) {
            $result = DB::select(DB::raw($sql), $sqlParam);
        } else {
            $result = $this->pagination($sql, $sqlParam, $param);
        }

        return $result;
    }

}
