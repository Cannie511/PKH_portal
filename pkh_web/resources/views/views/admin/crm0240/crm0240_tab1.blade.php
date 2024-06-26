<div class="row" ng-if="vm.m.activeFlag == 1" >
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách yêu cầu xử lý đơn</h3>
                    <div class="box-tools pull-right">
                        <div uib-dropdown class="btn-group">
                            <!-- <a ui-sref="app.crm0210" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                            <!-- <button type="button" uib-dropdown-toggle class="btn btn-success btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                            </button>
                            <ul uib-dropdown-menu>
                                <li><a ui-sref="a">a</a></li>
                                <li><a ui-sref="b">b</a></li>
                                <li><a ui-sref="c">c</a></li>
                                <li><a ui-sref="d">d</a></li>
                            </ul> -->
                        </div>
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                 <div class="box-body form">
                    <form class="form" ng-submit="vm.doSearch(vm.m.activeFlag,1)">
                        <div class="row" ng-if="vm.m.activeFlag == 1">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="day">Từ ngày</label>
                                    <div class="input-group">
                                        <input class="form-control" datetimepicker ng-model="vm.m[vm.m.activeFlag].filter.from_date" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
                                        <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="day">Đến ngày</label>
                                    <div class="input-group">
                                        <input class="form-control" datetimepicker ng-model="vm.m[vm.m.activeFlag].filter.to_date" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
                                        <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-3 col-sm-6 col-xs-12" ng-if="vm.m.activeFlag == 1">
                                <div class="form-group">
                                    <label for="store_name">Tên cửa hàng</label>
                                    <input type="text" class="form-control" id="store_name" ng-model="vm.m[vm.m.activeFlag].filter.store_name" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12" ng-if="vm.m.activeFlag == 1">
                                <div class="form-group">
                                    <label for="salesman_name">Người phụ trách</label>
                                    <input type="text" class="form-control" id="salesman_name" ng-model="vm.m[vm.m.activeFlag].filter.salesman_name" />
                                </div>
                            </div>
                        </div>
                        <div class="row" ng-if="vm.m.activeFlag == 1">
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Loại yêu cầu</label>
                                    <select class="form-control" ng-model="vm.m[vm.m.activeFlag].filter.request_type" >
                                        <option value="">Tất cả</option>
                                        <option value="1">Hủy đơn đặt hàng</option>
                                        <option value="2">Hủy đơn xuất hàng</option>
                                        <option value="3">Hủy hàng còn lại</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                        <label>Trạng thái</label>
                                        <select class="form-control" ng-model="vm.m[vm.m.activeFlag].filter.request_sts">
                                            <option value="">Tất cả</option>
                                            <option value="0">Chờ xác nhận</option>
                                            <option value="1">Đồng ý</option>
                                            <option value="2">Từ chối</option>
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
                                <button type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.resetFilter(vm.m.activeFlag)">
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
                                    <th style="width:30px">NO</th>
                                    <th style="width:120px">Ngày yêu cầu</th>
                                    <th style="width:100px">Yêu cầu</th>
                                    <th style="width:100px">Trạng thái</th>
                                    <th style="width:200px">Người phụ trách đơn</th>
                                    <th style="width:240px">Đơn hàng</th>
                                    <th>Ghi chú</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data'>
                                    <td>{{$index + vm.m[vm.m.activeFlag].data.from}}</td>
                                    <td>
                                        #{{item.request_id}} - {{item.request_date | date:'yyyy-MM-dd'}}
                                        <br/>
                                        <small>({{item.created_user_name}})</small>
                                    </td>
                                    <td>
                                        <span class="label label-warning" ng-if="item.request_type == 1">Hủy đơn đặt</span>
                                        <span class="label label-warning" ng-if="item.request_type == 2">Hủy phiếu xuất</span>
                                        <span class="label label-danger" ng-if="item.request_type == 3">Hủy hàng còn</span>
                                    </td>
                                    <td>
                                        <span class="label label-primary" ng-if="item.request_sts == 0">Chờ xác nhận</span>
                                        <span class="label label-success" ng-if="item.request_sts == 1">Đồng ý</span>
                                        <span class="label label-danger" ng-if="item.request_sts == 2">Từ chối</span>
                                    </td>
                                     <td>
                                        <span ng-if="item.request_type == 1 || item.request_type == 3">{{item.sale_1}}</span>
                                        <span  ng-if="item.request_type == 2">{{item.sale_2}}</span>
                                    </td>
                                    <td ng-if="item.request_type == 1 || item.request_type == 3">
                                        <a ng-if="item.store_order_code" ui-sref='app.crm0211({store_id: item.store_id, store_order_id: item.store_order_id})'>#{{item.store_order_code}}</a>
                                        <br/>
                                        {{item.store_name}} <br/>
                                        <small>{{item.address}}</small>
                                    </td>
                                   
                                    <td ng-if="item.request_type == 2">
                                        <a ui-sref='app.crm0411({store_order_id: item.store_order_id_delivery, store_delivery_id: item.store_delivery_id})'>#{{item.store_order_code_delivery}}</a>
                                        <br/>
                                        {{item.store_name_delivery}} <br/>
                                        <small>{{item.address_delivery}}</small>
                                    </td>
                                    <td>
                                        {{item.request_notes}}
                                        <hr/>
                                        {{item.response_notes}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row" ng-if="vm.m[vm.m.activeFlag].data.from > 0">
                        <div class="col-md-6 col-sm-12 text-left">
                            <p class="form-control-static">{{vm.m[vm.m.activeFlag].data.from}} - {{vm.m[vm.m.activeFlag].data.to}} / {{vm.m[vm.m.activeFlag].data.total}}</p>                            
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <uib-pagination ng-show="vm.m[vm.m.activeFlag].data.from > 0"
                                total-items="vm.m[vm.m.activeFlag].data.total"
                                ng-model="vm.m[vm.m.activeFlag].data.current_page"
                                items-per-page="vm.m[vm.m.activeFlag].data.per_page"
                                ng-change="vm.doSearch(1,vm.m[vm.m.activeFlag].data.current_page)"
                                class="pagination pagination-sm m-t-none m-b-none">
                            </uib-pagination>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
