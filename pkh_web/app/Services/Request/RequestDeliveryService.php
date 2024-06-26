<?php namespace App\Services\Request;

use DB;
use Mail;
use App\Services\BaseService;
use App\Models\TrnOrderEditRequest;

class RequestDeliveryService extends BaseService
{
    /**
     * @var string
     */
    private $subject = '[PHK-Portal] Y/c xu ly phieu xuat hang #';

    /***
     * INPUT :
     *  + $type: 1 (Request cancle), 3 (Request cancle remain)
     *  + $storeOrderId
     *  + $notes
     * OUTPUT:
     *  + rtnCd
     *  + msg
     ***/
    public function createRequest()
    {
        $logonUser             = $this->logonUser();
        $entity                = new TrnOrderEditRequest();
        $entity->request_type  = $type;
        $entity->request_sts   = '0';
        $entity->ref_id        = $storeOrderId;
        $entity->request_notes = $notes;
        $entity->request_date  = Carbon::today();
        $this->updateRecordHeader($entity, $logonUser, true);

        $entity->save();

        $param = [];

// 1: huy don dat hang

// 2: huy phieu xuat hang

// 3: tach don hang va huy phan chua giao

// 4: huy cong no
        if (1 == $type) {
            $param['type'] = "Hủy đơn đặt hàng";
        } elseif (3 == $type) {
            $param['type'] = "Tách đơn đặt hàng";
        } else {
            $param['type'] = '';
        }

        $param['notes']     = $notes;
        $param['user']      = $logonUser->name;
        $param['user_mail'] = $logonUser->email;

        $storeOrder                = TrnStoreOrder::find($storeOrderId);
        $param['store_order_code'] = $storeOrder->store_order_code;
        $param['url']              = '/crm0210//' . $storeOrder->store_id . '/' . $storeOrderId;

        // Send email
        Mail::queue('admin.emails.request_edit', ['param' => $param], function ($m) use ($logonUser, $param, $storeOrderId, $storeOrder) {
            $m->from('no-reply@phankhangco.com', 'PKH Automation');
            $m->to(['anh.phan@phankhangco.com', 'chien.phan@phankhangco.com', 'khangduyth@gmail.com '], '[PKH-PORTAL]')->subject('[PHK-Portal] Y/c xu ly don hang #' . $storeOrder->store_order_code . " - " . $logonUser->name);
        });

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
    public function acceptRequest()
    {
        $entity = TrnOrderEditRequest::find($params["request_id"]);

        if (null == $entity) {
            return [
                'rtnCd' => false,
                'msg'   => 'Không tìm thấy yêu cầu',
            ];
        }

        $logonUser = $this->logonUser();

        if (1 == $entity->request_type) {
            // Huy don hang
            $order = TrnStoreOrder::find($entity->ref_id);

            if (isset($order)) {
                $countDelivery =
                TrnStoreDelivery::where('store_order_id', $order->store_order_id)
                    ->where('delivery_sts', '!=', '5')->count();

                if ($countDelivery > 0) {
                    return [
                        "rtnCd" => false,
                        "msg"   => "Đơn hàng đã giao không thể hủy. Hint: Hãy hủy hết các đơn bên phiếu xuất được xuất từ phiếu đặt này",
                    ];
                }

                $order->order_sts    = "5";
                $order->notes_cancel = $params["notes"];
                $order->cancel_time  = Carbon::now();
                $this->updateRecordHeader($order, $logonUser, false);
                $order->save();

                $entity->response_notes = $params["notes"];
                $entity->request_sts    = 1;
                $this->updateRecordHeader($entity, $logonUser, false);

                $entity->save();

                return [
                    "rtnCd" => true,
                    "msg"   => "Đã hủy đơn hàng #" . $order->store_order_code,
                ];
            }

            return [
                "rtnCd" => false,
                "msg"   => "Đơn đặt hàng không tồn tại.",
            ];
        } elseif (3 == $entity->request_type) {
            // Huy don hang con lai chua giao
            $order = TrnStoreOrder::find($entity->ref_id);

            if (isset($order)) {
                $countDelivery =
                TrnStoreDelivery::where('store_order_id', $order->store_order_id)
                    ->where('delivery_sts', '!=', '5')->count();

                if ($countDelivery <= 0) {
                    return [
                        "rtnCd" => false,
                        "msg"   => "Đơn hàng chưa giao nên hãy hủy",
                    ];
                }

                $self = $this;
                DB::transaction(function () use ($order, $params, $entity, $self, $logonUser) {
                    // Split
                    $self->splitOrder($order);

                    $entity->response_notes = $params["notes"];
                    $entity->request_sts    = 1;
                    $self->updateRecordHeader($entity, $logonUser, false);

                    $entity->save();
                });

                return [
                    "rtnCd" => true,
                    "msg"   => "Đã hủy đơn hàng #" . $order->store_order_code,
                ];

            } else {
                return [
                    "rtnCd" => false,
                    "msg"   => "Đơn đặt hàng không tồn tại.",
                ];
            }

        }

    }

    /***
     *  INPUT: $request_id, $notes
     *  OUTPUT:
     *      + rtnCd : T/F
     *      + msg: Update successfully.
     ***/
    public function denyRequest()
    {
        $entity = TrnOrderEditRequest::find($params["request_id"]);

        if ($entity) {
            $logonUser              = $this->logonUser();
            $entity->response_notes = $params["notes"];
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
    public function loadRequest($storeOrderId)
    {
        $sqlParam = [$storeOrderId];
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
              and request_type in (2)
              and a.active_flg = '1'
        ";

        $sql .= "
            order by a.request_id desc
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

}
