<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm0720Service;
use App\Services\DownloadService;
use App\Services\SalesmanService;

class Crm0720Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0720Service;
    /**
     * @var mixed
     */
    protected $salesmanService;

    /**
     * @param Crm0720Service $crm0720Service
     * @param SalesmanService $salesmanService
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm0720Service $crm0720Service,
        SalesmanService $salesmanService,
        DownloadService $downloadService
    ) {
        $this->crm0720Service  = $crm0720Service;
        $this->salesmanService = $salesmanService;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.crm0720');
    }

    /**
     * @param Request $request
     */
    public function postLoadPromotion(Request $request)
    {
        $salesmanList = $this->salesmanService->selectDropdown();
        $result       = [
            'salesmanList' => $salesmanList,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $result  = $this->crm0720Service->selectList($param);

// $dataNew = $this->crm0720Service->selectListNew($param);
        // $dataOld = $this->crm0720Service->selectListOld($param);
//         $result = [

// // 'dataNew'   => $dataNew,
//             // 'dataOld'   => $dataOld
//             'data' => $data,
//         ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postDownload(Request $request)
    {
        // $this->requirePermission('screen.crm0720.download');
        $param = $request->all();
        //$result = $this->crm0720Service->download($param);
        $param['down'] = 1;
        $data          = $this->crm0720Service->selectList($param);
        $paramDownload = [
            "data"      => $data,
            "file_name" => "TheoDoiCongNo",
            "view"      => "crm0720-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

    /**
     * @param $paymentDate
     * @param $deliveryDate
     * @return int
     */
    public function diffDate(
        $paymentDate,
        $deliveryDate
    ) {
        $diff = strtotime($paymentDate) - strtotime($deliveryDate);

        if ($diff < 0) {
            return 0;
        }

        $years  = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));

        return floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    }

    /**
     * @param Request $request
     */
    public function postGetInfo(Request $request)
    {
        // $this->requirePermission('screen.crm0720.download');

        $param = $request->all();

// Log::debug('test---------');

//  Log::debug($param);
        if (!isset($param['store_id'])) {
            return null;
        }

        $delivery = [];
        $payment  = [];

        $delivery       = $this->crm0720Service->getDeliveryForStore($param);
        $payment        = $this->crm0720Service->getPaymentForStore($param);
        $flag           = 1;
        $x              = 0;
        $y              = 0;
        $countPayment   = 0;
        $sumPayment     = 0;
        $deliveryLength = count($delivery);
        $paymentLength  = count($payment);
        if ($deliveryLength > 0 && $paymentLength > 0) {
            $deliveryTotal = $delivery[$x]->total_with_discount;
            $paymentTotal  = $payment[$y]->payment_money;
            while ($x < $deliveryLength && $y < $paymentLength) {
                if ($deliveryTotal <= $paymentTotal) {
                    $delivery[$x]->payment_date = $payment[$y]->payment_date;
                    $delivery[$x]->diff         = $this->diffDate($delivery[$x]->payment_date, $delivery[$x]->delivery_date);

// Chỉ tính trung bình thời gian lúc nợ đến trả tiền
                    if (1 == $flag) {
                        $countPayment++;
                        $sumPayment += $delivery[$x]->diff;
                    }

                    $delivery[$x]->deliveryTotal = $deliveryTotal;
                    $delivery[$x]->paymentTotal  = $paymentTotal;
                    $x++;
                    if ($x >= $deliveryLength) {
                        break;
                    }

                    $flag = 0;
                    $deliveryTotal += $delivery[$x]->total_with_discount;
                } else {
                    $flag = 1;
                    //$delivery[$x]->payment_money = $payment[$y]->payment_money;
                    $y++;

                    if ($y >= $paymentLength) {
                        break;
                    }

                    $paymentTotal += $payment[$y]->payment_money;
                }

            }

        }

        if (0 == $countPayment) {
            $sumPayment = 30;
        } else {
            $sumPayment = $sumPayment / $countPayment;
        }

        $result = [
            'delivery' => $delivery,
            'AVG'      => $sumPayment,
        ];

        return response()->success($result);
    }

}
