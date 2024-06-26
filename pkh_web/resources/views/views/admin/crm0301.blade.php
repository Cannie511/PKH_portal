<section class="content-header">
    <h1>Bản đồ cửa hàng <small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Bản đồ cửa hàng</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Bản đồ cửa hàng</h3>
                    <div class="box-tools pull-right">
                        <a ng-click="vm.search()" class="btn btn-info btn-xs"><i class="fa fa-refresh"></i></a>
                    </div>
                </div>
                <div class="box-body">
                    <div map-lazy-load="https://maps.google.com/maps/api/js?key=<% env('GOOGLE_MAP_KEY')%>">
                        <ng-map center="10.737462,106.711953" zoom="5" style="height: 640px" default-style="false">
                            <!-- <marker id="market_{{$index}}" ng-repeat="item in vm.m.listPos" 
                                position="{{item.gps_lat}},{{item.gps_long}}" 
                                title="{{item.name}}"
                                on-click="vm.showInfo(event, item, vm)"
                                >
                            </marker> -->
                            <info-window id="myInfoWindow" >
                                <div ng-non-bindable>
                                    <span><b>{{vm.m.selected.name}}</b></span><br/>
                                    <small>{{vm.m.selected.address}} {{vm.m.selected.area2_name}} {{vm.m.selected.area1_name}}</small><br/>
                                    <small>{{vm.m.selected.salesman_name}}</small><br/>
                                    <small>{{vm.m.selected.first_order}}</small><br/>
                                </div> 
                            </info-window>
                        </ng-map>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>