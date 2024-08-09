<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Services\eSmsService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Bat0000Service extends BaseService
{
    /**
     * @var eSmsService
     */
    private $esmsService;

    /**
     * @param eSmsService $esmsService
     */
    public function __construct(eSmsService $esmsService)
    {
        $this->esmsService = $esmsService;
    }
    // gửi điểm về SMS khách hàng
    public function sendSMSScoreCard($quarter, $year)
    {
        $param = [];
        $data = $this->getisUsed($quarter, $year);
        foreach ($data as $contact) {
            $phone = $contact->contact_mobile1;
            $param["total_score_card"] = $contact->total_score_card;
                $this->esmsService->sendScore($phone,$param);
                Log::info('Send SMS to: ' . $phone);

        }
    }
    //lấy các khách hàng chưa dùng điểm 
    public function getisUsed($quarter, $year)
    {
        $sqlParam = array();
        $sql = "SELECT 
    a.store_id, 
    a.contact_mobile1, 
   b.total_score_card
FROM 
    `mst_store` as a 
JOIN 
    store_scores as b
ON 
    a.store_id = b.store_id
WHERE 
    b.quarter = ? 
    AND b.year = ?
    AND b.isUsed = 0
";
        $sqlParam = [$quarter, $year];
        return DB::select(DB::raw($sql), $sqlParam);
    }
}
