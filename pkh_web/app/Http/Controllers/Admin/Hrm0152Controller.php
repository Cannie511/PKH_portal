<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\Hrm0152Service;

/**
 * Hrm0152Controller
 */
class Hrm0152Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0152Service;

    /**
     * @param UserService $userService
     * @param Hrm0152Service $hrm0152Service
     */
    public function __construct(
        UserService $userService,
        Hrm0152Service $hrm0152Service
    ) {
        $this->userService    = $userService;
        $this->hrm0152Service = $hrm0152Service;
        $this->middleware('permission:screen.hrm0152');
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
        $param    = $request->all();
        $checkins = $this->hrm0152Service->getList($param);
        $images   = $this->hrm0152Service->getImages($checkins);

        $result = [
            'checkins' => $checkins,
            'images'   => $images,
        ];

        return response()->success($result);
    }

}
