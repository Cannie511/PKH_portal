<?php

namespace App\Http\Controllers\Admin;

//use Auth;
use Illuminate\Http\Request;
use App\Services\AbsentService;

/**
 * Hrm0120Controller
 * Danh sach duyet don
 */
class Hrm0100Controller extends AdminBaseController
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
        // $this->middleware('permission.hrm0120');
    }

    /**
     * Get all users.
     *
     * @return JSON
     */
    public function postSearch(Request $request)
    {
        $param       = $request->all();
        $listAbsent  = $this->absentService->searchForCalendar($param);
        $listHoliday = $this->absentService->searchHolidayForCalendar($param);

        $data = [
            "listAbsent"  => $listAbsent,
            "listHoliday" => $listHoliday,
        ];

        return response()->success($data);
    }
}
