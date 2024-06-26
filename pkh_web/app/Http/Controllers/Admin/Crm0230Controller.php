<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\AreaService;
use App\Services\Crm0230Service;
use App\Services\DownloadService;

// use App\Services\SalesmanService;

/**
 * Crm0230Controller
 */
class Crm0230Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0230Service;

    /**
     * @param Crm0230Service $crm0230Service
     * @param AreaService $areaService
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm0230Service $crm0230Service,
        AreaService $areaService,
        DownloadService $downloadService
    ) {
        $this->crm0230Service  = $crm0230Service;
        $this->areaService     = $areaService;
        $this->downloadService = $downloadService;
        // $this->middleware( 'permission:screen.crm0230' );
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
        $param = $request->all();
        //Log::debug($param);
        $param["sale_id"] = $this->getRoleSaleMan();
        $list             = $this->crm0230Service->selectStoreList($param);

        return response()->success($list);
    }

    /**
     * @param Request $request
     */
    public function postDownload(Request $request)
    {
        //  $this->requirePermission('screen.crm0230.download');
        $param            = $request->all();
        $param["sale_id"] = $this->getRoleSaleMan();
        //$result = $this->crm0230Service->download($param);
        $param["download"] = 1;
        $data              = $this->crm0230Service->selectStoreList($param);
        $paramDownload     = [
            "data"      => $data,
            "file_name" => "SanPhamDaGiao",
            "view"      => "crm0230-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

}
