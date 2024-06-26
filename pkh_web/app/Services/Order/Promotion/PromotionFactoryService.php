<?php namespace App\Services\Order\Promotion;

class PromotionFactoryService
{
    /**
     * @param $type
     * @param $id
     */
    public function createPromotion(
        $type,
        $id
    ) {

        switch ($type) {
            case 1:
                return new Promotion1Service($id);
                break;
            case 2:
                return new Promotion2Service($id);
                break;
            default:
                return null;
        }

    }

}
