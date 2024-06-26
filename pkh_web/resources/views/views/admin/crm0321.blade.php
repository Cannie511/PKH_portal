<section class="content-header">
    <h1>Theo dõi cửa hàng<small></small></h1>
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
                    <h3 class="box-title">Theo dõi cấp cửa hàng</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body form">
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                            <!--<div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="month">Tháng</label>
                                    <div class="input-group">
                                        <input id="monthPicker" class="form-control" datetimepicker ng-model="vm.m.filter.month" placeholder="YYYY-MM" options="vm.m.datetimepicker_options"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>-->
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
                <div class="box_body" id="chartdivContainer" ng-if="vm.m.showChart">
                    <amchart id="myFirstChart" options="vm.m.amChartOptions" height="400" width="100%"></amchart>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>NO</th>
                                    <th ng-click="vm.sort('area_group_name');" class="sortable">
                                        <span>Vùng</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="area_group_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th ng-click="vm.sort('area1_name');" class="sortable">
                                        <span>Tỉnh/Thành</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="area1_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th ng-click="vm.sort('store_name');" class="sortable">
                                        <span>Cửa hàng</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="store_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th></th>
                                    <th>{{vm.m.header[0].date | limitTo: 7}}</th>
                                    <th>{{vm.m.header[1].date | limitTo: 7}}</th>
                                    <th>{{vm.m.header[2].date | limitTo: 7}}</th>
                                    <th>{{vm.m.header[3].date | limitTo: 7}}</th>
                                    <th>{{vm.m.header[4].date | limitTo: 7}}</th>
                                    <th>{{vm.m.header[5].date | limitTo: 7}}</th>
                                    <!--<th>{{vm.m.header[6].date | limitTo: 7}}</th>
                                    <th>{{vm.m.header[7].date | limitTo: 7}}</th>
                                    <th>{{vm.m.header[8].date | limitTo: 7}}</th>
                                    <th>{{vm.m.header[9].date | limitTo: 7}}</th>
                                    <th>{{vm.m.header[10].date | limitTo: 7}}</th>
                                    <th>{{vm.m.header[11].date | limitTo: 7}}</th>
                                    <th>{{vm.m.header[12].date | limitTo: 7}}</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data'>
                                    <td><button class="btn btn-success btn-sm" ng-click="vm.draw(item)"><i class="fa fa-line-chart"></i></button></td>
                                    <td>{{$index + 1}}</td>
                                    <td>{{item.area_group_name}}</td>
                                    <td>
                                        {{item.area1_name}}<br/>
                                        {{item.area2_name}}
                                    </td>
                                    <td>
                                        {{item.store_name}}<br/>
                                        <i>({{item.salesman_name}})</i>
                                    </td>
                                    <td>
                                        Cấp <br/>
                                        ĐH <br/>
                                        ĐH(CK) <br/>
                                        GH <br/>
                                        GH(CK) <br/>
                                        CN
                                    </td>
                                    <td>
                                        <div ng-switch="item.items[0].store_rank">
                                            <span class="label label-primary" ng-switch-when="1">Cấp {{item.items[0].store_rank}}</span>
                                            <span class="label label-success" ng-switch-when="2">Cấp {{item.items[0].store_rank}}</span>
                                            <span class="label label-info" ng-switch-when="3">Cấp {{item.items[0].store_rank}}</span>
                                            <span class="label label-warning" ng-switch-when="4">Cấp {{item.items[0].store_rank}}</span>
                                            <span class="label label-default" ng-switch-when="5">Cấp {{item.items[0].store_rank}}</span>
                                            <span class="label" ng-switch-default=>&nbsp;</span>
                                        </div>
                                        {{item.items[0].order_total | currency: '' : 0 }}<br/>
                                        {{item.items[0].order_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[0].delivery_total | currency: '' : 0 }}<br/>
                                        {{item.items[0].delivery_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[0].payment | currency: '' : 0 }}
                                    </td>
                                    <td>
                                        <div ng-switch="item.items[1].store_rank">
                                            <span class="label label-primary" ng-switch-when="1">Cấp {{item.items[1].store_rank}}</span>
                                            <span class="label label-success" ng-switch-when="2">Cấp {{item.items[1].store_rank}}</span>
                                            <span class="label label-info" ng-switch-when="3">Cấp {{item.items[1].store_rank}}</span>
                                            <span class="label label-warning" ng-switch-when="4">Cấp {{item.items[1].store_rank}}</span>
                                            <span class="label label-default" ng-switch-when="5">Cấp {{item.items[1].store_rank}}</span>
                                            <span class="label" ng-switch-default=>&nbsp;</span>
                                        </div>
                                        {{item.items[1].order_total | currency: '' : 0 }}<br/>
                                        {{item.items[1].order_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[1].delivery_total | currency: '' : 0 }}<br/>
                                        {{item.items[1].delivery_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[1].payment | currency: '' : 0 }}
                                    </td>
                                    <td>
                                        <div ng-switch="item.items[2].store_rank">
                                            <span class="label label-primary" ng-switch-when="1">Cấp {{item.items[2].store_rank}}</span>
                                            <span class="label label-success" ng-switch-when="2">Cấp {{item.items[2].store_rank}}</span>
                                            <span class="label label-info" ng-switch-when="3">Cấp {{item.items[2].store_rank}}</span>
                                            <span class="label label-warning" ng-switch-when="4">Cấp {{item.items[2].store_rank}}</span>
                                            <span class="label label-default" ng-switch-when="5">Cấp {{item.items[2].store_rank}}</span>
                                            <span class="label" ng-switch-default=>&nbsp;</span>
                                        </div>
                                        {{item.items[2].order_total | currency: '' : 0 }}<br/>
                                        {{item.items[2].order_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[2].delivery_total | currency: '' : 0 }}<br/>
                                        {{item.items[2].delivery_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[2].payment | currency: '' : 0 }}
                                    </td>
                                    <td>
                                        <div ng-switch="item.items[3].store_rank">
                                            <span class="label label-primary" ng-switch-when="1">Cấp {{item.items[3].store_rank}}</span>
                                            <span class="label label-success" ng-switch-when="2">Cấp {{item.items[3].store_rank}}</span>
                                            <span class="label label-info" ng-switch-when="3">Cấp {{item.items[3].store_rank}}</span>
                                            <span class="label label-warning" ng-switch-when="4">Cấp {{item.items[3].store_rank}}</span>
                                            <span class="label label-default" ng-switch-when="5">Cấp {{item.items[3].store_rank}}</span>
                                            <span class="label" ng-switch-default=>&nbsp;</span>
                                        </div>
                                        {{item.items[3].order_total | currency: '' : 0 }}<br/>
                                        {{item.items[3].order_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[3].delivery_total | currency: '' : 0 }}<br/>
                                        {{item.items[3].delivery_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[3].payment | currency: '' : 0 }}
                                    </td>
                                    <td>
                                        <div ng-switch="item.items[4].store_rank">
                                            <span class="label label-primary" ng-switch-when="1">Cấp {{item.items[4].store_rank}}</span>
                                            <span class="label label-success" ng-switch-when="2">Cấp {{item.items[4].store_rank}}</span>
                                            <span class="label label-info" ng-switch-when="3">Cấp {{item.items[4].store_rank}}</span>
                                            <span class="label label-warning" ng-switch-when="4">Cấp {{item.items[4].store_rank}}</span>
                                            <span class="label label-default" ng-switch-when="5">Cấp {{item.items[4].store_rank}}</span>
                                            <span class="label" ng-switch-default=>&nbsp;</span>
                                        </div>
                                        {{item.items[4].order_total | currency: '' : 0 }}<br/>
                                        {{item.items[4].order_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[4].delivery_total | currency: '' : 0 }}<br/>
                                        {{item.items[4].delivery_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[4].payment | currency: '' : 0 }}
                                    </td>
                                    <td>
                                        <div ng-switch="item.items[5].store_rank">
                                            <span class="label label-primary" ng-switch-when="1">Cấp {{item.items[5].store_rank}}</span>
                                            <span class="label label-success" ng-switch-when="2">Cấp {{item.items[5].store_rank}}</span>
                                            <span class="label label-info" ng-switch-when="3">Cấp {{item.items[5].store_rank}}</span>
                                            <span class="label label-warning" ng-switch-when="4">Cấp {{item.items[5].store_rank}}</span>
                                            <span class="label label-default" ng-switch-when="5">Cấp {{item.items[5].store_rank}}</span>
                                            <span class="label" ng-switch-default=>&nbsp;</span>
                                        </div>
                                        {{item.items[5].order_total | currency: '' : 0 }}<br/>
                                        {{item.items[5].order_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[5].delivery_total | currency: '' : 0 }}<br/>
                                        {{item.items[5].delivery_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[5].payment | currency: '' : 0 }}
                                    </td>
                                    <!--<td>
                                        {{item.items[6].order_total | currency: '' : 0 }}<br/>
                                        {{item.items[6].order_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[6].delivery_total | currency: '' : 0 }}<br/>
                                        {{item.items[6].delivery_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[6].payment | currency: '' : 0 }}
                                    </td>
                                    <td>
                                        {{item.items[7].order_total | currency: '' : 0 }}<br/>
                                        {{item.items[7].order_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[7].delivery_total | currency: '' : 0 }}<br/>
                                        {{item.items[7].delivery_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[7].payment | currency: '' : 0 }}
                                    </td>
                                    <td>
                                        {{item.items[8].order_total | currency: '' : 0 }}<br/>
                                        {{item.items[8].order_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[8].delivery_total | currency: '' : 0 }}<br/>
                                        {{item.items[8].delivery_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[8].payment | currency: '' : 0 }}
                                    </td>
                                    <td>
                                        {{item.items[9].order_total | currency: '' : 0 }}<br/>
                                        {{item.items[9].order_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[9].delivery_total | currency: '' : 0 }}<br/>
                                        {{item.items[9].delivery_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[9].payment | currency: '' : 0 }}
                                    </td>
                                    <td>
                                        {{item.items[10].order_total | currency: '' : 0 }}<br/>
                                        {{item.items[10].order_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[10].delivery_total | currency: '' : 0 }}<br/>
                                        {{item.items[10].delivery_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[10].payment | currency: '' : 0 }}
                                    </td>
                                    <td>
                                        {{item.items[11].order_total | currency: '' : 0 }}<br/>
                                        {{item.items[11].order_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[11].delivery_total | currency: '' : 0 }}<br/>
                                        {{item.items[11].delivery_total_with_discount | currency: '' : 0 }}<br/>
                                        {{item.items[11].payment | currency: '' : 0 }}
                                    </td>-->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--<div class="row" ng-if="vm.m.data.from > 0">
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
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</section>
