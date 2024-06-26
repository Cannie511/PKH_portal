<?php namespace App\Http\Controllers\Frontend;

use View;
use App\Services\FuncConfService;
use App\Http\Controllers\Frontend\FrontendController;

/**
 * Load Page Controller
 */
class PageController extends FrontendController
{
    /**
     * @var mixed
     */
    protected $funcConfService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FuncConfService $funcConfService)
    {
        $this->middleware('guest');
        $this->funcConfService = $funcConfService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function home()
    {

// Send notify mail

// $mailParam = [

//     'name' => '1111',

//     'mail' => 'cuong.nguyen@phankhangco.com',

//     'type' => '1',

//     'date' => '2017-04-06'

// ];

// Mail::queue('admin.emails.absent_notify', ['param' => $mailParam], function ($m) use ($mailParam){

//     $emails = ['cuong.nguyen@phankhangco.com'];

//     $m->from('no-reply@phankhangco.com', 'PKH Automation');

//     $m->to($emails, '[PKH-INFO]')->subject('[ABSENT 111] ' . date('Y-m-d H:i:s') . ' ' . $mailParam['name'] . ' ' . $mailParam['date'] . ' ' . $mailParam['type'] );
        // });

        $result = [
            'cms_home_marquee'   => $this->funcConfService->selectByKey(FuncConfService::CMS_HOME_MARQUEE, 'txt_val'),
            'cms_home_marquee_2' => $this->funcConfService->selectByKey(FuncConfService::CMS_HOME_MARQUEE_2, 'txt_val'),
        ];

        // return view($this->viewFolder . 'pages.home', $result);

        return view($this->viewFolder . 'pages.home', $result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug)
    {
        // TODO: return view here
        $viewPage = $this->viewFolder . 'pages.' . $slug;

        if (View::exists($viewPage)) {
            return view($viewPage);
        }

//return $slug;
        //
        abort(404);
    }

}
