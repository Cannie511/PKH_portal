<section class="content-header">
    <h1>KPI cửa hàng<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm0300"><span>Cửa hàng</span></a></li>
        <li><a ui-sref="app.crm2600({store_id: vm.m.store_id})"><span>#{{vm.m.store_id}}</span></a></li>
        <li class="active">KPI cửa hàng</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12 col-md-3 col-lg-2">
            <crm2601/>
            <crm2602/>
        </div>
        <div class="col-xs-12 col-md-9 col-lg-10">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">KPI cửa hàng</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.crm2810({ employee_id: vm.m.employee_id,contract_id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <div class="box-body form">
                    <form role="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Năm</label>
                                    <select class="form-control"
                                    placeholder-text-single="'Năm'"
                                    ng-model="vm.m.filter.year"
                                    name="year"
                                    ng-options="item as item for item in vm.m.init.listYear"
                                    >
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                                    <i class="fa fa-search fa-fw"></i>
                                    <span translate="COM_BTN_SEARCH"></span>
                                </button>
                                <button ng-if="vm.m.kpi" type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.download()">
                                    <i class="fa fa-download fa-fw"></i>
                                    Tải về
                                </button>
                                <!-- <button type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.resetFilter()">
                                    <i class="fa fa-eraser fa-fw"></i>
                                    <span translate="COM_BTN_RESET"></span>
                                </button> -->
                            </div>
                        </div>
                    </form>
                </div>

                <div class="box-body" ng-if="vm.m.isInit == false && vm.m.kpi == null">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-primary btn-width-default" ng-click="vm.createKpi()">
                                <i class="fa fa-plus fa-fw"></i>
                                Tạo mới
                            </button>
                        </div>
                    </div>
                </div>

                <div class="box-body" ng-if="vm.m.isInit == false && vm.m.kpi != null">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tháng</th>
                                    <th class="text-right">Dự kiến</th>
                                    <th class="text-right">Thực tế</th>
                                    <th class="text-right">%</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tháng 1</td>
                                    <td class="text-right">{{vm.m.kpi.month_1_target | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.month_1_result | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.percent_1 | currency: '': 2 }}%</td>
                                    <td class="text-right">
                                        <a ng-if="vm.can('screen.crm2820')" class="btn btn-xs btn-info" ui-sref="app.crm2820({kpi_id: vm.m.kpi.id, month: 1})"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tháng 2</td>
                                    <td class="text-right">{{vm.m.kpi.month_2_target | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.month_2_result | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.percent_2 | currency: '': 2 }}%</td>
                                    <td class="text-right">
                                        <a ng-if="vm.can('screen.crm2820')" class="btn btn-xs btn-info" ui-sref="app.crm2820({kpi_id: vm.m.kpi.id, month: 2})"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tháng 3</td>
                                    <td class="text-right">{{vm.m.kpi.month_3_target | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.month_3_result | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.percent_3 | currency: '': 2 }}%</td>
                                    <td class="text-right">
                                        <a ng-if="vm.can('screen.crm2820')" class="btn btn-xs btn-info" ui-sref="app.crm2820({kpi_id: vm.m.kpi.id, month: 3})"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tháng 4</td>
                                    <td class="text-right">{{vm.m.kpi.month_4_target | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.month_4_result | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.percent_4 | currency: '': 2 }}%</td>
                                    <td class="text-right">
                                        <a ng-if="vm.can('screen.crm2820')" class="btn btn-xs btn-info" ui-sref="app.crm2820({kpi_id: vm.m.kpi.id, month: 4})"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tháng 5</td>
                                    <td class="text-right">{{vm.m.kpi.month_5_target | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.month_5_result | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.percent_5 | currency: '': 2 }}%</td>
                                    <td class="text-right">
                                        <a ng-if="vm.can('screen.crm2820')" class="btn btn-xs btn-info" ui-sref="app.crm2820({kpi_id: vm.m.kpi.id, month: 5})"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tháng 6</td>
                                    <td class="text-right">{{vm.m.kpi.month_6_target | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.month_6_result | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.percent_6 | currency: '': 2 }}%</td>
                                    <td class="text-right">
                                        <a ng-if="vm.can('screen.crm2820')" class="btn btn-xs btn-info" ui-sref="app.crm2820({kpi_id: vm.m.kpi.id, month: 6})"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tháng 7</td>
                                    <td class="text-right">{{vm.m.kpi.month_7_target | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.month_7_result | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.percent_7 | currency: '': 2 }}%</td>
                                    <td class="text-right">
                                        <a ng-if="vm.can('screen.crm2820')" class="btn btn-xs btn-info" ui-sref="app.crm2820({kpi_id: vm.m.kpi.id, month: 7})"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tháng 8</td>
                                    <td class="text-right">{{vm.m.kpi.month_8_target | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.month_8_result | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.percent_8 | currency: '': 2 }}%</td>
                                    <td class="text-right">
                                        <a ng-if="vm.can('screen.crm2820')" class="btn btn-xs btn-info" ui-sref="app.crm2820({kpi_id: vm.m.kpi.id, month: 8})"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tháng 9</td>
                                    <td class="text-right">{{vm.m.kpi.month_9_target | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.month_9_result | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.percent_9 | currency: '': 2 }}%</td>
                                    <td class="text-right">
                                        <a ng-if="vm.can('screen.crm2820')" class="btn btn-xs btn-info" ui-sref="app.crm2820({kpi_id: vm.m.kpi.id, month: 9})"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tháng 10</td>
                                    <td class="text-right">{{vm.m.kpi.month_10_target | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.month_10_result | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.percent_10 | currency: '': 2 }}%</td>
                                    <td class="text-right">
                                        <a ng-if="vm.can('screen.crm2820')" class="btn btn-xs btn-info" ui-sref="app.crm2820({kpi_id: vm.m.kpi.id, month: 10})"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tháng 11</td>
                                    <td class="text-right">{{vm.m.kpi.month_11_target | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.month_11_result | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.percent_11 | currency: '': 2 }}%</td>
                                    <td class="text-right">
                                        <a ng-if="vm.can('screen.crm2820')" class="btn btn-xs btn-info" ui-sref="app.crm2820({kpi_id: vm.m.kpi.id, month: 11})"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tháng 12</td>
                                    <td class="text-right">{{vm.m.kpi.month_12_target | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.month_12_result | currency: '': 2 }}</td>
                                    <td class="text-right">{{vm.m.kpi.percent_12 | currency: '': 2 }}%</td>
                                    <td class="text-right">
                                        <a ng-if="vm.can('screen.crm2820')" class="btn btn-xs btn-info" ui-sref="app.crm2820({kpi_id: vm.m.kpi.id, month: 12})"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Cả năm</td>
                                    <td class="text-right"><b>{{vm.m.kpiSummary.total_target | currency: '': 0}}</b></td>
                                    <td class="text-right"><b>{{vm.m.kpiSummary.total_result | currency: '': 0}}</b></td>
                                    <td class="text-right"><b>{{vm.m.kpiSummary.percent | currency: '': 0}}%</b></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- <div class="box-body" style="display:none">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list.data'>
                                    <td>{{$index + vm.m.list.from}}</td>
                                    <td>{{item.id}}</td>
                                    <td>{{item.name}}</td>
                                    <td>
                                        <a ng-if="vm.can('screen.crm2810')" class="btn btn-xs btn-info" ui-sref="app.crm2810({id: item.id})"><i class="fa fa-eye fa-fw"/></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row text-right">
                        <div class="col-md-12">
                            <uib-pagination ng-show="vm.m.list.from > 0"
                                total-items="vm.m.list.total"
                                ng-model="vm.m.list.current_page"
                                items-per-page="vm.m.list.per_page"
                                ng-change="vm.doSearch(vm.m.list.current_page)"
                                class="pagination pagination-sm m-t-none m-b-none">
                            </uib-pagination>    
                        </div>
                    </div>
                </div> -->
            </div>

            <div class="nav-tabs-custom" ng-if="vm.m.isInit == false && vm.m.kpi != null">
                <ul class="nav nav-tabs">
                    <li ng-class="{'active': vm.m.activeFlag == 1}"><a href="javascript:void(0)" ng-click="vm.chooseTab(1)">Từng tháng</a></li>
                    <li ng-class="{'active': vm.m.activeFlag == 2}"><a href="javascript:void(0)" ng-click="vm.chooseTab(2)">Cả năm</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" ng-class="{'active': vm.m.activeFlag == 1}">
                        <div class="box-body form">
                            <form role="form" ng-submit="vm.loadMonth()">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Tháng</label>
                                            <select class="form-control"
                                            placeholder-text-single="'Tháng'"
                                            ng-model="vm.m.filter.month"
                                            name="month"
                                            ng-options="item.id as item.display for item in vm.m.init.listMonth"
                                            >
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                                            <i class="fa fa-search fa-fw"></i>
                                            <span translate="COM_BTN_SEARCH"></span>
                                        </button>
                                        <!-- <button type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.resetFilter()">
                                            <i class="fa fa-eraser fa-fw"></i>
                                            <span translate="COM_BTN_RESET"></span>
                                        </button> -->
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="box-body" ng-if="vm.m.isInit == false && vm.m.kpi != null">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">NO</th>
                                            <th rowspan="2"></th>
                                            <th rowspan="2">Loại</th>
                                            <th rowspan="2">Mã SP</th>
                                            <th rowspan="2">Tên SP</th>
                                            <th colspan="2" class="text-center">Dự định</th>
                                            <th colspan="2" class="text-center">Thực tế</th>
                                            <th rowspan="2">Tỉ lệ</th>
                                        </tr>
                                        <tr>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat='item in vm.m.kpiMonth'>
                                            <td>{{$index + 1}}</td>
                                            <td>
                                                <img class="img-thumb-product" class="img-responsive" ng-src="{{item.imgUrl}}" />
                                            </td>
                                            <td>{{item.product_cat_name}}</td>
                                            <td>{{item.product_code}}</td>
                                            <td>{{item.name}}</td>
                                            <td class="text-right">{{item.amount | currency: '': 0}}</td>
                                            <td class="text-right">{{item.target_money | currency: '': 0}}</td>
                                            <td class="text-right">{{item.result_amount | currency: '': 0}}</td>
                                            <td class="text-right">{{item.result_money | currency: '': 0}}</td>
                                            <td class="text-right">{{item.percent | currency: '': 2}}%</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-right"><b>{{vm.m.monthSummary.totalPlan | currency: '': 0}}</b></td>
                                            <td></td>
                                            <td class="text-right"><b>{{vm.m.monthSummary.totalActual | currency: '': 0}}</b></td>
                                            <td class="text-right">{{vm.m.monthSummary.totalPlan / vm.m.monthSummary.totalActual | currency: '': 0}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane" ng-class="{'active': vm.m.activeFlag == 2}">
                        <div class="box-body" ng-if="vm.m.isInit == false && vm.m.kpi != null">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">NO</th>
                                            <th rowspan="2"></th>
                                            <th rowspan="2">Loại</th>
                                            <th rowspan="2">Mã SP</th>
                                            <th rowspan="2">Tên SP</th>
                                            <th colspan="2" class="text-center">Dự định</th>
                                            <th colspan="2" class="text-center">Thực tế</th>
                                            <th rowspan="2">Tỉ lệ</th>
                                        </tr>
                                        <tr>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat='item in vm.m.kpiYear'>
                                            <td>{{$index + 1}}</td>
                                            <td>
                                                <img class="img-thumb-product" class="img-responsive" ng-src="{{item.imgUrl}}" />
                                            </td>
                                            <td>{{item.product_cat_name}}</td>
                                            <td>{{item.product_code}}</td>
                                            <td>{{item.name}}</td>
                                            <td class="text-right">{{item.amount | currency: '': 0}}</td>
                                            <td class="text-right">{{item.target_money | currency: '': 0}}</td>
                                            <td class="text-right">{{item.result_amount | currency: '': 0}}</td>
                                            <td class="text-right">{{item.result_money | currency: '': 0}}</td>
                                            <td class="text-right">{{item.percent | currency: '': 2}}%</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-right"><b>{{vm.m.yearSummary.totalAmountPlan | currency: '': 0}}</b></td>
                                            <td class="text-right"><b>{{vm.m.yearSummary.totalPlan | currency: '': 0}}</b></td>
                                            <td class="text-right"><b>{{vm.m.yearSummary.totalAmountActual | currency: '': 0}}</b></td>
                                            <td class="text-right"><b>{{vm.m.yearSummary.totalActual | currency: '': 0}}</b></td>
                                            <td class="text-right">{{vm.m.yearSummary.percent | currency: '': 2}}%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>