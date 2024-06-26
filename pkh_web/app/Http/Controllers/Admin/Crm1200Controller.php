<?php

namespace App\Http\Controllers\Admin;

use Log;
use Illuminate\Http\Request;
use App\Services\Crm1200Service;
use App\Services\DownloadService;

/**
 * Crm1200Controller
 */
class Crm1200Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1200Service;

    /**
     * @param Crm1200Service $crm1200Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm1200Service $crm1200Service,
        DownloadService $downloadService
    ) {
        $this->crm1200Service  = $crm1200Service;
        $this->downloadService = $downloadService;
        //$this->middleware( 'permission:screen.crm1200' );
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $data  = $this->crm1200Service->selectListBankAccount($param);
        Log::debug('search bank account ---------------------------------------');
        Log::debug($data);

        return response()->success($data);
    }

    /**
     * @param Request $request
     */
    public function postDownload(Request $request)
    {
        //$this->requirePermission('screen.crm0910.download');

        $param = $request->all();
        //$result = $this->crm1200Service->download($param);
        $data          = $this->crm1200Service->selectListBankAccount($param);
        $paramDownload = [
            "data"      => $data,
            "file_name" => "BankAccount",
            "view"      => "crm1200-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

}
