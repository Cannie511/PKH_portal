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
    
    // count store pass 
    $countpass_TotalSale = $this->crm4001Service->getCountPass_TotalSale_QuarterOfYear($param,$year,$quarter);
    $countpass_Retention = $this->crm4001Service->getCountPass_Retention_QuarterOfYear($param,$year,$quarter);
    $countpass_Order = $this->crm4001Service->getCountPass_Order_QuarterOfYear($param,$year,$quarter);
    $countpass_Dept = $this->crm4001Service->getCountPass_Dept_QuarterOfYear($param,$year,$quarter);

    $countStore = $this->crm4001Service->getCountStoreQuarterOfYear($param,$year,$quarter);
    


    foreach ($data as $v) {
        // Lấy các giá trị từ service
        $retentionItem = $this->crm4001Service->getRetention($v->store_id, $year, $quarter);
        $checkdeptItem = $this->crm4001Service->checkDeptAStoreQuarterOfYear($v->store_id, $year, $quarter);
        $saleStoreItem = $this->crm4001Service->getSalesAStoreQuarterOfYear($year, $v->store_id, $quarter);
        $saleStoreLastYearItem = $this->crm4001Service->getTotalSalesQuarterOfLastYear($year, $v->store_id, $quarter);
        $orderStoreItem = $this->crm4001Service->getCountOrderAStoreQuarterOfYear($year, $v->store_id, $quarter);
        $orderStoreLastYearItem = $this->crm4001Service->getCountOrderQuarterOfLastYear($year, $v->store_id, $quarter);
    
        // Lấy điểm số từ Data Score Card
        $dataScoreCard = $this->crm4001Service->getData_ScoreCard_QuarterOfYear($v->store_id, $year, $quarter);
        if ($dataScoreCard && count($dataScoreCard) > 0) {
            $scoreCard = $dataScoreCard[0]; // Lấy bản ghi đầu tiên
            $v->total_score_card = $scoreCard->total_score_card ?? null;
            $v->sale_score = $scoreCard->sale_score ?? null;
            $v->order_score = $scoreCard->order_score ?? null;
        } else {
            $v->total_score_card = $v->sale_score = $v->order_score = null;
        }
    
        // Gán giá trị retention và dept check
        $v->retention = $retentionItem;
        $v->checkdept = $checkdeptItem;
    
        // Tính toán điểm số
        $dept_score = $checkdeptItem ? 15 : 25;
        $retention_score = $retentionItem ? 15 : 25;
        
        $order_score = ($orderStoreItem > $orderStoreLastYearItem * 1.2) ? 25 : 
                       (($orderStoreItem < $orderStoreLastYearItem * 1.2 && $orderStoreItem > $orderStoreLastYearItem * 0.8) ? 10 : 0);
    
        $sale_score = ($saleStoreItem > $saleStoreLastYearItem * 1.2) ? 25 : 
                      (($saleStoreItem < $saleStoreLastYearItem * 1.2 && $saleStoreItem > $saleStoreLastYearItem * 0.8) ? 10 : 0);
        
        $total_score_card = $dept_score + $retention_score + $order_score + $sale_score;
    
        // Lưu điểm số vào cơ sở dữ liệu
        StoreScore::updateOrCreate(
            [
                'store_id' => $v->store_id,
                'year' => $year,
                'quarter' => $quarter,
            ],
            [
                'sale_score' => $sale_score,
                'order_score' => $order_score,
                'dept_score' => $dept_score,
                'retention_score' => $retention_score,
                'total_score_card' => $total_score_card,
            ]
        );
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
