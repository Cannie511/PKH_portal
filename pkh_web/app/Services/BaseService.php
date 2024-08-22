<?php namespace App\Services;

use DB;
use Log;
use Auth;
use JWTAuth;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseService
{
    /**
     * @param $param
     * @param $key
     * @return mixed
     */
    public function getParam(
        $param,
        $key
    ) {

        if (isset($param[$key])) {
            return $param[$key];
        }

        return null;
    }

    /**
     * Pagination raw select sql
     *
     * @param [type] $sql
     * @param [type] $sqlParam
     * @param [type] $rawParam
     * @return void
     */
    public function pagination(
        $sql,
        $sqlParam,
        $rawParam
    ) {

        // Count item
        $sqlCount = "select count(1) count from (" . $sql . ") temp";
        $count    = DB::select(DB::raw($sqlCount), $sqlParam)[0]->count;

        // Select page
        $currentPage = 1;

        if (isset($rawParam['page'])) {
            $currentPageVal = intval($rawParam['page']);
            if ($currentPageVal > 0) {
                $currentPage = $currentPageVal;
            }

        }

        $perPage = config('constants.PAGING_SIZE', 50);

        if (isset($rawParam['page_size'])) {
            $tempPageSize = intval($rawParam['page_size']);

            if ($tempPageSize > 0) {
                $perPage = $tempPageSize;
            }

        }

        $offset = ($currentPage - 1) * $perPage;

        $sql .= " limit $perPage offset $offset ";
        $data = DB::select(DB::raw($sql), $sqlParam);

        $paginator = new LengthAwarePaginator($data, $count, $perPage, $currentPage);

        return $paginator;
    }

    /**
     * @param $entity
     * @param $user
     * @param $isCreate
     * @return null
     */
    public function updateRecordHeader(
        $entity,
        $user,
        $isCreate = false
    ) {

        if (!isset($entity)) {
            return;
        }

        if (!isset($user)) {
            $user = $this->logonUser();
        }

        $id = 0;

        if (is_int($user)) {
            $id = $user;
        } elseif (isset($user)) {
            $id = $user->id;
        }

        if (!isset($entity->version_no) || 0 == $entity->version_no) {
            $isCreate = true;
        }

        if (true == $isCreate) {
            $entity->created_by = $id;
            $entity->version_no = 1;
        } else {
            $entity->version_no = $entity->version_no + 1;
        }

        $entity->updated_at = Carbon::now();
        $entity->updated_by = $id;
    }

    /**
     * @param $param
     * @param $fieldName1
     * @param $fieldName2
     * @param $columnField
     * @param $sqlParam
     * @return mixed
     */
    public function andWhereDateBetween(
        $param,
        $fieldName1,
        $fieldName2,
        $columnField,
        &$sqlParam
    ) {
        $sql = "";

        if (isset($param[$fieldName1]) && isset($param[$fieldName2]) && strlen($param[$fieldName1]) > 0 && strlen($param[$fieldName2]) > 0) {
            $date1 = Carbon::createFromFormat('Y-m-d', substr($param[$fieldName1], 0, 10));
            $date2 = Carbon::createFromFormat('Y-m-d', substr($param[$fieldName2], 0, 10));

            if (isset($date1) && isset($date2)) {
                $sql .= " and $columnField between ? and ?";
                $sqlParam[] = $date1->format('Y-m-d');
                $sqlParam[] = $date2->format('Y-m-d');
            }

        } elseif (isset($param[$fieldName1]) && strlen($param[$fieldName1]) > 0) {
            $date = Carbon::createFromFormat('Y-m-d', substr($param[$fieldName1], 0, 10));

            if (isset($date)) {
                $sql .= " and $columnField >= ?";
                $sqlParam[] = $date->format('Y-m-d');
            }

        } elseif (isset($param[$fieldName2]) && strlen($param[$fieldName2]) > 0) {
            $date = Carbon::createFromFormat('Y-m-d', substr($param[$fieldName2], 0, 10));

            if (isset($date)) {
                $sql .= " and $columnField <= ?";
                $sqlParam[] = $date->format('Y-m-d');
            }

        }

        return $sql;
    }

    /**
     * @param $param
     * @param $fieldName1
     * @param $fieldName2
     * @param $columnField
     * @param $sqlParam
     * @return mixed
     */
    public function andWhereDateTimeBetween(
        $param,
        $fieldName1,
        $fieldName2,
        $columnField,
        &$sqlParam
    ) {
        $sql = "";

        if (isset($param[$fieldName1]) && isset($param[$fieldName2]) && strlen($param[$fieldName1]) > 0 && strlen($param[$fieldName2]) > 0) {
            $date1 = $this->toDateStart($param[$fieldName1]);
            $date2 = $this->toDateEnd($param[$fieldName2]);

            if (isset($date1) && isset($date2)) {
                $sql .= " and $columnField between ? and ?";
                $sqlParam[] = $date1->format('Y-m-d H:i:s');
                $sqlParam[] = $date2->format('Y-m-d H:i:s');
            }

        } elseif (isset($param[$fieldName1]) && strlen($param[$fieldName1]) > 0) {
            $date = $this->toDateStart($param[$fieldName1]);

            if (isset($date)) {
                $sql .= " and $columnField >= ?";
                $sqlParam[] = $date->format('Y-m-d H:i:s');
            }

        } elseif (isset($param[$fieldName2]) && strlen($param[$fieldName2]) > 0) {
            $date = $this->toDateEnd($param[$fieldName2]);

            if (isset($date)) {
                $sql .= " and $columnField <= ?";
                $sqlParam[] = $date->format('Y-m-d H:i:s');
            }

        }

        return $sql;
    }

    /**
     * @param $param
     * @param $fieldName
     * @param $columnField
     * @param $sqlParam
     * @return mixed
     */
    public function andWhereInt(
        $param,
        $fieldName,
        $columnField,
        &$sqlParam
    ) {
        $sql = "";

        if (isset($param[$fieldName]) && strlen($param[$fieldName]) > 0) {
            $sql .= " and $columnField = ? ";
            $sqlParam[] = $param[$fieldName];
        }

        return $sql;
    }

    /**
     * @param $param
     * @param $fieldName
     * @param $columnField
     * @param $sqlParam
     * @param $op
     * @return mixed
     */
    public function andWhereIntOperator(
        $param,
        $fieldName,
        $columnField,
        &$sqlParam,
        $op
    ) {
        $sql = "";

        if (isset($param[$fieldName]) && strlen($param[$fieldName]) > 0) {
            $sql .= " and $columnField " . $op . " ? ";
            $sqlParam[] = $param[$fieldName];
        }

        return $sql;
    }

    /**
     * @param $value
     * @param $columnField
     * @param $sqlParam
     * @return mixed
     */
    public function andWhereIntValue(
        $value,
        $columnField,
        &$sqlParam
    ) {
        $sql = "";

        if (isset($value) && strlen($value) > 0) {
            $sql .= " and $columnField = ? ";
            $sqlParam[] = $value;
        }

        return $sql;
    }

    /**
     * @param $param
     * @param $fieldName
     * @param $columnField
     * @param $sqlParam
     * @param $isExact
     * @return mixed
     */
    public function andWhereString(
        $param,
        $fieldName,
        $columnField,
        &$sqlParam,
        $isExact = false
    ) {
        $sql = "";

        if (isset($param[$fieldName]) && strlen($param[$fieldName]) > 0) {

            if ($isExact) {
                $sql .= " and $columnField = ? ";
                $sqlParam[] = $param[$fieldName];
            } else {
                $sql .= " and lower($columnField) like ? ";
                $sqlParam[] = '%' . strtolower($param[$fieldName]) . '%';
            }
        }
        return $sql;
    }

    /**
     * @param $param
     * @param $fieldName
     * @param $condition
     * @param $sqlParam
     * @param $sentenceParam
     * @return mixed
     */
    public function andWhere(
        $param,
        $fieldName,
        $condition,
        &$sqlParam,
        $sentenceParam
    ) {
        $sql = "";

        if (isset($param[$fieldName]) && strlen($param[$fieldName]) > 0) {
            $sql .= " and $condition ";

            foreach ($sentenceParam as $value) {
                $sqlParam[] = $value;
            }

        }

        return $sql;
    }

    /**
     * @param $param
     * @param $fieldName
     * @param $columnField
     * @param $sqlParam
     * @return mixed
     */
    public function andWhereDateEqual(
        $param,
        $fieldName,
        $columnField,
        &$sqlParam
    ) {
        $sql = "";

        if (isset($param[$fieldName]) && strlen($param[$fieldName]) > 0) {
            $date = Carbon::createFromFormat('Y-m-d', substr($param[$fieldName], 0, 10));

            if (isset($date)) {
                $sql .= " and $columnField = ? ";
                $sqlParam[] = $date->format('Y-m-d');
            }

        }

        return $sql;
    }

    /**
     * @param $param
     * @param $fieldName
     * @param $columnField
     * @param $sqlParam
     * @return mixed
     */
    public function andWhereDate(
        $param,
        $fieldName,
        $columnField,
        $operator,
        &$sqlParam
    ) {
        $sql = "";

        if (isset($param[$fieldName]) && strlen($param[$fieldName]) > 0) {
            $date = Carbon::createFromFormat('Y-m-d', substr($param[$fieldName], 0, 10));

            if (isset($date)) {
                $sql .= " and $columnField $operator ? ";
                $sqlParam[] = $date->format('Y-m-d');
            }

        }

        return $sql;
    }

    /**
     * @param $param
     * @param $fieldName
     * @param $columnField
     * @param $sqlParam
     * @return mixed
     */
    public function andWhereDateInMonthOfDate(
        $param,
        $fieldName,
        $columnField,
        &$sqlParam
    ) {
        $sql = "";

        if (isset($param[$fieldName]) && strlen($param[$fieldName]) > 0) {
            $date = Carbon::createFromFormat('Y-m-d', substr($param[$fieldName], 0, 10));

            if (isset($date)) {
                $sql .= " and $columnField between ? and ? ";
                $sqlParam[] = $date->startOfMonth()->format('Y-m-d');
                $sqlParam[] = $date->endOfMonth()->format('Y-m-d');
            }

        }

        return $sql;
    }

    /**
     * Search in month with string format: YYYY-MM
     *
     * @param [type] $param
     * @param [type] $fieldName
     * @param [type] $columnField
     * @param [type] $sqlParam
     * @return void
     */
    public function andWhereDateInMonthOfString(
        $param,
        $fieldName,
        $columnField,
        &$sqlParam
    ) {
        $sql = "";

        if (isset($param[$fieldName]) && strlen($param[$fieldName]) > 0) {
            $date = Carbon::createFromFormat('Y-m-d', substr($param[$fieldName], 0, 7) . '-01');

            if (isset($date)) {
                $sql .= " and $columnField between ? and ? ";
                $sqlParam[] = $date->startOfMonth()->format('Y-m-d');
                $sqlParam[] = $date->endOfMonth()->format('Y-m-d');
            }

        }

        return $sql;
    }

    /**
     * Get current user
     * @return [type] [description]
     */
    public function logonUser()
    {
        $user = null;

        if (Auth::check()) {
            $user = Auth::user();
        }

        try {
            $user = JWTAuth::toUser();
        } catch (Exception $e) {
            Log::warn($e->message);
        }

        return $user;
    }

    public function ok()
    {
        return [
            'rtnCd' => 0,
        ];
    }

    /**
     * @param $msg
     */
    public function fail($msg = null)
    {
        return [
            'rtnCd' => -1,
            'msg'   => $msg,
        ];
    }

    /**
     * @param $param
     * @param array $map
     * @return mixed
     */
    public function getOrderBy(
        $param,
        $map = array()
    ) {
        $sql = "";

        if (isset($param["orderBy"]) && !empty($param["orderBy"])) {

            $orderBy = $param["orderBy"];

            if (array_key_exists($orderBy, $map)) {
                $userMap = $map[$orderBy];

                if (array_key_exists($param["orderDirection"], $userMap)) {
                    $sql .= " order by " . $userMap[$param["orderDirection"]] . " ";
                }

            } else {
                $sql .= " order by " . $orderBy . " ";

                if (isset($param["orderDirection"]) && !empty($param["orderDirection"])) {
                    $sql .= $param["orderDirection"];
                }

            }

        }

        return $sql;
    }

    /**
     * @param $value
     */
    private function toDateStart($value)
    {

        if (!isset($value)) {
            return null;
        }

        if (strlen($value) > 18) {
            // yyyy-MM-dd HH:mm:ss
            return Carbon::createFromFormat('Y-m-d H:i:s', substr($value, 0, 19));
        } elseif (strlen($value) > 15) {
            // yyyy-MM-dd HH:mm
            return Carbon::createFromFormat('Y-m-d H:i:s', substr($value, 0, 16) . ":00");
        } else {
            return Carbon::createFromFormat('Y-m-d H:i:s', substr($value, 0, 10) . "00:00:00");
        }

    }

    /**
     * @param $value
     */
    private function toDateEnd($value)
    {

        if (!isset($value)) {
            return null;
        }

        if (strlen($value) > 18) {
            // yyyy-MM-dd HH:mm:ss
            return Carbon::createFromFormat('Y-m-d H:i:s', substr($value, 0, 19));
        } elseif (strlen($value) > 15) {
            // yyyy-MM-dd HH:mm
            return Carbon::createFromFormat('Y-m-d H:i:s', substr($value, 0, 16) . ":59");
        } else {
            return Carbon::createFromFormat('Y-m-d H:i:s', substr($value, 0, 10) . "23:59:59");
        }

    }

    /**
     * @param $listBig
     * @return mixed
     */
    public function sort(
        $listBig,
        $col
    ) {

        $n = count($listBig);

        for ($x = 0; $x < $n - 1; $x++) {

            for ($y = $x + 1; $y < $n; $y++) {

                if ($listBig[$x][$col] < $listBig[$y][$col]) {
                    $item        = $listBig[$x];
                    $listBig[$x] = $listBig[$y];
                    $listBig[$y] = $item;
                }

            }

        }

        return $listBig;
    }

    /**
     * @param $param
     * @param $data
     * @param $first_header
     * @param $last_header
     * @param $data_type
     * @return mixed
     */
    public function dataProcess(

        $param,
        $data,
        $first_header,
        $last_header,
        $data_type

    ) {

        $header = $first_header;

        $listBig    = [];
        $list       = null;
        $first_row  = [];
        $second_row = [];
        $third_row  = [];

//  $max_row = [];
        //  $min_row = [];
        $count     = 12;
        $base_year = 2016; // year start business
        $time_mode = $param["time_mode"];

        if (1 == $time_mode) {

            foreach (range($base_year, date("Y")) as $year) {
                $time              = $year;
                $first_row[$time]  = 0;
                $second_row[$time] = 0;
                $third_row[$time]  = 0;

// $max_row[$time] = 0;
                // $min_row[$time] = 0;
                array_push($header, $time);
            }

        } else {

            foreach (range(1, 12) as $month) {
                $time              = $param['year'] . "-" . str_pad($month, 2, '0', STR_PAD_LEFT);
                $first_row[$time]  = 0;
                $second_row[$time] = 0;
                $third_row[$time]  = 0;

// $max_row[$time] = 0;
                // $min_row[$time] = 0;
                array_push($header, $time);
            }

        }

        $first_row["AVG"] = 0;
        $type             = $data_type;

        foreach ($data as $obj) {

            $item = (array) $obj;

            if (1 == $time_mode) {
                $time = $obj->year;
            } else {
                $time = $obj->year . "-" . str_pad($obj->month, 2, '0', STR_PAD_LEFT);
            }

            if (!$time) {
                continue;
            }

            $list[$item['id']]["id"] = $item['id'];

            foreach ($first_header as $temp) {
                $list[$item['id']][$temp] = $item[$temp];
            }

            $amount = $item[$type];

            $first_row[$time] += $amount;
            $second_row[$time] += 1;
            $list[$obj->id][$time] = $amount;

//  $max_row[$time] = max($max_row[$time],$amount);

//  if ($min_row[$time] ==0){

//     $min_row[$time] = $amount;

//  } else {

//     $min_row[$time] = min($min_row[$time],$amount);

//  }

            if (!isset($list[$obj->id]["Total"])) {
                $list[$obj->id]["Total"] = ($amount);
            } else {
                $list[$obj->id]["Total"] = $list[$obj->id]["Total"] + ($amount);
            }

            if (!isset($list[$obj->id]["AVG"])) {
                $list[$obj->id]["AVG"] = ($amount);
            } else {
                $list[$obj->id]["AVG"] = $list[$obj->id]["AVG"] + ($amount);
            }

            if (!isset($list[$obj->id]["count"])) {
                $list[$obj->id]["count"] = 1;
            } else {
                $list[$obj->id]["count"] = $list[$obj->id]["count"] + 1;
            }

        }

        foreach ($last_header as $item) {
            array_push($header, $item);
        }

        $sum = 0;
        foreach ($first_row as $key => $value) {
            $sum += $value;
        }

        $first_row[$first_header[0]]  = "Sum colunm";
        $first_row["Total"]           = $sum;
        $second_row[$first_header[0]] = "Count column";
        $third_row[$first_header[0]]  = "AVG column";

// $max_row[$first_header[0]] = "Max coloumn";

// $min_row[$first_header[0]] = "Min coloumn";

        if (1 == $time_mode) {
            foreach (range($base_year, date("Y")) as $year) {
                $time = $year;
                if (0 != $second_row[$time]) {
                    $third_row[$time] = $first_row[$time] / $second_row[$time];
                }

            }

        } else {
            foreach (range(1, 12) as $month) {
                $time = $param['year'] . "-" . str_pad($month, 2, '0', STR_PAD_LEFT);
                if (0 != $second_row[$time]) {
                    $third_row[$time] = $first_row[$time] / $second_row[$time];
                }

            }

        }

        if (null == $list) {
            $listBig = null;
        } else {

            foreach ($list as $item) {
                $item["AVG"] = $item["AVG"] / $item["count"];
                array_push($listBig, $item);
            }

            $listBig = $this->sort($listBig, "Total");

//  array_unshift($listBig, $min_row);
            //  array_unshift($listBig, $max_row);
            array_unshift($listBig, $third_row);
            array_unshift($listBig, $second_row);
            array_unshift($listBig, $first_row);
        }

        $result = [
            'header' => $header,
            'data'   => $listBig,
        ];

        return $result;

    }

// Test hàm phần trang 12row
public function pagination12R(
    $sql,
    $sqlParam,
    $rawParam
) {
    // Count item
    $sqlCount = "select count(1) count from (" . $sql . ") temp";
    $count    = DB::select(DB::raw($sqlCount), $sqlParam)[0]->count;

    // Select page
    $currentPage = 1;

    if (isset($rawParam['page'])) {
        $currentPageVal = intval($rawParam['page']);
        if ($currentPageVal > 0) {
            $currentPage = $currentPageVal;
        }
    }

    $perPage = 25; // Số hàng trên mỗi trang, thay đổi tại đây

    $offset = ($currentPage - 1) * $perPage;

    $sql .= " limit $perPage offset $offset ";
    $data = DB::select(DB::raw($sql), $sqlParam);

    $paginator = new LengthAwarePaginator($data, $count, $perPage, $currentPage);

    return $paginator;
}


}
