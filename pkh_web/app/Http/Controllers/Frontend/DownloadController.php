<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class DownloadController extends Controller
{
    /**
     * @param $token
     */
    public function getDownloadOneTime($token)
    {
        dd($token);
    }
}
