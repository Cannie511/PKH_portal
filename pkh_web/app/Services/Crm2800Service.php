<?php

namespace App\Services;

use DB;
use Log;

/**
 * Crm2800Service class
 */
class Crm2800Service extends BaseService
{
    /**
     * @param StoreKpiService $storeKpiService
     */
    public function __construct(StoreKpiService $storeKpiService)
    {
        $this->storeKpiService = $storeKpiService;
    }

    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectList($param)
    {
        $sqlParam = array();
        $sql      = "
        select
            a.id
          , a.store_id
          , a.year
          , a.target_year
          , a.result_year
          , a.month_1_target
          , a.month_2_target
          , a.month_3_target
          , a.month_4_target
          , a.month_5_target
          , a.month_6_target
          , a.month_7_target
          , a.month_8_target
          , a.month_9_target
          , a.month_10_target
          , a.month_11_target
          , a.month_12_target
          , a.month_1_result
          , a.month_2_result
          , a.month_3_result
          , a.month_4_result
          , a.month_5_result
          , a.month_6_result
          , a.month_7_result
          , a.month_8_result
          , a.month_9_result
          , a.month_10_result
          , a.month_11_result
          , a.month_12_result
          , a.kpi_sts
          , a.notes
          , b.name
          , b.address
        from
          trn_store_kpi a join mst_store b
            on a.store_id = b.store_id
        ";

        $sql .= $this->andWhereString($param, 'name', 'b.name', $sqlParam);

        $sql .= "
            order by
            a.year desc,
            b.name
        ";

        $result = [];

        if (isset($param['export']) && true == $param['export']) {
            $result = DB::select(DB::raw($sql), $sqlParam);
            $listKpi = $result;
        } else {
            $result = $this->pagination($sql, $sqlParam, $param);
            $listKpi = $result->items();
        }

        Log::info($result);
        Log::info($listKpi);

        foreach($listKpi as $kpi) {
            // Get result from delivery
            $kpi->actual_money = $this->storeKpiService->getTotalDeliveryInYear($kpi->id);
            // Get amount from delivery
            $kpiAmount = $this->storeKpiService->getPercentageAmountInYear($kpi->id);
            $kpi->plan_amount = $kpiAmount["plan_amount"];
            $kpi->actual_amount = $kpiAmount["actual_amount"];
            $kpi->percent_amount = $kpiAmount["percent"];
        }

        return $result;
    }

}
