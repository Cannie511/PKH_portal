<?php

namespace App\Services;

use DB;
use Log;
use File;
use Cache;
use Excel;

/**
 * Crm0230Service class
 */
class Crm0230Service extends BaseService
{
    /**
     * @param $param
     * @return mixed
     */
    public function selectStoreList($param)
    {
        $sqlParam = [];
        $sql      = "
			select
			f.name area1
            , g.name area2
            , e.store_id
			, e.name as store_name
			, e.address
			, d.product_code
			, d.name as product_name
			, SUM(a.amount) as amount
			from
			trn_store_delivery_detail a
			join trn_store_delivery b
				on b.store_delivery_id = a.store_delivery_id
			join trn_store_order i
				on b.store_order_id = i.store_order_id
			left join mst_product d
				on d.product_id = a.product_id
			left join mst_store e
				on e.store_id = i.store_id
			left join mst_area f
				on f.area_id = e.area1
			left join mst_area g
				on g.area_id = e.area2
			left join mst_area_group h
				on h.area_group_id = f.area_group_id
			where
				b.delivery_sts in (0, 1, 2, 3, 4)
		";

        $sql .= $this->andWhereInt($param, 'storeId', 'e.store_id ', $sqlParam);
        $sql .= $this->andWhereString($param, 'storeName', 'e.name', $sqlParam);
        $sql .= $this->andWhereString($param, 'productCode', 'd.product_code', $sqlParam);
        $sql .= $this->andWhereDateBetween($param, 'start_date', 'end_date', 'b.delivery_date', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area1', 'e.area1', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area2', 'e.area2', $sqlParam);
        $sql .= $this->andWhereInt($param, 'sale_id', 'e.salesman_id', $sqlParam);

        $sql .= "
			group by
				f.name
                , g.name
                , e.store_id
				, e.name
				, e.address
				, d.product_code
				, d.name
			order by
				SUM(a.amount) desc
        ";
        // return $this->pagination($sql, $sqlParam, $param);
        $result = null;

        if (isset($param["download"]) && 1 == $param["download"]) {
            $result = DB::select(DB::raw($sql), $sqlParam);
        } else {
            $result = $this->pagination($sql, $sqlParam, $param);
        }

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function download($param)
    {
        $param["download"] = 1;
        $data              = $this->selectStoreList($param);
        Log::debug('-------------------------------download');
        $path = config('constants.DOWNLOAD_DIR');
        $path = storage_path($path);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $fileName = "SanPhamDaGiao_" . date('ymdhis');
        $ext      = "xlsx";

        Excel::create($fileName, function ($excel) use ($data) {
            $excel->sheet('Sản phẩm đã giao', function ($sheet) use ($data) {
                $sheet->loadView('admin.excels.crm0230-list')->with('data', $data);
            });
        })->store($ext, $path);

        $fullPath = $path . '/' . $fileName . '.' . $ext;
        $key      = $fileName . '.' . $ext;
        Cache::put($key, $fullPath, config('constants.DOWNLOAD_EXPIRE_MIN'));

        $result = [
            'rtnCd' => 0,
            'file'  => $key,
        ];

        return $result;
    }

}
