<?php namespace App\Services\Order\Promotion;

use App\Models\MstProduct;
use App\Models\TrnStoreOrderDetail;

/**** Khach hang than thiet ***/
class Promotion2Service extends PromotionService
{
    public function checkConditionForPromotion() {}

    public function call()
    {
        return "Welcome to the friendly promotion.";
    }

/*
return the set of items with the $type input for hand bidet promotion
 */
    /**
     * @param $type
     */
    private function getArrConditionForPromotionHandbitdet($type)
    {

        if ("blister" == $type) {
            return array(24, 25, 27, 88, 89);
        } elseif ("ocBag" == $type) {
            return array(26, 29, 30, 66, 83, 84, 85, 93);
        }

        return null;
    }

    /**
     * @param $type
     * @param $qty
     * @return mixed
     */
    private function getInforSupportPriceForHandbidetPromotion(
        $type,
        $qty
    ) {

        $infor = $this->getInforForPromotion();

        if (isset($infor[$type])) {

            foreach ($infor[$type] as $item) {

                if ($qty >= $item['amount']) {
                    return $item;
                }

            }

        }

        return null;
    }

/*
return [
price,
msg
]
return price =-1 when finding the wrong condition
wrong conditions:
+ Total amount of items with same type is less than minimun quantity of the packages.
+ The total items of the same type is less than 2.
+ The quality of item is less than minimun order quantity according to the package.
return price = 0 when there is no item of this type that is found
 */
    /**
     * @param $orderDetail
     * @param $type
     */
    private function getSupportPriceForPromotionHandbidet(
        $orderDetail,
        $type
    ) {
        //WT001O-6HBVXTM-1,WT001P-6HBVXMT-1,WT001R-6HBVXTM-1,WT002G-6HBVXTX-1,WT002H-6HBVXTX-1
        $arrCondition = $this->getArrConditionForPromotionHandbitdet($type);
        $msg          = "";
        $sum          = 0;
        $countItem    = 0;

        foreach ($orderDetail as $item) {

            if (in_array($item['product_id'], $arrCondition)) {
                $sum += $item['amount'];
                $countItem += 1;
            }

        }

        if (0 == $countItem) {
            return [
                'amountTotal' => 0,
                'msg'         => $msg,
            ];
        }

//The total items of the same type is less than 2.

// do not checking blister as new promotion update

        if ($countItem < 2) {
            $msg = "Không đủ mã hàng tối thiểu " . $type;

            return [
                'amountTotal' => -1,
                'msg'         => $msg,
            ];
        }

        $supportPrice = $this->getInforSupportPriceForHandbidetPromotion($type, $sum);

//Total amount of items with same type is less than minimun quantity of the packages.
        if (null == $supportPrice) {
            $msg = "Lượng đặt không xác định " . $type;

            return [
                'amountTotal' => -1,
                'msg'         => $msg,
            ];
        }

        $moq = $supportPrice["moq"];

// Taking minimum order quantity according to package

// Checking quantity of items with the same type is not less than $moq
        foreach ($orderDetail as $item) {
            if (in_array($item['product_id'], $arrCondition)) {
                if ($item['amount'] < $moq) {
                    $product = MstProduct::find($item['product_id']);
                    $msg     = $product->product_code . " Không đạt số lượng tối thiểu là " . $moq;

                    return [
                        'amountTotal' => -1,
                        'msg'         => $msg,
                    ];
                }

            }

        }

        return
            [
            'amountTotal' => $sum,
            'msg'         => $msg,
        ];

    }

    /**
     * @param $user
     * @param $order
     * @param $orderDetail
     * @return mixed
     */
    public function getListOrderDetailForPromotion(
        $user,
        $order,
        $orderDetail
    ) {
        $listOrderDetail = array();
        $total           = 0;
        $detailSeqNo     = 1;
        $supportBlister  = $this->getSupportPriceForPromotionHandbidet($orderDetail, "blister");
        $supportOcBag    = $this->getSupportPriceForPromotionHandbidet($orderDetail, "ocBag");

        $supportAmountForBlister = $supportBlister["amountTotal"]; //
        $supportAmountForOcBag   = $supportOcBag["amountTotal"];

        $msg = "Gợi ý: " . $supportBlister["msg"] . " - " . $supportOcBag["msg"];

        $arrblister    = $this->getArrConditionForPromotionHandbitdet("blister");
        $arrOcBag      = $this->getArrConditionForPromotionHandbitdet("ocBag");
        $error         = -1;
        $supportAmount = 0;

        if (-1 != $supportAmountForOcBag && -1 != $supportAmountForBlister) {
            $error = 1;

            foreach ($orderDetail as $item) {
                $product          = MstProduct::find($item['product_id']);
                $tempSellingPrice = $product->selling_price;

                if (in_array($item['product_id'], $arrblister)) {
                    $supportAmount = $supportAmountForBlister;
                } elseif (in_array($item['product_id'], $arrOcBag)) {
                    $supportAmount = $supportAmountForOcBag;
                }

//Log::debug('check -----------amount');
                //Log::debug($supportAmount);
                $tempSellingPrice = $this->getPromotionPrice($item['product_id'], $product->selling_price, intval($supportAmount));
                $total += $tempSellingPrice * intval($item['amount']);

                $orderDetail                 = new TrnStoreOrderDetail();
                $orderDetail->store_order_id = 0;
                $orderDetail->product_id     = $product->product_id;
                $orderDetail->seq_no         = $detailSeqNo++;
                $orderDetail->amount         = $item['amount'];
                $orderDetail->unit_price     = $tempSellingPrice;
                $this->updateRecordHeader($orderDetail, $user, true);
                $listOrderDetail[] = $orderDetail;
            }

        }

        $result = [
            'error'           => $error,
            'msg'             => $msg,
            'listOrderDetail' => $listOrderDetail,
            'total'           => $total,
        ];

        return $result;
    }

}
