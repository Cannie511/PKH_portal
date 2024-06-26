<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Services\Crm1710Service;

/**
 * Crm1710Controller
 */
class Crm1710Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1710Service;

    /**
     * @param Crm1710Service $crm1710Service
     */
    public function __construct(Crm1710Service $crm1710Service)
    {
        $this->crm1710Service = $crm1710Service;
        //$this->middleware( 'permission:screen.crm1710' );
    }

    /**
     * @param Request $request
     */
    public function postSave(Request $request)
    {

        $param = $request->all();
        $user  = Auth::user();

        $promotion_id = $this->crm1710Service->savePromotion($user, $param);

        return response()->success($promotion_id);

    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {

        $param = $request->all();

        $inforPromotion = null;

        if (isset($param['promotion_id'])) {
            $inforPromotion = $this->crm1710Service->selectPromotion($param);
        }

        $result = [

            'inforPromotion' => $inforPromotion,
        ];

        return response()->success($result);

    }

}
