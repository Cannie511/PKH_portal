<?php

namespace App\Http\Controllers\Admin;

use Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\Crm0900Service;
use App\Services\Crm1650Service;
use App\Services\Rpt0513Service;
use App\Services\DownloadService;
use App\Services\Das0100Service;
/**
 * Crm1650Controller
 */
class Crm1650Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1650Service;

    /**
     * @param Crm1650Service $crm1650Service
     * @param Crm0900Service $crm0900Service
     * @param Rpt0513Service $rpt0513Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm1650Service $crm1650Service,
        Crm0900Service $crm0900Service,
        Rpt0513Service $rpt0513Service,
        DownloadService $downloadService ,
        Das0100Service $das0100Service
    ) {
        $this->crm1650Service  = $crm1650Service;
        $this->crm0900Service  = $crm0900Service;
        $this->downloadService = $downloadService;
        $this->das0100Service  = $das0100Service;
        $this->middleware('permission:screen.crm1650');
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param      = [];
        $listBig    = [];
        $listResult = null;
        $header     = ["PKH code", "Stock code", "Tồn", "AVG"];

        $listPro = $this->crm1650Service->selectListProduct($param);

        foreach ($listPro as $item) {
            $listResult[$item->product_id]["PKH code"]   = $item->product_code;
            $listResult[$item->product_id]["Stock code"] = $item->stock_code;
        }

        // $listBalance = $this->crm0900Service->selectListProduct($param);
        // Get warehouse
        $warehouse = $this->das0100Service->selectListProductInWarehouse();
        foreach ($warehouse as $item) {
            $listResult[$item->product_id]["Tồn"] = $item->amount;
        }

        $listPI = $this->crm1650Service->selectListPI($param);

        foreach ($listPI as $item) {
            array_push($header, $item->pi_no);
            $listPIDetail = $this->crm1650Service->selectListPIDetail($item->supplier_delivery_id);

            foreach ($listPIDetail as $item1) {
                $listResult[$item1->product_id][$item->pi_no] = $item1->amount;
            }

        }

        $listAVG = $this->crm1650Service->selectListAVG($param);

        foreach ($listAVG as $item) {

            if ($item->time && $item->time > 0) {
                $listResult[$item->product_id]["AVG"] = $item->amount / $item->time;
            } else {
                $listResult[$item->product_id]["AVG"] = 0;
            }

        }

        $start = Carbon::now()->startOfMonth()->subMonth()->subMonth()->toDateString();
        $end   = Carbon::now()->toDateString();
        Log::debug('-----------check date -----------');
        Log::debug($start);
        Log::debug($end);

        $mStart  = (int) date("m", strtotime($start));
        $mEnd    = (int) date("m", strtotime($end));
        $mMiddle = $mStart + 1;

        array_push($header, $mEnd);
        array_push($header, $mMiddle);
        array_push($header, $mStart);
        $param4P = [
            '1' => $start,
            '2' => $end,
        ];
        $listRemainingProduct = $this->crm1650Service->select3MonthNearest($param4P);

        foreach ($listRemainingProduct as $item) {
            $listResult[$item->product_id][$item->m] = $item->sOrder ;
        }

        if (null == $listResult) {
            $listBig = null;
        } else {

            foreach ($listResult as $item) {
                array_push($listBig, $item);
            }

            $listBig = $this->crm1650Service->sort_($listBig);
        }

        $result = [
            'header' => $header,
            'data'   => $listBig,
        ];

        return response()->success($result);

    }

    /**
     * @param Request $request
     * @return null
     */
    public function postDownload(Request $request)
    {
        //$this->requirePermission('screen.crm0910.download');

        $param = $request->all();

//$result = $this->crm1650Service->download($param);
        if (!isset($param["data"])) {
            return;
        }

        $data          = $param["data"];
        $paramDownload = [
            "data"      => $data,
            "file_name" => "NhapHang",
            "view"      => "crm1650-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

}
