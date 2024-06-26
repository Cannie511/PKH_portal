<?php

namespace App\Services;

use DB;
use File;
use Cache;
use Excel;

class Hrm0120Service extends BaseService
{
    /**
     * @param $param
     * @param $paging
     * @return mixed
     */
    public function search(
        $param,
        $paging = false
    ) {
        $sqlParam = array();
        $sql      = "
        select
          a.id
          , a.user_id
          , a.absent_date
          , a.amount
          , a.absent_type
          , a.reason
          , a.status
          , a.created_at
          , a.version_no
          , a.approve_user_id
          , b.fullname approve_name
          , b.employee_code approve_user_code
          , a.cmt
          , c.fullname user_name
          , c.employee_code
          , a.approve_ts
          , d.reason leave_allocation_name
        from
          trn_absent a
          left join mst_employee_info b
            on b.employee_id = a.approve_user_id
          left join mst_employee_info c
            on c.employee_id = a.user_id
          left join trn_leave_allocation d
            on a.leave_allocation_id = d.id
        where
          a.active_flg = '1'
  		";

        $sql .= $this->andWhereInt($param, 'user_id', 'a.user_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'type', 'a.absent_type', $sqlParam);
        $sql .= $this->andWhereInt($param, 'status', 'a.status', $sqlParam);
        $sql .= $this->andWhereString($param, 'keyword', 'a.reason', $sqlParam);
        $sql .= $this->andWhereDateBetween($param, 'startDate', 'endDate', 'a.absent_date', $sqlParam);

        $sql .= "
			order by a.created_at desc, a.absent_date desc
  		";

        $result = [];

        if (isset($param['export']) && true == $param['export']) {
            $result = DB::select(DB::raw($sql), $sqlParam);
        } else {

            if ($paging) {
                $result = $this->pagination($sql, $sqlParam, $param);
            } else {
                return DB::select(DB::raw($sql), $sqlParam);
            }

        }

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function download($param)
    {
        $param['export'] = true;
        $data            = $this->search($param);

        // Create path if not exist
        $path = config('constants.DOWNLOAD_DIR');
        $path = storage_path($path);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $fileName = "DanhSachDonXinNghi_" . date('ymdhis');
        $ext      = "xlsx";

        Excel::create($fileName, function ($excel) use ($data) {
            $excel->sheet('DonNghi', function ($sheet) use ($data) {
                $sheet->loadView('admin.excels.hrm0120-list')
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
