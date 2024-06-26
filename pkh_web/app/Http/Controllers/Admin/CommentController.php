<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Input;
use Validator;
use Log;
use Carbon\Carbon;

use App\Services\CommentService;
use App\Services\DownloadService;

/**
 * CommentController
 */
class CommentController extends AdminBaseController
{    
    private $commentService;

    public function __construct(CommentService $commentService, DownloadService $downloadService){
        $this->commentService = $commentService;
        $this->downloadService = $downloadService;
        //$this->middleware('permission:screen.comment');
    }

    /**
     * Load init data
     *
     * @param Request $request
     * @return void
     */
    public function postInitData(Request $request) {
        // $param = $request->all();
        // $listEmployee = $this->employeeService->getDropdownEmployee();
        // $result = [
        //     'listEmployee' => $listEmployee
        // ];
        // return response()->success($result);
        return response()->success([]);
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
    public function list(Request $request) {
        $param = $request->all();
        $data = $this->commentService->selectList($param);
        return response()->success($data);
    }

}
