<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm2550Service;

/**
 * Crm2550Controller
 */
class Crm2550Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2550Service;

    /**
     * @param Crm2550Service $crm2550Service
     */
    public function __construct(Crm2550Service $crm2550Service)
    {
        $this->crm2550Service = $crm2550Service;
        //$this->middleware( 'permission:screen.crm2550' );
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
        $data   = $this->crm2550Service->selectList($param);
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
        // $this->requirePermission('screen.crm2530.download');
        $param           = $request->all();
        $param['export'] = true;
        $data            = $this->crm2550Service->selectList($param);
        $paramDownload   = [
            "data"      => $data,
            "file_name" => "TonKhoVatPham",
            "view"      => "crm2550-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

}
