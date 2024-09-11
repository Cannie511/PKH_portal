<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Bat4002Service extends BaseService
{
    // Hàm tự động cập nhật Voucher truyền vào $year, $quarter
    public function updataVoucher($year, $quarter)
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
                $total_score_card = $d->total_score_card;
               
                // Tính toán voucher dựa trên total_score_card
                $voucher = $this->calculateVoucher($total_score_card);
               
                // Cập nhật bảng với voucher và tổng điểm
                $this->UpdatetoTable($store_id, $year, $quarter, $voucher, $total_score_card);

                  // Ghi log 
                Log::info("Năm: $year, Quý: $quarter, Store ID: $store_id, Điểm Score Card: $total_score_card, Voucher: $voucher");

                // Đặt lại tổng điểm về 0 cho lần tiếp theo
                $total_score_card = 0;
                Log::info("Tổng điểm đặt lại: " . $total_score_card);
            }

            // Tăng offset để lấy lô dữ liệu tiếp theo
            $offset += $batchSize; 
        }
    }

    // Tính toán voucher dựa trên tổng điểm
    private function calculateVoucher($totalScoreCard)
    {
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

    // Lấy store_id, total_score_card
    public function getStoreBatch($year, $quarter, $limit, $offset)
    {
        $sqlParam = [$year, $quarter, $limit, $offset];
        $sql = "SELECT store_id, total_score_card FROM store_scores WHERE year = ? AND quarter = ? LIMIT ? OFFSET ?";
        return DB::select(DB::raw($sql), $sqlParam);
    }

    // Cập nhật voucher
    public function UpdatetoTable($store_id, $year, $quarter, $voucher, $total_score_card)
    {
        $sqlParam = [$voucher, $total_score_card, $store_id, $year, $quarter];
        $sql = "UPDATE promotion_stores SET voucher = ?, total_score_card = ?, discount = 50, type_promotion = 1 WHERE store_id = ? AND year = ? AND quarter = ?";
        DB::update($sql, $sqlParam);
    }
}
