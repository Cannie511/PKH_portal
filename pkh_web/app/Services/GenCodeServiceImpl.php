<?php namespace App\Services;

use DB;
use Carbon\Carbon;

// use App\Models\Booking;

// use App\Models\BigFreeGrab;

// use App\Models\DiscountCode;
// use App\Helpers\HelperServiceProvider;

class GenCodeServiceImpl implements GenCodeService
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
     * @param $param
     */
    private function genCodeForDelivery($param) {}

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
     * @param $param
     * @return mixed
     */

//     public function genBookingTransactionCode() {

//         while(true) {

//             $code = HelperServiceProvider::generateRandomString(12);

//             $booking = Booking::where('transaction_code', $code)->first();

//             if ($booking == null) {

//                 return $code;

//             }

//         }

//         return null;

//     }

//     public function genBigFreeGrabTransactionCode() {

//         while(true) {

//             $code = HelperServiceProvider::generateRandomString(11);

//             $booking = BigFreeGrab::where('transaction_code', $code)->first();

//             if ($booking == null) {

//                 return $code;

//             }

//         }

//         return null;

//     }

//     public function genDiscountCode()  {

//         while(true) {

//             $code = HelperServiceProvider::generateRandomString(10);

//             $booking = DiscountCode::where('code', $code)->first();

//             if ($booking == null) {

//                 return $code;

//             }

//         }

//         return null;
    //     }
}
