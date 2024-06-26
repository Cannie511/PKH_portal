<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Rpt0510Service;

/**
 * Rpt0510Controller
 */
class Rpt0510Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $rpt0510Service;

    /**
     * @param Rpt0510Service $rpt0510Service
     */
    public function __construct(Rpt0510Service $rpt0510Service)
    {
        $this->rpt0510Service = $rpt0510Service;
        $this->middleware('permission:screen.rpt0510');
    }

    /**
     * Get all users.
     *
     * @return JSON
     */

    public function postSearch(Request $request)
    {
        $param  = $request->all();
        $result = [];

        for ($i = 0; $i <= 5; $i++) {
            array_push($result, $this->rpt0510Service->makeList($param, $i));
        }

        $table2 = [
            'data'   => $this->rpt0510Service->makeList2(),
            'header' => ["Time", "Level1", "Level2", "Level3", "Level4", "Level5"],
        ];

        $resultBig = [
            'table1' => $result,
            'table2' => $table2,
        ];

        return response()->success($resultBig);
    }

}
