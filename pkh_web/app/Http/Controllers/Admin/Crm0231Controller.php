<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\AreaService;
use App\Services\Crm0231Service;
use App\Services\DownloadService;

/**
 * Crm0231Controller
 */
class Crm0231Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0231Service;

    /**
     * @param Crm0231Service $crm0231Service
     * @param AreaService $areaService
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm0231Service $crm0231Service,
        AreaService $areaService,
        DownloadService $downloadService
    ) {
        $this->crm0231Service  = $crm0231Service;
        $this->areaService     = $areaService;
        $this->downloadService = $downloadService;
        //$this->middleware( 'permission:screen.crm0231' );
    }

    /**
     * @param Request $request
     */
    public function postInit(Request $request)
    {
        $listArea1 = $this->areaService->selectListArea1();
        $listArea2 = $this->areaService->selectListArea2();
        $result    = [
            'listArea1' => $listArea1,
            'listArea2' => $listArea2,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param            = $request->all();
        $param["sale_id"] = $this->getRoleSaleMan();
        $list             = $this->crm0231Service->selectList($param);

        return response()->success($list);
    }

    /**
     * @param Request $request
     */
    public function postDownload(Request $request)
    {
        // $this->requirePermission('screen.crm0910.download');

        $param            = $request->all();
        $param["sale_id"] = $this->getRoleSaleMan();
        //$result = $this->crm0231Service->download($param);
        $param['export'] = true;
        $data            = $this->crm0231Service->selectList($param);
        $paramDownload   = [
            "data"      => $data,
            "file_name" => "SanPhammChuaNhap",
            "view"      => "crm0231-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

}
