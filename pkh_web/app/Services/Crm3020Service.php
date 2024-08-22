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
    // hàm tần suất đặt
    public function getAvgCountAStoreOrderAllQuartersOfYear($store_id, $year)
{
    $sqlParam = [
        'store_id' => $store_id,
        'year' => $year
    ];

    $sql = "
        SELECT 
            QUARTER(a.order_date) AS quarter,
            (COUNT(a.order_date)/3) AS avg_order_count
        FROM 
            trn_store_order a
        WHERE 
            a.order_date IS NOT NULL
            AND YEAR(a.order_date) = :year
            AND a.store_id = :store_id
        GROUP BY 
            QUARTER(a.order_date)
    ";

    $list = DB::select(DB::raw($sql), $sqlParam);

    // Initialize an array to store the average order count for each quarter
    $quarterData = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
    
    // Loop through the result and assign the value to the correct quarter
    foreach ($list as $item) {
        $quarterData[$item->quarter] = $item->avg_order_count;
    }

    return $quarterData;
}

    // hàm doanh số
    public function getSalesAStoreAllQuartersOfYear($store_id, $year)
{
    $sqlParam = [
        'store_id' => $store_id,
        'year' => $year
    ];

    $sql = "
        SELECT 
            QUARTER(order_date) AS quarter,
            SUM(total_with_discount) AS total_sales
        FROM 
            trn_store_order
        WHERE 
            YEAR(order_date) = :year
            AND store_id = :store_id
        GROUP BY 
            QUARTER(order_date)
    ";

    $list = DB::select(DB::raw($sql), $sqlParam);

    // Initialize an array to store the sales data for each quarter
    $quarterSales = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
    
    // Loop through the result and assign the value to the correct quarter
    foreach ($list as $item) {
        $quarterSales[$item->quarter] = $item->total_sales;
    }

    return $quarterSales;
}

   //  hàm thâm niên
   public function getRetentionAStoreAllQuarters($store_id, $year)
{
    $sqlParam = [
        'store_id' => $store_id,
        'year' => $year,
    ];

    $sql = "
        SELECT 
            quarter,
            retention_score
        FROM 
            store_scores
        WHERE 
            store_id = :store_id
            AND year = :year
    ";

    $result = DB::select(DB::raw($sql), $sqlParam);

    // Khởi tạo mảng để lưu điểm thâm niên của từng quý
    $retentionScores = [
        1 => 0,
        2 => 0,
        3 => 0,
        4 => 0,
    ];

    // Duyệt qua kết quả và gán điểm thâm niên cho từng quý tương ứng
    foreach ($result as $row) {
        if ($row->retention_score == 25) {
            $retentionScores[$row->quarter] = true;
        } else {
            $retentionScores[$row->quarter] = false;
        }
    }

    return $retentionScores;
}
  //   hàm công nợ
  public function checkDeptAStoreAllQuarters($store_id, $year)
{
    $sqlParam = [
        'store_id' => $store_id,
        'year' => $year,
    ];

    $sql = "
        SELECT 
            quarter,
            dept_score
        FROM 
            store_scores
        WHERE 
            store_id = :store_id
            AND year = :year
    ";

    $result = DB::select(DB::raw($sql), $sqlParam);

    // Khởi tạo mảng để lưu điểm thâm niên của từng quý
    $deptScores = [
        1 => 0,
        2 => 0,
        3 => 0,
        4 => 0,
    ];

    // Duyệt qua kết quả và gán điểm thâm niên cho từng quý tương ứng
    foreach ($result as $row) {
        if ($row->dept_score == 25) {
            $deptScores[$row->quarter] = true;
        } else {
            $deptScores[$row->quarter] = false;
        }
    }

    return $deptScores;
}

public function getTotalScoreCard($store_id, $year)
{
    $sqlParam = [
        'store_id' => $store_id,
        'year' => $year,
    ];

    $sql = "
        SELECT 
            quarter,
            dept_score,
            sale_score,
            retention_score,
            order_score,
            total_score_card
        FROM 
            store_scores
        WHERE 
            store_id = :store_id
            AND year = :year
    ";

    $result = DB::select(DB::raw($sql), $sqlParam);

    // Khởi tạo mảng để lưu điểm score card cho từng quý
    $scoreCards = [
        1 => [],
        2 => [],
        3 => [],
        4 => [],
    ];

    // Duyệt qua kết quả và gán điểm score card cho từng quý tương ứng
    foreach ($result as $row) {
        // Gán dữ liệu cho quý tương ứng
        $scoreCards[$row->quarter] = $row;
    }

    return $scoreCards;
}


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