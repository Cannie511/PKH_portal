<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Services\Mobile\UserService;
use App\Services\Mobile\AttendanceService;

/**
 * StoreController
 */
class UserController extends MobileBaseController
{
    /**
     * @var mixed
     */
    private $userService;
    /**
     * @var mixed
     */
    private $ipService;

    /**
     * @param UserService $userService
     */
    public function __construct(
        UserService $userService,
        AttendanceService $attendanceService
    ) {
        $this->userService       = $userService;
        $this->attendanceService = $attendanceService;
        //$this->middleware( 'permission:screen.cms0210' );
    }

    /**
     * @param Request $request
     */
    public function getListUser(Request $request)
    {
        $param  = $request->all();
        $result = $this->userService->selectList($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function getUser(Request $request)
    {
        $param  = $request->all();
        $result = $this->userService->selectById($param);

        return response()->success($result);
    }

    /**
     * Checkin
     *
     * @param Request $request
     * @return void
     */
    public function postCheckin(Request $request)
    {
        $agent = $request->header('User-Agent');
        $ip    = $this->getIp($request);

        $param          = $request->all();
        $param["agent"] = $agent;
        $param["ip"]    = $ip;

        $result = $this->attendanceService->checkin($param);

        return response()->success($result);
    }

    /**
     * Checkout
     *
     * @param Request $request
     * @return void
     */
    public function postCheckout(Request $request)
    {
        $agent = $request->header('User-Agent');
        $ip    = $this->getIp($request);

        $param          = $request->all();
        $param["agent"] = $agent;
        $param["ip"]    = $ip;

        $result = $this->attendanceService->checkout($param);

        return response()->success($result);
    }

}
