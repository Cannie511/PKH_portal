<?php

namespace App\Services;

use DB;


/**
 * Crm3000Service class
 */
class Crm3010Service extends BaseService
{
    /**
     * @param $params
     * @return void
     */
    public function selectList($param)
    {
        $sqlParam = array();
        $sql = "
            SELECT s.store_id, s.name store_name, s.address, s.supplier_id, p.product_code, p.name product_name
            FROM (
                SELECT DISTINCT c.store_id, b.name, b.address, c.supplier_id
                FROM trn_store_order_detail a
                JOIN trn_store_order c ON a.store_order_id = c.store_order_id
                JOIN mst_store b on c.store_id = b.store_id
            ) s
            CROSS JOIN mst_product p
            WHERE p.product_id NOT IN (
                SELECT a.product_id
                FROM trn_store_order_detail a
                JOIN trn_store_order c ON a.store_order_id = c.store_order_id
                WHERE c.store_id = s.store_id
            )
            ORDER BY s.store_id, p.product_id
        ";
        // $sql .= $this->andWhereString($param, 'name', 'main_query.name', $sqlParam);
        // $sql .= $this->andWhereInt($param, 'level_sales', 'main_query.level_sales', $sqlParam);
        // $sql .= $this->andWhereInt($param, 'level_retention', 'main_query.level_retention', $sqlParam);
        // $sql .= $this->andWhereInt($param, 'level_dept', 'payment.level_dept', $sqlParam);
        // $sql .= $this->andWhereInt($param, 'level_payment_history', 'level_payment_history', $sqlParam);
        // $sql .= $this->andWhereInt($param, 'level_order_frequency', 'main_query.level_order_frequency', $sqlParam);
        // return $this->pagination($sql, $sqlParam, $param);
        return $this->pagination($sql, $sqlParam, $param);   
    }
    public function getAvgSales($param){
        $sqlParam = array();
        $sql = "SELECT COUNT(*)/12 average from trn_store_order WHERE year(order_date) = 2021";
        $list = DB::select(DB::raw($sql), $sqlParam);
        if(count($list) === 0)
            return null;
        return $list[0];
    }

    public function getCountStore($param)
    {
        $sqlParam = array();
        $sql = "SELECT COUNT(*) all_store FROM mst_store where 1=1";
        $list = DB::select(DB::raw($sql), $sqlParam);
        if (count($list) === 0) return null;
        return $list[0];
    }
    public function getAverageSalePerYear($param){
        $sqlParam = array();
        $sql = "SELECT SUM(total_with_discount)/12 avg_total from trn_store_order
                where year(order_date) = 2021";
        $list = DB::select(DB::raw($sql), $sqlParam);
        if(count($list) === 0) return null;
        return $list[0]->avg_total;
    }
}