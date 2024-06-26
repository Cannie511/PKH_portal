<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Hrm0310Service;
use App\Services\EmployeeService;

/**
 * Crm0710Controller
 */
class Hrm0310Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0310Service;

    /**
     * @param Hrm0310Service $hrm0310Service
     */
    public function __construct(
        Hrm0310Service $hrm0310Service,
        EmployeeService $employeeService
    ) {
        $this->hrm0310Service  = $hrm0310Service;
        $this->employeeService = $employeeService;
        $this->middleware('permission:screen.hrm0310');
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
    public function postLoadInit(Request $request)
    {
        $param = $request->all();
        // $users = $this->hrm0310Service->selectUsers($param);
        $users = $this->employeeService->getDropdownEmployee();
        $task  = null;

        if (isset($param['task_id'])) {
            $task = $this->hrm0310Service->selectTask($param);
        }

        $result = [
            'users' => $users,
            'task'  => $task,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSave(Request $request)
    {
        $param   = $request->all();
        $user    = $this->logonUser();
        $task_id = $this->hrm0310Service->saveTask($user, $param);
        $result  = [
            'task_id' => $task_id,
        ];

        return response()->success($task_id);
    }

}
