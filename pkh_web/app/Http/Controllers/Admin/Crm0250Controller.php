<?php

namespace App\Http\Controllers\Admin;

use Artisan;
use Illuminate\Http\Request;
use App\Services\Crm0250Service;
use App\Services\DownloadService;
use App\Services\SalesmanService;

/**
 * Crm0250Controller
 */
class Crm0250Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0250Service;
    /**
     * @var mixed
     */
    protected $salesmanService;

    /**
     * @param Crm0250Service $crm0250Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm0250Service $crm0250Service,
        SalesmanService $salesmanService,
        DownloadService $downloadService
    ) {
        $this->crm0250Service  = $crm0250Service;
        $this->downloadService = $downloadService;
        $this->salesmanService = $salesmanService;
        $this->middleware('permission:screen.crm0250');
    }

    /**
     * @param Request $request
     */
    public function postInit(Request $request)
    {
        $salesmanList = $this->salesmanService->selectDropdown();
        $result       = [
            'salesmanList' => $salesmanList,
        ];

        return response()->success($result);
    }

    /**
     * Search order
     *
     * @param Request $request
     * @return void
     */
    public function postSearch(Request $request)
    {
        $param            = $request->all();
        $param["sale_id"] = $this->getRoleSaleMan();

        if (1 == $param['index']) {
            $data = $this->crm0250Service->selectList($param);
        } else {
            $data = $this->crm0250Service->selectListStore($param);
        }

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postStats(Request $request)
    {
        $param = $request->all();
        $this->requirePermission('screen.crm0250.stat');
        $data_1 = $this->crm0250Service->selectStatistic('0');
        $data_2 = $this->crm0250Service->selectStatistic('1');
        $data_3 = $this->crm0250Service->selectStatistic2();

        $result = [
            'table_1' => $data_1,
            'table_2' => $data_2,
            'table_3' => $data_3,
        ];

        return response()->success($result);
    }

    /**
     * Download Excel
     *
     * @param Request $request
     * @return void
     */
    public function postDownload(Request $request)
    {
        $this->requirePermission('screen.crm0250.download');

        $param = $request->all();
        //$result = $this->crm0250Service->download($param);
        $param['down'] = 1;
        $data          = $this->crm0250Service->selectList($param);
        $paramDownload = [
            "data"      => $data,
            "file_name" => "SoNgayCongNo",
            "view"      => "crm0250-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

    public function postExec()
    {
        //$this->requirePermission('screen.crm0250.exec');

        $exitCode = Artisan::queue("BAT0250", []);

        $result = [
            'rtnCd' => $exitCode,
            'msg'   => "Đang thực thi",
        ];

        // ob_clean();

        return response()->success($result);
    }

}
