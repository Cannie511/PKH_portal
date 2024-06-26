<?php

namespace App\Services;

use DB;
use Log;
use File;
use Cache;
use Excel;
use Carbon\Carbon;
use App\Services\DownloadService;

/**
 * Hrm0140Service class
 */
class Hrm0140Service extends BaseService
{
    /**
     * @param DownloadService $downloadService
     */
    public function __construct(
        DownloadService $downloadService
    ) {
        $this->downloadService = $downloadService;
    }

    public function getListOfUser()
    {
        $sqlParam = array();
        $sql      = "
                select
                a.name as user_name
                , a.id as user_id
                from
                users a
                where
                a.id in (
                    select
                    user_id
                    from
                    role_user
                    where
                    role_id in (1, 2, 3, 4, 5, 6, 7, 10)
                )
                group by
                a.id
                order by
                a.id
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
                  a.created_at
                  , b.name
                  , a.event_name
                  , a.ip
                  , a.agent
                  , a.notes
                  , a.ip_as
                  , a.ip_city
                  , a.ip_country
                  , a.ip_country_code
                  , a.ip_isp
                  , a.ip_lat
                  , a.ip_lon
                  , a.ip_org
                  , a.ip_region
                  , a.ip_region_name
                  , a.ip_timezone
                  , a.ip_zip
                from
                  trn_audit_log a
                  join users b
                    on a.user_id = b.id
                where
                  b.id in (
                    select
                      user_id
                    from
                      role_user
                    where
                      role_id in (1, 2, 3, 4, 5, 6, 7, 10)
                  )
                ";
        $sql .= $this->andWhereDateBetween($param, 'start_date', 'end_date', 'a.created_at', $sqlParam);

        if (isset($param['download']) && 1 == $param['download']) {
            $sql .= "
              and  a.event_name = 'LOGIN'
              order by a.created_at asc
            ";

            return DB::select(DB::raw($sql), $sqlParam);
        }

        $sql .= $this->andWhereInt($param, 'user_id', 'a.user_id', $sqlParam);

        $sql .= "
        	order by a.created_at desc
          ";

        return $this->pagination($sql, $sqlParam, $param);
    }

    public function selectUserForDownload()
    {
        $sqlParam = array();
        $sql      = "
                select
                  a.id
                  , a.name
                from
                  users a
                  left join role_user b
                    on a.id = b.user_id
                where
                  b.role_id in (4, 6, 7)
            ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $oldMinute
     * @param $newMinute
     * @param $ip
     * @param $standardTime
     * @param $logTime
     */
    public function checkInfoLogin(
        $oldMinute,
        $newMinute,
        $ip,
        $standardTime,
        $logTime
    ) {
        $ip1     = "180";
        $ip2     = "93";
        $ipSplit = explode('.', $ip);

// check condition about IP address , 180.93
        if ($ipSplit[0] != $ip1 || $ipSplit[1] != $ip2) {
            return false;
        }

// Login before standard time
        if ($standardTime > $logTime) {
            return true;
        }

        if ($oldMinute <= $newMinute) {
            return false;
        }

        return true;
    }

    /**
     * @param $item
     * @param $ip
     * @param $time
     * @return mixed
     */
    public function getMinTimeLogin(
        $item,
        $ip,
        $time
    ) {
        $strTime = '8:5'; // Take 8:5 as standard time to calculate
        $y       = date("H:i:s", strtotime($strTime));
        $x       = date("H:i:s", strtotime($time));
        //print_r($login);
        $z = round(abs(strtotime($x) - strtotime($y)) / 60, 0);

        if ($this->checkInfoLogin($item["min"], $z, $ip, $y, $x)) {

            if ($x < $y) {
                $z = -$z;
            }

            $result = [
                "min"  => $z,
                "time" => $x,
                "ip"   => $ip,
            ];
        } else {
            $result = $item;
        }

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectDataForDownload($param)
    {

        if (!isset($param['start_date']) || !isset($param['end_date'])) {
            return null;
        }

        $param["download"] = 1;
        $loginData         = $this->selectList($param);      // take information login of users from startDate to endDate
        $userData          = $this->selectUserForDownload(); // only take accountant, sale admin, warehouse man

        $startDate = date('Y-m-d', (strtotime($param['start_date'])));
        $endDate   = date('Y-m-d', (strtotime($param['end_date'])));
        //Log::debug($loginData);
        $i             = 0;
        $list          = [];
        $j             = 0;
        $loginDataSize = sizeof($loginData);

        while ($startDate <= $endDate) {

            if ($i == $loginDataSize) {
                break;
            }

            $crDate = date('Y-m-d', (strtotime($loginData[$i]->created_at)));

            while ($crDate < $startDate) {
                $i++;
                $crDate = date('Y-m-d', (strtotime($loginData[$i]->created_at)));
            }

            $j = $i;

            while ($crDate == $startDate) {
                $j++;

                if ($j == $loginDataSize) {
                    break;
                }

                $crDate = date('Y-m-d', (strtotime($loginData[$j]->created_at)));

            }

            if ($j > $i) {

                foreach ($userData as $user) {

                    $item = [
                        "min" => 3000,
                    ];

                    for ($z = $i; $z < $j; $z++) {

                        if ($loginData[$z]->name == $user->name) {
                            //   Log::debug($loginData[$z]->ip);

                            $item = $this->getMinTimeLogin($item, $loginData[$z]->ip, $loginData[$z]->created_at);
                        }

                    }

                    if ($item['min'] < 3000) {
                        $infor         = null;
                        $infor["name"] = $user->name;
                        $infor['date'] = $startDate;
                        $infor['min']  = $item['min'];
                        $infor['time'] = $item['time'];
                        $infor['D']    = date("D", strtotime($startDate));
                        $infor['ip']   = $item['ip'];
                        array_push($list, $infor);
                    }

                }

            }

            $i = $j;
                                                                                      //Log::debug($startDate);
            $startDate = date('Y-m-d', (strtotime('+1 day', strtotime($startDate)))); // increase date
        }

        return $list;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function download($param)
    {
        Log::debug('download');

        if (!isset($param['start_date']) || !isset($param['end_date'])) {
            $param['start_date'] = Carbon::today()->addDays(-30)->format('Y-m-d');
            $param['end_date']   = Carbon::today()->format('Y-m-d');
        }

        $data = $this->selectDataForDownload($param);
        Log::debug(print_r($data, true));

        if (null == $data) {
            return;
        }

        // Create path if not exist
        $path = config('constants.DOWNLOAD_DIR');
        $path = storage_path($path);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $fileName = "ChamCong_" . date('ymdhis');
        $ext      = "xlsx";

        Excel::create($fileName, function ($excel) use ($data) {
            $excel->sheet('ChamCong', function ($sheet) use ($data) {
                $sheet->loadView('admin.excels.hrm0140-list')
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
