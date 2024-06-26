<?php

namespace App\Services;

use DB;
use File;
use Cache;
use Excel;
use Carbon\Carbon;

class Crm1000Service extends BaseService
{
    public function selectShippingListToday()
    {
        $date     = Carbon::now()->format('Y-m-d');
        $sqlParam = array();
        $sqlParam = [$date, $date];
        $sql      = "
				select
				    a.delivery_date
				  , a.id
                  ,CONCAT(b.delivery_vendor_name, '_', a.price,'_',a.delivery_date) as name
				  , a.notes
				  , a.active_flg
				from trn_delivery a left join mst_delivery_vendor b on  a.delivery_vendor_id=b.id
				where
			        a.active_flg = '1' and
                     a.delivery_date between ? and ?
			";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectList($param)
    {

        $sqlParam = array();
        $sql      = "
				select
				    a.delivery_date
                  , a.id
                  , CONCAT(b.delivery_vendor_name, '_', a.price,'_',a.delivery_date) as name
				  , b.delivery_vendor_name
				  , a.price
				  , a.notes
                  , sum(c.carton) as carton
                  , sum(c.volume) as volume
                  , sum(c.total) as total
                  , sum(c.total_with_discount) as total_discount
                from
                    trn_delivery a left join mst_delivery_vendor b on  a.delivery_vendor_id=b.id
                    left join trn_store_delivery c
                    on a.id = c.shipping_id
				where
                    a.active_flg = '1' ";
        $sql .= $this->andWhereDateBetween($param, 'delivery_start_date', 'delivery_end_date', 'a.delivery_date', $sqlParam);
        $sql .= $this->andWhereString($param, 'delivery_vendor_name', ' b.delivery_vendor_name', $sqlParam);

        $sql .= "
                group by
					a.id
			";

        $sql .= " order by a.delivery_date desc";

        if (isset($param['down']) && 1 == $param['down']) {
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

        $fileName = "ChiPhiGiaoHang_" . date('ymdhis');
        $ext      = "xlsx";

        Excel::create($fileName, function ($excel) use ($data) {
            $excel->sheet('ChiPhiGiaoHang', function ($sheet) use ($data) {
                $sheet->loadView('admin.excels.crm1000-list')
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
