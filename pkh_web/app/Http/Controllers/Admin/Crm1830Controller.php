<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Services\Crm1830Service;
use App\Services\DownloadService;

/**
 * Crm1830Controller
 */
class Crm1830Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1830Service;

    /**
     * @param Crm1830Service $crm1830Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm1830Service $crm1830Service,
        DownloadService $downloadService
    ) {
        $this->crm1830Service  = $crm1830Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.crm1830');
    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {
        $param       = [];
        $departments = $this->crm1830Service->selectDepartments();
        $costcats    = $this->crm1830Service->selectConcats();
        $result      = [
            'departments' => $departments,
            'costcats'    => $costcats,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $param["user_id"] = $this->getRoleForCost();
        $list  = $this->crm1830Service->selectCost($param);

        return response()->success($list);
    }

    /**
     * @param Request $request
     */
    public function postDownload(Request $request)
    {
        $param = $request->all();
        //$result = $this->crm1830Service->download($param);
        $data          = $this->crm1830Service->selectCost($param);
        $paramDownload = [
            "data"      => $data,
            "file_name" => "ChiPhi",
            "view"      => "crm1830-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

}
