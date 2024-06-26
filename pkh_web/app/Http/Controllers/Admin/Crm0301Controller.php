<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm0301Service;

/**
 * Crm0301Controller
 */
class Crm0301Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0301Service;

    /**
     * @param Crm0301Service $crm0301Service
     */
    public function __construct(Crm0301Service $crm0301Service)
    {
        $this->crm0301Service = $crm0301Service;
        $this->middleware('permission:screen.crm0301');
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
        $data  = $this->crm0301Service->getList($param);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

}
