<?php

namespace App\Services;

use DB;
use Log;
use File;
use Cache;
use Excel;

class Crm2520Service extends BaseService
{
    /**
     * Search store for sales
     * @param  [type] $param [description]
     * @return [type]        list product
     */
    public function selectList($param)
    {
        Log::debug('--------------------selectList------------------------');
        $sqlParam = array();
        $sql      = "
				select
					a.name
                    ,a.contact_name
                    ,a.supplier_code
                    ,a.contact_email
                    ,a.contact_tel
                    ,a.supplier_id
                    ,a.address
				from mst_supplier a
				where  a.active_flg='1'
			";
        $sql .= $this->andWhereString($param, 'supplier_name', 'a.name', $sqlParam);
        $sql .= $this->andWhereString($param, 'contact_tel', 'a.contact_tel', $sqlParam);

        // if (isset($param['delivery_vendor_phone']) && strlen($param['delivery_vendor_phone']) > 0) {
        //     $paramContact = '%' . strtolower($param['delivery_vendor_phone']) . '%';
        //     $sql .= $this->andWhere(
        //         $param,
        //         'delivery_vendor_phone',
        //         " ( a.contact_tel like ?  or a.contact_mobile1 like ? or a.contact_mobile2 like ?  ) ",
        //         $sqlParam,
        //         [$paramContact, $paramContact, $paramContact]
        //     );
        // }

        // if (isset($param['down']) && 1 == $param['down']) {
        //     return DB::select(DB::raw($sql), $sqlParam);
        // }

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

        $fileName = "NguoiGiaoHang_" . date('ymdhis');
        $ext      = "xlsx";

        Excel::create($fileName, function ($excel) use ($data) {
            $excel->sheet('NguoiGiaoHang', function ($sheet) use ($data) {
                $sheet->loadView('admin.excels.crm1100-list')
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
