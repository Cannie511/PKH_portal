<?php

namespace App\Services;

use DB;
use File;
use Cache;
use Excel;

/**
 * Crm1830Service class
 */
class Crm1830Service extends BaseService
{
    public function selectConcats()
    {
        $sqlParam = array();
        $sql      = "
          select
            a.cost_cat_id
            , a.name
        from
            mst_cost_cat a
        where
            a.active_flg = 1
        ";

        $sql .= "
            order by a.cost_cat_id desc
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    public function selectDepartments()
    {
        $sqlParam = array();
        $sql      = "
          select
            a.department_id
            , a.name
        from
            mst_department a
        where
            a.active_flg = 1
        ";
        $sql .= "
            order by a.department_id desc
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectCost($param)
    {
        $sqlParam = array();
        $sql      = "
         select
            a.cost_id
            , a.cost_cat_id
            , a.department_id
            , a.cost_date
            , a.amount
            , a.contra_account
            , a.voucher
            , b.name as cate_name
            , c.name as department_name
            , a.cost_sts
            , a.description
            , a.active_flg
            , a.created_at
            , a.updated_at
            , d.name as updated_by
            , a.version_no
            , e.name as created_by
        from
            trn_cost a
            left join mst_cost_cat b
                on a.cost_cat_id = b.cost_cat_id
            left join mst_department c
                on a.department_id = c.department_id
            left join users d
                on a.updated_by = d.id
            left join users e 
                on a.created_by = e.id 
        where
            a.active_flg = 1
        ";
        $sql .= $this->andWhereDateBetween($param, "from_date", "to_date", " a.cost_date ", $sqlParam);
        $sql .= $this->andWhereInt($param, "department_id", " a.department_id ", $sqlParam);
        $sql .= $this->andWhereInt($param, "cost_cat_id", " a.cost_cat_id ", $sqlParam);
        $sql .= $this->andWhereString($param, "cost_sts", " a.cost_sts ", $sqlParam);
        $sql .= $this->andWhereInt($param, "user_id", " a.created_by", $sqlParam);
        $sql .= "
            order by a.cost_date desc
        ";

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
        $data = $this->selectCost($param);

        // Create path if not exist
        $path = config('constants.DOWNLOAD_DIR');
        $path = storage_path($path);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $fileName = "ChiPhi_" . date('ymdhis');
        $ext      = "xlsx";

        Excel::create($fileName, function ($excel) use ($data) {
            $excel->sheet('ChiPhi', function ($sheet) use ($data) {
                $sheet->loadView('admin.excels.crm1830-list')
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
