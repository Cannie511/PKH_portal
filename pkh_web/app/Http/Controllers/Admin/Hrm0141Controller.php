<?php

namespace App\Http\Controllers\Admin;

use Log;
use Artisan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\Hrm0141Service;
use App\Services\DownloadService;
use App\Services\EmployeeService;

/**
 * Hrm0141Controller
 */
class Hrm0141Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $userService;
    /**
     * @var mixed
     */
    private $hrm0141Service;

    /**
     * @param UserService $userService
     * @param Hrm0141Service $hrm0141Service
     * @param EmployeeService $employeeService
     */
    public function __construct(
        UserService $userService,
        Hrm0141Service $hrm0141Service,
        EmployeeService $employeeService,
        DownloadService $downloadService
    ) {
        $this->userService     = $userService;
        $this->hrm0141Service  = $hrm0141Service;
        $this->employeeService = $employeeService;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.hrm0141');
    }

    /**
     * Init page
     *
     * @param Request $request
     * @return void
     */
    public function postInit(Request $request)
    {
        // $users  = $this->userService->getListUserDropDownList();
        $users  = $this->employeeService->getDropdownEmployee();
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
        $data  = $this->hrm0141Service->selectList($param);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
    public function postSearchAll(Request $request)
    {
        $param = $request->all();
        $data  = $this->hrm0141Service->selectListAll($param);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    /**
     * Execute
     *
     * @param Request $request
     * @return void
     */
    public function postExecute(Request $request)
    {
        $fromDate = substr($request->get('month'), 0, 8) . '-01';
        $toDate   = Carbon::createFromFormat('Y-m-d', $fromDate)->endOfMonth()->format('Y-m-d');

        $params = [
            "--fromDate" => $fromDate,
            "--toDate"   => $toDate,
        ];

        Log::info($params);

        // Artisan::queue('BAT0410', $params);
        Artisan::queue('BAT0420', $params);

        return response()->success([]);
    }

    /**
     * @param Request $request
     */
    public function postDownload(Request $request)
    {
        $param = $request->only("month");

        $result = $this->hrm0141Service->download($param);

        return response()->success($result);
    }

}
