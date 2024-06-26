<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Hrm0714Service;
use App\Services\DownloadService;

/**
 * Hrm0714Controller
 */
class Hrm0714Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0714Service;

    /**
     * @param Hrm0714Service $hrm0714Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Hrm0714Service $hrm0714Service,
        DownloadService $downloadService
    ) {
        $this->hrm0714Service  = $hrm0714Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.hrm0714');
    }

    /**
     * Save
     *
     * @param Request $request
     * @return void
     */
    public function postSave(Request $request)
    {

        $this->validate($request, [
            'employee_code'          => 'required|max:16',
            'fullname'               => 'required|max:128',
            'title'                  => 'max:128',
            'count_dependent_person' => 'min:0|max:10',
            'devision'               => 'max:128',
            'address_permernance'    => 'max:512',
            'address_contact'        => 'max:512',
            'card_id'                => 'max:32',
            'card_id_issue_at'       => 'max:64',
            'tax_number'             => 'max:32',
            'social_number'          => 'max:32',
            'home_phone'             => 'max:32',
            'tel1'                   => 'max:32',
            'tel2'                   => 'max:32',
            'nationality'            => 'max:32',
            'dob'                    => 'required|date|date_format:Y-m-d',
            'card_id_issue_on'       => 'date|date_format:Y-m-d',
            'probation_start_date'   => 'date|date_format:Y-m-d',
            'probation_end_date'     => 'date|date_format:Y-m-d',
            'start_date'             => 'date|date_format:Y-m-d',
            'end_date'               => 'date|date_format:Y-m-d',
        ]);

        $param = $request->all();
        $data  = $this->hrm0714Service->save($param);

        return response()->success($data);
    }

}
