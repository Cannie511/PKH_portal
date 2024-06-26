<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Hrm1021Service;
use App\Services\DownloadService;

/**
 * Hrm1021Controller
 */
class Hrm1021Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm1021Service;

    /**
     * @param Hrm1021Service $hrm1021Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Hrm1021Service $hrm1021Service,
        DownloadService $downloadService
    ) {
        $this->hrm1021Service  = $hrm1021Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.hrm1021');
    }

    /**
     * Load data
     *
     * @param Request $request
     * @return void
     */
    public function postLoad(Request $request)
    {
        $param = $request->all();
        $data  = $this->hrm1021Service->selectById($param['id']);
        $this->hrm1021Service->updateRead($param['id']);
        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

}
