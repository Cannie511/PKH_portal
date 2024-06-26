<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm1830Service;
use App\Services\Rpt0100Service;
use App\Services\Rpt0516Service;

/**
 * Rpt0516Controller
 */
class Rpt0516Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $rpt0516Service;
    /**
     * @var mixed
     */
    protected $rpt0100Service;
    /**
     * @var mixed
     */
    private $crm1830Service;

    /**
     * @param Rpt0516Service $rpt0516Service
     * @param Rpt0100Service $rpt0100Service
     * @param Crm1830Service $crm1830Service
     */
    public function __construct(
        Rpt0516Service $rpt0516Service,
        Rpt0100Service $rpt0100Service,
        Crm1830Service $crm1830Service
    ) {
        $this->rpt0516Service = $rpt0516Service;
        $this->rpt0100Service = $rpt0100Service;
        $this->crm1830Service = $crm1830Service;
        $this->middleware('permission:screen.rpt0516');
    }

    public function postInit()
    {
        // Get list year
        $listYear = $this->rpt0100Service->selectListYear();
        $result   = [
            'listYear' => $listYear,
        ];

        return response()->success($result);
    }

    /**
     * @param $data
     * @return mixed
     */
    private function sort($data)
    {
        $n = count($data);

        for ($i = 0; $i < $n - 1; $i++) {

            for ($j = $i + 1; $j < $n; $j++) {

                if ($data[$i][13] < $data[$j][13]) {
                    $temp     = $data[$i];
                    $data[$i] = $data[$j];
                    $data[$j] = $temp;
                }

            }

        }

        return $data;
    }

    /**
     * @param $flag
     * @param $item
     * @return mixed
     */
    private function getId(
        $flag,
        $item
    ) {

        if (1 == $flag) {
            return $item->cost_cat_id;
        }

        if (2 == $flag) {
            return $item->department_id;
        }

        return null;
    }

    /**
     * @param $flag
     * @param $title
     * @param $listHeader
     * @param $listData
     * @return mixed
     */
    private function processData(
        $flag,
        $title,
        $listHeader,
        $listData
    ) {

        $header = [];

        for ($i = 0; $i < 14; $i++) {

            if (0 == $i) {
                $str = $title;
            } elseif ($i < 13) {
                $str = "Tháng " . $i;
            } else {
                $str = "Total";
            }

            array_push($header, $str);
        }

        //init

        $data = [];

        for ($i = 0; $i < count($listHeader); $i++) {
            $item = [];

            $index   = $this->getId($flag, $listHeader[$i]);
            $item[0] = $listHeader[$i]->name;

            for ($j = 1; $j < 14; $j++) {
                $item[$j] = 0;
            }

            $data[$index] = $item;
        }

        $item    = [];
        $item[0] = "Total";

        for ($j = 1; $j < 14; $j++) {
            $item[$j] = 0;
        }

        $data[0] = $item;

        for ($i = 0; $i < count($listData); $i++) {
            $index                = $this->getId($flag, $listData[$i]);
            $month                = intval($listData[$i]->month);
            $total                = intval($listData[$i]->total);
            $data[$index][$month] = $total;
            $data[$index][13] += $total;
            $data[0][13] += $total;
            $data[0][$month] += $total;
        }

        $data = $this->sort($data);

        $result = [
            'header' => $header,
            'data'   => $data,
        ];

        return $result;
    }

    /**
     * @param Request $request
     */
    public function postLoadCate(Request $request)
    {
        $param      = $request->all();
        $listHeader = $this->crm1830Service->selectConcats();
        $listData   = $this->rpt0516Service->selectCategories($param);
        $title      = "Loại chi phí";
        $flag       = 1;
        $result     = $this->processData($flag, $title, $listHeader, $listData);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postLoadDepartment(Request $request)
    {
        $param      = $request->all();
        $listHeader = $this->crm1830Service->selectDepartments();
        $listData   = $this->rpt0516Service->selectDepartments($param);
        $title      = "Phòng ban";
        $flag       = 2;
        $result     = $this->processData($flag, $title, $listHeader, $listData);

        return response()->success($result);
    }

}
