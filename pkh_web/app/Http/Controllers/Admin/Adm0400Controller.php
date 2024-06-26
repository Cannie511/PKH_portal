<?php

namespace App\Http\Controllers\Admin;

use Artisan;
use Illuminate\Http\Request;
use App\Services\Adm0400Service;

/**
 * Adm0400Controller
 */

class Adm0400Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $adm0400Service;

    /**
     * @param Adm0400Service $adm0400Service
     */
    public function __construct(Adm0400Service $adm0400Service)
    {
        $this->adm0400Service = $adm0400Service;
        //$        this->middleware( 'permission:screen.adm0400' );
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
    public function postRun(Request $request)
    {
        $text    = $request->get("cmd");
        $listCmd = explode("\n", $text);

        $exitCode = 1;

        foreach ($listCmd as $cmd) {
            $listArg = preg_split('/\s+/', $cmd);

            $params = [];

            if (!empty($listArg) && count($listArg) > 1) {

                for ($i = 1; $i < count($listArg); $i++) {
                    $arr             = explode("=", $listArg[$i]);
                    $params[$arr[0]] = $arr[1];
                }

            }

            $exitCode &= Artisan::queue($listArg[0], $params);
        }

        $result = [
            'rtnCd' => $exitCode,
        ];

        // ob_clean();

        return response()->success($result);

    }

    /**
     * @param Request $request
     */
    public function postClean(Request $request)
    {

        $type = $request->get("type");

        $exitCode = 1;

        switch ($type) {
            case "route":
                $exitCode &= Artisan::queue("route:clear");
                break;
            case "config":
                $exitCode &= Artisan::queue("config:clear");
                break;
            case "cache":
                $exitCode &= Artisan::queue("cache:clear");
                break;
            case "view":
                $exitCode &= Artisan::queue("view:clear");
                break;
            case "all":
                $exitCode &= Artisan::queue("route:clear");
                $exitCode &= Artisan::queue("config:clear");
                $exitCode &= Artisan::queue("cache:clear");
                $exitCode &= Artisan::queue("view:clear");
                break;
            default:
        }

        $result = [
            'rtnCd' => $exitCode,
        ];

        // ob_clean();

        return response()->success($result);
    }

}
