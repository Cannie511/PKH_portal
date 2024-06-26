<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Cms0200Service;

/**
 * Cms0200Controller
 */
class Cms0200Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $cms0200Service;

    /**
     * @param Cms0200Service $cms0200Service
     */
    public function __construct(Cms0200Service $cms0200Service)
    {
        $this->cms0200Service = $cms0200Service;
        $this->middleware('permission:screen.cms0200');
    }

    /**
     * Search news
     *
     * @param Request $request
     * @return void
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $data  = $this->cms0200Service->selectList($param);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    /**
     * Search news
     *
     * @param Request $request
     * @return void
     */
    public function postEdit(Request $request)
    {
        $param = $request->all();
        $data  = $this->cms0200Service->updateStatus($param);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

}
