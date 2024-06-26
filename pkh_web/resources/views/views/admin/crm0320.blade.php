<section class="content-header">
    <h1>Phân cấp cửa hàng<small></small></h1>
    <!-- <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Lịch nghỉ nghep</li>
    </ol> -->
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách cấp cửa hàng</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body form">
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="month">Tháng</label>
                                    <div class="input-group">
                                        <input id="monthPicker" class="form-control" datetimepicker ng-model="vm.m.filter.month" placeholder="YYYY-MM" options="vm.m.datetimepicker_options"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Vùng</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn tỉnh'"
                                        ng-model="vm.m.filter.areaGroup"
                                        ng-options="item.area_group_id as item.name for item in vm.m.init.listAreaGroup"
                                        >
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Tỉnh/Thành</label>
                                    {{vm.m.filter.area1}}
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn tỉnh'"
                                        ng-model="vm.m.filter.area1"
                                        ng-options="item.area_id as item.name for item in vm.m.init.listArea1  | filter : {'area_group_id': vm.m.filter.areaGroup}"
                                        >
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group" ng-if="vm.m.filter.area1">
                                    <label>Quận/Huyện</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn tỉnh'"
                                        ng-model="vm.m.filter.area2"
                                        ng-options="item.area_id as item.name for item in vm.m.init.listArea2 | filter : {'parent_area_id': vm.m.filter.area1}"
                                        >
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Tên cửa hàng</label>
                                    <input type="text" ng-model="vm.m.filter.name" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>NVBH</label>
                                    <select class="form-control"   
                                        chosen
                                        placeholder-text-single="'Chọn NVBH'"
                                        ng-model="vm.m.filter.salesman"
                                        ng-options="item.id as item.name for item in vm.m.init.listSalesman track by item.id"
                                        >
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Cấp</label>
                                    <select class="form-control"   
                                        chosen
                                        placeholder-text-single="'Chọn NVBH'"
                                        ng-model="vm.m.filter.rank"
                                        >
                                        <option value="">Tất cả</option>
                                        <option value="1">Cấp 1</option>
                                        <option value="2">Cấp 2</option>
                                        <option value="3">Cấp 3</option>
                                        <option value="4">Cấp 4</option>
                                        <option value="5">Cấp 5</option>
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
                                <button type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.resetFilter()">
                                    <i class="fa fa-eraser fa-fw"></i>
                                    <span translate="COM_BTN_RESET"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th rowspan="2">NO</th>
                                    <th rowspan="2" ng-click="vm.sort('year_month');" class="sortable">
                                        <span>Năm/Tháng</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="year_month"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th rowspan="2" ng-click="vm.sort('area_group_name');" class="sortable">
                                        <span>Vùng</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="area_group_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th rowspan="2" ng-click="vm.sort('area1_name');" class="sortable">
                                        <span>Tỉnh/Thành</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="area1_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th rowspan="2" ng-click="vm.sort('area2_name');" class="sortable">
                                        <span>Quận/Huyện</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="area2_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th rowspan="2" ng-click="vm.sort('salesman');" class="sortable">
                                        <span>NVBH</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="salesman"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th rowspan="2" ng-click="vm.sort('store_name');" class="sortable">
                                        <span>Cửa hàng</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="store_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th colspan="2" class="text-center">Đặt hàng</th>
                                    <th colspan="2" class="text-center">Giao hàng</th>
                                    <th rowspan="2">Công nợ</th>
                                    <th rowspan="2">Cấp</th>
                                </tr>
                                <tr>
                                    <th>Trước CK</th>
                                    <th>Sau CK</th>
                                    <th>Trước CK</th>
                                    <th>Sau CK</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data'>
                                    <td>{{$index + 1}}</td>
                                    <td>{{item.year}}-{{("00"+item.month).slice(-2)}}</td>
                                    <td>{{item.area_group_name}}</td>
                                    <td>{{item.area1_name}}</td>
                                    <td>{{item.area2_name}}</td>
                                    <td>{{item.salesman_name}}</td>
                                    <td>{{item.store_name}}</td>
                                    <td class="text-right">
                                        {{item.order_total | currency : '' : 0}}
                                    </td>
                                    <td class="text-right">
                                        {{item.order_total_with_discount | currency : '' : 0}}
                                    </td>
                                    <td class="text-right">
                                        {{item.delivery_total | currency : '' : 0}}
                                    </td>
                                    <td class="text-right">
                                        {{item.delivery_total_with_discount | currency : '' : 0}}
                                    </td>
                                    <td class="text-right">
                                        {{item.payment | currency : '' : 0}}
                                    </td>
                                    <td ng-switch="item.store_rank">
                                        <span class="label label-primary" ng-switch-when="1">Cấp {{item.store_rank}}</span>
                                        <span class="label label-success" ng-switch-when="2">Cấp {{item.store_rank}}</span>
                                        <span class="label label-info" ng-switch-when="3">Cấp {{item.store_rank}}</span>
                                        <span class="label label-warning" ng-switch-when="4">Cấp {{item.store_rank}}</span>
                                        <span class="label label-default" ng-switch-when="5">Cấp {{item.store_rank}}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row" ng-if="vm.m.data.from > 0">
                        <div class="col-md-6 col-sm-12 text-left">
                            <p class="form-control-static">{{vm.m.data.from}} - {{vm.m.data.to}} / {{vm.m.data.total}}</p>                            
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <uib-pagination ng-show="vm.m.data.from > 0"
                                total-items="vm.m.data.total"
                                ng-model="vm.m.data.current_page"
                                items-per-page="vm.m.data.per_page"
                                ng-change="vm.doSearch(vm.m.data.current_page)"
                                class="pagination pagination-sm m-t-none m-b-none">
                            </uib-pagination>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
