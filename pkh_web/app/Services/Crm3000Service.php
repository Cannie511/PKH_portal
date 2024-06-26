<?php

namespace App\Services;

use DB;


/**
 * Crm3000Service class
 */
class Crm3000Service extends BaseService
{
    /**
     * @param $params
     * @return void
     */
    public function selectList($param)
    {
        // $sqlParam = array();
        // $sql = "    
        // SELECT 
        // main_query.*,
        // COALESCE(payment.remain_amount, 0) remain_amount,
       	// payment.level_dept,
        // CASE
        // WHEN main_query.total > 0 then payment.level_payment_history ELSE 1 END level_payment_history,
        // COALESCE(payment.history, 0) history
        //     FROM (
        //         SELECT 
        //         b.store_id, 
        //         b.name,
        //         b.address,
        //         COALESCE(SUM(a.total_with_discount), 0) total,
        //         CASE 
        //             WHEN COALESCE(SUM(a.total_with_discount), 0) < 50000000 THEN 1 
        //             WHEN COALESCE(SUM(a.total_with_discount), 0) >= 50000000 AND COALESCE(SUM(a.total_with_discount), 0) < 250000000 THEN 2 
        //             WHEN COALESCE(SUM(a.total_with_discount), 0) >= 250000000 AND COALESCE(SUM(a.total_with_discount), 0) < 500000000 THEN 3 
        //         ELSE 4 
        //         END AS level_sales,
        //         YEAR(a.order_date) current_order_year,
        //         COALESCE(first_order.first_order_year, 0) first_order,
        //         COALESCE(TIMESTAMPDIFF(YEAR, first_order.first_order_date, CURDATE()), 0) retention,
        //         CASE 
        //             WHEN SUM(COALESCE(TIMESTAMPDIFF(YEAR, first_order.first_order_date, CURDATE()), 0)) < 1 THEN 1 
        //             WHEN SUM(COALESCE(TIMESTAMPDIFF(YEAR, first_order.first_order_date, CURDATE()), 0)) >= 1 AND SUM(COALESCE(TIMESTAMPDIFF(YEAR, first_order.first_order_date, CURDATE()), 0)) < 3 THEN 2 
        //             WHEN SUM(COALESCE(TIMESTAMPDIFF(YEAR, first_order.first_order_date, CURDATE()), 0)) >= 3 AND SUM(COALESCE(TIMESTAMPDIFF(YEAR, first_order.first_order_date, CURDATE()), 0)) < 5 THEN 3 
        //         ELSE 4 
        //         END AS level_retention,
        //         b.created_at,
        //         CONCAT(MAX(quarter(a.order_date)), '/', MAX(year(a.order_date))) order_time,
        //         COUNT(store_order_code)/3 count_order,
        //         CASE 
        //             WHEN COUNT(store_order_code)/3 <= 1 THEN 1 
        //             WHEN COUNT(store_order_code)/3 > 1 AND COUNT(store_order_code)/3 <= 2 THEN 2 
        //             WHEN COUNT(store_order_code)/3 > 2 AND COUNT(store_order_code)/3 <= 3 THEN 3 
        //         ELSE 4 
        //         END AS level_order_frequency
        //         FROM mst_store b
        //         LEFT JOIN trn_store_order a ON a.store_id = b.store_id AND YEAR(a.order_date) = YEAR(CURDATE()) AND Quarter(a.order_date) = 4
        //         LEFT JOIN (
        //             SELECT   
        //             store_id, 
        //             MIN(order_date) first_order_date, 
        //             YEAR(MIN(order_date)) first_order_year
        //             FROM 
        //             trn_store_order
        //             GROUP BY 
        //             store_id
        //         ) first_order ON b.store_id = first_order.store_id
        //         GROUP BY 
        //         b.store_id, YEAR(a.order_date)
        //     ) main_query
        //     LEFT JOIN (
        //         SELECT 
        //         store_id,
        //         SUM(remain_amount) remain_amount,
        //        	IF(SUM(remain_amount) > 0, 2, 0) level_dept,
        //         AVG(TIMESTAMPDIFF(day,delivery_date, payment_date)) history,
        //         CASE 
        //             WHEN AVG(TIMESTAMPDIFF(day,delivery_date, payment_date)) > 28 THEN 1 
        //             WHEN AVG(TIMESTAMPDIFF(day,delivery_date, payment_date)) <= 28 AND AVG(TIMESTAMPDIFF(day,delivery_date, payment_date)) > 14 THEN 2 
        //             WHEN AVG(TIMESTAMPDIFF(day,delivery_date, payment_date)) <= 14 AND AVG(TIMESTAMPDIFF(day,delivery_date, payment_date)) > 7 THEN 3 
        //         ELSE 4 
        //         END AS level_payment_history
        //         FROM 
        //         trn_store_payment_status
        //         GROUP BY 
        //         store_id
        //     ) payment ON main_query.store_id = payment.store_id
        //     WHERE 1=1
        // ";
        // $sql .= $this->andWhereString($param, 'name', 'main_query.name', $sqlParam);
        // $sql .= $this->andWhereInt($param, 'level_sales', 'main_query.level_sales', $sqlParam);
        // $sql .= $this->andWhereInt($param, 'level_retention', 'main_query.level_retention', $sqlParam);
        // $sql .= $this->andWhereInt($param, 'level_dept', 'payment.level_dept', $sqlParam);
        // $sql .= $this->andWhereInt($param, 'level_payment_history', 'level_payment_history', $sqlParam);
        // $sql .= $this->andWhereInt($param, 'level_order_frequency', 'main_query.level_order_frequency', $sqlParam);
        // return $this->pagination($sql, $sqlParam, $param);
        $sqlParam = array();
        $sql = "SELECT a.store_id, a.name,a.address, SUM(b.total_with_discount) total_sale from mst_store a join trn_store_order b on a.store_id = b.store_id
            where year(order_date) = 2021
            group by a.store_id, a.name";
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