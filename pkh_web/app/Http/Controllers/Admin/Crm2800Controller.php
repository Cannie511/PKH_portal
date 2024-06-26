<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm2800Service;
use App\Services\DownloadService;

/**
 * Crm2800Controller
 */
class Crm2800Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2800Service;

    /**
     * @param Crm2800Service $crm2800Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm2800Service $crm2800Service,
        DownloadService $downloadService
    ) {
        $this->crm2800Service  = $crm2800Service;
        $this->downloadService = $downloadService;
        //$this->middleware('permission:screen.crm2800');
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
        // $listEmployee = $this->employeeService->getDropdownEmployee();
        // $result = [
        //     'listEmployee' => $listEmployee
        // ];
        // return response()->success($result);
        return response()->success([]);
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
    public function postSearch(Request $request)
    {
        $param  = $request->all();
        $data   = $this->crm2800Service->selectList($param);
        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    // /**
    //  * Download Excel
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // public function postDownload(Request $request) {
    //     $this->requirePermission('screen.crm2800.download');
    //     $param = $request->all();
    //     $param['export'] = true;
    //     $data = $this->crm2800Service->selectList($param);
    //     $paramDownload = [
    //         "data" => $data,
    //         "file_name" => "crm2800",
    //         "view" => "crm2800-list"
    //     ];
    //     $result = $this->downloadService->downloadExcelFile($paramDownload);
    //     return response()->success($result);
    // }

}
