<section class="content-header">
    <!-- <ol class="breadcrumb">
    <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
    <li class="active">Lịch nghỉ nghep</li>
    </ol> -->
</section>
<section class="content">
    <ul class="nav nav-tabs">
        <li ng-class="{'active': vm.m.activeFlag == 1}"><a href="javascript:void(0)" ng-click="vm.choose(1)"><h4>Nhập hàng nhà máy</h4></a></li>
        <li ng-class="{'active': vm.m.activeFlag == 2 }"><a href="javascript:void(0)" ng-click="vm.choose(2)"><h4>Nhập hàng bảo hành - trả lại</h4></a></li>
    </ul>
    <div class="tab-content" style="margin-top: 3px">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title" ng-if="vm.m.activeFlag == 1">Danh sách nhập hàng từ nhà máy</h3>
                        <h3 class="box-title" ng-if="vm.m.activeFlag == 2">Danh sách nhập hàng bảo hành - trả lại</h3>
                        <div class="box-tools pull-right">
                            <div uib-dropdown class="btn-group">
                                <a ng-if="vm.m.activeFlag == 2" ui-sref="app.crm0300" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> 
                            </div>
                        </div>
                    </div>
                    <div class="box-body form">
                    <form class="form" ng-submit="vm.doSearch(vm.m.activeFlag,1)">
                        <div class="row">
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
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Kho</label>
                                      <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn nơi xuất'"
                                        ng-model="vm.m[vm.m.activeFlag].filter.warehouse_id"
                                        ng-options="item.warehouse_id as item.warehouse_name for item in vm.m.warehouseList "
                                        >
                                        <option value=0>Không có</option>
                                        </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Nhà cung ứng</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn nhà cung ứng'"
                                        ng-model="vm.m[vm.m.activeFlag].filter.supplier_id"
                                        ng-options="item.supplier_id as item.name for item in vm.m.supplierList"
                                        >
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-12" ng-if="vm.m.activeFlag == 2">
                                <div class="form-group">
                                    <label for="store_name">Tên cửa hàng</label>
                                    <input type="text" class="form-control" id="store_name" ng-model="vm.m[vm.m.activeFlag].filter.store_name" />
                                </div>
                            </div>
                           
                        </div>
                        <div class="row" ng-if="vm.m.activeFlag == 2">
                            <div class="col-md-3 col-sm-6 col-xs-12" ng-if="vm.m.activeFlag == 2">
                                <div class="form-group">
                                    <label for="salesman_name">Người phụ trách</label>
                                    <input type="text" class="form-control" id="salesman_name" ng-model="vm.m[vm.m.activeFlag].filter.salesman_name" />
                                </div>
                            </div>
                           
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Loại Nhập</label>
                                    <select class="form-control" ng-model="vm.m[vm.m.activeFlag].filter.import_type" ng-init="vm.m[vm.m.activeFlag].filter.import_type = ''">
                                        <option value="">Tất cả</option>
                                        <option value="1">Bảo Hành</option>
                                        <option value="2">Trả Lại</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                        <label>Trạng thái</label>
                                        <select class="form-control" ng-model="vm.m[vm.m.activeFlag].filter.import_sts" ng-init="vm.m[vm.m.activeFlag].filter.import_sts = ''">
                                            <option value="">Tất cả</option>
                                            <option value="0">Mới</option>
                                            <option value="1">Nhập kho bán</option>
                                            <option value="5">Hủy</option>
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
                                <button type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.download()">
                                    <i class="fa fa-download fa-fw"></i>
                                    Tải về
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
                                        <th class="col-action"></th>
                                        <th>NO</th>
                                        <th >
                                            <span>Ngày nhập</span>
                                        </th>
                                        <th >
                                            <span>Kho</span>
                                        </th>
                                        <th ng-if="vm.m.activeFlag == 2">
                                            <span>Tên cửa hàng</span>
                                        </th>
                                        <th ng-if="vm.m.activeFlag == 2">
                                            <span>Người phụ trách</span>
                                        </th>
                                        <th ng-if="vm.m.activeFlag == 1">
                                            <span>Tên nhà cung ứng</span>
                                        </th>
                                        <th ng-if="vm.m.activeFlag == 1">
                                            <span>pi_no</span>
                                        </th>
                                        <th>
                                            <span>Ghi chú</span>
                                        </th>
                                        <th >
                                            <span>Loại</span>
                                        </th>
                                        <th ng-if="vm.m.activeFlag == 2">
                                            <span>trạng thái</span>
                                        </th>
                                        <th >
                                            <span>Cập nhật cuối</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data'>
                                        <td class="col-action">
                                            <span ng-if="vm.m.activeFlag == 2" ><a class="text-danger" ui-sref='app.crm1631({type:2, import_wh_id: item.import_wh_store_id})'><b>Chi tiết>></b></a></span>
                                            <span ng-if="vm.m.activeFlag == 1 &&item.active_flg==1"  ><a class="text-danger"  ui-sref='app.crm1631({type:1, import_wh_id: item.import_wh_factory_id})'><b>Đã nhập kho >></b></a></span>
                                            <span ng-if="vm.m.activeFlag == 1 &&item.active_flg==0"  ><a  class="text-success" ui-sref='app.crm1631({type:1, import_wh_id: item.import_wh_factory_id})'><b>Chưa nhập kho >></b></a></span>
                                        </td>
                                        <td>{{$index + vm.m[vm.m.activeFlag].data.from}}</td>

                                        <td>{{item.import_date}}</td>
                                        <td>{{item.warehouse_name}}</td>

                                        <td ng-if="vm.m.activeFlag == 1">{{item.name}}</td>
                                        <td ng-if="vm.m.activeFlag == 1">{{item.pi_no}}</td>
                                        <td ng-if="vm.m.activeFlag == 2">{{item.store_name}}<br/><small><i>{{item.store_address}}</i></small></td>
                                        <td ng-if="vm.m.activeFlag == 2">{{item.salesman_name }}</td>
                                        <td>{{item.notes}}</td>
                                        <td >
                                            <span ng-if="vm.m.activeFlag == 1" class="label label-success">Nhà máy</span>
                                            <span ng-if="vm.m.activeFlag == 2 && item.import_type==1" class="label label-warning">Bảo hành</span>
                                            <span ng-if="vm.m.activeFlag == 2 && item.import_type==2" class="label label-danger">Trả lại</span>
                                        </td>
                                        <td ng-if="vm.m.activeFlag == 2">
                                            <span ng-if="item.import_sts == 0" class="label label-success">Mới</span> 
                                            <span ng-if="item.import_sts == 1" class="label label-primary">Nhập kho bán</span> 
                                            <span ng-if="item.import_sts == 5" class="label label-primary">Hủy</span>
                                        </td>
                                        <td>
                                            {{item.updated_at}}<br/>
                                            <small><i>{{item.updated_by}}</i></small>
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
                                ng-change="vm.doSearch(vm.m.activeFlag,vm.m[vm.m.activeFlag].data.current_page)"
                                class="pagination pagination-sm m-t-none m-b-none">
                                </uib-pagination> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
