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
        // Lấy dữ liệu theo lô (batch)
        $data = $this->getStoreBatch($year, $quarter, $batchSize, $offset);
        
        // Nếu không có dữ liệu thì dừng vòng lặp
        if (empty($data)) {
            break; 
        }
        
        foreach ($data as $d) {
            $store_id = $d->store_id;
            $sale_score = $d->sale_score;
            $order_score = $d->order_score;
            $dept_score = $d->dept_score;

            // Gọi hàm getRetention để kiểm tra kết quả retention
            $retention = $this->getRetention($store_id, $year, $quarter);
            
            // Logic tính điểm retention dựa trên kết quả trả về
            $retention_score = $retention ? 25 : 10;

            // Tính tổng điểm
            $total = $sale_score + $order_score + $dept_score + $retention_score;
            
            // Ghi log 
            Log::info("Năm: $year, Quý: $quarter, Store ID: $store_id, Điểm Doanh Số: $sale_score, Điểm Tần Suất: $order_score, Điểm Thâm Niên: $retention_score, Điểm Công Nợ: $dept_score, Tổng điểm: $total");

            
            // Cập nhật bảng với retention_score và tổng điểm
            $this->UpdatetoTable($store_id, $year, $quarter, $retention_score, $total);

            // Đặt lại tổng điểm về 0 cho lần tiếp theo
            $total = 0;
            Log::info("Tổng điểm đặt lại: " . $total);
        }

        // Tăng offset để lấy lô dữ liệu tiếp theo
        $offset += $batchSize; 
    }
}

public function getRetention($store_id, $year, $quarter)
{
    // Nếu năm là 2016, 2017, hoặc 2018 thì trả về 0
    if (in_array($year, [2016, 2017, 2018])) {
        return 0;
    }

    // Xác định ngày kết thúc của quý
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
    // Ngày bắt đầu là 3 năm trước từ ngày kết thúc quý
    $startDate = (new \DateTime($endDate))->modify('-3 years')->format('Y-m-d');

    // Lấy các đơn hàng trong khoảng từ startDate đến endDate
    $sqlCheck = "
        SELECT order_date
        FROM trn_store_order
        WHERE store_id = :store_id
        AND order_date BETWEEN :startDate AND :endDate
        ORDER BY order_date
    ";

    $orders = DB::select(DB::raw($sqlCheck), [
        'store_id' => $store_id, 
        'startDate' => $startDate, 
        'endDate' => $endDate
    ]);

    // Nếu không có đơn hàng nào trong khoảng thời gian này, trả về 0
    if (count($orders) === 0) {
        return 0;
    }

    $previousOrderDate = new \DateTime($orders[0]->order_date);

    // Kiểm tra khoảng cách giữa các đơn hàng liên tiếp
    foreach ($orders as $order) {
        $currentOrderDate = new \DateTime($order->order_date);
        $diff = $previousOrderDate->diff($currentOrderDate);
        $monthsDiff = ($diff->y * 12) + $diff->m;

        // Nếu có khoảng cách hơn 6 tháng giữa hai đơn hàng liên tiếp, trả về 0
        if ($monthsDiff > 6) {
            return 0;
        }

        $previousOrderDate = $currentOrderDate;
    }

    // Kiểm tra khoảng cách giữa đơn hàng cuối cùng và ngày kết thúc
    $endDateTime = new \DateTime($endDate);
    $lastOrderDate = new \DateTime(end($orders)->order_date);
    $diffToEndDate = $lastOrderDate->diff($endDateTime);
    $monthsDiffToEndDate = ($diffToEndDate->y * 12) + $diffToEndDate->m;

    // Nếu khoảng cách giữa đơn hàng cuối cùng và ngày kết thúc lớn hơn 6 tháng, trả về 0
    if ($monthsDiffToEndDate > 6) {
        return 0;
    }

    // Nếu tất cả các điều kiện đều thoả mãn, trả về 1 (hoặc giá trị khác theo yêu cầu của bạn)
    return 1;
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