<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm2601Service;
use App\Services\DownloadService;

/**
 * Crm2601Controller
 */
class Crm2601Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2601Service;

    /**
     * @param Crm2601Service $crm2601Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm2601Service $crm2601Service,
        DownloadService $downloadService
    ) {
        $this->crm2601Service  = $crm2601Service;
        $this->downloadService = $downloadService;
        // $this->middleware('permission:screen.crm2601');
    }

    /**
     * Load store
     *
     * @param Request $request
     * @return void
     */
    public function postLoad(Request $request)
    {
        $store = $this->crm2601Service->selectStore($request->all());

        $result          = [];
        $result["store"] = $store;

        return response()->success($result);
    }
}
