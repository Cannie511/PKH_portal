<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm4001Service;
use App\Models\StoreScore;

class Crm4001Controller extends AdminBaseController
{
   
    /**
     * @var mixed
     */
    private $crm4001Service;
    /**
     * @var mixed
     */
    protected $storeService;
    /**
     * @param crm4001Service $crm4001Service
     * 
     */
    public function __construct(Crm4001Service $crm4001Service){
        $this->crm4001Service = $crm4001Service;
    }
    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
{
    $param = $request->all();
    $year = $param['year'] ?? date('Y');
    $quarter = $param['quarter'] ?? 1;

    if (isset($param['storeName']) && !empty($param['storeName'])) {
        $data = $this->crm4001Service->getDataSeach($param, $year, $param['storeName'], $quarter);
    }
    elseif (isset($param['listAboveAvg']) && $param['listAboveAvg']) {
        $data = $this->crm4001Service->getDataAboveAvgSales($param, $year, $quarter);
    }
    elseif (isset($param['listAboveRetention']) && $param['listAboveRetention']) {
        $data = $this->crm4001Service->getDataStoresAboveRetention($param, $year, $quarter);
    }
    elseif (isset($param['listAboveOrderfrequency']) && $param['listAboveOrderfrequency']) {
        $data = $this->crm4001Service->getDataStoresWithHigherThanAvgOrderFrequency($param, $year, $quarter);
    }
    elseif (isset($param['listAboveDept']) && $param['listAboveDept']) {
        $data = $this->crm4001Service->getDataStoresWithDebt($param, $year, $quarter);
    }
    else {
        $data = $this->crm4001Service->getData($param, $year, $quarter);
    }

    $avgSale = $this->crm4001Service->getSalesQuarterOfYear($param, $year, $quarter);
    $avg_OD = $this->crm4001Service->getCountOrderQuarterOfYear($param, $year, $quarter);

    $countpass_TotalSale = $this->crm4001Service->getCountPass_TotalSale_QuarterOfYear($param,$year,$quarter);
    $countpass_Retention = $this->crm4001Service->getCountPass_Retention_QuarterOfYear($param,$year,$quarter);
    $countpass_Order = $this->crm4001Service->getCountPass_Order_QuarterOfYear($param,$year,$quarter);
    $countNopass_Dept = $this->crm4001Service->getCountNoPass_Dept_QuarterOfYear($param,$year,$quarter);

    $storeCountsByScore = $this->crm4001Service->getStoreCountsByScore($param,$year,$quarter);
    $storeCountsByScoreSamePeriod = $this->crm4001Service->getStoreCountsByScoreSamePeriod($param,$year,$quarter);

    foreach ($data as $v) {
        $orderFrequency = $this->crm4001Service->getAvgCountAStoreOrderQuarterOfYear($v->store_id, $year, $quarter);
        $retentionItem = $this->crm4001Service->getRetention($v->store_id, $year, $quarter);
        $checkdeptItem = $this->crm4001Service->checkDeptAStoreQuarterOfYear($v->store_id, $year, $quarter);
        $countOrderYear120Item = $this->crm4001Service->getCountOrderQuarterOfLastYear120($year, $v->store_id, $quarter);
        $TotalSales120Item = $this->crm4001Service->getTotalSalesQuarterOfLastYear120($year, $v->store_id, $quarter);

        // Goi Ham tinh diem

        // $Sale_scoreItem = $this->crm4001Service->getSalesScore($year, $v->store_id, $quarter);
        // $Order_scoreItem = $this->crm4001Service->getOrderScore($year, $v->store_id, $quarter);
        // $Retention_scoreItem = $this->crm4001Service->getRetentionScore($v->store_id, $year, $quarter);
        // $Dept_scoreItem = $this->crm4001Service->getDeptScore($v->store_id, $year, $quarter);
        // $Total_score_card = $this->crm4001Service->getTotalScoreCard($year, $v->store_id, $quarter);

        $v->order_frequency = $orderFrequency;
        $v->retention = $retentionItem;
        $v->checkdept = $checkdeptItem;
        $v->countOrderYear120 = $countOrderYear120Item;
        $v->TotalSales120 = $TotalSales120Item;

        // $v->Sale_score = $Sale_scoreItem;
        // $v->Order_score = $Order_scoreItem;
        // $v->Retention_score = $Retention_scoreItem;
        // $v->Dept_score = $Dept_scoreItem;
        // $v->Total_score_card = $Total_score_card;

        // // Lưu điểm số vào cơ sở dữ liệu

        // StoreScore::updateOrCreate(
        //     [
        //         'store_id' => $v->store_id,
        //         'year' => $year,
        //         'quarter' => $quarter,
        //     ],
        //     [
        //         'sale_score' => $Sale_scoreItem,
        //         'retention_score' => $Retention_scoreItem,
        //         'order_score' => $Order_scoreItem,
        //         'dept_score' => $Dept_scoreItem,
        //         'total_score_card' => $Total_score_card,
        //         'isUsed' => false, // giá trị mặc định là false
        //     ]
        // );
    }

    $result = [
        "data" => $data,
        "avg_sale" => $avgSale,
        "avg_OD" => $avg_OD,
        "storePass_1" => $countpass_TotalSale,
        "storePass_2" => $countpass_Retention,
        "storePass_3" => $countpass_Order,
        "storePass_4" => $countNopass_Dept,
        "storeCountsByScore" => $storeCountsByScore,
        "storeCountsByScoreSamePeriod" => $storeCountsByScoreSamePeriod
    ];

    return response()->success($result);
}
    
    public function getYears(Request $request)
{
    $years = $this->crm4001Service->getYears($request->all());
    return response()->json($years);
}

}   
