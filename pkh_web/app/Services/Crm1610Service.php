<?php

namespace App\Services;

use DB;
use Log;
use File;
use Cache;
use Excel;
use Carbon\Carbon;
use App\Models\MstProduct;
use App\Models\TrnSupplierOrder;
use App\Models\TrnSupplierDelivery;
use App\Models\TrnSupplierDeliveryDetail;

/**
 * Crm1610Service class
 */
class Crm1610Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */

    public function confirmStatus(
        $user,
        $param
    ) {
        $today1 = Carbon::now();
        $form   = $param['form'];
        $today  = date('Y-m-d', strtotime($today1));

        if (1 == $param['index']) {
            $payment2Date = date('Y-m-d', (strtotime('+45 day', strtotime($today1))));
            TrnSupplierDelivery::where('supplier_delivery_id', $form['supplier_delivery_id'])
                ->update(['delivery_sts' => 1
                    , 'payment_1_date' => $today
                    , 'contract_no' => $form['contract_no']
                    , 'updated_at' => $today1
                    , 'payment_2_expected_date' => $payment2Date
                    , 'payment_2_duration' => $form['payment_2_duration']
                    , 'payment_1_percent' => $form['payment_1_percent']
                    , 'updated_by' => $user->id]);

        } elseif (2 == $param['index']) {
            TrnSupplierDelivery::where('supplier_delivery_id', $form['supplier_delivery_id'])
                ->update(['delivery_sts' => 2
                    , 'finish_cont_date' => $today
                    , 'updated_at' => $today1
                    , 'updated_by' => $user->id]);
        } elseif (3 == $param['index']) {
            TrnSupplierDelivery::where('supplier_delivery_id', $form['supplier_delivery_id'])
                ->update(['delivery_sts' => 3
                    , 'deliver_cont_date' => $today
                    , 'updated_at' => $today1
                    , 'updated_by' => $user->id]);
        } elseif (4 == $param['index']) {
            TrnSupplierDelivery::where('supplier_delivery_id', $form['supplier_delivery_id'])
                ->update(['delivery_sts' => 4
                    , 'arrive_port_date' => $today
                    , 'updated_at' => $today1
                    , 'updated_by' => $user->id]);
        } elseif (5 == $param['index']) {
            TrnSupplierDelivery::where('supplier_delivery_id', $form['supplier_delivery_id'])
                ->update(['delivery_sts' => 5
                    , 'comming_pkh_date' => $today
                    , 'updated_at' => $today1
                    , 'updated_by' => $user->id]);

        } elseif (6 == $param['index']) {
            TrnSupplierDelivery::where('supplier_delivery_id', $form['supplier_delivery_id'])
                ->update(['delivery_sts' => 6
                    , 'payment_2_date' => $today
                    , 'updated_at' => $today1
                    , 'updated_by' => $user->id]);
        }

        $instance = TrnSupplierDelivery::find($form['supplier_delivery_id']); // check delivery has changed or

        return $instance;
    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function saveExpectedDate(
        $user,
        $param
    ) {
        $today1 = Carbon::now();
        $form   = $param['form'];
        $today  = date('Y-m-d', strtotime($today1));

        if (2 == $param['index']) {
            $deliverDate = date('Y-m-d', (strtotime('+7 day', strtotime($form['finish_cont_expected_date']))));
            $arriveDate  = date('Y-m-d', (strtotime('+11 day', strtotime($form['finish_cont_expected_date']))));
            $commingDate = date('Y-m-d', (strtotime('+19 day', strtotime($form['finish_cont_expected_date']))));
            TrnSupplierDelivery::where('supplier_delivery_id', $form['supplier_delivery_id'])
                ->update([
                    'finish_cont_expected_date' => $form['finish_cont_expected_date']
                    , 'deliver_cont_expected_date' => $deliverDate
                    , 'arrive_port_expected_date' => $arriveDate
                    , 'comming_pkh_expected_date' => $commingDate
                    , 'updated_at' => $today1
                    , 'updated_by' => $user->id]);
        } elseif (3 == $param['index']) {
            TrnSupplierDelivery::where('supplier_delivery_id', $form['supplier_delivery_id'])
                ->update([
                    'deliver_cont_expected_date' => $form['deliver_cont_expected_date']
                    , 'updated_at' => $today1
                    , 'updated_by' => $user->id]);
        } elseif (4 == $param['index']) {
            TrnSupplierDelivery::where('supplier_delivery_id', $form['supplier_delivery_id'])
                ->update([
                    'arrive_port_expected_date' => $form['arrive_port_expected_date']
                    , 'updated_at' => $today1
                    , 'updated_by' => $user->id]);
        } elseif (5 == $param['index']) {
            TrnSupplierDelivery::where('supplier_delivery_id', $form['supplier_delivery_id'])
                ->update([
                    'comming_pkh_expected_date' => $form['comming_pkh_expected_date']
                    , 'updated_at' => $today1
                    , 'updated_by' => $user->id]);
        } elseif (6 == $param['index']) {
            TrnSupplierDelivery::where('supplier_delivery_id', $form['supplier_delivery_id'])
                ->update([
                    'payment_2_expected_date' => $form['payment_2_expected_date']
                    , 'updated_at' => $today1
                    , 'updated_by' => $user->id]);
        }

        $instance = TrnSupplierDelivery::find($form['supplier_delivery_id']); // check delivery has changed or

        return $instance;
    }

    /**
     * @param $form
     * @param $str
     * @return mixed
     */
    private function getData(
        $form,
        $str
    ) {

        if (isset($form[$str])) {
            return $form[$str];
        } else {
            return null;
        }

    }

    /**
     * @param $user
     * @param $param
     */
    public function saveActualDate(
        $user,
        $param
    ) {
        $today1 = Carbon::now();
        $form   = $param;
        Log::debug('check save actual date ');
        Log::debug($form);
        $payment_1_date    = $this->getData($form, "payment_1_date");
        $finish_cont_date  = $this->getData($form, "finish_cont_date");
        $deliver_cont_date = $this->getData($form, "deliver_cont_date");
        $arrive_port_date  = $this->getData($form, "arrive_port_date");
        $comming_pkh_date  = $this->getData($form, "comming_pkh_date");
        $payment_2_date    = $this->getData($form, "payment_2_date");
        $today             = date('Y-m-d', strtotime($today1));
        TrnSupplierDelivery::where('supplier_delivery_id', $form['supplier_delivery_id'])
            ->update([
                'finish_cont_date' => $finish_cont_date
                , 'payment_1_date' => $payment_1_date
                , 'payment_2_date' => $payment_2_date
                , 'deliver_cont_date' => $deliver_cont_date
                , 'arrive_port_date' => $arrive_port_date
                , 'comming_pkh_date' => $comming_pkh_date
                , 'updated_at' => $today1
                , 'updated_by' => $user->id]);

        return true;
    }

    /**
     * @param $supplierDeliveryId
     */
    public function selectDeliveryDetail($supplierDeliveryId)
    {
        $sqlParam = array();
        $sql      = "
           select
                a.supplier_delivery_id
                , d.supplier_id
                , a.product_id
                , a.seq_no
                 , a.duty_tax
                , a.amount
                , a.price as unit_price
                , a.price_vi
                , b.product_code
                , b.color
                , b.name name_vi
                , b.name_origin product_name
                , c.product_cat_id
                , c.name
                , b.standard_packing
                , b.stock_code
                , b.name_origin stock_name
                , e.length
                , e.width
                , e.height
                , e.name as packaging
            from
                trn_supplier_delivery_detail a
                left join mst_product b
                    on a.product_id = b.product_id
                left join mst_product_cat c
                    on b.product_cat_id = c.product_cat_id
                left join trn_supplier_delivery d
                    on a.supplier_delivery_id = d.supplier_delivery_id
                left join mst_packaging e
                    on e.packaging_id = b.packaging_id
            where
                a.supplier_delivery_id = ?
                and a.active_flg = '1'
            order by
                a.seq_no
        ";

        $sqlParam[] = $supplierDeliveryId;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $supplierDeliveryId
     */
    public function selectDelivery($supplierDeliveryId)
    {
        $sqlParam = array();
        $sql      = "
        select
            a.supplier_delivery_id
            , a.supplier_order_id
            , a.supplier_id
            , a.pi_no
            , a.delivery_date
            , b.order_date
            , a.total
            , a.total_vi
            , a.rate
             , a.notes
            , a.vat_tax
            , a.volume
            , a.frieght_cost
            , a.landed_cost
            , a.cancel_time
            , a.delivery_date
            , a.contract_no
            , a.payment_1_date
            , a.finish_cont_date
            , a.deliver_cont_date
            , a.arrive_port_date
            , a.comming_pkh_date
            , a.payment_2_date
            , a.finish_cont_expected_date
            , a.deliver_cont_expected_date
            , a.arrive_port_expected_date
            , a.comming_pkh_expected_date
            , a.payment_2_expected_date
            , a.payment_1_percent
            , a.payment_2_duration
            , a.insurance_cost
            , a.delivery_sts
        from
            trn_supplier_delivery a
            left join trn_supplier_order b
                on a.supplier_order_id = b.supplier_order_id
        where
            a.supplier_delivery_id = ?
        ";

        $sqlParam[] = $supplierDeliveryId;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $supplierOrderId
     */
    public function selectExactSupplier($supplierOrderId)
    {
        $sqlParam = array();
        $sql      = "
           select
                a.supplier_delivery_id
                , a.supplier_id
            from
                trn_supplier_delivery a
            where
                a.supplier_delivery_id = ?
                and a.active_flg = '1'
        ";

        $sqlParam[] = $supplierOrderId;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $user
     * @param $supplierOrderId
     */
    public function updateOrderStatus(
        $user,
        $supplierOrderId
    ) {

        if (null != $supplierOrderId) {
            $today = Carbon::now();
            TrnSupplierOrder::where('supplier_order_id', $supplierOrderId)
                ->update([
                    'order_sts' => 2
                    , 'updated_at' => $today
                    , 'updated_by' => $user->id]);
        }

    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function createSupplierDelivery(
        $user,
        $param
    ) {
        $deliveryDetailX    = $param['deliveryDetail'];
        $detailSeqNo        = 1;
        $listDeliveryDetail = array();

        foreach ($deliveryDetailX as $item) {
            $product = MstProduct::find($item['product_id']);

            $deliveryDetail             = new TrnSupplierDeliveryDetail();
            $deliveryDetail->product_id = $product->product_id;
            $deliveryDetail->seq_no     = $detailSeqNo++;
            $deliveryDetail->amount     = $item['amount'];
            $deliveryDetail->price      = $item['price'];
            $deliveryDetail->duty_tax   = $item['duty_tax'];
            $deliveryDetail->price_vi   = $item['price'] * $param['rate'];
            $this->updateRecordHeader($deliveryDetail, $user, true);
            $listDeliveryDetail[] = $deliveryDetail;
        }

        if (isset($param['supplier_delivery_id']) && null != $param['supplier_delivery_id']) {
            // Update
            $entityOrder = TrnSupplierDelivery::find($param['supplier_delivery_id']);
            $this->updateRecordHeader($entityOrder, $user, false);

        } else {
            $entityOrder                = new TrnSupplierDelivery();
            $entityOrder->delivery_date = Carbon::today();
            $this->updateOrderStatus($user, $param['supplier_order_id']); // changing order status from new to turn to PI
            $this->updateRecordHeader($entityOrder, $user, true);
        }

        $entityOrder->supplier_id       = $param['supplier_id'];
        $entityOrder->supplier_order_id = $param['supplier_order_id'];
        $entityOrder->total             = $param['total'];
        $entityOrder->total_vi          = $param['total'] * $param['rate'];
        $entityOrder->total_duty_vi     = $param['totalDuty'];
        $entityOrder->volume            = $param['totalVolume'];
        $entityOrder->rate              = $param['rate'];
        $entityOrder->notes             = $param['notes'];
        $entityOrder->pi_no             = $param['pi_no'];
        $entityOrder->vat_tax           = $param['vat_tax'];
        $entityOrder->frieght_cost      = $param['frieght_cost'];
        $entityOrder->landed_cost       = $param['landed_cost'];
        $entityOrder->insurance_cost    = $param['insurance_cost'];

        DB::transaction(function () use ($entityOrder, $listDeliveryDetail, $param) {

            $entityOrder->save();

            TrnSupplierDeliveryDetail::where('supplier_delivery_id', $param['supplier_delivery_id'])->delete();

            foreach ($listDeliveryDetail as $detail) {
                $detail->supplier_Delivery_id = $entityOrder->supplier_delivery_id;
                $detail->save();
            }

        });
        $newId          = $entityOrder->supplier_delivery_id;
        $newEntityOrder = TrnSupplierDelivery::find($newId);

        return $newEntityOrder;
    }

    /**
     * @param $today
     * @return mixed
     */
    public function getMonth($today)
    {
        $month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        $index = intval(date('m', strtotime($today)));

        if ($index > 12 || $index < 0) {
            return "";
        } else {
            return $month[$index - 1];
        }

    }

    /**
     * @param $today
     */
    public function getDay($today)
    {
        return intval(date('d', strtotime($today)));
    }

    /**
     * @param $today
     */
    public function getMark($today)
    {
        $day = intval(date('d', strtotime($today)));

        if ($day >= 11 && $day <= 13) {
            return "th";
        }

        switch ($day % 10) {
            case 1:
                return "st";
            case 2:
                return "nd";
            case 3:
                return "rd";
            default:
                return "th";
        }

    }

    /**
     * @param $today
     */
    public function getYear($today)
    {
        return intval(date('Y', strtotime($today)));
    }

    /**
     * @param $param
     * @return mixed
     */
    public function downloadWarehouse($param)
    {
        $data = $this->selectDeliveryDetail($param['supplier_delivery_id']);

        // Create path if not exist
        $path = config('constants.DOWNLOAD_DIR');
        $path = storage_path($path);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $fileName = "warehouse_" . date('ymdhis');
        $ext      = "xlsx";

        Excel::create($fileName, function ($excel) use ($data) {
            $excel->sheet('downloadForWarehouse', function ($sheet) use ($data) {
                $sheet->loadView('admin.excels.crm1610-warehouse')
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
     * @param $param
     * @return mixed
     */
    public function downloadAdmin($param)
    {
        $data = $this->selectDeliveryDetail($param['supplier_delivery_id']);

        // Create path if not exist
        $path = config('constants.DOWNLOAD_DIR');
        $path = storage_path($path);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $fileName = "admin_" . date('ymdhis');
        $ext      = "xlsx";

        Excel::create($fileName, function ($excel) use ($data) {
            $excel->sheet('downloadForAdmin', function ($sheet) use ($data) {
                $sheet->loadView('admin.excels.crm1610-admin')
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

}
