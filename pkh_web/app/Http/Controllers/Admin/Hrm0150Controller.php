<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Hrm0150Service;

/**
 * Hrm0150Controller
 */
class Hrm0150Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0150Service;

    /**
     * @param Hrm0150Service $hrm0150Service
     */
    public function __construct(Hrm0150Service $hrm0150Service)
    {
        $this->hrm0150Service = $hrm0150Service;
        $this->middleware('permission:screen.hrm0150');
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $data  = $this->hrm0150Service->getLastPosData($param);

        $result = [
            'lastPos' => $data,
        ];

        return response()->success($result);
    }

}
