<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\Hrm0151Service;

/**
 * Hrm0151Controller
 */
class Hrm0151Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0151Service;

    /**
     * @param UserService $userService
     * @param Hrm0151Service $hrm0151Service
     */
    public function __construct(
        UserService $userService,
        Hrm0151Service $hrm0151Service
    ) {
        $this->userService    = $userService;
        $this->hrm0151Service = $hrm0151Service;
        $this->middleware('permission:screen.hrm0151');
    }

    /**
     * Init page
     *
     * @param Request $request
     * @return void
     */
    public function postInit(Request $request)
    {
        $users  = $this->userService->getListUserDropDownList();
        $result = [
            'users' => $users,
        ];

        return response()->success($result);
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
        $data  = $this->hrm0151Service->getPosData($param);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

}
