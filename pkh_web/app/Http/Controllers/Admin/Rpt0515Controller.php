<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm0210Service;
use App\Services\Rpt0515Service;

/**
 * Rpt0515Controller
 */
class Rpt0515Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $rpt0515Service;
    /**
     * @var mixed
     */
    protected $crm0210Service;

    /**
     * @param Rpt0515Service $rpt0515Service
     * @param Crm0210Service $crm0210Service
     */
    public function __construct(
        Rpt0515Service $rpt0515Service,
        Crm0210Service $crm0210Service
    ) {
        $this->rpt0515Service = $rpt0515Service;
        $this->crm0210Service = $crm0210Service;
        $this->middleware('permission:screen.rpt0515');
    }

    /**
     * @param Request $request
     */
    public function postLoadPromotion(Request $request)
    {
        $promotionList = $this->crm0210Service->loadPromotionList();

        $result = [
            'promotionList' => $promotionList,
        ];

        return response()->success($result);
    }

    /**
     * @param $item1
     * @param $attr
     * @return int
     */
    public function getValue(
        $item1,
        $attr
    ) {

        if (property_exists($item1, $attr)) {
            return $item1->{$attr};
        }

        return 0;
    }

    /**
     * @param $item1
     * @param $item
     */
    public function calTotal(
        $item1,
        &$item
    ) {

        $item["deliveryCount"] += $this->getValue($item1, "deliveryCount");
        $item["deliverySum"] += $this->getValue($item1, "deliverySum");
        $item["deliverySumDis"] += $this->getValue($item1, "deliverySumDis");
        $item["orderCount"] += $this->getValue($item1, "orderCount");
        $item["orderSum"] += $this->getValue($item1, "orderSum");
        $item["orderSumDis"] += $this->getValue($item1, "orderSumDis");

    }

    /**
     * @return mixed
     */
    public function initTotal()
    {
        $item = [
            "name"           => "Total",
            "deliveryCount"  => 0,
            "deliverySum"    => 0,
            "deliverySumDis" => 0,
            "orderCount"     => 0,
            "orderSum"       => 0,
            "orderSumDis"    => 0,
        ];

        return $item;
    }

    /**
     * @param Request $request
     */
    public function postLoadSalesman(Request $request)
    {
        $param = $request->all();
                                                                            //1: order, 2: delivery
        $dataOrder    = $this->rpt0515Service->loadSalesManData($param, 1); // load data order based on order_date
        $dataDelivery = $this->rpt0515Service->loadSalesManData($param, 2); // load data delivery based on delivery_date
        $item         = $this->initTotal();

        foreach ($dataOrder as $itemOrder) {

            foreach ($dataDelivery as $itemDelivery) {

                if ($itemOrder->id == $itemDelivery->id) {
                    $itemOrder->deliveryCount  = $itemDelivery->deliveryCount;
                    $itemOrder->deliverySum    = $itemDelivery->deliverySum;
                    $itemOrder->deliverySumDis = $itemDelivery->deliverySumDis;
                    break;
                }

            }

            //print_r($itemOrder);
            $this->calTotal($itemOrder, $item);
        }

        array_push($dataOrder, $item);

        return response()->success($dataOrder);
    }

    /**
     * @param Request $request
     */
    public function postLoadArea(Request $request)
    {
        $param = $request->all();
                                                                        //1: order, 2: delivery
        $dataOrder    = $this->rpt0515Service->loadAreaData($param, 1); // load data order based on order_date
        $dataDelivery = $this->rpt0515Service->loadAreaData($param, 2); // load data delivery based on delivery_date
        $item         = $this->initTotal();

//Log::debug($dataOrder);
        foreach ($dataOrder as $itemOrder) {
            foreach ($dataDelivery as $itemDelivery) {
                if ($itemOrder->area_id == $itemDelivery->area_id) {
                    $itemOrder->deliveryCount  = $itemDelivery->deliveryCount;
                    $itemOrder->deliverySum    = $itemDelivery->deliverySum;
                    $itemOrder->deliverySumDis = $itemDelivery->deliverySumDis;
                    break;
                }

            }

            $this->calTotal($itemOrder, $item);
        }

        array_push($dataOrder, $item);

        return response()->success($dataOrder);
    }

    /**
     * @param Request $request
     */
    public function postLoadProduct(Request $request)
    {
        $param = $request->all();
                                                                           //1: order, 2: delivery
        $dataOrder    = $this->rpt0515Service->loadProductData($param, 1); // load data order based on order_date
        $dataDelivery = $this->rpt0515Service->loadProductData($param, 2);

// load data delivery based on delivery_date

        foreach ($dataOrder as $itemOrder) {
            foreach ($dataDelivery as $itemDelivery) {
                if ($itemOrder->id == $itemDelivery->id) {
                    $itemOrder->deliveryQty = $itemDelivery->deliveryQty;
                    break;
                }

            }

        }

        return response()->success($dataOrder);
    }

    /**
     * @param Request $request
     */
    public function postLoadStore(Request $request)
    {
        $param = $request->all();
                                                                         //1: order, 2: delivery
        $dataOrder    = $this->rpt0515Service->loadStoreData($param, 1); // load data order based on order_date
        $dataDelivery = $this->rpt0515Service->loadStoreData($param, 2); // load data delivery based on delivery_date
        $item         = $this->initTotal();

//Log::debug($dataOrder);
        foreach ($dataOrder as $itemOrder) {
            foreach ($dataDelivery as $itemDelivery) {
                if ($itemOrder->store_id == $itemDelivery->store_id) {
                    $itemOrder->deliveryCount  = $itemDelivery->deliveryCount;
                    $itemOrder->deliverySum    = $itemDelivery->deliverySum;
                    $itemOrder->deliverySumDis = $itemDelivery->deliverySumDis;
                    break;
                }

            }

            $this->calTotal($itemOrder, $item);
        }

        array_push($dataOrder, $item);

        return response()->success($dataOrder);
    }

}
