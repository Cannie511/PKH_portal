<?php

namespace App\Services;

use DB;
use File;
use Cache;
use Excel;

/**
 * Crm0920Service class
 */
class Crm0920Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $param
     *      + fromDate
     *      + toDate
     * @return void
     */
    public function selectList($param)
    {
        $sqlParam = array();
        $sql      = "
                select distinct
				  a.changed_date
          ,a.amount
          ,b.product_name
          ,b.product_cat1_id 
          ,b.product_cat2_id
          ,c.name as type1_name
          ,d.name as type2_name
          ,b.product_code
          ,a.warehouse_change_type as type_change
				  
				from
				  trn_warehouse_change a
        left join mst_product b
          on a.product_id = b.product_id 
        left join mst_product_cat1 c
          on c.product_cat1_id = b.product_cat1_id
        left join mst_product_cat2 d
          on d.product_cat2_id = b.product_cat2_id
         
				 
				where
				  a.active_flg = '1'";

        $sql .= $this->andWhereDateBetween($param, 'fromDate', 'toDate', 'a.changed_date', $sqlParam);
        $sql .= $this->andWhereString($param, 'product_code', 'b.product_code', $sqlParam);
        // $sql .= $this->andWhereString($param, 'order_code', 'd.store_order_code', $sqlParam);
        // $sql .= $this->andWhereString($param, 'store_name', 'e.name', $sqlParam);

       
        // $sql .= $this->andWhereInt($param, 'warehouse_id', 'a.warehouse_id', $sqlParam);
        // $sql .= $this->andWhereInt($param, 'supplier_id', 'f.supplier_id', $sqlParam);
        /*$sql .= "
        order by
        a.changed_date desc
        , a.warehouse_change_type
        , d.store_order_code
        , a.store_delivery_id ";*/
        

        // $result =  $this->pagination($sql, $sqlParam, $param);
        $result = [];

        if (isset($param['export']) && true == $param['export']) {
            $result = DB::select(DB::raw($sql), $sqlParam);
        } else {
            $result = $this->pagination($sql, $sqlParam, $param);
        }

        return $result;
    }

    /**
     * Download excel
     *
     * @return void
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

        $fileName = "XuatNhapKho_" . date('ymdhis');
        $ext      = "xlsx";

        Excel::create($fileName, function ($excel) use ($data) {
            $excel->sheet('Tonkho', function ($sheet) use ($data) {
                $sheet->loadView('admin.excels.crm0920-list')
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
