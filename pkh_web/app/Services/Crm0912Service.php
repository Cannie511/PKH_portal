<?php

namespace App\Services;

use DB;
use File;
use Cache;
use Excel;

/**
 * Crm0912Service class
 */
class Crm0912Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectList($param)
    {
        $sqlParam = array();
        $sql      = "
            select
              a.in_date
              , a.product_id
              , b.product_code
              , b.name
              , a.amount
              , a.remain
              , DATEDIFF(now(), a.in_date) spent
              , b.selling_price
              , c.pi_no
              , d.supplier_code
            from
              trn_wh_product_time a
              left join mst_product b
                on a.product_id = b.product_id
              left join trn_supplier_delivery c
                on a.supplier_delivery_id = c.supplier_delivery_id
              left join mst_supplier d
                on b.supplier_id = d.supplier_id
            where
              a.remain != 0
        ";

        $sql .= $this->andWhereIntOperator($param, 'days', 'DATEDIFF(now(), a.in_date)', $sqlParam, ">=");
        $sql .= $this->andWhereString($param, 'product_code', 'b.product_code', $sqlParam);
        $sql .= $this->andWhereInt($param, 'supplier_id', 'd.supplier_id', $sqlParam);
        $sql .= "
            order by
              a.in_date
              , product_id
        ";

        // $result = array();
        $result = DB::select(DB::raw($sql), $sqlParam);
        // $result =  $this->pagination($sql, $sqlParam, $param);

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function download($param)
    {
        // $param['export'] = true;
        $data = $this->selectList($param);

        // Create path if not exist
        $path = config('constants.DOWNLOAD_DIR');
        $path = storage_path($path);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $fileName = "SoNgayTonkho_" . date('ymdhis');
        $ext      = "xlsx";

        Excel::create($fileName, function ($excel) use ($data) {
            $excel->sheet('SoNgayTonkho', function ($sheet) use ($data) {
                $sheet->loadView('admin.excels.crm0912-list')
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
