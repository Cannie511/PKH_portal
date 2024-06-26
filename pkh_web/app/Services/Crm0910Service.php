<?php

namespace App\Services;

use DB;
use File;
use Cache;
use Excel;

/**
 * Crm0910Service class
 */
class Crm0910Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $month     yyyy-MM
     * @return void
     */

    /**
     * @param $date
     * @return mixed
     */
    private function selectChangeInMonth($date)
    {
        $sqlParam = [
            $date->startOfMonth()->format('Y-m-d'),
            $date->endOfMonth()->format('Y-m-d'),
        ];

        $sql = "
								select
						a.product_id
						, a.supplier_id
						, a.product_cat_id
						, a.product_code
						, a.stock_code
						, a.name
						, a.name_origin
						, a.color
						, a.packing
						, a.moq
						, a.standard_packing
						, a.warning_qty
						, a.selling_price
						, a.active_flg
						, b.product_cat_code
						, b.name product_cat_name
						, c.supplier_code
						, c.name supplier_name
						, d.in_num
						, d.out_num
						, d.in_num_edit
						, d.out_num_edit
						, (d.in_num + d.in_num_edit - d.out_num - d.out_num_edit ) start_num
					from
						mst_product a
						left join mst_product_cat b
						on a.product_cat_id = b.product_cat_id
						left join mst_supplier c
						on a.supplier_id = c.supplier_id join (
							select
							a.product_id
							, sum(
								case
								when a.warehouse_change_type in (1,5,6)
								then amount
								else 0
								end
							) in_num
							, sum(
								case
								when a.warehouse_change_type = 2
								then amount
								else 0
								end
							) out_num
							, sum(
								case
								when a.warehouse_change_type = 3
								then amount
								else 0
								end
							) in_num_edit
							, sum(
								case
								when a.warehouse_change_type = 4
								then amount
								else 0
								end
							) out_num_edit
							from
							trn_warehouse_change a
							left join trn_store_delivery b on a.store_delivery_id = b.store_delivery_id
							where
								a.changed_date between ? and ?
								and (b.delivery_sts is null or b.delivery_sts in ('0', '1', '2', '4'))
							group by
							a.product_id
						) d
						on a.product_id = d.product_id
					where
						a.active_flg = '1'
								order by a.product_code ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * Download excel
     *
     * @return void
     */
    public function download($month)
    {
        $data = $this->selectList($month);

        // Create path if not exist
        $path = config('constants.DOWNLOAD_DIR');
        $path = storage_path($path);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $fileName = "TonKhoThang_" . date('ymdhis');
        $ext      = "xlsx";

        Excel::create($fileName, function ($excel) use ($data) {
            $excel->sheet('Tonkho', function ($sheet) use ($data) {
                $sheet->loadView('admin.excels.crm0910-list')
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
