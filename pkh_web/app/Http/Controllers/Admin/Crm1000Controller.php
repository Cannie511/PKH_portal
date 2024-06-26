<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm1000Service;
use App\Services\DownloadService;
use App\Http\Controllers\Controller;

class Crm1000Controller extends Controller
{
    /**
     * @var mixed
     */
    protected $crm1000Service;

    /**
     * @param Crm1000Service $crm1000Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm1000Service $crm1000Service,
        DownloadService $downloadService
    ) {
        $this->crm1000Service  = $crm1000Service;
        $this->downloadService = $downloadService;
        // $this->middleware( 'role.sale' );
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $list  = $this->crm1000Service->selectList($param);

        return response()->success($list);
    }

    /**
     * @param Request $request
     */
    public function postDownload(Request $request)
    {
        //$this->requirePermission('screen.crm0910.download');
        $param = $request->all();
        $data  = $this->crm1000Service->selectList($param);
        // param: data, file name, sheet name, view file
        $paramDownload = [
            "data"      => $data,
            "file_name" => "ChiPhiGiaoHang",
            "view"      => "crm1000-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }
}
