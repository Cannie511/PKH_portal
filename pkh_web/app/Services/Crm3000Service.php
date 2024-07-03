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
        $sqlParam = array();
        $sql = "
            SELECT 
                a.store_id, 
                b.name, 
                b.address, 
                SUM(a.total_with_discount) total_sale
            from trn_store_order a
            join mst_store b on a.store_id = b.store_id
            where year(a.order_date) = 2021 
                and lower(name) not LIKE 'khách lẻ%' 
                and lower(name) not LIKE '[pts]%' 
                and lower(name) not LIKE '%nhân viên%' 
                and lower(name) not LIKE '%PKH%'
                and lower(name) not LIKE '%shopee%' 
                and lower(name) not LIKE '%lazada%' 
                and lower(name) not LIKE '%tiki%'
        ";
        $sql .= $this->andWhereString($param, 'name', 'b.name', $sqlParam);
        $sql .= " group by a.store_id";
        
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

    public function getAverageOderFrequencyPerYear($param)
    {
        $sqlParam = array();
        $sql = "
            SELECT 
                a.store_id, 
                b.name, 
                b.address, 
                SUM(a.total_with_discount) total_sale
            from trn_store_order a
            join mst_store b on a.store_id = b.store_id
            where year(a.order_date) = 2021 
                and lower(name) not LIKE 'khách lẻ%' 
                and lower(name) not LIKE '[pts]%' 
                and lower(name) not LIKE '%nhân viên%' 
                and lower(name) not LIKE '%PKH%'
                and lower(name) not LIKE '%shopee%' 
                and lower(name) not LIKE '%lazada%' 
                and lower(name) not LIKE '%tiki%'
                group by a.store_id
        ";
        $sql1 = "SELECT count(*)/12 total_order from trn_store_order
                where year(order_date) = 2021";
        $count_order = DB::select(DB::raw($sql1), $sqlParam);
        $count_store = count(DB::select(DB::raw($sql), $sqlParam));
        if(count($count_order) > 0 && $count_store > 0){
            $avg_OD = $count_order[0]->total_order/$count_store;
            return round($avg_OD, 2);
        }
        return null;
    }
    public function getSale($store_id){
        $sqlParam = array();
        $sql = "select store_id, sum(total_with_discount) total_sale from trn_store_order
                WHERE year(order_date) = 2021 and store_id = ".$store_id." 
                GROUP BY store_id";
        $list = DB::select(DB::raw($sql), $sqlParam);
        if (count($list) === 0)
            return null;
        return $list[0]->total_sale;
    }

    /**
     * @param store_id
     */
    public function getAverageOrderFrequency($store_id){
        $sqlParam = array();
        $sql = "SELECT count(*)/12 OD from trn_store_order
                where store_id = " . $store_id . " and year(order_date) = 2021";
        $list = DB::select(DB::raw($sql), $sqlParam);
        if (count($list) === 0)
            return null;
        return round($list[0]->OD,2);
    }
    public function getRetention($store_id){
        $sqlParam = array();
        $sql = "select store_id, min(order_date), timestampdiff(year, min(order_date), curdate()) retention from trn_store_order
                where store_id = ".$store_id." 
                group by store_id";
        $list = DB::select(DB::raw($sql), $sqlParam);
        if (count($list) === 0)
            return null;
        return $list[0]->retention;
    }

    public function getPaymentHistory($store_id){
        $sqlParam = array();
        $sql_paid = "SELECT count(timestampdiff(day,delivery_date, payment_date)) payment_history FROM `trn_store_payment_status` 
                WHERE store_id = ".$store_id." and year(delivery_date) = 2021 and timestampdiff(day,delivery_date, payment_date) < 0
                GROUP by store_id";
        $sql_all_order = "
            select count(store_delivery_id) all_order from trn_store_payment_status
            where store_id = ".$store_id." and year(delivery_date) = 2021
            GROUP by store_id
        ";
        $paid = DB::select(DB::raw($sql_paid), $sqlParam);
        $all_order = DB::select(DB::raw($sql_all_order), $sqlParam);
        if(!$paid) return false;
        if ($paid[0]->payment_history == $all_order[0]->all_order)
            return true;
        return false;
    }

    public function getTotalScore($param, $store_id){
        $total_score = 0;
        $sale = $this->getSale($store_id);
        $retention = $this->getRetention($store_id);
        $OD = $this->getAverageOrderFrequency($store_id);
        $payment = $this->getPaymentHistory($store_id);
        $avg_sale = $this->getAverageSalePerYear($param);
        $avg_OD = $this->getAverageOderFrequencyPerYear($param);
        if($sale >= $avg_sale){
            $total_score += 25;
        }
        else $total_score +=10;
        if($retention >= 3) $total_score += 25;
        else $total_score += 10;
        if($OD >=$avg_OD) $total_score += 25;
        else $total_score +=10;
        if($payment) $total_score += 25;
        else $total_score += 15;
        return $total_score;
    }
}