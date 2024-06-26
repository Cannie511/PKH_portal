<?php
namespace App\Http\Controllers\Frontend;

use Mail;
use Input;
use Request;
use App\Http\Controllers\Frontend\FrontendController;

/**
 * Contact Page Controller
 */
class ContactController extends FrontendController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Load page.
     *
     * @return Response
     */
    public function index()
    {
        return view($this->viewFolder . $this->currentTheme . '.pages.lien-he', ['sended' => '0']);
    }

    /**
     * Load page.
     *
     * @return Response
     */
    public function send()
    {
        // Send mail
        $param = Input::all();
        $that  = $this;

        $param['ip']    = Request::ip();
        $param['agent'] = Request::header('User-Agent');
        Mail::queue('frontend.emails.contact_mail', ['param' => $param], function ($m) use ($that, $param) {
            $m->from('no-reply@phankhangco.com', 'PKH Automation');

            $m->to(['anh.phan@phankhangco.com', 'chien.phan@phankhangco.com', env('MAIL_CONTACT_TO', 'cuong.nguyen@phankhangco.com')], '[PKH-INFO]')->subject('[PHK-Web] Contact from ' . $param['email']);
        });

        return view($this->viewFolder . $this->currentTheme . '.pages.lien-he', ['sended' => '1']);
    }
}
