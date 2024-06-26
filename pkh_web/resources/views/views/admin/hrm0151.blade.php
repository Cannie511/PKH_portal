<section class="content-header">
    <h1>Lịch sử vị trí <small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Lịch sử vị trí</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-9" ng-class="{'col-md-9': vm.m.showList, 'col-md-12': !vm.m.showList}">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Vị trí</h3>
                    <div class="box-tools pull-right">
                        <a ng-click="vm.toogleList()" class="btn btn-info btn-xs"><i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="box-body">
                    <div map-lazy-load="https://maps.google.com/maps/api/js?key=<% env('GOOGLE_MAP_KEY')%>">
                        <ng-map center="10.737462,106.711953" zoom="17" style="height: 640px" default-style="false" zoom-to-include-markers='auto'>
                            <marker id="market_{{$index}}" ng-repeat="item in vm.m.data.data" 
                                position="{{item.gps_lat}},{{item.gps_long}}" 
                                title="{{item.name}}"
                                on-click="vm.showInfo(event, item, vm)"
                                >
                            </marker>
                            <shape name="polyline" 
                                path="{{vm.m.direction}}" 
                                geodesic="true" 
                                stroke-color="#4285F4" 
                                stroke-opacity="0.5" 
                                stroke-weight="1.5"
                                icons="{{vm.m.mapOption.icons}}"
                                ng-if="vm.m.direction.length > 0"
                            >
                            </shape>
                            <info-window id="myInfoWindow" >
                                <div ng-non-bindable>
                                    <span>{{vm.m.selected.track_time}}</span>
                                </div> 
                            </info-window>
                        </ng-map>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3" ng-if="vm.m.showList">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Lịch sử</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.crm0310" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <div class="box-body form">
                    <form role="form" ng-submit="vm.search()">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nhân viên</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn nhân viên'"
                                        ng-model="vm.m.filter.user_id"
                                        ng-options="item.user_id as item.user_name for item in vm.m.init.users "
                                        >
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
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
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data' ng-click="vm.focusItem(item, $index)">
                                    <td>{{$index + vm.m.data.from}}</td>
                                    <td>{{item.name}}</td>
                                    <td>{{item.track_time}}</td>
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