<?php namespace App\Services\Order\Promotion;

use App\Models\MstPromotion;
use App\Services\BaseService;

class PromotionService extends BaseService
{
    /**
     * @var mixed
     */
    protected $promotionID;

    /**
     * @param $promotionId
     */
    public function __construct($promotionId)
    {
        $this->promotionID = $promotionId;

    }

    /**
     * @return mixed
     */
    public function getProductList()
    {
        $data = $this->getInforForPromotion();

        return $data["product_id_list"];
    }

    /**
     * @param $productId
     * @param $sellingPrice
     * @param $amount
     * @return mixed
     */
    protected function getPromotionPrice(
        $productId,
        $sellingPrice,
        $amount
    ) {
        $result            = $sellingPrice;
        $setting           = $this->getInforForPromotion($this->promotionID);
        $productsPromotion = $this->getProductList();

        if (in_array($productId, $productsPromotion)) {
            $priceList = $setting[$productId];

            foreach ($priceList as $priceItem) {

                if ($amount >= $priceItem['amount']) {
                    $result = $priceItem['price'];
                    //$result= $this->getSpecialPriceForPromotion($promotionId,$result);
                    break;
                }

            }

        }

        return $result;
    }

/***
 * Structure json data:
 *  + is_special_product_list:
 *      - 0: return normal list
 *      - 1: return special list
 *  + product_id_list
 *  + product_id_list (blister) promotion2
 *  + product_id_list (OC_bag) promotion2
 *  +
 *
 ***/
    /**
     * @return mixed
     */
    protected function getInforForPromotion()
    {
        $entity   = MstPromotion::find($this->promotionID);
        $jsonData = json_decode($entity["meta_data"], true);

        return $jsonData;
    }

    public function call() {}

}
