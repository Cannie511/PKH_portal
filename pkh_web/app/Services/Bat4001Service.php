<?php

namespace App\Services;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class Bat4001Service extends BaseService{

 // hàm tự động cập nhật Retention truyền vào $year, $quarter 
public function updataRetention($year, $quarter)
    {
        $batchSize = 100; 
        $offset = 0;
        
        while (true) {
            $data = $this->getStoreBatch($year, $quarter, $batchSize, $offset);
            if (empty($data)) {
                break; 
            }
            
            foreach ($data as $d) {
                $store_id = $d->store_id;
                $sale_score = $d-> sale_score;
                $order_score = $d->order_score;
                $dept_score = $d->dept_score;
                $retention = $this->getRetention($store_id, $year, $quarter);
                $retention_score = $retention >= 3 ? 25 : 10; 
                $total = $sale_score + $order_score +  $dept_score + $retention_score;
                Log::info("diem". $total);
                $this->UpdatetoTable($store_id, $year, $quarter, $retention_score, $total);
                $total = 0;
                 Log::info("diem dat lai". $total);
            }
            $offset += $batchSize; 
        }
}
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
//lấy store_id, sale_score, order_score, dept_score 
public function getStoreBatch($year, $quarter, $limit, $offset)
{
    $sqlParam = [$year, $quarter, $limit, $offset];
    $sql = "SELECT store_id, sale_score, order_score, dept_score FROM store_scores WHERE year = ? AND quarter = ? LIMIT ? OFFSET ?";
    return DB::select(DB::raw($sql), $sqlParam);
}
// update retention và total_score_card
public function UpdatetoTable($store_id, $year, $quarter,$retention_score, $total)
{
    $sqlParam = array();
    $sql = "UPDATE store_scores as a set retention_score = ?, total_score_card = ? WHERE store_id = ? and a.year = ? and a.quarter = ? ";
    $sqlParam = [$retention_score,$total,$store_id,$year,$quarter ];
    DB::update($sql, $sqlParam);
}
}