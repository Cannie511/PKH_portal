<?php

namespace App\Services;

use DB;
use App\Models\TrnStoreKpiDetail;

/**
 * Crm2820Service class
 */
class Crm2820Service extends BaseService
{
    /**
     * @param StoreKpiService $storeKpiService
     */
    public function __construct(StoreKpiService $storeKpiService)
    {
        $this->storeKpiService = $storeKpiService;
    }

    /**
     * @param $kpiId
     * @return mixed
     */
    public function loadKPI($kpiId)
    {
        $sqlParam = [$kpiId];
        $sql      = "
        select
          a.id
          , a.store_id
          , b.name as store_name
          , a.discount
        from
          trn_store_kpi a join mst_store b
            on a.store_id = b.store_id
        where
          a.id = ?
        limit 1
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        if (count($result) > 0) {
            return $result[0];
        }

        return null;
    }

    /**
     * @param $kpiId
     * @param $month
     * @return mixed
     */
    public function selectKPIDetail(
        $kpiId,
        $month
    ) {
        $sqlParam = [$kpiId, $month];
        $sql      = "
        select
          a.id
          , a.kpi_id
          , a.month_index
          , a.product_id
          , a.seq_no
          , a.amount
          , a.unit_price
          , a.result_amount
          , a.result_money
          , b.name
          , b.product_code
          , b.product_cat_id
          , b.selling_price
        from
          trn_store_kpi_detail a join mst_product b
            on a.product_id = b.product_id join mst_product_cat c
            on b.product_cat_id = c.product_cat_id
        where
          a.kpi_id = ?
          and a.month_index = ?
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     */
    public function saveEntity($param)
    {

        $listProduct = $param["listProduct"];

        $user = $this->logonUser();
        // Remove old data
        TrnStoreKpiDetail::where("kpi_id", $param["kpi_id"])
            ->where("month_index", $param["month"])
            ->delete();

        $seq_no = 1;

        foreach ($listProduct as $inputProduct) {
            $detail = new TrnStoreKpiDetail();

            $detail->kpi_id      = $param["kpi_id"];
            $detail->month_index = $param["month"];
            $detail->product_id  = $inputProduct["product_id"];
            $detail->amount      = $inputProduct["amount"];
            $detail->seq_no      = $seq_no++;

            $this->updateRecordHeader($detail, $user, true);
            $detail->save();
        }

        // Update selling price
        $sqlParam = [$param['kpi_id'], $param['month']];
        $sql      = "
        update
            trn_store_kpi_detail a
            , mst_product b
        set
            a.unit_price = b.selling_price
        where
            a.kpi_id = ?
            and a.month_index = ?
            and a.product_id = b.product_id
        ";
        DB::update(DB::raw($sql), $sqlParam);

        // Update trn_store_kpi
        $this->storeKpiService->updateTarget($param['kpi_id']);

        return [
            "rtnCd" => true,
            "msg"   => "Cập nhật thành công",
        ];
    }

// function deleteEntity($id) {

//     TrnStoreKpiDetail::where('id', $id)->delete();

//     return [

//         "rtnCd" => true,

//         "msg"   => "Xóa thành công",

//     ];
    // }

}
