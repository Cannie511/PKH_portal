<section class="content-header">
    <h1>Ghi chú cửa hàng<small></small></h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách ghi chú cửa hàng</h3>
                    <div class="box-tools pull-right">
                        <!--<a ui-sref="app.crm0331({store_id: item.store_id})" class="btn btn-success btn-xs">-->
                        <!--<a ui-sref="app.crm0331({store_id: 26})" class="btn btn-success btn-xs">-->
                        <a ui-sref="app.crm0331" class="btn btn-success btn-xs">
                        <i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a>
                    </div>
                </div>
                <div class="box-body form">
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                            <!--<div class="col-md-3 col-sm-6 m-b-xs">
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
                            </div>-->
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
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Tên cửa hàng</label>
                                    <input type="text" ng-model="vm.m.filter.name" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Mã cửa hàng</label>
                                    <input type="text" ng-model="vm.m.filter.store_id" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--<div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Tên cửa hàng</label>
                                    <input type="text" ng-model="vm.m.filter.name" class="form-control"/>
                                </div>
                            </div>-->
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
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="from_date">Từ ngày</label>
                                    <p class="input-group">
                                        <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.filter.from_date" is-open="vm.dp1Opened" datepicker-options="vm.m.dateOptions" close-text="Close"
                                        ng-model-options="{timezone: 'utc'}" />
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" ng-click="vm.dp1Opened = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="to_date">Đến ngày</label>
                                    <p class="input-group">
                                        <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.filter.to_date" is-open="vm.dp2Opened" datepicker-options="vm.m.dateOptions" close-text="Close"
                                        ng-model-options="{timezone: 'utc'}" />
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" ng-click="vm.dp2Opened = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </p>
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
                                    <th>NO</th>
                                    <th>HÌnh ảnh</th>
                                    <!--<th ng-click="vm.sort('area_group_name');" class="sortable">
                                        <span>Vùng</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="area_group_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>-->
                                    <th>Thời gian làm việc</th>
                                    <th ng-click="vm.sort('area1_name');" class="sortable">
                                        <span>Tỉnh/Thành</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="area1_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th ng-click="vm.sort('area2_name');" class="sortable">
                                        <span>Quận/Huyện</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="area2_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th ng-click="vm.sort('store_name');" class="sortable">
                                        <span>Cửa hàng</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="store_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th ng-click="vm.sort('salesman');" class="sortable">
                                        <span>NVBH</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="salesman"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>

                                    <th>Ghi chú</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data'>
                                    <td>{{$index + vm.m.data.from}}</td>
                                    <td>
                                        <img class="thumb-img-list-item" ng-if="item.img_path" ng-src="/images/{{item.img_path}}" />
                                    </td>
                                    <td>
                                        <a ui-sref='app.crm0332({store_id: item.store_id,store_working_id: item.id})' style="white-space:nowrap">{{item.working_time}}</a>
                                    </td>
                                    <!--<td>{{item.area_group_name}}</td>-->
                                    <td>{{item.area1_name}}</td>
                                    <td>{{item.area2_name}}</td>
                                    <td>
                                        <a ui-sref='app.crm2600({store_id: item.store_id})'>#{{item.store_id}}</a>
                                        <br/>
                                        {{item.store_name}}
                                    </td>
                                    <td>{{item.salesman_name}}</td>                                   
                                    <td>{{item.notes}}</td>
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
