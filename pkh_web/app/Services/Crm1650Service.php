<?php

namespace App\Services;

use DB;
use Log;
use File;
use Cache;
use Excel;
use Carbon\Carbon;

/**
 * Crm1650Service class
 */
class Crm1650Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectListProduct($param)
    {
        $sqlParam = array();
        $sql      = "
        select
            a.product_id
            ,a.product_code,6
            , a.stock_code
        from
            mst_product a
        where
            a.selling_price > 0
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     */
    public function selectListPI($param)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.supplier_delivery_id
                , a.pi_no
                , a.comming_pkh_expected_date
            from
                trn_supplier_delivery a
            where
                a.comming_pkh_expected_date > CURDATE()
            order by
                a.comming_pkh_expected_date asc
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     */
    public function select3MonthNearest($param)
    {
        $start    = Carbon::createFromFormat('Y-m-d', $param['1']);
        $end      = Carbon::createFromFormat('Y-m-d', $param['2']);
        $sqlParam = [
            $start->format('Y-m-d'),
            $end->format('Y-m-d')
        ];

        $sql = "
            select
                e.product_id
                , month (a.order_date) as m
                , sum(b.amount) as sOrder
            from
                mst_product e
                left join trn_store_order_detail b
                    on b.product_id = e.product_id
                left join trn_store_order a
                    on a.store_order_id = b.store_order_id
            where
                a.order_date between ? and ?
                and a.order_sts in ('0',  '2', '8')
            group by
                e.product_id
                , month (a.order_date)
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $supplierDeliveryId
     * @return null
     */
    public function selectListPIDetail($supplierDeliveryId)
    {
        $sqlParam = array();

        if (null == $supplierDeliveryId) {
            return;
        }

        $sql = "
           select
                a.product_id
                , a.amount
            from
                trn_supplier_delivery_detail a
            where
                a.supplier_delivery_id = ?
        ";
        $sqlParam[] = $supplierDeliveryId;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     */
    public function selectListAVG($param)
    {
        $sqlParam = array();
        $sql      = "
          select
            a.product_id
            , a.product_code
            , datediff(curdate(), min(b.changed_date)) / 30 as time
            , e.amount  as amount
            from
            mst_product a
            left join trn_warehouse_change b
                on (
                a.product_id = b.product_id
                and b.warehouse_change_type = 1
                )
            left join (
                select
                sum(c.amount) as amount
                , c.product_id
                from
                trn_store_delivery_detail c
                left join trn_store_delivery d
                    on (d.store_delivery_id = c.store_delivery_id)
                where
                d.delivery_sts != 5
                group by
                c.product_id
            ) e
                on e.product_id = a.product_id
            where
            a.selling_price > 0
            group by
            b.product_id

        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $x
     * @param $y
     */
    public function checkSort(
        $x,
        $y
    ) {

        if (!isset($x["AVG"])) {
            return true;
        }

        if (!isset($y["AVG"])) {
            return false;
        }

        if ($x["AVG"] < $y["AVG"]) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * @param $listBig
     * @return mixed
     */
    public function sort_($listBig)
    {

        $n = count($listBig);

        for ($x = 0; $x < $n - 1; $x++) {

            for ($y = $x + 1; $y < $n; $y++) {

                if ($this->checkSort($listBig[$x], $listBig[$y])) {
                    $item        = $listBig[$x];
                    $listBig[$x] = $listBig[$y];
                    $listBig[$y] = $item;
                }

            }

        }

        return $listBig;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function download($param)
    {

        if (!isset($param["data"])) {
            return;
        }

        $data = $param["data"];
        Log::debug('download');
        Log::debug($data);
        // Create path if not exist
        $path = config('constants.DOWNLOAD_DIR');
        $path = storage_path($path);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $fileName = "NhapHang_" . date('ymdhis');
        $ext      = "xlsx";

        Excel::create($fileName, function ($excel) use ($data) {
            $excel->sheet('NhapHang', function ($sheet) use ($data) {
                $sheet->loadView('admin.excels.crm1650-list')
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
