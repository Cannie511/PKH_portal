<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm1100Service;
use App\Services\DownloadService;
use App\Http\Controllers\Controller;

class Crm1100Controller extends Controller
{
    /**
     * @var mixed
     */
    protected $crm1100Service;

    /**
     * @param Crm1100Service $crm1100Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm1100Service $crm1100Service,
        DownloadService $downloadService
    ) {
        $this->crm1100Service  = $crm1100Service;
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
        $list = $this->crm1100Service->selectList($param);

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
