<?php
namespace App\Http\Controllers\Frontend;

use Mail;
use Input;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Http\Request;
use App\Services\OrderStatusService;

/**
 * Contact Page Controller
 */
class OrderStatusController extends FrontendController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(OrderStatusService $orderStatusService)
    {
        $this->middleware('guest');
        $this->orderStatusService = $orderStatusService;
    }

    /**
     * Display page
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $params   = $request->all();

        if (!isset($params["orderId"])) {
            return view($this->viewFolder . $this->currentTheme . '.pages.don-hang');
        }

        $data = $this->orderStatusService->getDelivery($params["orderId"]);

        return view($this->viewFolder . $this->currentTheme . '.pages.don-hang', $data);
    }
}
