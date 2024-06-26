<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Services\StoreService;
use App\Services\Crm0510Service;
use App\Services\DownloadService;

class Crm0510Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    protected $crm0510Service;
    /**
     * @var mixed
     */
    protected $salesmanService;
    /**
     * @var mixed
     */
    protected $storeService;

    /**
     * @param Crm0510Service $crm0510Service
     * @param DownloadService $downloadService
     * @param StoreService $storeService
     */
    public function __construct(
        Crm0510Service $crm0510Service,
        DownloadService $downloadService,
        StoreService $storeService
    ) {
        $this->crm0510Service = $crm0510Service;
        $this->storeService   = $storeService;

    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {
        $param   = $request->all();
        $store   = $this->storeService->selectStoreById($param['store_id']);
        $inforCS = null;

        if (isset($param['cs_id'])) {
            $inforCS = $this->crm0510Service->selectCSNotes($param);
        }

        $result = [
            'store'   => $store,
            'inforCs' => $inforCS,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSave(Request $request)
    {
        $param    = $request->all();
        $user     = Auth::user();
        $store_id = $this->crm0510Service->saveCSNotes($user, $param);
        $result   = [
            'store_id' => $store_id,
        ];

        return response()->success($store_id);
    }

    /**
     * @param Request $request
     */
    public function postUpdate(Request $request)
    {
        $param  = $request->all();
        $user   = Auth::user();
        $ok     = $this->crm0510Service->updateCSNotes($user, $param);
        $result = [
            'oke' => $ok,
        ];

        return response()->success($result);
    }

}
