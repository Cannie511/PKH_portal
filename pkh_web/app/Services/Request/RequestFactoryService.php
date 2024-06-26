<?php namespace App\Services\Request;

class RequestFactoryService
{
    /**
     * @param $type
     */
    public function createRequest($type)
    {

        switch ($type) {
            case 1:
                return new RequestOrderService();
                break;
            case 2:
                return new RequestDeliveryService();
                break;
            case 3:
                return new RequestImportService();
                break;
            case 7:
                return new RequestWarehouseService();
                break;
        }

    }

}
