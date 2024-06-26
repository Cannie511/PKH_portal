<?php

namespace App\Http\Controllers\Admin;

use Input;
use Illuminate\Http\Request;
use App\Services\Crm2600Service;
use App\Services\Crm2601Service;
use App\Services\DownloadService;

/**
 * Crm2600Controller
 */
class Crm2600Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2600Service;
    /**
     * @var mixed
     */
    private $crm2601Service;

    /**
     * @param Crm2600Service $crm2600Service
     * @param Crm2601Service $crm2601Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm2600Service $crm2600Service,
        Crm2601Service $crm2601Service,
        DownloadService $downloadService
    ) {
        $this->crm2600Service  = $crm2600Service;
        $this->crm2601Service  = $crm2601Service;
        $this->downloadService = $downloadService;
        // $this->middleware('permission:screen.crm2600');
    }

    /**
     * Load store
     *
     * @param Request $request
     * @return void
     */
    public function postLoad(Request $request)
    {
        $store_id   = $request->input('store_id', 0);
        $store      = $this->crm2600Service->selectStore($request->all());
        $signatures = $this->crm2600Service->selectStoreSign($store_id);

        $result               = [];
        $result["store"]      = $store;
        $result["signatures"] = $signatures;

        return response()->success($result);
    }

    /**
     * Load store
     *
     * @param Request $request
     * @return void
     */
    public function postReview(Request $request)
    {
        $this->requirePermission('screen.crm2600.review');
        $this->validate($request, [
            'store_id'      => 'required|numeric|min:1',
            'type'          => 'required|numeric|min:0|max:2',
            'review_expired_date' => 'required|date_format:Y-m-d'
        ]);

        $param  = $request->all();
        $result = $this->crm2600Service->reviewStore($param);

        return response()->success($result);
    }

}
