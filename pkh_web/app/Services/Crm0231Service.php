<?php

namespace App\Services;

use DB;
use File;
use Cache;
use Excel;

/**
 * Crm0231Service class
 */
class Crm0231Service extends BaseService
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
            a.store_id
            , c.name area1
            , d.name area2
            , a.name store_name
            , a.address
            , b.product_id
            , b.product_code
            , b.name product_name
            from
            (
                select
                *
                from
                mst_store
                where
                store_id in (select store_id from trn_store_order)
            ) a join (
                select
                *
                from
                mst_product
                where
                selling_price > 0
            ) b
            left join mst_area c
                on c.area_id = a.area1
            left join mst_area d
                on d.area_id = a.area2
            where
            (a.store_id, b.product_id) not in (
                select
                b.store_id
                , a.product_id
                from
                trn_store_order_detail a join trn_store_order b
                    on a.store_order_id = b.store_order_id
            )
        ";

        $sql .= $this->andWhereInt($param, 'area1', 'a.area1', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area2', 'a.area2', $sqlParam);
        $sql .= $this->andWhereInt($param, 'storeId', 'a.store_id', $sqlParam);
        $sql .= $this->andWhereString($param, 'storeName', 'a.name', $sqlParam);
        $sql .= $this->andWhereString($param, 'productCode', 'b.product_code', $sqlParam);
        $sql .= $this->andWhereString($param, 'productName', 'b.product_name', $sqlParam);
        $sql .= $this->andWhereInt($param, 'sale_id', 'a.salesman_id', $sqlParam);

        $result = array();

        if (isset($param['export']) && true == $param['export']) {
            return DB::select(DB::raw($sql), $sqlParam);
        }

        $result = $this->pagination($sql, $sqlParam, $param);

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function download($param)
    {
        $param['export'] = true;
        $data            = $this->selectList($param);
        // Create path if not exist
        $path = config('constants.DOWNLOAD_DIR');
        $path = storage_path($path);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $fileName = "SanPhammChuaNhap_" . date('ymdhis');
        $ext      = "xlsx";
        Excel::create($fileName, function ($excel) use ($data) {
            $excel->sheet('Tonkho', function ($sheet) use ($data) {
                $sheet->loadView('admin.excels.crm0231-list')
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
