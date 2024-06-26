<?php

namespace App\Http\Controllers\Admin;

class AngularController extends AdminBaseController
{
    /**
     * Serve the angular application.
     *
     * @return JSON
     */
    public function serveApp()
    {
        return view($this->viewFolder . 'index');
    }

    /**
     * Page for unsupported browsers.
     *
     * @return JSON
     */
    public function unsupported()
    {
        return view($this->viewFolder . 'unsupported_browser');
    }
}
