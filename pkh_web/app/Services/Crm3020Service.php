<?php

namespace App\Services;

use DB;
/**
 * Crm3020Service class
 */
class Crm3020Service extends BaseService
{
    /**
     * @param $params
     * @return void
     */
    public function selectList($param)
    {
        $sqlParam = array();
        $sql = "select * from mst_store where 1=1 ";
        $sql .= $this->andWhereInt($param, 'store_id', 'store_id', $sqlParam);
        $list = DB::select(DB::raw($sql), $sqlParam);
        if (count($list) == 0) {
            return null;
        }

        return $list[0];  
    }
    public function getAvgCountAStoreOrderQuarterOfYear($store_id)
{   
    
    $sql = "
        SELECT 
            COUNT(a.order_date) AS total_order_count
        FROM 
            trn_store_order a
        WHERE 
            a.order_date IS NOT NULL
            AND YEAR(a.order_date) = 2020
            AND a.store_id = :store_id
            AND MONTH(a.order_date) BETWEEN 1 AND 3 
    ";

    $sqlParam = ['store_id' => $store_id];
    $list = DB::select(DB::raw($sql), $sqlParam);
    return !empty($list) ? $list[0]->total_order_count : 0;
}
}