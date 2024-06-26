<?php namespace App\Services;

/*
interface GenCodeService {
public function genBookingTransactionCode();
public function genBigFreeGrabTransactionCode();
public function genDiscountCode();
public function genCode($type);
}*/

use DB;
use Carbon\Carbon;

class GenCodeService
{
    const ORDER_CODE    = 1;
    const DELIVERY_CODE = 2;
    const IMPORT_CODE   = 3;
    const STORE_CODE    = 4;
    const SUPPLIER_CODE = 5;
    const BRANCH_CODE   = 6;
    const PO_CODE       = 7;
    const PI_CODE       = 8;

    /**
     * @return mixed
     */
    private function getCurrentTime()
    {
        $time = date('dmy');

        return $time;
    }

    /**
     * @return mixed
     */
    private function getNumberOrderInMonth()
    {

        $firstOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth   = Carbon::now();

        $sqlParam = [$firstOfMonth, $endOfMonth];

        $sql = '
            select
            count(*) as count
            from
            trn_store_order a
            where
            a.created_at between ? and ?
        ';
        $result    = DB::select(DB::raw($sql), $sqlParam);
        $numberOrd = strval($result[0]->count + 1);

        while (strlen($numberOrd) < 4) {
            $numberOrd = '0' . $numberOrd;
        }

        return $numberOrd;
    }

    /**
     * @param $param
     */
    private function getOrderNote($param)
    {

        switch ($param["order_type"]) {
            case 1:return "NORM";
            case 2:return "WARR";
            case 3:return "SAMP";
        }

        return "NORM";
    }

    /**
     * @param $param
     * @return mixed
     */
    private function genCodeForOrder($param)
    {
        $part1 = "FORD";
        $part2 = $this->getCurrentTime();
        $part3 = $this->getNumberOrderInMonth();
        $part4 = $this->getOrderNote($param);
        $code  = $part1 . "_" . $part2 . "_" . $part3 . "_" . $part4;

        return $code;
    }

    /**
     * @return mixed
     */
    private function getNumberDeliveryInMonth()
    {

        $firstOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth   = Carbon::now();

        $sqlParam = [$firstOfMonth, $endOfMonth];

        $sql = '
            select
            count(*) as count
            from
            trn_store_delivery a
            where
            a.created_at between ? and ?
        ';
        $result    = DB::select(DB::raw($sql), $sqlParam);
        $numberOrd = strval($result[0]->count + 1);

        while (strlen($numberOrd) < 4) {
            $numberOrd = '0' . $numberOrd;
        }

        return $numberOrd;
    }

    /**
     * @param $param
     * @return mixed
     */
    private function genCodeForDelivery($param)
    {
        $part1 = "FDEL";
        $part2 = $this->getCurrentTime();
        $part3 = $this->getNumberDeliveryInMonth();
        $part4 = $this->getOrderNote($param);
        $code  = $part1 . "_" . $part2 . "_" . $part3 . "_" . $part4;

        return $code;
    }

    /**
     * @param $type
     * @param $param
     * @return mixed
     */
    public function genCode(
        $type,
        $param
    ) {

        switch ($type) {
            case 1:
                return $this->genCodeForOrder($param);
            case 2:
                return $this->genCodeForDelivery($param);

        }

    }

    /**
     * @return mixed
     */
    private function getNumberExchangeWarehouseInMonth()
    {

        $firstOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth   = Carbon::now();

        $sqlParam = [$firstOfMonth, $endOfMonth];

        $sql = '
            select
            count(*) as count
            from
            trn_warehouse_exim a
            where
            a.created_at between ? and ?
        ';
        $result    = DB::select(DB::raw($sql), $sqlParam);
        $numberOrd = strval($result[0]->count + 1);

        while (strlen($numberOrd) < 4) {
            $numberOrd = '0' . $numberOrd;
        }

        return $numberOrd;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function genCodeForExchangeWarehouse($param)
    {
        $part1 = "EXIM";
        $part2 = $this->getCurrentTime();
        $part3 = $this->getNumberExchangeWarehouseInMonth();
        $code  = $part1 . "_" . $part2 . "_" . $part3;

        return $code;
    }

    /**
     * @return mixed
     */
    private function getNumberVendorDeliveryInMonth()
    {

        $firstOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth   = Carbon::now();

        $sqlParam = [$firstOfMonth, $endOfMonth];

        $sql = '
            select
            count(*) as count
            from
            trn_delivery a
            where
            a.created_at between ? and ?
        ';
        $result    = DB::select(DB::raw($sql), $sqlParam);
        $numberOrd = strval($result[0]->count + 1);

        while (strlen($numberOrd) < 4) {
            $numberOrd = '0' . $numberOrd;
        }

        return $numberOrd;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function genCodeForVendorDelivery($param)
    {
        $part1 = "VEDL";
        $part2 = $this->getCurrentTime();
        $part3 = $this->getNumberVendorDeliveryInMonth();
        $code  = $part1 . "_" . $part2 . "_" . $part3;

        return $code;
    }

}
