<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm0220Service;
use App\Services\DownloadService;

/**
 * Crm0220Controller
 * Xem đơn hàng giao hàng còn thiếu
 */
class Crm0220Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0220Service;

    /**
     * @param Crm0220Service $crm0220Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm0220Service $crm0220Service,
        DownloadService $downloadService
    ) {
        $this->crm0220Service  = $crm0220Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.crm0220');
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
        $data             = $this->crm0220Service->selectList($param);

        $result = [
            'data' => $data,
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
        $this->requirePermission('screen.crm0220.download');

        $param = $request->all();
        //$result = $this->crm0220Service->download($param);
        $param["download"] = 1;
        $data              = $this->crm0220Service->selectList($param);

        $viewName = 'crm0220-list-bill';

        if ("1" == $param['search_type']) {
            $viewName = 'crm0220-list';
        }

        $paramDownload = [
            "data"      => $data,
            "file_name" => "KiemDonHang",
            "view"      => $viewName,
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

}
