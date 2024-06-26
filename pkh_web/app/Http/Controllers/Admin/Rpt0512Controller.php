<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\AreaService;
use App\Services\Rpt0512Service;
use App\Services\SalesmanService;

/**
 * Rpt0512Controller
 */
class Rpt0512Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $rpt0512Service;
    /**
     * @var mixed
     */
    protected $areaService;
    /**
     * @var mixed
     */
    protected $salesmanService;

    /**
     * @param Rpt0512Service $rpt0512Service
     */
    public function __construct(Rpt0512Service $rpt0512Service,
        SalesmanService $salesmanService,
        AreaService $areaService
    ) {
        $this->rpt0512Service  = $rpt0512Service;
        $this->areaService     = $areaService;
        $this->salesmanService = $salesmanService;

        $this->middleware('permission:screen.rpt0512');
    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {
        $listAreaGroup = $this->areaService->selectListAreaGroup();
        $salesmanList  = $this->salesmanService->select4SalemanDropdown();

        $listDataType = [[
            'id'   => 1,
            'name' => 'Doanh số chiết khấu (1.000 VND)',
        ],
            [
                'id'   => 2,
                'name' => 'Doanh số chưa chiết khấu (1.000 VND)',
            ],
            [
                'id'   => 3,
                'name' => 'Số đơn',
            ],
            [
                'id'   => 4,
                'name' => 'Trung bình chiết khấu (%)',
            ],
            [
                'id'   => 5,
                'name' => 'Số cửa hàng',
            ],
        ];
        $listViewMode = [[
            'id'   => 1,
            'name' => 'Xem theo tỉnh/thành',
        ],
            [
                'id'   => 2,
                'name' => 'Xem theo vùng',
            ],
        ];
        $result = [
            'listAreaGroup' => $listAreaGroup,
            'listDataType'  => $listDataType,
            'listViewMode'  => $listViewMode,
            'salesmanList'  => $salesmanList,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postLoadData(Request $request)
    {
        $param = $request->all();

//Log::debug('ahihihi load part 1');

//Log::debug($param);
        if (4 == $param['index']) {
            $res = $this->rpt0512Service->loadDataOverview($param);
        } else {
            $res = $this->rpt0512Service->loadData($param);
        }

        return response()->success($res);
    }

    /**
     * sản phẩm theo khu vực
     */
    public function postCompare(Request $request)
    {
        $param = $request->all();
        $res   = $this->rpt0512Service->getData($param, true);

        return response()->success($res['data']);
    }

}
