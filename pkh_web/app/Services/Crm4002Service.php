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
   
     public function getRecommendedProductForStore($store_id, $year, $quarter)
{
    // Lấy giá trị voucher của cửa hàng
    $voucher = $this->getVoucher($store_id, $year, $quarter);

    if ($voucher === null) {
        return null; // Không tìm thấy voucher
    }

    // Truy vấn để lấy sản phẩm với giá thấp hơn hoặc bằng voucher và còn hàng
    $sql = "
        SELECT DISTINCT 
            mpm.name, tph.price, tph.amount
        FROM trn_product_market_his tph
        JOIN mst_product_market mpm
            ON mpm.product_market_id = tph.product_market_id
        WHERE tph.updated_at = (
            SELECT MAX(updated_at) 
            FROM trn_product_market_his 
            WHERE product_market_id = tph.product_market_id
            AND lower(mpm.name) NOT LIKE '%Đồng phục PKH%'
        )
        AND tph.price <= ?
        AND tph.amount > 0 -- Chỉ lấy các sản phẩm còn hàng
        ORDER BY tph.price DESC
    ";

    $products = DB::select(DB::raw($sql), [$voucher]);

    if (count($products) === 0) {
        return null; // Không tìm thấy sản phẩm còn hàng
    }

    // Lấy giá cao nhất trong các sản phẩm đã tìm được
    $maxPrice = $products[0]->price;

    // Lọc các sản phẩm có giá bằng với giá cao nhất và còn hàng
    $recommendedProducts = array_filter($products, function($product) use ($maxPrice) {
        return $product->price == $maxPrice;
    });

    if (count($recommendedProducts) === 0) {
        return null; // Không tìm thấy sản phẩm phù hợp
    }

    // Trả về tên của sản phẩm đầu tiên có giá cao nhất còn hàng
    return array_values($recommendedProducts)[0]->name;
}

public function checkIsUsed($store_id, $year, $quarter)
{
    // Truy vấn để kiểm tra giá trị isUsed từ bảng store_scores
    $sql = "
        SELECT isUsed 
        FROM store_scores
        WHERE store_id = ?
        AND year = ?
        AND quarter = ?
    ";

    // Thực thi truy vấn
    $result = DB::select(DB::raw($sql), [$store_id, $year, $quarter]);

    // Kiểm tra nếu tìm thấy kết quả
    if (count($result) > 0) {
        return $result[0]->isUsed; // Trả về giá trị của isUsed
    } else {
        return null; // Không tìm thấy bản ghi phù hợp
    }
}

     
 
     /**
 * Lay danh sach nam
 */
public function getYears($param)
{
    $currentYear = date('Y');
    $startYear = 2016;
    
    // Tạo danh sách các năm từ 2016 đến năm hiện tại
    $years = [];
    for ($year = $currentYear; $year >= $startYear; $year--) {
        $years[] = ['year' => $year];
    }

    return $years;
}


}