<?php

namespace App\Services;
use DateTime;
use DB;


/**
 * Crm4001Service class
 */
class Crm4001Service extends BaseService
{
    /**
     * @param $params
     * @return void
     */

    public function index()
    {
        return null;
    }
// tinh tham nien dai ly
    public function getRetention($store_id, $year, $quarter)
{   
    switch ($quarter) {
        case 1:
            $endQuarter = $year . '-03-31';
            break;
        case 2:
            $endQuarter = $year . '-06-30';
            break;
        case 3:
            $endQuarter = $year . '-09-30';
            break;
        case 4:
            $endQuarter = $year . '-12-31';
            break;
    }
    $endDate = $endQuarter;
    $sqlCheck = "
        SELECT order_date
        FROM trn_store_order
        WHERE store_id = :store_id
        AND order_date <= :endDate
        ORDER BY order_date
    ";

    $orders = DB::select(DB::raw($sqlCheck), ['store_id' => $store_id, 'endDate' => $endDate]);

    if (count($orders) === 0) {
        return 0;
    }

    $retentionStartDate = new \DateTime($orders[0]->order_date);
    $previousOrderDate = $retentionStartDate;

    foreach ($orders as $order) {
        $currentOrderDate = new \DateTime($order->order_date);
        $diff = $previousOrderDate->diff($currentOrderDate);
        $monthsDiff = ($diff->y * 12) + $diff->m;

        if ($monthsDiff > 6) {
            return 0;
        }

        $previousOrderDate = $currentOrderDate;
    }

   
    $endDateTime = new \DateTime($endDate);
    $lastOrderDate = new \DateTime($orders[count($orders) - 1]->order_date);
    $diffToEndDate = $lastOrderDate->diff($endDateTime);
    $monthsDiffToEndDate = ($diffToEndDate->y * 12) + $diffToEndDate->m;

    if ($monthsDiffToEndDate > 6) {
        return 0;
    }

    $retentionMonths = ($endDateTime->diff($retentionStartDate)->y * 12) + $endDateTime->diff($retentionStartDate)->m;
    $retentionYears = floor($retentionMonths / 12);

    return max(0, $retentionYears);
}


// Lay ID, Name, Address, Total_sale cua dai ly
public function getData($param, $year, $quarter)
{
    $sqlParam = ['year' => $year];
    
    // Xác định tháng bắt đầu và kết thúc của quý
    switch ($quarter) {
        case 1:
            $startMonth = 1;
            $endMonth = 3;
            break;
        case 2:
            $startMonth = 4;
            $endMonth = 6;
            break;
        case 3:
            $startMonth = 7;
            $endMonth = 9;
            break;
        case 4:
            $startMonth = 10;
            $endMonth = 12;
            break;
    }

    $sql = "
        SELECT DISTINCT 
            a.store_id, 
            b.name, 
            b.address, 
            COALESCE(SUM(CASE 
                WHEN YEAR(a.order_date) = :year 
                     AND MONTH(a.order_date) BETWEEN $startMonth AND $endMonth 
                THEN a.total_with_discount 
                ELSE 0 
            END), 0) AS total_sale
        FROM mst_store b
        LEFT JOIN trn_store_order a ON a.store_id = b.store_id
        WHERE a.order_date IS NOT NULL  
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
    $sql .= " GROUP BY a.store_id";
    $sql .= " ORDER BY b.name ASC";
    
    return $this->pagination12R($sql, $sqlParam, $param);
}
// Tong doanh so cua tat ca cua hang
public function getSalesQuarterOfYear($param, $year, $quarter)
{
    $sqlParam = ['year' => $year];
    
    // Xác định tháng bắt đầu và kết thúc của quý
    switch ($quarter) {
        case 1:
            $startMonth = 1;
            $endMonth = 3;
            break;
        case 2:
            $startMonth = 4;
            $endMonth = 6;
            break;
        case 3:
            $startMonth = 7;
            $endMonth = 9;
            break;
        case 4:
            $startMonth = 10;
            $endMonth = 12;
            break;
    }

    $sql = "
        SELECT 
            SUM(total_sale) AS total_sales
        FROM (
            SELECT 
                b.store_id, 
                COALESCE(SUM(CASE 
                    WHEN YEAR(a.order_date) = :year 
                        AND MONTH(a.order_date) BETWEEN $startMonth AND $endMonth 
                    THEN a.total_with_discount 
                    ELSE 0 
                END), 0) AS total_sale
            FROM 
                mst_store b
            LEFT JOIN 
                trn_store_order a ON a.store_id = b.store_id
            WHERE 
                a.order_date IS NOT NULL  
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
            GROUP BY 
                b.store_id
        ) AS store_sales;
    ";

    $result = DB::select(DB::raw($sql), $sqlParam);
    return !empty($result) ? round($result[0]->total_sales, 2) : null;
}

/**
 * Tong so don da dat trong quy cua tat ca cua hang
 */
public function getCountOrderQuarterOfYear($param, $year, $quarter)
{
    $sqlParam = ['year' => $year];
    switch ($quarter) {
        case 1:
            $startMonth = 1;
            $endMonth = 3;
            break;
        case 2:
            $startMonth = 4;
            $endMonth = 6;
            break;
        case 3:
            $startMonth = 7;
            $endMonth = 9;
            break;
        case 4:
            $startMonth = 10;
            $endMonth = 12;
            break;
    }

    $sql = "
        SELECT 
             SUM(order_count)  AS avg_OD
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
                AND YEAR(a.order_date) = :year
                AND MONTH(a.order_date) BETWEEN $startMonth AND $endMonth 
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
            GROUP BY 
                b.store_id
            HAVING 
                COUNT(a.order_date) > 0
        ) AS store_order_counts;
    ";

    $result = DB::select(DB::raw($sql), $sqlParam);
    return !empty($result) ? round($result[0]->avg_OD, 2) : null;
}
/**
 *  So don dat cua 1 cua hang trong quy
 */
public function getAvgCountAStoreOrderQuarterOfYear($store_id, $year, $quarter)
{   
    switch ($quarter) {
        case 1:
            $startMonth = 1;
            $endMonth = 3;
            break;
        case 2:
            $startMonth = 4;
            $endMonth = 6;
            break;
        case 3:
            $startMonth = 7;
            $endMonth = 9;
            break;
        case 4:
            $startMonth = 10;
            $endMonth = 12;
            break;
    }
    
    $sql = "
        SELECT 
            COUNT(a.order_date) AS total_order_count
        FROM 
            trn_store_order a
        WHERE 
            a.order_date IS NOT NULL
            AND YEAR(a.order_date) = :year
            AND a.store_id = :store_id
            AND MONTH(a.order_date) BETWEEN $startMonth AND $endMonth 
    ";

    $sqlParam = ['year' => $year, 'store_id' => $store_id];
    $list = DB::select(DB::raw($sql), $sqlParam);
    return !empty($list) ? $list[0]->total_order_count : 0;
}

/**
 * check cong no trong quy cua tat ca cua hang
 */
public function checkDeptAStoreQuarterOfYear($store_id, $year,$quarter)
{
        switch ($quarter) {
            case 1:
                $startMonth = 1;
                $endMonth = 3;
                break;
            case 2:
                $startMonth = 4;
                $endMonth = 6;
                break;
            case 3:
                $startMonth = 7;
                $endMonth = 9;
                break;
            case 4:
                $startMonth = 10;
                $endMonth = 12;
                break;
        }
        $sqlParam = ['year' => $year, 'store_id' => $store_id];
        $sql_debt_status = "
            SELECT 
                CASE 
                    WHEN SUM(CASE 
                        WHEN TIMESTAMPDIFF(DAY, delivery_date, payment_date) < 0 THEN 1 
                        ELSE 0 
                    END) > 0 THEN 'Có nợ'
                    ELSE 'Không nợ'
                END AS debt_status
            FROM trn_store_payment_status
            WHERE store_id = :store_id
            AND YEAR(delivery_date) = :year
             AND MONTH(delivery_date) BETWEEN $startMonth AND $endMonth
            GROUP BY store_id;
        ";
        $debt_status = DB::select(DB::raw($sql_debt_status), $sqlParam);
        return !empty($debt_status) && $debt_status[0]->debt_status == 'Có nợ';
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
/**
 * Lay du lieu seach
 */
public function getDataSeach($param, $year, $namestore,$quarter) {
    switch ($quarter) {
        case 1:
            $startMonth = 1;
            $endMonth = 3;
            break;
        case 2:
            $startMonth = 4;
            $endMonth = 6;
            break;
        case 3:
            $startMonth = 7;
            $endMonth = 9;
            break;
        case 4:
            $startMonth = 10;
            $endMonth = 12;
            break;
    }
    $sqlParam = [];
    $sql = "
        SELECT DISTINCT 
            a.store_id, 
            b.name, 
            b.address, 
            COALESCE(SUM(CASE 
                WHEN YEAR(a.order_date) = :year 
                     AND MONTH(a.order_date) BETWEEN $startMonth AND $endMonth
                THEN a.total_with_discount 
                ELSE 0 
            END), 0) AS total_sale
        FROM mst_store b
        LEFT JOIN trn_store_order a ON a.store_id = b.store_id
        WHERE a.order_date IS NOT NULL  
            AND lower(b.name) LIKE '%".$namestore."%'
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
        GROUP BY a.store_id
    ";
    $sql .= " ORDER BY b.name ASC";

    $sqlParam['year'] = $year;

    return $this->pagination12R($sql, $sqlParam, $param);
}
// Tan suat dat cung ky quy truoc*120
public function getCountOrderQuarterOfLastYear120($year, $store_id,$quarter)
{
    $previousYear = $year - 1;
    switch ($quarter) {
        case 1:
            $startMonth = 1;
            $endMonth = 3;
            break;
        case 2:
            $startMonth = 4;
            $endMonth = 6;
            break;
        case 3:
            $startMonth = 7;
            $endMonth = 9;
            break;
        case 4:
            $startMonth = 10;
            $endMonth = 12;
            break;
    }
    $sqlParam = ['year' => $previousYear, 'store_id' => $store_id];
    $sql = "
        SELECT 
            SUM(order_count) * 1.2 AS desired_OD
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
                AND YEAR(order_date) = :year
                AND MONTH(order_date) BETWEEN $startMonth AND $endMonth 
                AND b.store_id = :store_id
            GROUP BY 
                b.store_id
            HAVING 
                COUNT(a.order_date) > 0
        ) AS store_order_counts;
    ";

    $list = DB::select(DB::raw($sql), $sqlParam);
    return count($list) === 0 ? null : $list[0]->desired_OD;
}
// Doanh so cung ky quy truoc*120
public function getTotalSalesQuarterOfLastYear120($year,$store_id,$quarter)
{   
    $previousYear = $year - 1;
    switch ($quarter) {
        case 1:
            $startMonth = 1;
            $endMonth = 3;
            break;
        case 2:
            $startMonth = 4;
            $endMonth = 6;
            break;
        case 3:
            $startMonth = 7;
            $endMonth = 9;
            break;
        case 4:
            $startMonth = 10;
            $endMonth = 12;
            break;
    }
    $sqlParam = ['year' => $previousYear, 'store_id' => $store_id];
    $sql = "
        SELECT 
            SUM(total_with_discount)* 1.2 AS Total_OD
        FROM 
            trn_store_order 
        WHERE 
            YEAR(order_date) = :year 
             AND MONTH(order_date) BETWEEN $startMonth AND $endMonth 
            AND store_id = :store_id
    ";

    $list = DB::select(DB::raw($sql), $sqlParam);
    return count($list) === 0 ? null : $list[0]->Total_OD;
}

// Lay doanh so cua mot cua hang
public function getSalesAStoreQuarterOfYear($year,$store_id,$quarter)
{
    switch ($quarter) {
        case 1:
            $startMonth = 1;
            $endMonth = 3;
            break;
        case 2:
            $startMonth = 4;
            $endMonth = 6;
            break;
        case 3:
            $startMonth = 7;
            $endMonth = 9;
            break;
        case 4:
            $startMonth = 10;
            $endMonth = 12;
            break;
    }
    $sqlParam = ['year' => $year, 'store_id' => $store_id];
    $sql = "
        SELECT 
            SUM(total_with_discount) AS Total_OD
        FROM 
            trn_store_order 
        WHERE 
            YEAR(order_date) = :year 
             AND MONTH(order_date) BETWEEN $startMonth AND $endMonth 
            AND store_id = :store_id
    ";

    $list = DB::select(DB::raw($sql), $sqlParam);
    return count($list) === 0 ? null : $list[0]->Total_OD;
}
// Tan suat dat cung ky quy cua mot cua hang
public function getCountOrderAStoreQuarterOfYear($year, $store_id,$quarter)
{
    switch ($quarter) {
        case 1:
            $startMonth = 1;
            $endMonth = 3;
            break;
        case 2:
            $startMonth = 4;
            $endMonth = 6;
            break;
        case 3:
            $startMonth = 7;
            $endMonth = 9;
            break;
        case 4:
            $startMonth = 10;
            $endMonth = 12;
            break;
    }
    $sqlParam = ['year' => $year, 'store_id' => $store_id];
    $sql = "
        SELECT 
            SUM(order_count) AS desired_OD
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
                AND YEAR(order_date) = :year
                AND MONTH(order_date) BETWEEN $startMonth AND $endMonth 
                AND b.store_id = :store_id
            GROUP BY 
                b.store_id
            HAVING 
                COUNT(a.order_date) > 0
        ) AS store_order_counts;
    ";

    $list = DB::select(DB::raw($sql), $sqlParam);
    return count($list) === 0 ? null : $list[0]->desired_OD;
}

// Tinh diem doanh so
public function getSalesScore($year, $store_id, $quarter)
    {
        $currentSales = $this->getSalesAStoreQuarterOfYear($year, $store_id, $quarter);
        $previousSales120 = $this->getTotalSalesQuarterOfLastYear120($year, $store_id, $quarter);

        $sale_score = 0;

        if ($currentSales > $previousSales120) {
            $sale_score = 25;
        } else {
            $sale_score = 10;
        }
        return $sale_score;
    }

// Tinh diem tuan suat
public function getOrderScore($year, $store_id, $quarter)
    {
        $currentOrder = $this->getCountOrderAStoreQuarterOfYear($year, $store_id, $quarter);
        $previousOrder120 = $this->getCountOrderQuarterOfLastYear120($year, $store_id, $quarter);

        $order_score = 0;

        if ($currentOrder > $previousOrder120) {
            $order_score = 25;
        } else {
            $order_score = 10;
        }
        return $order_score;
    }

// Tinh diem tham nien
public function getRetentionScore($store_id, $year, $quarter)
{
    $retention = $this->getRetention($store_id, $year, $quarter);

    $retention_score = 0;

    if ($retention >= 3) {
        $retention_score = 25;
    } else {
        $retention_score = 10;
    }

    return $retention_score;
}
// Tinh diem cong no
public function getDeptScore($store_id, $year, $quarter)
{
    $retention = $this->checkDeptAStoreQuarterOfYear($store_id, $year, $quarter);

    $dept_score = 0;

    if ($retention) {
        $dept_score = 15;
    } else {
        $dept_score = 25;
    }

    return $dept_score;
}
// Tinh tong diem 4 tieu chi cua 1 cua hang
public function getTotalScoreCard($year, $store_id, $quarter)
{
    $sales_score = $this->getSalesScore($year, $store_id, $quarter);
    $order_score = $this->getOrderScore($year, $store_id, $quarter);
    $retention_score = $this->getRetentionScore($store_id, $year, $quarter);
    $dept_score = $this->getDeptScore($store_id, $year, $quarter);

    $total_score = $sales_score + $order_score + $retention_score + $dept_score;

    return $total_score;
}


// Dem so cua hang pass tieu chi 1 Doanh So

public function getCountPass_TotalSale_QuarterOfYear($param,$year,$quarter)
{
    $sqlParam = ['year' => $year,'quarter' => $quarter];
   
    $sql = "SELECT COUNT(*) AS store_count
    FROM store_scores
    WHERE sale_score = 25
      AND year = :year
      AND quarter = :quarter";

    $result = DB::select(DB::raw($sql), $sqlParam);
    return !empty($result) ? round($result[0]->store_count, 2) : null;
}

// Dem so cua hang pass tieu chi 2 Tham Nien

public function getCountPass_Retention_QuarterOfYear($param,$year,$quarter)
{
    $sqlParam = ['year' => $year,'quarter' => $quarter];
   
    $sql = "SELECT COUNT(*) AS store_count
    FROM store_scores
    WHERE retention_score = 25
      AND year = :year
      AND quarter = :quarter";

    $result = DB::select(DB::raw($sql), $sqlParam);
    return !empty($result) ? round($result[0]->store_count, 2) : null;
}


// Dem so cua hang pass tieu chi 3 Tan Suat Dat
public function getCountPass_Order_QuarterOfYear($param,$year,$quarter)
{
    $sqlParam = ['year' => $year,'quarter' => $quarter];
   
    $sql = "SELECT COUNT(*) AS store_count
    FROM store_scores
    WHERE order_score = 25
      AND year = :year
      AND quarter = :quarter";

    $result = DB::select(DB::raw($sql), $sqlParam);
    return !empty($result) ? round($result[0]->store_count, 2) : null;
}


// Dem so cua hang co cong no 
public function getCountNoPass_Dept_QuarterOfYear($param,$year,$quarter)
{
    $sqlParam = ['year' => $year,'quarter' => $quarter];
   
    $sql = "SELECT COUNT(*) AS store_count
    FROM store_scores
    WHERE dept_score = 15
      AND year = :year
      AND quarter = :quarter";

    $result = DB::select(DB::raw($sql), $sqlParam);
    return !empty($result) ? round($result[0]->store_count, 2) : null;
}
// Lay List ID cua hang pass tieu chi 1 Doanh So
public function getStoreIdPass_TotalSale_QuarterOfYear($param, $year, $quarter)
{
    $sqlParam = ['year' => $year, 'quarter' => $quarter];
    $sql = "SELECT store_id
            FROM store_scores
            WHERE sale_score = 25
              AND year = :year
              AND quarter = :quarter";
    $result = DB::select(DB::raw($sql), $sqlParam);
    
    $storeIds = array_map(function($item) {
        return $item->store_id;
    }, $result);

    return $storeIds;
}
// Lay List ID cua hang pass tieu chi 2 Tham Nien
public function getStoreIdPass_Retention_QuarterOfYear($param, $year, $quarter)
{
    $sqlParam = ['year' => $year, 'quarter' => $quarter];
    $sql = "SELECT store_id
            FROM store_scores
            WHERE retention_score = 25
              AND year = :year
              AND quarter = :quarter";
    $result = DB::select(DB::raw($sql), $sqlParam);
    
    $storeIds = array_map(function($item) {
        return $item->store_id;
    }, $result);

    return $storeIds;
}
// Lay List ID cua hang pass tieu chi 3 Tan Suat Dat
public function getStoreIdPass_Order_QuarterOfYear($param, $year, $quarter)
{
    $sqlParam = ['year' => $year, 'quarter' => $quarter];
    $sql = "SELECT store_id
            FROM store_scores
            WHERE order_score = 25
              AND year = :year
              AND quarter = :quarter";
    $result = DB::select(DB::raw($sql), $sqlParam);
    
    $storeIds = array_map(function($item) {
        return $item->store_id;
    }, $result);

    return $storeIds;
}
// Lay List ID cua hang co cong no
public function getStoreIdNoPass_Dept_QuarterOfYear($param, $year, $quarter)
{
    $sqlParam = ['year' => $year, 'quarter' => $quarter];
    $sql = "SELECT store_id
            FROM store_scores
            WHERE dept_score = 15
              AND year = :year
              AND quarter = :quarter";
    $result = DB::select(DB::raw($sql), $sqlParam);
    
    $storeIds = array_map(function($item) {
        return $item->store_id;
    }, $result);

    return $storeIds;
}
// Liet ke cua hang pass tieu chi 1 Doanh So

public function getDataAboveAvgSales($param, $year, $quarter)
{
    $storeIds = $this->getStoreIdPass_TotalSale_QuarterOfYear($param, $year, $quarter);

    if (empty($storeIds)) {
        return [];
    }

    $storeIdsStr = implode(',', $storeIds);
    
    $sqlParam = ['year' => $year];
    
    switch ($quarter) {
        case 1:
            $startMonth = 1;
            $endMonth = 3;
            break;
        case 2:
            $startMonth = 4;
            $endMonth = 6;
            break;
        case 3:
            $startMonth = 7;
            $endMonth = 9;
            break;
        case 4:
            $startMonth = 10;
            $endMonth = 12;
            break;
    }

    $sql = "
        SELECT DISTINCT 
            a.store_id, 
            b.name, 
            b.address, 
            COALESCE(SUM(CASE 
                WHEN YEAR(a.order_date) = :year 
                     AND MONTH(a.order_date) BETWEEN $startMonth AND $endMonth 
                THEN a.total_with_discount 
                ELSE 0 
            END), 0) AS total_sale
        FROM mst_store b
        LEFT JOIN trn_store_order a ON a.store_id = b.store_id
        WHERE a.order_date IS NOT NULL  
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
            AND a.store_id IN ($storeIdsStr)
    ";
    $sql .= " GROUP BY a.store_id";
    $sql .= " ORDER BY b.name ASC";
    
    return $this->pagination12R($sql, $sqlParam, $param);
    
}

//  Liet ke cua hang pass tieu chi 2 Tham Nien
public function getDataStoresAboveRetention($param, $year, $quarter)
{
    $storeIds = $this->getStoreIdPass_Retention_QuarterOfYear($param, $year, $quarter);

    if (empty($storeIds)) {
        return [];
    }

    $storeIdsStr = implode(',', $storeIds);
    
    $sqlParam = ['year' => $year];
    
    switch ($quarter) {
        case 1:
            $startMonth = 1;
            $endMonth = 3;
            break;
        case 2:
            $startMonth = 4;
            $endMonth = 6;
            break;
        case 3:
            $startMonth = 7;
            $endMonth = 9;
            break;
        case 4:
            $startMonth = 10;
            $endMonth = 12;
            break;
    }

    $sql = "
        SELECT DISTINCT 
            a.store_id, 
            b.name, 
            b.address, 
            COALESCE(SUM(CASE 
                WHEN YEAR(a.order_date) = :year 
                     AND MONTH(a.order_date) BETWEEN $startMonth AND $endMonth 
                THEN a.total_with_discount 
                ELSE 0 
            END), 0) AS total_sale
        FROM mst_store b
        LEFT JOIN trn_store_order a ON a.store_id = b.store_id
        WHERE a.order_date IS NOT NULL  
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
            AND a.store_id IN ($storeIdsStr)
    ";
    $sql .= " GROUP BY a.store_id";
    $sql .= " ORDER BY b.name ASC";
    
    return $this->pagination12R($sql, $sqlParam, $param);
}

//  Liet ke cua hang pass tieu chi 3 Tan Suat Dat
public function getDataStoresWithHigherThanAvgOrderFrequency($param, $year, $quarter)
{
    $storeIds = $this->getStoreIdPass_Order_QuarterOfYear($param, $year, $quarter);

    if (empty($storeIds)) {
        return [];
    }

    $storeIdsStr = implode(',', $storeIds);
    
    $sqlParam = ['year' => $year];
    
    switch ($quarter) {
        case 1:
            $startMonth = 1;
            $endMonth = 3;
            break;
        case 2:
            $startMonth = 4;
            $endMonth = 6;
            break;
        case 3:
            $startMonth = 7;
            $endMonth = 9;
            break;
        case 4:
            $startMonth = 10;
            $endMonth = 12;
            break;
    }

    $sql = "
        SELECT DISTINCT 
            a.store_id, 
            b.name, 
            b.address, 
            COALESCE(SUM(CASE 
                WHEN YEAR(a.order_date) = :year 
                     AND MONTH(a.order_date) BETWEEN $startMonth AND $endMonth 
                THEN a.total_with_discount 
                ELSE 0 
            END), 0) AS total_sale
        FROM mst_store b
        LEFT JOIN trn_store_order a ON a.store_id = b.store_id
        WHERE a.order_date IS NOT NULL  
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
            AND a.store_id IN ($storeIdsStr)
    ";
    $sql .= " GROUP BY a.store_id";
    $sql .= " ORDER BY b.name ASC";
    
    return $this->pagination12R($sql, $sqlParam, $param);
}


//  Liet ke cua hang co Cong No
public function getDataStoresWithDebt($param, $year, $quarter)
{
    $storeIds = $this->getStoreIdNoPass_Dept_QuarterOfYear($param, $year, $quarter);

    if (empty($storeIds)) {
        return [];
    }

    $storeIdsStr = implode(',', $storeIds);
    
    $sqlParam = ['year' => $year];
    
    switch ($quarter) {
        case 1:
            $startMonth = 1;
            $endMonth = 3;
            break;
        case 2:
            $startMonth = 4;
            $endMonth = 6;
            break;
        case 3:
            $startMonth = 7;
            $endMonth = 9;
            break;
        case 4:
            $startMonth = 10;
            $endMonth = 12;
            break;
    }

    $sql = "
        SELECT DISTINCT 
            a.store_id, 
            b.name, 
            b.address, 
            COALESCE(SUM(CASE 
                WHEN YEAR(a.order_date) = :year 
                     AND MONTH(a.order_date) BETWEEN $startMonth AND $endMonth 
                THEN a.total_with_discount 
                ELSE 0 
            END), 0) AS total_sale
        FROM mst_store b
        LEFT JOIN trn_store_order a ON a.store_id = b.store_id
        WHERE a.order_date IS NOT NULL  
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
            AND a.store_id IN ($storeIdsStr)
    ";
    $sql .= " GROUP BY a.store_id";
    $sql .= " ORDER BY b.name ASC";
    
    return $this->pagination12R($sql, $sqlParam, $param);
}

// So luong cua hang theo ScoreCard
public function getStoreCountsByScore($param,$year, $quarter)
{
    $sqlParam = ['year' => $year,'quarter' => $quarter];
    $sql = "SELECT 
    COALESCE(t.store_count, 0) AS store_count
FROM (
    SELECT 45 AS total_score_card UNION ALL
    SELECT 50 UNION ALL
    SELECT 55 UNION ALL
    SELECT 60 UNION ALL
    SELECT 65 UNION ALL
    SELECT 70 UNION ALL
    SELECT 75 UNION ALL
    SELECT 80 UNION ALL
    SELECT 85 UNION ALL
    SELECT 90 UNION ALL
    SELECT 95 UNION ALL
    SELECT 100
) ds
LEFT JOIN (
    SELECT total_score_card, COUNT(*) AS store_count
    FROM store_scores
    WHERE year = :year AND quarter = :quarter
    GROUP BY total_score_card
) t ON ds.total_score_card = t.total_score_card
ORDER BY ds.total_score_card";
    
    $result = DB::select(DB::raw($sql), $sqlParam);
    
    $storeCounts = [];
    foreach ($result as $item) {
        $storeCounts[] = (int)$item->store_count;
    }

    return $storeCounts;
}

// So luong cua hang theo ScoreCard cung ky quy truoc
public function getStoreCountsByScoreSamePeriod($param,$year, $quarter)
{   
    $SamePeriod = $year-1;
    $sqlParam = ['year' => $SamePeriod,'quarter' => $quarter];
    $sql = "SELECT 
    COALESCE(t.store_count, 0) AS store_count
FROM (
    SELECT 45 AS total_score_card UNION ALL
    SELECT 50 UNION ALL
    SELECT 55 UNION ALL
    SELECT 60 UNION ALL
    SELECT 65 UNION ALL
    SELECT 70 UNION ALL
    SELECT 75 UNION ALL
    SELECT 80 UNION ALL
    SELECT 85 UNION ALL
    SELECT 90 UNION ALL
    SELECT 95 UNION ALL
    SELECT 100
) ds
LEFT JOIN (
    SELECT total_score_card, COUNT(*) AS store_count
    FROM store_scores
    WHERE year = :year AND quarter = :quarter
    GROUP BY total_score_card
) t ON ds.total_score_card = t.total_score_card
ORDER BY ds.total_score_card";
    
    $result = DB::select(DB::raw($sql), $sqlParam);
    
    $storeCounts = [];
    foreach ($result as $item) {
        $storeCounts[] = (int)$item->store_count;
    }

    return $storeCounts;
}

}

