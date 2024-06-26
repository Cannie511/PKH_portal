<?php

namespace App\Services;

use App\Models\TrnStoreKpi;
use App\Services\FuncConfService;
use Carbon\Carbon;
use DB;

/**
 * Product StoreKpiService
 */
class StoreKpiService extends BaseService
{
    /**
     * @var mixed
     */
    private $funcConfService;

    /**
     * @param FuncConfService $funcConfService
     */
    public function __construct(FuncConfService $funcConfService)
    {
        $this->funcConfService = $funcConfService;
    }

    /**
     * @param $kpiId
     * @param $month
     * @return mixed
     */
    public function selectMonthlyKpi(
        $kpiId,
        $month
    ) {
        $kpi = TrnStoreKpi::find($kpiId);

        if (!isset($kpi)) {
            return [];
        }

        $startDate = Carbon::create($kpi->year, $month, 1, 0, 0, 0);
        $endDate = $startDate->copy()->addMonth();
        $sqlParam = array(
            $kpiId,
            $startDate->format('Y-m-d H:i:s'),
            $endDate->format('Y-m-d H:i:s'),
        );

        $sql = "
        select
          a.product_id
          , sum(a.amount) as sum_amount
          , sum(a.amount * a.unit_price * (100 - d.discount_1 - d.discount_2)  / 100 ) as sum_money
        from
          trn_store_delivery_detail a join trn_store_delivery d
            on a.store_delivery_id = d.store_delivery_id join trn_store_kpi b
            on b.store_id = d.store_id
            and b.id = ? join trn_store_kpi_detail c
            on c.kpi_id = b.id and c.product_id = a.product_id and month(d.delivery_date) = c.month_index
        where
            ? <= d.delivery_date and d.delivery_date < ?
        group by a.product_id
        ";
        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $kpiId
     * @param $month
     * @return mixed
     */
    public function selectYearKpi(
        $kpiId
    ) {
        $kpi = TrnStoreKpi::find($kpiId);

        if (!isset($kpi)) {
            return [];
        }

        $startDate = Carbon::create($kpi->year, 1, 1, 0, 0, 0);
        $endDate = $startDate->copy()->addYear();
        $sqlParam = array(
            $kpiId,
            $startDate->format('Y-m-d H:i:s'),
            $endDate->format('Y-m-d H:i:s'),
        );

        $sql = "
      select
        a.product_id
        , sum(a.amount) as sum_amount
        , sum(a.amount * a.unit_price * (100 - d.discount_1 - d.discount_2)  / 100 ) as sum_money
      from
        trn_store_delivery_detail a join trn_store_delivery d
          on a.store_delivery_id = d.store_delivery_id join trn_store_kpi b
          on b.store_id = d.store_id
          and b.id = ? join trn_store_kpi_detail c
          on c.kpi_id = b.id and c.product_id = a.product_id
      where
          ? <= d.delivery_date and d.delivery_date < ?
      group by a.product_id
      ";
        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $kpiId
     */
    public function updateTarget($kpiId)
    {
        $user = $this->logonUser();
        $kpi = TrnStoreKpi::find($kpiId);

        if (!isset($kpi)) {
            return [];
        }

        $sqlParam = [$kpiId];
        $sql = "
        select
          a.month_index
          , sum(a.amount) as sum_amount
          , sum(a.amount * a.unit_price) as sum_money
        from
          trn_store_kpi_detail a
        where
          a.kpi_id = ?
        group by
          a.month_index
        ";
        $details = DB::select(DB::raw($sql), $sqlParam);

        $total = 0;
        foreach ($details as $detail) {
            $prop = "month_" . $detail->month_index . "_target";
            $kpi->$prop = $detail->sum_money * (100 - $kpi->discount) / 100;
            $total += $detail->sum_money;
        }

        $kpi->target_year = $total * (100 - $kpi->discount) / 100;

        $this->updateRecordHeader($kpi, $user, false);
        $kpi->save();
    }

    /**
     * @param $kpiId
     * @return mixed
     */
    public function selectKpiResultInYear($kpiId)
    {
        $kpi = TrnStoreKpi::find($kpiId);

        if (!isset($kpi)) {
            return [];
        }

        $startDate = Carbon::create($kpi->year, 1, 1, 0, 0, 0);
        $endDate = $startDate->copy()->addYear();
        $sqlParam = array(
            $kpiId,
            $startDate->format('Y-m-d H:i:s'),
            $endDate->format('Y-m-d H:i:s'),
        );

        // Calculate all product
        // -> Remove: and c.product_id = a.product_id
        $sql = "
        select
            month (a.delivery_date)    as month
          , sum(a.total_with_discount) as sum_money
        from
          trn_store_delivery a join trn_store_kpi b
            on b.id = ?
            and b.store_id = a.store_id
        where
          ? <= a.delivery_date
          and a.delivery_date < ?
          and a.delivery_sts = '4'
        group by
          month (a.delivery_date)
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    public function getTotalDeliveryInYear($kpiId)
    {
        $total = 0;

        $monthly = $this->selectKpiResultInYear($kpiId);
        foreach ($monthly as $month) {
            $total += $month->sum_money;
        }

        return $total;
    }

    public function getPercentageAmountInYear($kpiId)
    {

        $percent = 0;
        $kpi = TrnStoreKpi::find($kpiId);

        if (!isset($kpi)) {
            return [
                "plan_amount" => 0,
                "actual_amount" => 0,
                "percent" => 0,
            ];
        }

        $startDate = Carbon::create($kpi->year, 1, 1, 0, 0, 0);
        $endDate = $startDate->copy()->addYear();
        $sqlParam = array(
            $kpiId,
            $startDate->format('Y-m-d H:i:s'),
            $endDate->format('Y-m-d H:i:s'),
            $kpiId,
        );

        $sql = "
        select
            coalesce(sum(a.amount), 0) as amount
        from
          trn_store_kpi_detail a
        where
          a.kpi_id = ?
        union all
        select
            coalesce(sum(a.amount), 0) as amount
        from
          trn_store_delivery_detail a join trn_store_delivery b
            on a.store_delivery_id = b.store_delivery_id
            and b.delivery_sts = '4' 
            and ? <= b.delivery_date
            and b.delivery_date < ?
            join trn_store_kpi c
            on b.store_id = c.store_id
            and c.id = ? join trn_store_kpi_detail d
            on d.kpi_id = c.id
            and d.product_id = a.product_id
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);
        if($result[0]->amount > 0 ) {
            $percent = $result[1]->amount / $result[0]->amount;
        }

        return [
            "plan_amount" => $result[0]->amount,
            "actual_amount" => $result[1]->amount,
            "percent" => $percent,
        ];
    }

}
