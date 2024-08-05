<?php

namespace App\Http\Controllers\Admin;

use App\Services\Crm3000Service;
use Illuminate\Http\Request;
use App\Services\Crm3020Service;

class Crm3020Controller extends AdminBaseController
{

    /**
     * @var mixed
     */
    private $crm3020Service;
    private $crm3000Service;
    /**
     * @param Crm3020Service $crm3020Service
     * 
     */
    public function __construct(Crm3020Service $crm3020Service, Crm3000Service $crm3000Service)
    {
        $this->crm3020Service = $crm3020Service;
        $this->crm3000Service = $crm3000Service;
    }
    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $years = [];
        $currrentYear = date("Y");
        $retention = [];
        $paymentHistoryMap = [];
        $avg_sale = $this->crm3000Service->getAverageSalePerYear($param);
        $avg_order = $this->crm3000Service->getAverageOderFrequencyPerYear($param);

        $data = $this->crm3020Service->selectList($param);
        $salePerMonth = $this->crm3020Service->getTotalSalePerMonth($param);
        $order_frequency = $this->crm3020Service->getOrderFrequency($param);
        $payment_history = $this->crm3020Service->getPaymentHistory($param);

        for ($i = 2016; $i < $currrentYear; $i++) {
            $year = $i . "-12-31";
            $paramRetention = $this->crm3020Service->getRetentionParam($param, $year);
            $temp = [
                "year" => $i,
                "retention" => $paramRetention
            ];
            array_push($retention, $temp);
        }
        foreach ($payment_history as $p) {
            $paymentHistoryMap[$p->month] = true;
        }

        for ($i = 0; $i < count($salePerMonth); $i++) {
            $salePerMonth[$i]["order"] = $order_frequency[$i]["total_order"];
            $salePerMonth[$i]["gap_order"] = $order_frequency[$i]["gap"];
            $salePerMonth[$i]["payment"] = isset($paymentHistoryMap[$salePerMonth[$i]["month"]]) ? 1 : 0;
            foreach ($retention as $r) {
                if (isset($r["year"]) && $salePerMonth[$i]["year"] == $r["year"]) {
                    $salePerMonth[$i]["retention"] = $r["retention"];
                    break;
                } else
                    $salePerMonth[$i]["retention"] = "";
            }
        }
        
        foreach ($salePerMonth as $item) {
            if (!in_array($item['year'], $years)) {
                $years[] = $item['year'];
            }
        }

        $data->avg_sale = $avg_sale;
        $data->avg_order = $avg_order;
        $data->retention = $retention;
        $data->years = array_reverse($years);
        $data->payment = $payment_history;
        $data->sale = array_reverse($salePerMonth);
        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

}
