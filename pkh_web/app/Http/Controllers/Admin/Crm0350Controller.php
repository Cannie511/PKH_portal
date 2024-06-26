<?php

namespace App\Http\Controllers\Admin;

use Log;
use Illuminate\Http\Request;
use App\Services\AreaService;
use App\Services\Crm0350Service;

/**
 * Crm0350Controller
 */
class Crm0350Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0350Service;
    /**
     * @var mixed
     */
    protected $areaService;

    /**
     * @param Crm0350Service $crm0350Service
     * @param AreaService $areaService
     */
    public function __construct(
        Crm0350Service $crm0350Service
        ,
        AreaService $areaService
    ) {
        $this->crm0350Service = $crm0350Service;
        $this->areaService    = $areaService;
        //$this->middleware( 'permission:screen.crm0350' );
        $this->middleware('permission:screen.crm0300');
    }

    /**
     * @param Request $request
     */
    public function postInit(Request $request)
    {
        $listAreaGroup = $this->areaService->selectListAreaGroup();
        $listArea1     = $this->areaService->selectListArea1();
        $listArea2     = $this->areaService->selectListArea2();

        $result = [
            'listAreaGroup' => $listAreaGroup,
            'listArea1'     => $listArea1,
            'listArea2'     => $listArea2,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $list  = $this->crm0350Service->selectChanhList($param);
        Log::debug('---------------check chanh list-------');
        Log::debug($list);

        return response()->success($list);
    }
}
