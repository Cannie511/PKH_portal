<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Rpt0100Service;

/**
 * Rpt0100Controller
 * Bao cao doanh so
 */
class Rpt0100Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    protected $rpt0100Service;

    /**
     * @param Rpt0100Service $rpt0100Service
     */
    public function __construct(Rpt0100Service $rpt0100Service)
    {
        $this->rpt0100Service = $rpt0100Service;
    }

    public function postInit()
    {

        // Get list year
        $listYear = $this->rpt0100Service->selectListYear();

        $result = [
            'listYear' => $listYear,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {

        $params       = $request->all();
        $listOrder    = $this->rpt0100Service->searchOrder($params);
        $listDelivery = $this->rpt0100Service->searchDelivery($params);
        $listPayment  = $this->rpt0100Service->searchPayment($params);
        $result       = [
            'listOrder'    => $listOrder,
            'listDelivery' => $listDelivery,
            'listPayment'  => $listPayment,
        ];

        return response()->success($result);
    }

}
