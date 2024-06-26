<?php

namespace App\Services;

use DB;
use File;
use Cache;
use Excel;
use App\Models\TrnZaloPaymentNotify;

class Crm0700Service extends BaseService
{
    /**
     * @param $param
     * @return mixed
     */
    public function selectList($param)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.cpayment_id
                , a.customer_id
                , a.cpayment_date
               
               
                , a.cpayment_money
               , a.total
             
                , b.name as store_name
              
                , b.address as address
               
                , e.name as updated_by
                , a.updated_at
                , b.contact_mobile1
              from
                trn_customer_payment a
                left join mst_store b
                  on b.store_id = a.customer_id
                 left join users e
                    on a.updated_by = e.id
              where
                a.active_flg = '1'
        ";

        // $sql .= $this->andWhereInt($param, 'payment_type', 'a.payment_type', $sqlParam);
        // $sql .= $this->andWhereInt($param, 'salesman_id', 'a.salesman_id', $sqlParam);
        $sql .= $this->andWhereString($param, 'store_name', 'b.name', $sqlParam);
      
        // $sql .= $this->andWhereInt($param, 'sale_id', 'b.salesman_id', $sqlParam);
        // //$sql .= $this->andWhereInt($param,'bank_account_no','a.bank_account_no',$sqlParam);
        $sql .= $this->andWhereDateBetween($param, 'from_date', 'to_date', 'a.cpayment_date', $sqlParam);
        $sql .= "
            order by a.cpayment_date desc, a.updated_at desc
          ";

        if (1 == $param['down']) {
            return DB::select(DB::raw($sql), $sqlParam);
        }

        return $this->pagination($sql, $sqlParam, $param);
    }

    /**
     * @param $param
     * @return mixed
     */
    public function download($param)
    {
        $data = $this->selectList($param);

        // Create path if not exist
        $path = config('constants.DOWNLOAD_DIR');
        $path = storage_path($path);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $fileName = "CongNo_" . date('ymdhis');
        $ext      = "xlsx";

        Excel::create($fileName, function ($excel) use ($data) {
            $excel->sheet('CongNo', function ($sheet) use ($data) {
                $sheet->loadView('admin.excels.crm0700-list')
                    ->with('data', $data);
            });
        })->store($ext, $path);

        $fullPath = $path . '/' . $fileName . '.' . $ext;
        $key      = $fileName . '.' . $ext;
        Cache::put($key, $fullPath, config('constants.DOWNLOAD_EXPIRE_MIN'));

        $result = [
            'rtnCd' => 0,
            'file'  => $key,
            'test'  => Cache::get($key),
        ];

        return $result;
    }

    /**
     * @param $payment_id
     */
    public function selectSpecificPayment($payment_id)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.payment_id
                , a.store_id
                , a.payment_date
                , a.payment_type
                , a.payment_money
                , d.bank_account_no
                , d.bank_name
                , a.notes
                , b.name as store_name
                , b.accountant_store_id as accountant
                , b.address as address
                , c.name as salesman_name
                , b.contact_mobile1
                , e.name as updated_by
                , a.updated_at
              from
                trn_payment a
                left join mst_store b
                  on b.store_id = a.store_id
                left join users c
                  on a.salesman_id = c.id
                left join mst_bank_account d
                  on  d.bank_account_id = a.bank_account_id
                 left join users e
                    on a.updated_by = e.id
              where
                a.active_flg = '1' and a.payment_id = ?
      ";
        $sqlParam[] = $payment_id;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $phone
     * @return mixed
     */
    private function formatPhoneNumber($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (strlen($phone) < 9) {
            return $phone;
        }

        if ('0' == $phone[0]) {
            $phone = '84' . substr_replace($phone, '', 0, 1);
        }

        return $phone;
    }

    /**
     * @param $payment_id
     */
    public function makeMessageToSend($payment_id)
    {

        $data  = $this->selectSpecificPayment($payment_id);
        $phone = $this->formatPhoneNumber($data[0]->contact_mobile1);

        $store_name    = $data[0]->store_name;
        $store_address = $data[0]->address;
        $payment_money = $data[0]->payment_money;
        $salesman_name = $data[0]->salesman_name;
        $payment_date  = $data[0]->payment_date;
        $mess          = "Cửa hàng: " . $store_name . "\r\n Địa chỉ:" . $store_address . "\r\n Người phụ trách: " . $salesman_name . "\r\n Đã thanh toán: " . number_format($payment_money, 2) . " VND \r\n Ngày xác nhận: " . $payment_date . "\r\n Xin chân thành cảm ơn quý khách!";

        return [
            'message' => $mess,
            'uid'     => $phone,
        ];
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectZaloNotifyList($param)
    {
        $sqlParam = array();
        $sql      = "
              select
              a.content
              , a.zalo_sts
              , a.zalo_notes
              , a.phone_number
              , a.created_at
              , b.name
            from
            trn_zalo_payment_notify  a left join users b on a.created_by = b.id
            left join trn_payment c on c.payment_id = a.payment_id
            left join mst_store d on d.store_id = c.store_id
            where
              a.active_flg = '1' ";
        $sql .= $this->andWhereString($param, 'store_name', 'd.name', $sqlParam);
        $sql .= $this->andWhereString($param, 'phone_number', 'a.phone_number', $sqlParam);
        $sql .= $this->andWhereInt($param, 'sale_id', 'd.salesman_id', $sqlParam);

        $sql .= "
            order by
            a.created_at desc
        ";

// $sql .= $this->andWhereInt($param, 'payment_type', 'a.payment_type', $sqlParam);

// $sql .= $this->andWhereInt($param, 'salesman_id', 'a.salesman_id', $sqlParam);

// $sql .= $this->andWhereInt($param, 'store_id', 'a.store_id', $sqlParam);

// $sql .= $this->andWhereInt($param, 'sale_id', 'b.salesman_id', $sqlParam);

// //$sql .= $this->andWhereInt($param,'bank_account_no','a.bank_account_no',$sqlParam);

// $sql .= $this->andWhereDateBetween($param, 'from_date', 'to_date', 'a.payment_date', $sqlParam);

// $sql .= "

//     order by a.payment_date desc, a.updated_at desc
        //   ";

        return $this->pagination($sql, $sqlParam, $param);

    }

    /**
     * @param $payment_id
     */
    public function updatePaymentStatus($payment_id)
    {
        DB::update('update trn_payment set payment_sts = 1 where payment_id = ?', array($payment_id));
    }

    /**
     * @param $param
     * @param $user
     */
    public function recordZaloNotify(
        $param,
        $user
    ) {
        $entity               = new TrnZaloPaymentNotify();
        $entity->payment_id   = $param["payment_id"];
        $entity->content      = $param["message"];
        $entity->phone_number = $param["uid"];
        $entity->zalo_sts     = $param["errorCode"];
        $entity->zalo_notes   = $param["errorMsg"];
        $this->updateRecordHeader($entity, $user, true);
        DB::transaction(function () use ($entity) {
            $entity->save();
        });
    }

    /**
     * @param $param
     * @return mixed
     */
    public function updateAccountant($param)
    {
        $sql      = 'update mst_store set accountant_store_id = "' . $param["accountant_store_id"] . '" where store_id = ?';
        $affected = DB::update($sql, [$param['store_id']]);

        return $affected;
    }

}
