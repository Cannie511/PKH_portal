<?php

namespace App\Services;

use DB;
use Log;

/**
 * Rpt0510Service class
 */
class Rpt0510Service extends BaseService
{
    /**
     * @return mixed
     */
    public function takeMonth()
    {
        $sqlParam = array();

        $sql = "
          select distinct
            month (a.order_date) as month
            , year (a.order_date) as year
          from
            trn_store_order a
          order by
            year (a.order_date) desc
            , month (a.order_date) desc
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @return mixed
     */
    public function makeList2()
    {
        $results = $this->takeMonth();
        $listBig = [];

        foreach ($results as $result) {
            $date         = $result->month . "/1/" . $result->year;
            $time         = date('Y-m-d', strtotime($date));
            $list["Time"] = $result->year . "-" . str_pad($result->month, 2, '0', STR_PAD_LEFT);

            $temp           = $this->selectData($time, "delivery", 3, 1);
            $list["Level1"] = $temp[0]->money;

            $temp           = $this->selectData($time, "delivery", 3, 2);
            $list["Level2"] = $temp[0]->money;

            $temp           = $this->selectData($time, "delivery", 3, 3);
            $list["Level3"] = $temp[0]->money;

            $temp           = $this->selectData($time, "delivery", 3, 4);
            $list["Level4"] = $temp[0]->money;

            $temp           = $this->selectData($time, "delivery", 3, 5);
            $list["Level5"] = $temp[0]->money;

            array_push($listBig, $list);
        }

        return $listBig;
    }

// search order unit, money, delivery unit money today
    /**
     * @param $time
     * @param $type
     * @param $level
     * @return mixed
     */
    public function searchData(
        $time,
        $type,
        $level
    ) {

        Log::debug($type);
        $list1 = $this->selectData($time, "order", $type, $level);
        $list2 = $this->selectData($time, "delivery", $type, $level);

        $list['orderTime'] = $list1[0]->time;

        if (0 == $type) {
            $list['orderTime'] = date('Y-m-d', strtotime($time));
        }

        $list['orderCount']    = $list1[0]->count;
        $list['orderMoney']    = $list1[0]->money;
        $list['deliveryCount'] = $list2[0]->count;
        $list['deliveryMoney'] = $list2[0]->money;

        return $list;
    }

    /**
     * @param $param
     * @param $level
     * @return mixed
     */
    public function makeList(
        $param,
        $level
    ) {
        $data = [];

        if ($level > 0) {
            $header = "DOANH SỐ CẤP " . (string) $level;
        } else {
            $header = "DOANH SỐ TỔNG ";
        }

        $now       = $param['date'];
        $yesterday = date('Y-m-d', (strtotime('-1 day', strtotime($now))));

//Log::debug('now');

//Log::debug( $now);

// Log::debug('yesterday');
        //Log::debug( $yesterday);

        $listNow       = $this->searchData($now, 0, $level); // get order, delivery count, money current
        $listYesterday = $this->searchData($yesterday, 0, $level);

// get order, delivery count, money yesterday current

// Log::debug('--------------------');
        // Log::debug(print_r($listYesterday, true));

        $listMonth = $this->searchData($now, 1, $level); // get order, delivery count, money current month
        $listYear  = $this->searchData($now, 2, $level); // get order, delivery count, money current year

        array_push($data, $listYesterday);
        array_push($data, $listNow);
        array_push($data, $listMonth);
        array_push($data, $listYear);
        $result = [
            'header' => $header,
            'data'   => $data,
        ];

        return $result;
    }

    /**
     * @param $data
     * @param $name
     * @param $type
     * @param $level
     * @return mixed
     */
    public function selectData(
        $data,
        $name,
        $type,
        $level
    ) {
        $sqlParam = array();

        $month = (int) date("m", strtotime($data)); // get month from current date
        $year  = (int) date("Y", strtotime($data)); // get year from current date

        $sql1 = "";

// depend on type : 0 find date , 1 find month , 2 find year
        if ((int) $type == 0) {
            $sql1 = "a." . $name . "_date as time, ";
        }

        if ((int) $type == 1) {
            // $sql1 = "month(a.".$name."_date) as time, ";
            $sql1 = "'" . $year . "-" . str_pad($month, 2, '0', STR_PAD_LEFT) . "' as time, ";
        }

        if ((int) $type == 2) {
            // $sql1 = "year(a.".$name."_date) as time, ";
            $sql1 = "'" . $year . "' as time, ";
        }

        $sqlJoin = "";

// If find on rank insert this code into sql
        if (((int) $level > 0) and ("order" == $name)) {
            $sqlJoin = " left join trn_store_rank b
                        on (
                        a.store_id = b.store_id
                        and month (a." . $name . "_date) = b.month
                        and year (a." . $name . "_date) = b.year
                        ) ";
        }

        if (((int) $level > 0) and ("delivery" == $name)) {
            $sqlJoin = " left join trn_store_order c on c.store_order_id= a.store_order_id
                            left join trn_store_rank b
                        on (
                        c.store_id = b.store_id
                        and month (a." . $name . "_date) = b.month
                        and year (a." . $name . "_date) = b.year
                        ) ";
        }

        // sts<>5 (find store is not destroyed) , export column count and money.
        $sql = "
            Select " . $sql1 . "count(a.total_with_discount) as count,
                            sum(a.total_with_discount) as money
            from  trn_store_" . $name . " a " . $sqlJoin . " where a." . $name . "_sts<> 5 	and a.order_type = 1
        ";

// depend on type : 0 find date , 1 find month , 2 find year
        if ((int) $type == 0) {
            $sql .= $this->andWhereIntValue($data, " a." . $name . "_date ", $sqlParam);
        }

        if (((int) $type == 1) || ((int) $type == 3)) {
            $sql .= $this->andWhereIntValue($month, " month(a." . $name . "_date) ", $sqlParam);
        }

        if (((int) $type == 1) || ((int) $type == 2) || ((int) $type == 3)) {
            $sql .= $this->andWhereIntValue($year, " year(a." . $name . "_date) ", $sqlParam);
        }

        if (((int) $level > 0) and ((int) $level <= 5)) {
            $sql .= $this->andWhereIntValue($level, " b.store_rank ", $sqlParam);
        }

        //  Log::info($sql);
        $result = DB::select(DB::raw($sql), $sqlParam);
        //  Log::info(print_r($result, true));

        return $result;
    }

}
