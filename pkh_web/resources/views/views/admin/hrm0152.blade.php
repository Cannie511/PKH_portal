<section class="content-header">
    <h1>Checkin <small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Checkin</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-4 col-xs-12" ng-if="vm.m.showList">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Vị trí</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body">
                    <div map-lazy-load="https://maps.google.com/maps/api/js?key=<% env('GOOGLE_MAP_KEY')%>">
                        <ng-map 
                            center="10.737462,106.711953" 
                            zoom="17" style="height: 640px" 
                            default-style="false"
                            >
                            <marker id="market_{{$index}}" ng-repeat="item in vm.m.data.data" 
                                position="{{item.gps_lat}},{{item.gps_long}}" 
                                title="{{item.name}}"
                                on-click="vm.showInfo(event, item, vm)"
                                >
                            </marker>
                            <marker id="store_market" 
                                position="{{vm.m.selected.store_gps_lat}},{{vm.m.selected.store_gps_long}}" 
                                title="{{vm.m.selected.store_name}}"
                                icon="https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png"
                                on-click="vm.showStoreInfo(event, vm.m.selected, vm)"
                                ng-if="vm.m.selected"
                                >
                            </marker>
                            <info-window id="myInfoWindow" >
                                <div ng-non-bindable>
                                    <span>{{vm.m.selected.salesman_name}}</span>
                                    <br/>
                                    <span>{{vm.m.selected.working_time}}</span>
                                </div> 
                            </info-window>
                            <info-window id="myInfoWindowStore" >
                                <div ng-non-bindable>
                                    <span>{{vm.m.selected.store_name}}</span>
                                </div> 
                            </info-window>
                        </ng-map>
                    </div>
                </div>
            </div>
        </div>
        <div ng-class="{'col-md-8': vm.m.showList, 'col-md-12': !vm.m.showList}">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Lịch sử</h3>
                    <div class="box-tools pull-right">
                        <a ng-click="vm.toogleList()" class="btn btn-info btn-xs"><i class="fa fa-list"></i></a>
                        <!-- <a ui-sref="app.crm0310" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <div class="box-body form">
                    <form role="form" ng-submit="vm.search()">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="month">Từ ngày</label>
                                    <div class="input-group">
                                        <input id="monthPicker" class="form-control" 
                                            datetimepicker ng-model="vm.m.filter.dateFrom" placeholder="YYYY-MM-DD HH:mm" options="vm.m.optionsFrom"
                                            on-change="vm.update(vm.m.filter.dateFrom, vm.m.filter.dateTo)"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="month">Đến ngày</label>
                                    <div class="input-group">
                                        <input id="monthPicker" class="form-control" datetimepicker ng-model="vm.m.filter.dateTo" placeholder="YYYY-MM-DD HH:mm" 
                                            options="vm.m.optionsTo"
                                            on-change="vm.update(vm.m.filter.dateFrom, vm.m.filter.dateTo)"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                          
                                <div class="form-group">
                                    <label>Nhân viên</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn nhân viên'"
                                        ng-model="vm.m.filter.user_id"
                                        ng-options="item.user_id as item.user_name for item in vm.m.init.users "
                                        >
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tên cửa hàng</label>
                                    <input type="text" ng-model="vm.m.filter.store_name" class="form-control"/>
                                </div>
                               
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                                    <i class="fa fa-search fa-fw"></i>
                                    <span translate="COM_BTN_SEARCH"></span>
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
                                    <th>Tên</th>
                                    <th>Thời gian</th>
                                    <th>Cửa hàng</th>
                                    <th>Độ lệch</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data'>
                                    <td ng-click="vm.focusItem(item, $index)">{{$index + vm.m.data.from}}</td>
                                    <td ng-click="vm.focusItem(item, $index)"><a href="javascript:void(0);">{{item.working_time}}</a></td>
                                    <td ng-click="vm.focusItem(item, $index)">{{item.salesman_name}}</td>
                                    <td>
                                        {{item.store_name}}
                                        <br/>
                                        <small>{{item.store_address}} {{item.store_area2_name}} {{item.store_area1_name}}</small>
                                        <br/>
                                        {{item.gps_lat}},{{item.gps_long}}
                                        <br/>
                                        {{item.notes}}
                                        <br/>
                                        <ul ng-if="item.images" class="list-inline">
                                            <li ng-repeat="img in item.images">
                                                <a target="__blank" ng-href="/images{{img.img_path}}">
                                                    <img ng-src="/images{{img.img_path | imgThumb}}" class="img-rounded img-thumb-product-2x"/>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        {{item.dist | currency: '' : 0}} Km
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row" ng-if="vm.m.data.from > 0">
                        <div class="col-md-12 col-sm-12 text-left">
                            <p class="form-control-static">{{vm.m.data.from}} - {{vm.m.data.to}} / {{vm.m.data.total}}</p>                            
                        </div>
                        <div class="col-md-12 col-sm-12 text-right">
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