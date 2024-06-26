<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Hrm0140Service;

/**
 * Hrm0140Controller
 */
class Hrm0140Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0140Service;

    /**
     * @param Hrm0140Service $hrm0140Service
     */
    public function __construct(Hrm0140Service $hrm0140Service)
    {
        $this->hrm0140Service = $hrm0140Service;
        //$this->middleware( 'permission:screen.hrm0140' );
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $list  = $this->hrm0140Service->selectList($param);

        return response()->success($list);
    }

    /**
     * @param Request $request
     */
    public function postInit(Request $request)
    {
        $listStaff = $this->hrm0140Service->getListOfUser();
        $result    = [
            'listStaff' => $listStaff,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postDownload(Request $request)
    {
        //$this->requirePermission('screen.crm0910.download');

        $param  = $request->all();
        $result = $this->hrm0140Service->download($param);

        return response()->success($result);
    }

}
