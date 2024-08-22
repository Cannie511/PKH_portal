<?php

namespace App\Services;

use DB;
/**
 * Crm4003Service class
 */
class Crm4003Service extends BaseService
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
// Điểm Score Card hiện tại   
    public function getTotalScoreCard($store_id)
    {
        $currentQuarter = ceil(date('n') / 3); 
        $currentYear = date('Y'); 
    
        $sqlParam = [
            'store_id' => $store_id,
            'quartercurrent' => $currentQuarter,
            'yearcurrent' => 2020,
        ];
    
        $sql = "
            SELECT 
                total_score_card
            FROM 
                store_scores
            WHERE 
                store_id = :store_id
                AND quarter = :quartercurrent
                AND year = :yearcurrent
        ";
    
        $result = DB::select(DB::raw($sql), $sqlParam);
        return $result ? $result[0]->total_score_card : null;
    }

// Doanh số hiện tại
public function getTotalSale($store_id)
{
    $currentQuarter = ceil(date('n') / 3); 
    $currentYear = date('Y'); 

    // Xác định tháng bắt đầu và kết thúc của quý hiện tại
    $startMonth = ($currentQuarter - 1) * 3 + 1; // Tháng bắt đầu của quý
    $endMonth = $startMonth + 2; // Tháng kết thúc của quý
    
    $sqlParam = [
        'store_id' => $store_id,
        'yearcurrent' => 2020,
        'startMonth' => $startMonth,
        'endMonth' => $endMonth,
    ];

    $sql = "
        SELECT 
            SUM(total_with_discount) AS Total_OD
        FROM 
            trn_store_order 
        WHERE 
            YEAR(order_date) = :yearcurrent 
            AND MONTH(order_date) BETWEEN :startMonth AND :endMonth 
            AND store_id = :store_id
    ";

    $result = DB::select(DB::raw($sql), $sqlParam);
    
    // Trả về 0 nếu không có kết quả hoặc nếu kết quả là null
    return $result && $result[0]->Total_OD !== null ? $result[0]->Total_OD : 0;
}


// Doanh số cùng kỳ
public function getTotalSaleSamePeriod($store_id)
{
    $currentQuarter = ceil(date('n') / 3); 
    $currentYear = date('Y'); 

    $startMonth = ($currentQuarter - 1) * 3 + 1; 
    $endMonth = $startMonth + 2; 
    $lastYear = 2020 -1;

    $sqlParam = [
        'store_id' => $store_id,
        'yearcurrent' => $lastYear,
        'startMonth' => $startMonth,
        'endMonth' => $endMonth,
    ];

    $sql = "
        SELECT 
            SUM(total_with_discount) AS Total_OD
        FROM 
            trn_store_order 
        WHERE 
            YEAR(order_date) = :yearcurrent 
            AND MONTH(order_date) BETWEEN :startMonth AND :endMonth 
            AND store_id = :store_id
    ";

    $result = DB::select(DB::raw($sql), $sqlParam);
    return $result && $result[0]->Total_OD !== null ? $result[0]->Total_OD : 0;
}

// Điểm Doanh số hiện tại   
public function getSaleScore($store_id)
{
    $currentQuarter = ceil(date('n') / 3); 
    $currentYear = date('Y'); 

    $sqlParam = [
        'store_id' => $store_id,
        'quartercurrent' => $currentQuarter,
        'yearcurrent' => 2020,
    ];

    $sql = "
        SELECT 
            sale_score
        FROM 
            store_scores
        WHERE 
            store_id = :store_id
            AND quarter = :quartercurrent
            AND year = :yearcurrent
    ";

    $result = DB::select(DB::raw($sql), $sqlParam);
    return $result ? $result[0]->sale_score : null;
}
// Điểm Tan Suat hiện tại   
public function getOrderScore($store_id)
{
    $currentQuarter = ceil(date('n') / 3); 
    $currentYear = date('Y'); 

    $sqlParam = [
        'store_id' => $store_id,
        'quartercurrent' => $currentQuarter,
        'yearcurrent' => 2020,
    ];

    $sql = "
        SELECT 
            order_score
        FROM 
            store_scores
        WHERE 
            store_id = :store_id
            AND quarter = :quartercurrent
            AND year = :yearcurrent
    ";

    $result = DB::select(DB::raw($sql), $sqlParam);
    return $result ? $result[0]->order_score : null;
}

// Tần suất đặt cùng kỳ
public function getOrderFrequencySamePeriod($store_id)
{
    $currentQuarter = ceil(date('n') / 3); 
    $currentYear = date('Y'); 

    $startMonth = ($currentQuarter - 1) * 3 + 1; 
    $endMonth = $startMonth + 2; 
    $lastYear = 2020 -1;

    $sqlParam = [
        'store_id' => $store_id,
        'yearcurrent' => $lastYear,
        'startMonth' => $startMonth,
        'endMonth' => $endMonth,
    ];

    $sql = "
        SELECT 
            (SUM(order_count)/3) AS desired_OD
        FROM (
            SELECT 
                b.store_id, 
                COUNT(a.order_date) AS order_count
            FROM 
                mst_store b
            LEFT JOIN 
                trn_store_order a ON a.store_id = b.store_id
            WHERE 
                a.order_date IS NOT NULL
                AND YEAR(order_date) = :yearcurrent
                AND MONTH(order_date) BETWEEN :startMonth AND :endMonth 
                AND b.store_id = :store_id
            GROUP BY 
                b.store_id
            HAVING 
                COUNT(a.order_date) > 0
        ) AS store_order_counts;
    ";

    $result = DB::select(DB::raw($sql), $sqlParam);
    return $result && $result[0]->desired_OD !== null ? $result[0]->desired_OD : 0;
}

// Tần suất đặt hiện tại
public function getOrderFrequencyCurrent($store_id)
{
    $currentQuarter = ceil(date('n') / 3); 
    $currentYear = date('Y'); 

    $startMonth = ($currentQuarter - 1) * 3 + 1; 
    $endMonth = $startMonth + 2; 
    $lastYear = 2020;

    $sqlParam = [
        'store_id' => $store_id,
        'yearcurrent' => $lastYear,
        'startMonth' => $startMonth,
        'endMonth' => $endMonth,
    ];

    $sql = "
        SELECT 
            (SUM(order_count)/3) AS desired_OD
        FROM (
            SELECT 
                b.store_id, 
                COUNT(a.order_date) AS order_count
            FROM 
                mst_store b
            LEFT JOIN 
                trn_store_order a ON a.store_id = b.store_id
            WHERE 
                a.order_date IS NOT NULL
                AND YEAR(order_date) = :yearcurrent
                AND MONTH(order_date) BETWEEN :startMonth AND :endMonth 
                AND b.store_id = :store_id
            GROUP BY 
                b.store_id
            HAVING 
                COUNT(a.order_date) > 0
        ) AS store_order_counts;
    ";

    $result = DB::select(DB::raw($sql), $sqlParam);
    return $result && $result[0]->desired_OD !== null ? $result[0]->desired_OD : 0;
}

}