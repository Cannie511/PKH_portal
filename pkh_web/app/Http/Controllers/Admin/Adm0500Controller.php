<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Adm0500Service;
use App\Services\DownloadService;

/**
 * Adm0500Controller
 */
class Adm0500Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $adm0500Service;

    /**
     * @param Adm0500Service $adm0500Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Adm0500Service $adm0500Service,
        DownloadService $downloadService
    ) {
        $this->adm0500Service  = $adm0500Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:admin.adm0500');
    }

    /**
     * Save
     *
     * @param Request $request
     * @return void
     */
    public function postLoad(Request $request)
    {
        $formId = $request->all()["formId"];
        $data   = $this->adm0500Service->load($formId);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    /**
     * Save
     *
     * @param Request $request
     * @return void
     */
    public function postSave(Request $request)
    {
        $param = $request->all();
        $data  = $this->adm0500Service->save($param);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

}
