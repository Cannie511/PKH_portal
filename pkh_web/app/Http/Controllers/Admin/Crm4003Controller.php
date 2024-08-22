<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm4003Service;

class Crm4003Controller extends AdminBaseController
{
    private $crm4003Service;

    public function __construct(Crm4003Service $crm4003Service)
    {
        $this->crm4003Service = $crm4003Service;
    }

    public function postSearch(Request $request)
    {
        $param = $request->all();
        $store_id = $request->input('store_id');

        $data = $this->crm4003Service->selectList($param);
        $totalScoreCard = $this->crm4003Service->getTotalScoreCard($store_id);
        $SaleScore = $this->crm4003Service->getSaleScore($store_id);
        $totalSale = $this->crm4003Service->getTotalSale($store_id);
        $TotalSaleSamePeriod = $this->crm4003Service->getTotalSaleSamePeriod($store_id);
        $OrderFrequencySamePeriod = $this->crm4003Service->getOrderFrequencySamePeriod($store_id);
        $OrderFrequencyCurrent = $this->crm4003Service->getOrderFrequencyCurrent($store_id);
        $OrderScore = $this->crm4003Service->getOrderScore($store_id);

        $result = [
            'data' => $data,
            'total_Score_Card'=>$totalScoreCard,
            'total_Sale'=>$totalSale,
            'total_Sale_SamePeriod'=>$TotalSaleSamePeriod,
            'SaleScore'=>$SaleScore,
            'OrderScore'=>$OrderScore,
            'OrderFrequencySamePeriod'=>$OrderFrequencySamePeriod,
            'OrderFrequencyCurrent'=>$OrderFrequencyCurrent,
        ];

        return response()->success($result);
    }

    
}
