<?php

namespace App\Http\Controllers\Admin;

use Log;
use Illuminate\Http\Request;
use App\Services\OaZaloService;
use App\Services\Cms0400Service;
use App\Services\ESMS\Esms;
/**
 * Cms0300Controller
 */
class Cms0400Controller extends AdminBaseController
{
    /**
     * @var mixed
     */

    protected $esms;
    protected $oaZaloService;
    private $cms0400Service;
     /**
     * @param Cms0300Service $cms0210Service
     */
    public function __construct(Cms0400Service $cms0400Service,
                                Esms $esms,
                                OaZaloService $oaZaloService)
    {
        $this->oaZaloService         = $oaZaloService;
        $this->esms                  = $esms;
        $this->cms0400Service        = $cms0400Service;
        $this->middleware( 'permission:screen.cms0400' );
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
        $data  = $this->cms0400Service->selectListEsms($param);
        Log::debug("data esms");
        Log::debug($data);
        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

  
}