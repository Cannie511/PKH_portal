<section class="content-header">
    <h1>Danh sách cửa hàng <small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Danh sách cửa hàng</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách cửa hàng</h3>
                    <div class="box-tools pull-right">
                        <a ui-sref="app.crm0310" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a>
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <div class="box-body form">
                    <form role="form" ng-submit="vm.search()">
                        <div class="row">
                            
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
                            <!--<div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input type="text" ng-model="vm.m.filter.store_id" class="form-control"/>
                                </div>
                            </div>-->
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="month">Tháng bắt đầu</label>
                                    <div class="input-group">
                                        <input class="form-control" datetimepicker ng-model="vm.m.filter.month" placeholder="YYYY-MM" options="vm.m.datetimepicker_options"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
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
                                    <label>Fax/Điện thoại</label>
                                    <input type="text" ng-model="vm.m.filter.contact" class="form-control"/>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="row">
                             <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Tỉnh/Thành chành</label>
                                    {{vm.m.filter.chanh_area1}}
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn tỉnh'"
                                        ng-model="vm.m.filter.chanh_area1"
                                        ng-options="item.area_id as item.name for item in vm.m.init.listArea1 "
                                        >
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group" ng-if="vm.m.filter.chanh_area1">
                                    <label>Quận/Huyện chành</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn tỉnh'"
                                        ng-model="vm.m.filter.chanh_area2"
                                        ng-options="item.area_id as item.name for item in vm.m.init.listArea2| filter : {'parent_area_id': vm.m.filter.chanh_area1}"
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
                                <button type="button" class="btn btn-info btn-sm btn-width-default"  ng-if="vm.can('screen.crm0300.download')" ng-click="vm.download()">
                                    <i class="fa fa-download fa-fw"></i>
                                    Tải về
                                </button>
                                <!-- <button type="button" class="btn btn-warning btn-sm btn-width-default"  ng-if="vm.can('screen.crm0300.update_zalo')" ng-click="vm.updateZalo()">
                                    <i class="fa fa-send fa-fw"></i>
                                    Cập nhật ZALO
                                </button> -->
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="col-action"></th>
                                    <th>NO</th>
                                    <!--<th>ID</th>-->
                                    <th>Vùng</th>
                                    <th ng-click="vm.sort('area1');" class="sortable">
                                        <span translate="COM_LABEL_AREA1"></span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="area1"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <!--<th ng-click="vm.sort('area1');" class="sortable">
                                        <span translate="COM_LABEL_AREA2"></span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="area2"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>-->
                                    <!--<th ng-click="vm.sort('dealer_name');" class="sortable">
                                        <span translate="COM_LABEL_DEALER"></span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="dealer_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>-->
                                   
                                    <th ng-click="vm.sort('name');" class="sortable">
                                        <span translate="COM_LABEL_STORE"></span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                   
                                    <th>
                                        <span>Chiết khấu</span>
                                    </th>
                                    <th style="width: 200px">
                                        <span>Liên hệ</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    
                                    <th>Ngày bắt đầu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data'>
                                    <td class="col-action">                       
                                        <button type="button" class="btn btn-default btn-sm" ng-click="vm.openMenu(item)">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                    </td>
                                    <td>{{$index + vm.m.data.from}}</td>
                                    <!--<td>{{item.store_id}}</td>-->
                                    <td>{{item.area_group_name}}</td>
                                    <td>
                                        {{item.area1_name}}<br/>
                                        <i>{{item.area2_name}}</i>
                                    </td>
                                    <!--<td>{{item.area2_name}}</td>-->
                                    <!--<td>{{item.dealer_name}}</td>-->
                                    <td>
                                        <a ui-sref='app.crm2600({store_id: item.store_id})'> #{{item.store_id}}</a>
                                        &nbsp;-&nbsp;{{item.name}}
                                        &nbsp;
                                        <span class="badge badge-success" ng-if="item.is_review_valid && item.review_sts == 'VERIFIED'"><i class="fas fa-thumbs-up fa-fw"></i>&nbsp;{{item.review_expired_date}}</span>
                                        <span class="badge badge-warning" ng-if="!item.is_review_valid && item.review_sts == 'VERIFIED'"><i class="fas fa-thumbs-up fa-fw"></i>&nbsp;{{item.review_expired_date}}</span>
                                        <span class="badge badge-danger" ng-if="item.review_sts == 'BLACKLIST'"><i class="fas fa-thumbs-down"></i></span>
                                        <br/>
                                        <a target="__blank" href="http://www.google.com/maps/place/{{item.gps_lat}},{{item.gps_long}}">
                                            <i ng-class="{'text-danger': item.gps_lat == 0 || item.gps_long == 0, 'text-success': item.gps_lat != 0 && item.gps_long != 0}" class="fa fa-map-marker "></i>
                                            <i>{{item.address}}</i>
                                        </a> 
                                        
                                    </td>
                                   
                                    <td>
                                        {{item.discount}}
                                    </td>
                                    <td>
                                        <span ng-if="item.contact_name">{{item.contact_name}} &nbsp;</span>
                                        <nobr ng-if="item.contact_tel"><i class="fa fa-phone fa-fw"></i>{{item.contact_tel}}</nobr>
                                        <nobr ng-if="item.contact_fax"><i class="fa fa-fax fa-fw"></i>{{item.contact_fax}}</nobr>
                                        <nobr ng-if="item.contact_mobile1"><i class="fa fa-mobile fa-fw"></i>{{item.contact_mobile1}}</nobr>
                                        <nobr ng-if="item.contact_mobile2"><i class="fa fa-mobile fa-fw"></i>{{item.contact_mobile2}}</nobr>
                                    </td>
                                    
                                    <td>
                                        <span ng-if="item.first_order != null">{{item.first_order}}</span>
                                        <span ng-if="item.first_order == null" class="label label-warning">Chưa đặt</span>
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