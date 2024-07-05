<?php

namespace App\Services;

use DB;


/**
 * Crm3010Service class
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
            SELECT DISTINCT s.store_id, s.store_name, s.address, s.supplier_id, p.product_code, p.name product_name
            FROM (
                SELECT DISTINCT c.store_id, b.name store_name, b.address, c.supplier_id
                FROM trn_store_order_detail a
                JOIN trn_store_order c ON a.store_order_id = c.store_order_id
                JOIN mst_store b on c.store_id = b.store_id
            ) s
            JOIN mst_product p 
            WHERE 
                1=1 and s.store_id = 97
        ";
        $sql .= $this->andWhereString($param, 'name', 'store_name', $sqlParam);
        $sql .= $this->andWhereString($param, 'product_code', 'p.product_code', $sqlParam);
        $sql .="
            and p.product_id NOT IN (
                    SELECT a.product_id
                    FROM trn_store_order_detail a
                    JOIN trn_store_order c ON a.store_order_id = c.store_order_id
                    WHERE c.store_id = s.store_id
                )
            ORDER BY s.store_id, p.product_code desc
        ";
        return $this->pagination($sql, $sqlParam, $param);   
    }

    public function getProductNotBuy($param)
    {
        $sqlParam = array();
        $sql = "
            SELECT DISTINCT s.store_id, s.store_name, s.address, s.supplier_id, p.product_code, p.name product_name
            FROM (
                SELECT DISTINCT c.store_id, b.name store_name, b.address, c.supplier_id
                FROM trn_store_order_detail a
                JOIN trn_store_order c ON a.store_order_id = c.store_order_id
                JOIN mst_store b on c.store_id = b.store_id
            ) s
            JOIN mst_product p 
            WHERE 
                1=1 and s.store_id = ". 3 ." and p.product_id NOT IN (
                SELECT a.product_id
                FROM trn_store_order_detail a
                JOIN trn_store_order c ON a.store_order_id = c.store_order_id
                WHERE c.store_id = s.store_id
            )
        ORDER BY s.store_id, p.product_code desc
        ";
        return $this->pagination($sql, $sqlParam, $param);
    }
}