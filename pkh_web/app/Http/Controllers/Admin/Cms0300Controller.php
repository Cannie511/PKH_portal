<?php

namespace App\Http\Controllers\Admin;

use Log;
use Illuminate\Http\Request;
use App\Services\Cms0300Service;
use App\Services\OaZaloService;

/**
 * Cms0300Controller
 */
class Cms0300Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $cms0300Service;

    protected $oaZaloService;

     /**
     * @param Cms0300Service $cms0210Service
     */
    public function __construct(Cms0300Service $cms0300Service,
                                OaZaloService $oaZaloService)
    {
        $this->cms0300Service        = $cms0300Service;
        $this->oaZaloService         = $oaZaloService;
        //$this->middleware( 'permission:screen.cms0210' );
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
        $data  = $this->cms0300Service->selectList($param);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postUpdateFollowers(Request $request)
    {
        $param  = $request->all();
        $result = [];
        $data = $this->oaZaloService->getDetailFollowers();
        $res  = $this->cms0300Service->updateFollowers($data);
        Log::debug("----Upload controller -------");
        Log::debug($data);
        return response()->success($result);
    }
}