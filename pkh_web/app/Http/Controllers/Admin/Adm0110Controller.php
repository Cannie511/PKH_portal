<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Services\Adm0110Service;

class Adm0110Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $adm0110Service;

    /**
     * @param Adm0110Service $adm0110Service
     */
    public function __construct(Adm0110Service $adm0110Service)
    {
        $this->adm0110Service = $adm0110Service;
        //$this->middleware( 'permission:screen.adm0110' );
    }

    /**
     * @param Request $request
     */
    public function postIndex(Request $request)
    {
        $param = $request->all();
        $user  = Auth::user();

        $UserId = $this->adm0110Service->createUser($user, $param);
        $result = [
            'rtnCd'  => 'OK',
            'UserId' => $UserId,
        ];

        return response()->success($result);
    }

}
