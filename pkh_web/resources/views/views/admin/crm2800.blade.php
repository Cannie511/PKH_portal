<section class="content-header">
    <h1>KPI cửa hàng<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm0300"><span>Cửa hàng</span></a></li>
        <li class="active">KPI cửa hàng</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">KPI cửa hàng</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.crm2800({ employee_id: vm.m.employee_id,contract_id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <div class="box-body form">
                    <form role="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Cửa hàng</label>
                                    <input type="text" class="form-control" ng-model="vm.m.filter.name" name="name" placeholder="Cửa hàng">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                                    <i class="fa fa-search fa-fw"></i>
                                    <span translate="COM_BTN_SEARCH"></span>
                                </button>
                                <button type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.resetFilter()">
                                    <i class="fa fa-eraser fa-fw"></i>
                                    <span translate="COM_BTN_RESET"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-body">
                    <!-- <div class="text-right">
                        <i>Đơn vị: Nghìn đồng</i>
                    </div> -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th rowspan="2" >NO</th>
                                    <th rowspan="2" >Năm</th>
                                    <th rowspan="2" >Cửa hàng</th>
                                    <th colspan="3" class="text-center">Doanh số</th>
                                    <th colspan="3" class="text-right">Sản phẩm</th>
                                    <th rowspan="2" ></th>
                                </tr>
                                <tr>
                                    <th class="text-center">Dự kiến</th>
                                    <th class="text-center">Thực tế</th>
                                    <th class="text-center">Tỉ lệ</th>
                                    <th class="text-center">Dự kiến</th>
                                    <th class="text-center">Thực tế</th>
                                    <th class="text-center">Tỉ lệ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list.data'>
                                    <td>{{$index + vm.m.list.from}}</td>
                                    <td>{{item.year}}</td>
                                    <td>
                                        {{item.name}}<br/>
                                        <small>{{item.address}}</small>
                                    </td>
                                    <td class="text-right">{{item.target_year | currency: '': 0}}</td>
                                    <td class="text-right">{{item.actual_money | currency: '': 0}}</td>
                                    <td class="text-right">{{item.percent_money | currency: '': 2}}%</td>
                                    <td class="text-right">{{item.plan_amount | currency: '': 0}}</td>
                                    <td class="text-right">{{item.actual_amount | currency: '': 0}}</td>
                                    <td class="text-right">{{item.percent_amount | currency: '': 2}}%</td>
                                    <td>
                                        <a ng-if="vm.can('screen.crm2810')" class="btn btn-xs btn-info" ui-sref="app.crm2810({store_id: item.store_id})"><i class="fa fa-eye fa-fw"/></a>
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
                </div>
            </div>
        </div>
    </div>
</section>