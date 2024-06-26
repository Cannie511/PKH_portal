<?php

namespace App\Http\Controllers\Admin;

//use Auth;
use Log;
use Illuminate\Http\Request;
use App\Services\Hrm0300Service;
use App\Services\DownloadService;
use App\Services\EmployeeService;
use App\Services\SalesmanService;

/**
 * Hrm0130Controller
 * Danh sach task
 */
class Hrm0300Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    protected $hrm0300Service;
    /**
     * @var mixed
     */
    protected $salesmanService;

    /**
     * @param ETestService $eTestService
     */
    public function __construct(Hrm0300Service $hrm0300Service,
        SalesmanService $salesmanService,
        EmployeeService $employeeService,
        DownloadService $downloadService) {
        $this->hrm0300Service  = $hrm0300Service;
        $this->salesmanService = $salesmanService;
        $this->downloadService = $downloadService;
        $this->employeeService = $employeeService;
        $this->middleware('permission:screen.hrm0300');
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
    public function postLoadInit(Request $request)
    {
        $param                = $request->all();
        $param["acc_user_id"] = $this->getRoleForTask();
        // $users                = $this->hrm0300Service->selectUsers($param);
        $users  = $this->employeeService->getDropdownEmployee();
        $task   = null;
        $result = [
            'users' => $users,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param                = $request->all();
        $param["acc_user_id"] = $this->getRoleForTask();

// $param["sale_id"] = $this->getRoleSaleMan();
        if (1 == $param['index']) {
            $param["task_sts"] = 1;
        } elseif (2 == $param['index']) {
            $param["task_sts"] = 2;
        } elseif (3 == $param['index']) {
            $param["task_sts"] = 3;
        } else {
            $param["task_sts"] = 4;
        }

        if ($param['index'] < 5) {
            $data = $this->hrm0300Service->selectList($param);
        } else {
            $paramReport             = $param;
            $paramReport['task_sts'] = '1';

            $data1                   = $this->hrm0300Service->selectReportForm1($paramReport);
            $paramReport['task_sts'] = '2';

            $data2                   = $this->hrm0300Service->selectReportForm1($paramReport);
            $paramReport['task_sts'] = '3';

            $data3                   = $this->hrm0300Service->selectReportForm1($paramReport);
            $paramReport['task_sts'] = '4';

            $data4 = $this->hrm0300Service->selectReportForm1($paramReport);

            $data5 = $this->hrm0300Service->selectReportForm2($paramReport);
            $data6 = $this->hrm0300Service->selectReportForm21($paramReport);

            $data = [
                'data1' => $data1
                , 'data2' => $data2
                , 'data3' => $data3
                , 'data4' => $data4
                , 'data5' => $data5
                , 'data6' => $data6
            ];
        }

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postUpdate(Request $request)
    {
        $param = $request->all();
        // $user  = Auth::user();
        $user = $this->logonUser();

        $acc = $this->getRoleForTask();
        $oke = false;

        Log::info('postUpdate');
        Log::info($acc);
        Log::info($user);
        Log::info($param);

        if (isset($param["task_sts"])) {

            if (2 == $param["task_sts"]) {
                // Cho phép tất cả thành viên nhận task 
                if ($user->id == $param["user_id"]) {
                    $oke = true;
                    $this->hrm0300Service->updateSts($user, $param);
                }

            } elseif (3 == $param["task_sts"]) {

                if ($user->id == $param["user_id"]) {
                    $oke = true;
                    $this->hrm0300Service->updateStsFinish($user, $param);
                }

            } else {
                // Không cho chủ task chấm và chỉ có role hr, it, manager có thể chấm
                if (!$acc && $user->id != $param["user_id"]) {
                    $oke = true;
                    $this->hrm0300Service->updateStsScore($user, $param);
                } 
                // chỉ có người tạo ra task mới chấm được và người đó không là người tạo ra task 
                elseif ($acc == $param["created_by"] && $acc != $param["user_id"]) {
                    $oke = true;
                    $this->hrm0300Service->updateStsScore($user, $param);
                }

            }

        }

        $result = [
            'oke' => $oke,
        ];

        return response()->success($result);
    }

     /**
     * @param Request $request
     */
    public function postDownload(Request $request)
    {
        //$this->requirePermission('screen.crm0910.download');
        $param = $request->all();
        $data  = $this->hrm0300Service->selectList($param);
        Log::debug('dơnload task');
        Log::debug($data);
        // param: data, file name, sheet name, view file
        $paramDownload = [
            "data"      => $data,
            "file_name" => "task",
            "view"      => "hrm0300-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);
        Log::debug('dơnload task');
        Log::debug($result);
        return response()->success($result);
    }

}
