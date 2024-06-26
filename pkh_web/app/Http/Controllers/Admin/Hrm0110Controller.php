<?php

namespace App\Http\Controllers\Admin;

//use Auth;
use JWTAuth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\AbsentService;

/**
 * Crm0110Controller
 * Danh muc san pham danh cho nhan vien ban hang
 */
class Hrm0110Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    protected $absentService;

    /**
     * @param AbsentService $absentService
     */
    public function __construct(AbsentService $absentService)
    {
        $this->absentService = $absentService;
        $this->middleware('permission:screen.hrm0110');
    }

    /**
     * Init data
     *
     * @param Request $request
     * @return void
     */
    public function postInit(Request $request)
    {
        $user           = JWTAuth::toUser();
        $listAllocation = $this->absentService->selectAllocationByEmployee($user->id);

        $result = [
            "listAllocation" => $listAllocation,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSave(Request $request)
    {
        $param = $request->all();
        $today = Carbon::yesterday()->format('Y-m-d');
        $this->validate($request, [
            'dayOffDate'          => 'required|date_format:Y-m-d|after:' . $today,
            'dayOffType'          => 'required|in:1,2,3',
            'leave_type'          => 'required|in:1,2',
            'leave_allocation_id' => 'numeric',
            'reason'              => 'required|max:1024',
        ],
            [],
            [
                'dayOffDate'          => 'Ngày nghỉ',
                'dayOffType'          => 'Loại nghỉ',
                'reason'              => 'Lý do',
                'leave_allocation_id' => 'Ngày phép',
            ]
        );

        $user = JWTAuth::toUser();

        $param = [
            'user_id'             => $user->id,
            'absent_date'         => $request->get('dayOffDate'),
            'absent_type'         => $request->get('dayOffType'),
            'leave_type'          => $request->get('leave_type'),
            'reason'              => $request->get('reason'),
            'leave_allocation_id' => $request->get('leave_allocation_id'),
        ];

        $result = $this->absentService->regisAbsent($param);

        return response()->success($result);
    }

    public function postList()
    {
        $user = JWTAuth::toUser();

        $param = [
            "user_id" => $user->id,
        ];
        $list = $this->absentService->getListOfUser($param);

        return response()->success($list);
    }
}
