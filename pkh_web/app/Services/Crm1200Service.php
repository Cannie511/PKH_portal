<?php

namespace App\Services;

use DB;
use File;
use Cache;
use Excel;

/**
 * Crm1200Service class
 */
class Crm1200Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectListBankAccount($param)
    {
        $sqlParam = array();
        $sql      = "
            Select
                a.bank_account_id
                , a.bank_name
                , b.store_id
                , b.name
                , b.address
                , c.name as salesman_name
                , a.bank_branch
                , a.bank_account_no
                , a.bank_account_name
                , a.notes
                , a.active_flg
                , a.created_at
                , a.created_by
                , a.updated_at
                , a.updated_by
                , a.version_no
            from
                mst_bank_account a
                left join mst_store b
                    on a.store_id = b.store_id
                left join users c
                    on b.salesman_id = c.id
            where
                a.active_flg = 1
        ";

        $sql .= $this->andWhereString($param, 'bank_name', 'a.bank_name', $sqlParam);
        $sql .= $this->andWhereString($param, 'store_name', 'b.name', $sqlParam);
        $sql .= $this->andWhereString($param, 'bank_account_no', 'a.bank_account_no', $sqlParam);

        $sql .= "order by a.bank_name";

        if (1 == $param['down']) {
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
        $data = $this->selectListBankAccount($param);

        // Create path if not exist
        $path = config('constants.DOWNLOAD_DIR');
        $path = storage_path($path);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $fileName = "BankAccount_" . date('ymdhis');
        $ext      = "xlsx";

        Excel::create($fileName, function ($excel) use ($data) {
            $excel->sheet('BankAccount', function ($sheet) use ($data) {
                $sheet->loadView('admin.excels.crm1200-list')
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
