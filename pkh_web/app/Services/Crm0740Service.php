<?php

namespace App\Services;

use Log;
use File;
use Cache;
use Excel;

/**
 * Crm0740Service class
 */
class Crm0740Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */

    public function checkMin($x)
    {
        $count = 0;

        while ($x > 0) {

            if ($x % 10 == 0) {
                $count++;
            } else {
                break;
            }

            $x = $x / 10;
        }

        return $count;
    }

    /**
     * @param $list
     * @return mixed
     */
    public function findMin($list)
    {
        $n   = sizeof($list);
        $min = 10;

        for ($i = 0; $i < $n; $i++) {
            $x = $this->checkMin($list[$i]['unit_price']);

            if ($min > $x) {
                $min = $x;
            }

        }

        $num = 1;

        for ($i = 0; $i < $min; $i++) {
            $num = $num * 10;
        }

        return $num;

    }

    /**
     * @param $param
     * @return mixed
     */
    public function createAmountForProductList($param)
    {

        $listPro = $param['orderDetail'];
        $num     = $this->findMin($listPro); // Giảm hàng đơn vị và hàng chục or hàng trăm của tiền để giảm số lần duyệt mảng

        Log::debug('ahihihihihi');
        Log::debug($num);
        $n     = sizeof($listPro);
        $trace = array();
        $len   = array();
        ini_set('memory_limit', '2000M');
        $sum = 0;

        for ($i = 0; $i < $n; $i++) {
            //$listPro[$i]['amount']=0;
            $sum = $sum + $listPro[$i]['unit_price'] * $listPro[$i]['amount'];
        }

        $totalMoney = ($param['totalMoney'] - $sum) / $num;
        Log::debug($totalMoney);

        if ($totalMoney <= 0) {
            return $listPro;
        }

        $check = true;

        for ($i = 0; $i < $n; $i++) {

            if ($listPro[$i]['balance'] != $listPro[$i]['amount']) {
                $check = false;
            }

        }

        if (true == $check) {
            return $listPro;
        }

        for ($i = 0; $i <= $totalMoney; $i++) {
            $trace[$i] = -2;
            $len[$i]   = 0;
        }

        $trace[0] = -1;
        $check    = array();

        for ($i = 1; $i <= $totalMoney; $i++) {
            $check[$i] = array();

            for ($j = 0; $j < $n; $j++) {
                $check[$i][$j] = 0;
            }

        }

        for ($i = 0; $i < $n; $i++) {
            $listPro[$i]['unit_price'] = $listPro[$i]['unit_price'] / $num;
            $check[0][$i]              = $listPro[$i]['amount'];
        }

        for ($i = 0; $i <= $totalMoney; $i++) {

            if (-2 != $trace[$i]) {

                for ($j = 0; $j < $n; $j++) {
                    $value = $i + $listPro[$j]['unit_price'];

                    if ($value <= $totalMoney && -2 == $trace[$value]) {

                        if ($check[$i][$j] < $listPro[$j]['balance']) {
                            $check[$value] = $check[$i];
                            $len[$value]   = $len[$i];

                            if (0 == $check[$value][$j]) {
                                $len[$value]++;
                            }

                            $check[$value][$j] += 1;

                            $trace[$value] = $j;

                            if ($value == $totalMoney) {
                                break;
                            }

                        }

                    } elseif ($value <= $totalMoney && -2 != $trace[$value]) {

                        if ($check[$i][$j] < $listPro[$j]['balance']) {
                            $add = 0;

                            if (0 == $check[$i][$j]) {
                                $add = 1;
                            }

                            if ($len[$i] + $add > $len[$value]) {
                                $check[$value] = $check[$i];
                                $len[$value]   = $len[$i] + $add;

                                $check[$value][$j] += 1;

                                $trace[$value] = $j;

                                if ($value == $totalMoney) {
                                    break;
                                }

                            }

                        }

                    }

                }

            }

        }

        if (-2 == $trace[$totalMoney]) {

            for ($i = $totalMoney; $i > 0; $i--) {

                if (-2 != $trace[$i]) {
                    $totalMoney = $i;
                    break;
                }

            }

        }

        Log::debug('bug ahihi------------');
        Log::debug($totalMoney);
        Log::debug($check[$totalMoney]);

        $x = $totalMoney;

        for ($y = 0; $y < $n; $y++) {

            if (0 != $check[$x][$y]) {
                $listPro[$y]['amount'] = $check[$x][$y];
            }

        }

        for ($i = 0; $i < $n; $i++) {
            $listPro[$i]['unit_price'] = $listPro[$i]['unit_price'] * $num;
        }

        return $listPro;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function download($param)
    {

        if (!isset($param['list'])) {
            return;
        }

        $data = $param['list'];

        foreach ($data as $item) {
            Log::debug($item['product_code']);
        }

        Log::debug('ahihihihihi');
        Log::debug($data);
        // Create path if not exist
        $path = config('constants.DOWNLOAD_DIR');
        $path = storage_path($path);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $fileName = "HoaDon_" . date('ymdhis');
        $ext      = "xlsx";

        Excel::create($fileName, function ($excel) use ($data) {
            $excel->sheet('HoaDon', function ($sheet) use ($data) {
                $sheet->loadView('admin.excels.crm0740-list')
                    ->with('data', $data);
            });
        })->store($ext, $path);

        $fullPath = $path . '/' . $fileName . '.' . $ext;
        $key      = $fileName . '.' . $ext;
        Cache::put($key, $fullPath, config('constants.DOWNLOAD_EXPIRE_MIN'));

        $result = [
            'rtnCd' => 0,
            'file'  => $key,
            'test'  => Cache::get($key),
        ];

        return $result;
    }

}
