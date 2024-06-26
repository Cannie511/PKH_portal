<?php namespace App\Services\Order\Promotion;

use App\Models\MstProduct;
use App\Models\TrnStoreOrderDetail;

/**** Voi ho , Day Cap ***/
class Promotion1Service extends PromotionService
{
    public function checkConditionForPromotion() {}

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
        $detailSeqNo     = 1;
        $total           = 0;
        $msg             = '';

        foreach ($orderDetail as $item) {
            $product          = MstProduct::find($item['product_id']);
            $tempSellingPrice = $product->selling_price;
            //$tempOld = $tempSellingPrice;
            $tempSellingPrice = $this->getPromotionPrice($item['product_id'], $product->selling_price, intval($item['amount']));
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

        $result = [
            'msg'             => $msg,
            'listOrderDetail' => $listOrderDetail,
            'total'           => $total,
            'error'           => 1,
        ];

        return $result;
    }

    public function call()
    {
        return "Welcome to the bibtap promotion.";
    }

}
