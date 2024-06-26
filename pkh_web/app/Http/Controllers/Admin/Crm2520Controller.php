<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm2520Service;
use App\Services\DownloadService;
use App\Http\Controllers\Controller;

class Crm2520Controller extends Controller
{
    /**
     * @var mixed
     */
    protected $crm2520Service;

    /**
     * @param Crm2520Service $crm2520Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm2520Service $crm2520Service,
        DownloadService $downloadService
    ) {
        $this->crm2520Service  = $crm2520Service;
        $this->downloadService = $downloadService;
        // $this->middleware( 'role.sale' );
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        //Log::debug('postSearchpostSearchpostSearchpostSearchpostSearchpostSearchpostSearch');
        $list = $this->crm2520Service->selectList($param);

        return response()->success($list);
    }

    /**
     * @param Request $request
     */
    public function postDownload(Request $request)
    {
        //$this->requirePermission('screen.crm0910.download');

        $param         = $request->all();
        $data          = $this->crm1100Service->selectList($param);
        $paramDownload = [
            "data"      => $data,
            "file_name" => "NguoiGiaoHang",
            "view"      => "crm1100-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }
}
