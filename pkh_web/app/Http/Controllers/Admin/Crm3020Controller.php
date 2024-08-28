<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm3020Service;

class Crm3020Controller extends AdminBaseController
{
    private $crm3020Service;

    public function __construct(Crm3020Service $crm3020Service)
    {
        $this->crm3020Service = $crm3020Service;
    }

    public function postSearch(Request $request)
    {
        $param = $request->all();
        $year = $param['year'] ?? date('Y');
        $store_id = $request->input('store_id');

        $data = $this->crm3020Service->selectList($param);
        $totalOrderCount = $this->crm3020Service->getAvgCountAStoreOrderAllQuartersOfYear($store_id, $year);
        $totalSale = $this->crm3020Service->getSalesAStoreAllQuartersOfYear($store_id, $year);
        $totalRetention = $this->crm3020Service->getRetentionAStoreAllQuarters($store_id, $year);
        $totalDept = $this->crm3020Service->checkDeptAStoreAllQuarters($store_id, $year);
        $totalScoreCard = $this->crm3020Service->getTotalScoreCard($store_id, $year);

        $result = [
            'data' => $data,
            'CountOrder' => $totalOrderCount,
            'TotalSale' => $totalSale,
            'Retention' => $totalRetention,
            'Dept' => $totalDept,
            'totalScoreCard' => $totalScoreCard,
        ];

        return response()->success($result);
    }

    public function getYears(Request $request)
    {
        $years = $this->crm3020Service->getYears($request->all());
        return response()->json($years);
    }
}
