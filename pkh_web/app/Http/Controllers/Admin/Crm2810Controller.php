<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm2810Service;
use App\Services\DownloadService;

/**
 * Crm2810Controller
 */
class Crm2810Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2810Service;

    /**
     * @param Crm2810Service $crm2810Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm2810Service $crm2810Service,
        DownloadService $downloadService
    ) {
        $this->crm2810Service  = $crm2810Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.crm2810');
    }

    /**
     * Load init data
     *
     * @param Request $request
     * @return void
     */
    public function postInitData(Request $request)
    {
        // $param = $request->all();
        $listYear = $this->crm2810Service->selectDropdownYear();
        $result   = [
            'listYear' => $listYear,
        ];

        return response()->success($result);
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();

        $kpi = $this->crm2810Service->selectKPI($param);
        // $data = $this->crm2810Service->selectList($param);
        $result = [
            'kpi' => $kpi,
        ];

        return response()->success($result);
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
    public function postCreateKpi(Request $request)
    {
        // $this->middleware('permission:screen.crm2820.save');
        $this->validate($request, [
            'store_id' => 'required|numeric|min:0',
            'year'     => 'required|numeric|min:0',
        ]);

        $param = $request->all();
        $data  = $this->crm2810Service->createKpi($param);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postLoadMonth(Request $request)
    {
        // $this->middleware('permission:screen.crm2820.save');
        $this->validate($request, [
            'kpi_id' => 'required|numeric|min:0',
            'month'  => 'required|numeric|min:1|max:12',
        ]);

        $param = $request->all();
        $data  = $this->crm2810Service->loadMonth($param);

        return response()->success($data);
    }

    /**
     * @param Request $request
     */
    public function postLoadYear(Request $request)
    {
        // $this->middleware('permission:screen.crm2820.save');
        $this->validate($request, [
            'kpi_id' => 'required|numeric|min:0',
        ]);

        $param = $request->all();
        $data  = $this->crm2810Service->loadYear($param);

        return response()->success($data);
    }

    /**
     * Download Excel
     *
     * @param Request $request
     * @return void
     */
    public function postDownload(Request $request) {
        // $this->requirePermission('screen.crm2810.download');
        $param = $request->all();
        $result = $this->crm2810Service->download($param);

        return response()->success($result);
    }

}
