<?php

namespace App\Services;

use DB;


/**
 * Crm4002Service class
 */
class Crm4002Service extends BaseService
{
    /**
     * @param $params
     * @return void
     */

     public function getData($param,$years,$quarter)
     {
        $sqlParam = ['year' =>$years,'quarter' => $quarter];
         $sql = "
             SELECT DISTINCT 
                 b.store_id, 
                 b.name, 
                 b.address,
                 a.total_score_card
             FROM mst_store b    
             LEFT JOIN store_scores a ON a.store_id = b.store_id
             WHERE
                 a.quarter = :quarter
                 AND a.year = :year
                 AND lower(b.name) NOT LIKE '%khách lẻ%' 
                 AND lower(b.address) NOT LIKE '%khách lẻ%'
                 AND lower(b.name) NOT LIKE '%[pts]%' 
                 AND lower(b.name) NOT LIKE '%nhân viên%' 
                 AND lower(b.name) NOT LIKE '%PKH%' 
                 AND lower(b.name) NOT LIKE '%shopee%' 
                 AND lower(b.name) NOT LIKE '%lazada%' 
                 AND lower(b.name) NOT LIKE '%tiki%' 
                 AND lower(b.name) NOT LIKE 'a%' 
                 AND lower(b.name) NOT LIKE 'anh%'
         ";
         
         $sql .= $this->andWhereString($param, 'name', 'b.name', $sqlParam);
     
         $sql .= " ORDER BY b.name ASC";
     
         return $this->pagination12R($sql, $sqlParam, $param);
     }
     
     
     public function getVoucher($store_id,$years,$quarter)
     {
         $sqlParam = ['store_id' => $store_id,'year' =>$years,'quarter' => $quarter];
         $sql = "
             SELECT 
                 a.total_score_card
             FROM mst_store b    
             LEFT JOIN store_scores a ON a.store_id = b.store_id
             WHERE
                 a.quarter = :quarter
                 AND a.year = :year
                 AND b.store_id = :store_id
                 AND lower(b.name) NOT LIKE '%khách lẻ%' 
                 AND lower(b.address) NOT LIKE '%khách lẻ%'
                 AND lower(b.name) NOT LIKE '%[pts]%' 
                 AND lower(b.name) NOT LIKE '%nhân viên%' 
                 AND lower(b.name) NOT LIKE '%PKH%' 
                 AND lower(b.name) NOT LIKE '%shopee%' 
                 AND lower(b.name) NOT LIKE '%lazada%' 
                 AND lower(b.name) NOT LIKE '%tiki%' 
                 AND lower(b.name) NOT LIKE 'a%' 
                 AND lower(b.name) NOT LIKE 'anh%'
         ";
         $list = DB::select(DB::raw($sql), $sqlParam);
         
         if (count($list) === 0) {
             return null;
         }
         
         
         $totalScoreCard = $list[0]->total_score_card;
     
         if ($totalScoreCard > 80) {
             return 1000000;
         } elseif ($totalScoreCard > 60) {
             return 500000;
         } elseif ($totalScoreCard > 40) {
             return 300000;
         } elseif ($totalScoreCard > 20) {
             return 200000;
         } else {
             return 100000;
         }
     }
     /**
 * Lay danh sach nam
 */
public function getYears($param)
{
    $sqlParam = [];
    $sql = "
        SELECT DISTINCT 
            YEAR(order_date) AS year
        FROM trn_store_order
        WHERE YEAR(order_date) >= 2016
        ORDER BY year DESC;
    ";
    $years = DB::select(DB::raw($sql), $sqlParam);

    return $years;
}

}