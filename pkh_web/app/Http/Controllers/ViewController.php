<?php

namespace App\Http\Controllers;

class ViewController extends Controller
{
    /**
     * Serve the angular application.
     *
     * @return JSON
     */
    public function view($viewName)
    {
        $viewName = "views." . $viewName;

        if (view()->exists($viewName)) {
            return view($viewName);
        }

        abort(404);
    }

}
