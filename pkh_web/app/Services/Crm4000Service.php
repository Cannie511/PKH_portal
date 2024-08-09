<?php
namespace App\Services;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class Crm4000Service extends BaseService
{
      /**
     * @param $params
     * @return void
     */
    public function getStore($param)
    {
     $sqlParam = array();
     $sql = " SELECT 
    b.store_id, 
    b.contact_mobile1,
    b.name, 
    b.address   
FROM 
    mst_store b 
LEFT JOIN 
    trn_store_order a 
ON 
    a.store_id = b.store_id 
WHERE 
    a.order_date IS NOT NULL 
    AND LOWER(b.name) NOT REGEXP '^(khách lẻ|nhân viên|PKH|shopee|lazada|tiki|Anh|A)'
    AND lower(b.name) not LIKE '[pts]%'
        and  b.active_flg = '1'
GROUP BY 
    b.store_id 
ORDER BY 
    b.name ASC
     ";
    
     return $this->pagination($sql, $sqlParam, $param);
    }


// lấy thông tin đơn hàng thông qua payment_id
public function selectSpecificPayment($payment_id)
{
    $sqlParam = array();
    $sql      = "
      SELECT
    a.payment_id,
    a.store_id,
    a.payment_date,
    a.payment_type,
    a.payment_money,
    b.name AS store_name,
    b.address AS address,
    b.contact_mobile1,
    f.total_score_card
FROM
    trn_payment a
LEFT JOIN
    mst_store b ON b.store_id = a.store_id
LEFT JOIN
    store_scores f ON a.store_id = f.store_id
WHERE
    a.active_flg = '1' AND a.payment_id = ?;
  ";
    $sqlParam[] = $payment_id;
    $data = DB::select(DB::raw($sql), $sqlParam);
    return $data[0];
}
}


