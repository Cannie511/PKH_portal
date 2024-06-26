<?php namespace App\Http\Controllers\Frontend;

use Illuminate\Routing\Controller as BaseController;

/**
 * Load Page Controller
 */
class FrontendController extends BaseController
{
    /**
     * @var string
     */
    protected $viewFolder = "frontend.";

    /**
     * Frontend theme
     *
     * @var string
     */
    protected $currentTheme = "theme2";
}
