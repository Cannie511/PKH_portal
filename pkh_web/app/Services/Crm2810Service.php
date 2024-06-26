<?php

namespace App\Services;

use DB;
use Log;
use App\Models\TrnStoreKpi;
use App\Models\MstStore;

/**
 * Crm2810Service class
 */
class Crm2810Service extends BaseService
{
    /**
     * @param ProductService $productService
     * @param StoreKpiService $storeKpiService
     */
    public function __construct(
        ProductService $productService,
        StoreKpiService $storeKpiService,
        DownloadService $downloadService
    ) {
        $this->productService  = $productService;
        $this->storeKpiService = $storeKpiService;
        $this->downloadService = $downloadService;
    }

    /**
     * Select list year
     *
     * @return array
     */
    public function selectDropdownYear()
    {
        $thisYear = intval(date('Y'));

        $sqlParam = [$thisYear];
        $sql      = "
        select
            distinct year
        from
            trn_store_kpi
        where year != ?
        ";
        $result = DB::select(DB::raw($sql), $sqlParam);
        Log::info($result);

        $listYear = [$thisYear];

        if (count($result) == 0) {
            return [$thisYear];
        } else {

            foreach ($result as $item) {
                $listYear[] = $item->year;
            }

            return $listYear;
        }

    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectKPI($param)
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
        from
          trn_store_kpi a
        where
          a.store_id = ?
          and a.year = ?
        limit 1
        ";

        $sqlParam[] = $param["store_id"];

        if (isset($param["year"])) {
            $sqlParam[] = $param["year"];
        } else {
            $sqlParam[] = date('Y');
        }

        $result = DB::select(DB::raw($sql), $sqlParam);

        if (count($result) == 0) {
            return null;
        }

        $kpi        = $result[0];
        $kpiResults = $this->storeKpiService->selectKpiResultInYear($kpi->id);

        foreach ($kpiResults as $kpiResult) {
            $prop       = "month_" . $kpiResult->month . "_result";
            $kpi->$prop = $kpiResult->sum_money;
        }

        return $kpi;
    }

    /**
     * @param $param
     */
    public function createKpi($param)
    {
        $store = MstStore::find($param["store_id"]);

        $entity = null;
        $entity = new TrnStoreKpi();
        $user   = $this->logonUser();

        $entity->store_id = $param["store_id"];
        $entity->year     = $param["year"];
        $entity->discount = $store->discount;

        $entity->save();

        return [
            "rtnCd" => true,
            "id"    => $entity->id,
            "msg"   => "Cập nhật thành công",
        ];
    }

    /**
     * @param $param
     * @return mixed
     */
    public function loadMonth($param)
    {
        $sqlParam = array($param["kpi_id"], $param["month"]);
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
          , b.product_type
          , b.supplier_id
          , b.product_cat_id
          , b.product_code
          , b.name
          , b.packing
          , b.moq
          , b.selling_price
          , c.product_cat_id
          , c.product_cat_code
          , c.name as product_cat_name
          , d.discount
        from
          trn_store_kpi_detail a join mst_product b
            on a.product_id = b.product_id join mst_product_cat c
            on c.product_cat_id = b.product_cat_id
            join trn_store_kpi d on a.kpi_id = d.id
        where
          a.kpi_id = ?
          and a.month_index = ?
        ";

        $sql .= "
            order by c.name, b.product_code
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

// Load result
        if (count($result) > 0) {
            // Add image link
            $result = $this->productService->addImageUrl($result);

            // Get result
            $resultDeliver = $this->storeKpiService->selectMonthlyKpi($param["kpi_id"], $param["month"]);
            $mapProduct    = array();

            foreach ($resultDeliver as $delivery) {
                $mapProduct["p_" . $delivery->product_id] = $delivery;
            }

            foreach ($result as $item) {

                if (isset($mapProduct["p_" . $item->product_id])) {
                    $item->result_amount = $mapProduct["p_" . $item->product_id]->sum_amount;
                    $item->result_money  = $mapProduct["p_" . $item->product_id]->sum_money;
                }

            }

        }

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function loadYear($param)
    {
        $sqlParam = array($param["kpi_id"]);
        $sql      = "
        select
            a.product_id 
          , b.product_type
          , b.supplier_id
          , b.product_cat_id
          , b.product_code
          , b.name
          , b.packing
          , b.moq
          , b.selling_price
          , c.product_cat_id
          , c.product_cat_code
          , c.name as product_cat_name
          , d.discount
          , sum(a.amount) amount
          , sum(a.amount * a.unit_price * (100 - d.discount) / 100) target_money
        from
          trn_store_kpi_detail a join mst_product b 
            on a.product_id = b.product_id join mst_product_cat c 
            on c.product_cat_id = b.product_cat_id join trn_store_kpi d 
            on a.kpi_id = d.id 
        where
          a.kpi_id = ?
        group by
          a.product_id
          , b.product_type
          , b.supplier_id
          , b.product_cat_id
          , b.product_code
          , b.name
          , b.packing
          , b.moq
          , b.selling_price
          , c.product_cat_id
          , c.product_cat_code
          , c.name
          , d.discount    
        ";

        $sql .= "
            order by c.name, b.product_code
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

// Load result
        if (count($result) > 0) {
            // Add image link
            $result = $this->productService->addImageUrl($result);

            // Get result
            $resultDeliver = $this->storeKpiService->selectYearKpi($param["kpi_id"]);
            $mapProduct    = array();

            foreach ($resultDeliver as $delivery) {
                $mapProduct["p_" . $delivery->product_id] = $delivery;
            }

            foreach ($result as $item) {

                if (isset($mapProduct["p_" . $item->product_id])) {
                    $item->result_amount = $mapProduct["p_" . $item->product_id]->sum_amount;
                    $item->result_money  = $mapProduct["p_" . $item->product_id]->sum_money;
                }

            }

        }

        return $result;
    }

    /**
     * Download excel file
     *
     * @param [type] $param
     * @return void
     */
    public function download($param)
    {
        $sheets = [];

        // Print all
        $kpi  = $this->selectKPI($param);
        $store = MstStore::find($kpi->store_id);

        $sheets[] = [
            "name" => "ALL",
            "data" => [
                'kpi' => $kpi,
                'store' => $store
            ],
            "view" => "crm2810-list",
        ];

        // Print 12 month
        for($month = 1; $month <= 12; $month++) {
            // array($param["kpi_id"], $param["month"]);
            $monthParam = [
                "kpi_id" => $kpi->id,
                "month" => $month,
            ];

            $monthData = $this->loadMonth($monthParam);
            $sheets[] = [
                "name" => "Thang_" . $month,
                "data" => [
                    'monthData' => $monthData,
                    'month'    => $month,
                ],
                "view" => "crm2810-month",
            ];
        }

        // Print full year
        $yearParam = ["kpi_id" => $kpi->id];
        $yearData = $this->loadYear($yearParam);
        $sheets[] = [
            "name" => $kpi->year . "",
            "data" => [
                'yearData' => $yearData,
                'year' => $kpi->year
            ],
            "view" => "crm2810-year",
        ];

        $paramDownload = [
            "file_name" => "Store_KPI_" . $kpi->store_id,
            "view"      => "crm2810",
            "sheets"    => $sheets,
        ];

        $result = $this->downloadService->downloadExcelFileMultiSheets($paramDownload);

        return $result;
    }
}
