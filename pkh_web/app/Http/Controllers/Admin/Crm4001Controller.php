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
    // get year
    $year = $param['year'] ?? date('Y');
    // get quarter
    $quarter = $param['quarter'] ?? ceil(date('n') / 3);   
    // Button seach
    if (isset($param['storeName']) && !empty($param['storeName'])) {
        $data = $this->crm4001Service->getDataSeach($param, $year, $param['storeName'], $quarter);
    }
     // Button pass total
    elseif (isset($param['listAboveAvg']) && $param['listAboveAvg']) {
        $data = $this->crm4001Service->getDataAboveAvgSales($param, $year, $quarter);
    }
     // Button pass retention
    elseif (isset($param['listAboveRetention']) && $param['listAboveRetention']) {
        $data = $this->crm4001Service->getDataStoresAboveRetention($param, $year, $quarter);
    }
     // Button pass order
    elseif (isset($param['listAboveOrderfrequency']) && $param['listAboveOrderfrequency']) {
        $data = $this->crm4001Service->getDataStoresWithHigherThanAvgOrderFrequency($param, $year, $quarter);
    }
     // Button pass dept
    elseif (isset($param['listAboveDept']) && $param['listAboveDept']) {
        $data = $this->crm4001Service->getDataStoresWithDebt($param, $year, $quarter);
    }
     // Button reset
    else {
        $data = $this->crm4001Service->getData($param, $year, $quarter);
    }
    // Sum(Total_sale)
    $avgSale = $this->crm4001Service->getSalesQuarterOfYear($param, $year, $quarter);
    // Count Order 
    $avg_OD = $this->crm4001Service->getCountOrderQuarterOfYear($param, $year, $quarter);
    
    // count store pass Criteria
    $countpass_TotalSale = $this->crm4001Service->getCountPass_TotalSale_QuarterOfYear($param,$year,$quarter);
    $countpass_Retention = $this->crm4001Service->getCountPass_Retention_QuarterOfYear($param,$year,$quarter);
    $countpass_Order = $this->crm4001Service->getCountPass_Order_QuarterOfYear($param,$year,$quarter);
    $countpass_Dept = $this->crm4001Service->getCountPass_Dept_QuarterOfYear($param,$year,$quarter);

    $countStore = $this->crm4001Service->getCountStoreQuarterOfYear($param,$year,$quarter);
    


    foreach ($data as $v) {
        // $orderFrequency = $this->crm4001Service->getAvgCountAStoreOrderQuarterOfYear($v->store_id, $year, $quarter);
        $retentionItem = $this->crm4001Service->getRetention($v->store_id, $year, $quarter);
        $checkdeptItem = $this->crm4001Service->checkDeptAStoreQuarterOfYear($v->store_id, $year, $quarter);
        
        $dataScoreCard = $this->crm4001Service->getData_ScoreCard_QuarterOfYear($v->store_id, $year, $quarter);
       
        if ($dataScoreCard && count($dataScoreCard) > 0) {
            $scoreCard = $dataScoreCard[0]; // Giả sử $dataScoreCard chứa ít nhất một bản ghi
            $v->total_score_card = $scoreCard->total_score_card ?? null;
            $v->sale_score = $scoreCard->sale_score ?? null;
            $v->order_score = $scoreCard->order_score ?? null;
        } else {
            $v->total_score_card = null;
            $v->sale_score = null;
            $v->order_score = null;
        }
    
        // Goi Ham tinh diem

        // $Sale_scoreItem = $this->crm4001Service->getSalesScore($year, $v->store_id, $quarter);
        // $Order_scoreItem = $this->crm4001Service->getOrderScore($year, $v->store_id, $quarter);
       
        // $Total_score_card = $this->crm4001Service->getTotalScoreCard($year, $v->store_id, $quarter);

        // $v->order_frequency = $orderFrequency;
        $v->retention = $retentionItem;
        $v->checkdept = $checkdeptItem;
      
        // $v->Sale_score = $Sale_scoreItem;
        // $v->Order_score = $Order_scoreItem;
       
        // $v->Total_score_card = $Total_score_card;

        // Ham Luu điểm số vào cơ sở dữ liệu

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
        "storePass_4" => $countpass_Dept,
        "CountStore" =>  $countStore,
    ];

    return response()->success($result);
}
     
    public function getYears(Request $request)
{
    $years = $this->crm4001Service->getYears($request->all());
    return response()->json($years);
}

}   
