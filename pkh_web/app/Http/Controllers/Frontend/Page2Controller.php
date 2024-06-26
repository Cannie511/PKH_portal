<?php

namespace App\Http\Controllers\Frontend;

use View;
use Illuminate\Http\Request;
use App\Services\FuncConfService;
use App\Http\Controllers\Controller;
use App\Services\ProductWebsiteService;

class Page2Controller extends FrontendController
{
    /**
     * @var mixed
     */
    protected $funcConfService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        FuncConfService $funcConfService,
        ProductWebsiteService $productWebsiteService
    ) {
        $this->middleware('guest');
        $this->funcConfService       = $funcConfService;
        $this->productWebsiteService = $productWebsiteService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function home()
    {
        $listProductSales = $this->productWebsiteService->selectTopProductOnHome(FuncConfService::CMS_HOME_TOP_PRODUCT);
        $listProductNew   = $this->productWebsiteService->selectTopProductOnHome(FuncConfService::CMS_HOME_NEW_PRODUCT);

        $result = [
            'cms_home_marquee'   => $this->funcConfService->selectByKey(FuncConfService::CMS_HOME_MARQUEE, 'txt_val'),
            'cms_home_marquee_2' => $this->funcConfService->selectByKey(FuncConfService::CMS_HOME_MARQUEE_2, 'txt_val'),
            'listProductSales'   => $listProductSales,
            'listProductNew'     => $listProductNew,
        ];

        return view($this->viewFolder . $this->currentTheme . '.pages.home', $result);
    }

    /**
     * @param Request $request
     */
    public function printQr(Request $request)
    {
        // TODO: return view here
        $params   = $request->all();
        $viewPage = $this->viewFolder . $this->currentTheme . '.pages.print-qr';

        $listCode = explode(",", $params["listCode"]);

        return view($viewPage, [
            'params'   => $params,
            'size'     => $params['size'],
            'amount'   => $params['amount'],
            "listCode" => $listCode,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug)
    {
        $viewPage = $this->viewFolder . $this->currentTheme . '.pages.' . $slug;

        if (View::exists($viewPage)) {
            return view($viewPage);
        }

        $viewPage = 'frontend.pages.' . $slug;

        if (View::exists($viewPage)) {
            return view($viewPage);
        }

        abort(404);
    }

}
