<?php

namespace App\Http\Controllers\Admin;
use Log;
use Illuminate\Http\Request;
use App\Services\Rpt0200Service;
use App\Services\SupplierService;

/**
 * Rpt0200Controller
 * Bao cao doanh so
 */
class Rpt0200Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    protected $rpt0200Service;
     /**
     * @var mixed
     */
    protected $supplierService;

    /**
     * @param Rpt0200Service $rpt0200Service
     */
    public function __construct(Rpt0200Service $rpt0200Service,
                                SupplierService $supplierService)
    {
        $this->rpt0200Service = $rpt0200Service;
        $this->supplierService = $supplierService;
    }

    public function postInit()
    {

        // Get list year
        $listYear = $this->rpt0200Service->selectListYear();
        $supplierList  = $this->supplierService->selectSupplierDropDown();

        $result = [
            'listYear' => $listYear,
            'supplierList'  => $supplierList
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {

        $params = $request->all();
        /*--------------- ORDER REPORT-----------------*/
        $listOrder             = $this->rpt0200Service->getOrder($params);
        $listSpecialOrder      = $this->rpt0200Service->getSpecialOrder($params);
        $listCancleOrder       = $this->rpt0200Service->getCancleOrder($params);
        $listCancleRemainOrder = $this->rpt0200Service->getCancleRemainOrder($params);
        /*--------------- DELIVERY REPORT-----------------*/
        $listDelivery        = $this->rpt0200Service->getDelivery($params);
        $listSpecialDelivery = $this->rpt0200Service->getSpecialDelivery($params);
        $listCancleDelivery  = $this->rpt0200Service->getCancleDelivery($params);
        /*--------------- PURCHASING REPORT-----------------*/
        $listPurchasing      = $this->rpt0200Service->getPurchasing($params);
        // Log::debug("------ check purchasing ");
        // Log::debug($listPurchasing );
        $listPayment     = $this->rpt0200Service->getPayment($params);
        $listImport      = $this->rpt0200Service->getImport($params);
        $listCostTransit = $this->rpt0200Service->getCostTransit($params);
        $listCost        = $this->rpt0200Service->getCost($params);
        $result          = [
            'listOrder'             => $listOrder,
            'listDelivery'          => $listDelivery,
            'listPayment'           => $listPayment,
            'listImport'            => $listImport,
            'listCostTransit'       => $listCostTransit,
            'listCost'              => $listCost,
            'listSpecialOrder'      => $listSpecialOrder,
            'listCancleOrder'       => $listCancleOrder,
            'listCancleRemainOrder' => $listCancleRemainOrder,
            'listSpecialDelivery'   => $listSpecialDelivery,
            'listCancleDelivery'    => $listCancleDelivery,
            'listPurchasing'        => $listPurchasing,
        ];

        return response()->success($result);
    }

}
