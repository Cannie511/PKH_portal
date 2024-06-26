<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Hrm1000Service;
use App\Services\DownloadService;

/**
 * Hrm1000Controller
 */
class Hrm1000Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm1000Service;

    /**
     * @param Hrm1000Service $hrm1000Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Hrm1000Service $hrm1000Service,
        DownloadService $downloadService
    ) {
        $this->hrm1000Service  = $hrm1000Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.hrm1000');
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
        $data   = $this->hrm1000Service->selectList($param);
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
    //     $this->requirePermission('screen.hrm1000.download');
    //     $param = $request->all();
    //     $param['export'] = true;
    //     $data = $this->hrm1000Service->selectList($param);
    //     $paramDownload = [
    //         "data" => $data,
    //         "file_name" => "hrm1000",
    //         "view" => "hrm1000-list"
    //     ];
    //     $result = $this->downloadService->downloadExcelFile($paramDownload);
    //     return response()->success($result);
    // }

}
