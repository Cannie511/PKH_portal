<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm4002Service;
use App\Models\PromotionStore;

class Crm4002Controller extends AdminBaseController
{
   
    /**
     * @var mixed
     */
    private $crm4002Service;
    /**
     * @var mixed
     */
    protected $storeService;
    /**
     * @param Crm4002Service $crm4002Service
     */
    public function __construct(Crm4002Service $crm4002Service){
        $this->crm4002Service = $crm4002Service;
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request){
        $param = $request->all();
        $year = $param['year'] ?? date('Y');
        $quarter = $param['quarter'] ?? ceil(date('n') / 3);   
        $data = $this->crm4002Service->getData($param, $year, $quarter);   
        
        foreach($data as $v){
            // Lấy giá trị voucher cho store_id
            $voucherItem = $this->crm4002Service->getVoucher($v->store_id, $year, $quarter);
            
            // Đặt giá trị voucher mặc định là 50 nếu $voucherItem trống
            $v->voucher = $voucherItem ?? 50;

            // Hàm lưu điểm số vào cơ sở dữ liệu
            // PromotionStore::updateOrCreate(
            //     [
            //         'store_id' => $v->store_id,
            //         'year' => $year,
            //         'quarter' => $quarter,
            //         'total_score_card' => $v->total_score_card,
            //     ],
            //     [
            //         'discount' => 50,  
            //         'voucher' => $v->voucher,         
            //         'type_promotion' => 1,           
            //     ]
            // );
        }    

        $result = [
            "data" => $data,
        ];
        
        return response()->success($result);
    }

    public function getYears(Request $request)
    {
        $years = $this->crm4002Service->getYears($request->all());
        return response()->json($years);
    }
}
