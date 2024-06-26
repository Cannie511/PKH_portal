<?php namespace App\Services\Request;

use DB;
use Carbon\Carbon;
use App\Services\BaseService;
use App\Models\TrnWarehouseExim;
use App\Models\TrnWarehouseChange;
use App\Models\TrnOrderEditRequest;

class RequestWarehouseService extends BaseService
{
    /**
     * @var string
     */
    private $subject = '[PHK-Portal] Y/c xu ly phieu xuat nhap kho #';

    /**
     * @param $type
     * @param $param
     * @return int
     */
    private function checkToCreateRequest(
        $type,
        $param
    ) {
        $id              = $param['warehouse_exim_id'];
        $arrayTypeList   = [7];
        $arrayStatusList = ['0', '1'];
        //Đếm số lượng đơn đang pending
        $count =
        TrnOrderEditRequest::where('ref_id', $id)
            ->whereIn('request_type', $arrayTypeList)
            ->whereIn('request_sts', $arrayStatusList)->count();

        if ($count > 0) {
            return 0;
        }

        return -1;
    }

/***
 * INPUT :
 *  + $type: 1 (Request cancle), 3 (Request cancle remain)
 *  + $storeOrderId
 *  + $notes
 * OUTPUT:
 *  + rtnCd
 *  + msg
 ***/
    /**
     * @param $type
     * @param $param
     */
    public function createRequest(
        $type,
        $param
    ) {
        $checkValue = $this->checkToCreateRequest($type, $param);

        if ($checkValue > -1) {
            return [
                'rtnCd' => false,
                'msg'   => 'Không thể tạo request',
            ];
        }

        $logonUser             = $this->logonUser();
        $entity                = new TrnOrderEditRequest();
        $entity->request_type  = $type;
        $entity->request_sts   = '0';
        $entity->ref_id        = $param["warehouse_exim_id"];
        $entity->request_notes = $param["notes"];
        $entity->request_date  = Carbon::today();
        $this->updateRecordHeader($entity, $logonUser, true);

        $entity->save();

        $paramSend         = [];
        $paramSend['type'] = "Hủy phiếu xuất nhập kho";

        $paramSend['notes']     = $param["notes"];
        $paramSend['user']      = $logonUser->name;
        $paramSend['user_mail'] = $logonUser->email;

        $warehouse = TrnWarehouseExim::find($param["warehouse_exim_id"]);
        // $param['store_order_code'] = $storeOrder->store_order_code;
        $param['url'] = '/crm2310//' . $param["warehouse_exim_id"];

// Send email

// Mail::queue('admin.emails.request_edit', ['param' => $param], function ($m) use ($logonUser, $param) {

//     $m->from('no-reply@phankhangco.com', 'PKH Automation');

//     $m->to(['anh.phan@phankhangco.com', 'chien.phan@phankhangco.com', 'khangduyth@gmail.com '], '[PKH-PORTAL]')->subject('[PHK-Portal] Y/c huy phieu xuat nhap kho #' . " - " . $logonUser->name);
        // });

        return [
            'rtnCd' => true,
            'msg'   => 'Cập nhật thành công.',
        ];
    }

/***
 * INPUT :
 *  + request_id
 *  + $notes
 * OUTPUT:
 *  + rtnCd
 *  + msg
 ***/
    /**
     * @param $param
     */
    public function acceptRequest($param)
    {
        $entity = TrnOrderEditRequest::find($param["request_id"]);

        if (null == $entity) {
            return [
                'rtnCd' => false,
                'msg'   => 'Không tìm thấy yêu cầu',
            ];
        }

        $logonUser = $this->logonUser();

        // phiếu xuất nhập kho
        $warehouse = TrnWarehouseExim::find($entity->ref_id);

        if (isset($warehouse)) {

            $warehouse->exim_sts     = "5";
            $warehouse->notes_cancel = $param["notes"];
            $warehouse->cancel_time  = Carbon::now();
            $this->updateRecordHeader($warehouse, $logonUser, false);
            $warehouse->save();

            $entity->response_notes = $param["notes"];
            $entity->request_sts    = 1;
            $this->updateRecordHeader($entity, $logonUser, false);

            $entity->save();

            TrnWarehouseChange::where('warehouse_exim_id', $warehouse->warehouse_exim_id)
                ->delete();

            return [
                "rtnCd" => true,
                "msg"   => "Đã  huỷ phiếu xuất nhập kho  thành công#",
            ];
        }

        return [
            "rtnCd" => false,
            "msg"   => "Phiếu xuất nhập kho không tồn tại.",
        ];

    }

/***
 *  INPUT: $request_id, $notes
 *  OUTPUT:
 *      + rtnCd : T/F
 *      + msg: Update successfully.
 ***/
    /**
     * @param $param
     */
    public function denyRequest($param)
    {
        $entity = TrnOrderEditRequest::find($param["request_id"]);

        if ($entity) {
            $logonUser              = $this->logonUser();
            $entity->response_notes = $param["notes"];
            $entity->request_sts    = 2;
            $this->updateRecordHeader($entity, $logonUser, false);

            $entity->save();

            return [
                'rtnCd' => true,
                'msg'   => 'Cập nhật thành công.',
            ];
        }

    }

/***
 *  INPUT: $storeOrderId
 *  OUTPUT: List of request
 ***/
    /**
     * @param $storeOrderId
     */
    public function loadRequest($warehouse_exim_id)
    {
        $sqlParam = [$warehouse_exim_id];
        $sql      = "
            select
              a.request_id
              , a.request_date
              , a.request_type
              , a.request_sts
              , a.ref_id
              , a.request_notes
              , a.response_notes
              , b.name created_user_name
            from
              trn_order_edit_request a
              left join users b
                on a.created_by = b.id
            where
              ref_id = ?
              and request_type in (7)
              and a.active_flg = '1'
        ";

        $sql .= "
            order by a.request_id desc
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

}
