<section class="content-header">
    <h1>Vị trí mới nhất <small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Vị trí mới nhất</li>
    </ol>
</section>
<section class="content hrm0150">
    <div class="row">
        <div class="col-md-9" ng-class="{'col-md-9': vm.m.showList, 'col-md-12': !vm.m.showList}">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Vị trí</h3>
                    <div class="box-tools pull-right">
                        <a ng-click="vm.search()" class="btn btn-info btn-xs"><i class="fa fa-refresh"></i>&nbsp;Tải lại</a>
                        <a ng-click="vm.toogleList()" class="btn btn-info btn-xs"><i class="fa fa-list"></i>&nbsp;Danh sách</a>
                    </div>
                </div>
                <div class="box-body">
                    <div map-lazy-load="https://maps.google.com/maps/api/js?key=<% env('GOOGLE_MAP_KEY')%>">
                        <ng-map center="10.737462,106.711953" zoom="17" style="height: 640px" default-style="false" zoom-to-include-markers='auto'>
                            <custom-marker ng-repeat="item in vm.m.data.lastPos.data" position="{{item.gps_lat}},{{item.gps_long}}" title="{{item.name}}">
                                <span>{{item.name}}</span>
                            </custom-marker>
                            <marker id="market_{{$index}}" ng-repeat="item in vm.m.data.lastPos.data" 
                                position="{{item.gps_lat}},{{item.gps_long}}" 
                                title="{{item.name}}"
                                on-click="vm.showInfo(event, item, vm)"
                                >
                            </marker>
                            <info-window id="myInfoWindow" >
                                <div ng-non-bindable>
                                    <h5>{{vm.m.selected.name}}</h5>
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
                    <h3 class="box-title">Nhân viên</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.crm0310" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <!--<div class="box-body form">
                    <form role="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                                    <i class="fa fa-search fa-fw"></i>
                                    <span translate="COM_BTN_SEARCH"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>-->
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
                                <tr ng-repeat='item in vm.m.data.lastPos.data' ng-click="vm.focusItem(item, $index)">
                                    <td>{{$index + vm.m.data.lastPos.from}}</td>
                                    <td>{{item.name}}</td>
                                    <td>{{item.track_time}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row" ng-if="vm.m.data.lastPos.from > 0">
                        <div class="col-md-12 col-sm-12 text-left">
                            <p class="form-control-static">{{vm.m.data.lastPos.from}} - {{vm.m.data.lastPos.to}} / {{vm.m.data.lastPos.total}}</p>                            
                        </div>
                        <div class="col-md-12 col-sm-12 text-right">
                            <uib-pagination ng-show="vm.m.data.lastPos.from > 0"
                                total-items="vm.m.data.lastPos.total"
                                ng-model="vm.m.data.lastPos.current_page"
                                items-per-page="vm.m.data.lastPos.per_page"
                                ng-change="vm.doSearch(vm.m.data.lastPos.current_page)"
                                class="pagination pagination-sm m-t-none m-b-none">
                            </uib-pagination>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>