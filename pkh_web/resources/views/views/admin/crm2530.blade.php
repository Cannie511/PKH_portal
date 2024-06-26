<section class="content-header">
    <h1>Chi tiết nhập xuất vật phẩm<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Chi tiết nhập xuất vật phẩm</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Chi tiết xuất nhập vật phẩm</h3>
                    <div class="box-tools pull-right">
                        <a ui-sref="app.crm2541({warehouse_change_type: 1})" class="btn btn-success btn-xs"><i class="fa fa-fw fa-plus"></i>&nbsp;Nhập</a>
                        <a ui-sref="app.crm2541({warehouse_change_type: 2})" class="btn btn-warning btn-xs"><i class="fa fa-fw fa-minus"></i>&nbsp;Xuất</a>
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <div class="box-body form">
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="month">Từ ngày</label>
                                    <div class="input-group">
                                        <input class="form-control" datetimepicker ng-model="vm.m.filter.fromDate" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="month">Đến ngày</label>
                                    <div class="input-group">
                                        <input class="form-control" datetimepicker ng-model="vm.m.filter.toDate" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Mã SP</label>
                                    <input type="text" ng-model="vm.m.filter.product_code" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Tên sản phẩm</label>
                                    <input type="text" ng-model="vm.m.filter.product_name" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Loại vật phẩm</label>
                                    <select chosen class="form-control" ng-model="vm.m.filter.product_type" ng-init="vm.m.filter.product_type = ''">
                                        <option value="">Tất cả</option>
                                        <option value="1">Vật phẩm marketing</option>
                                        <option value="2">Văn phòng</option>
                                        <option value="3">In ấn</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Xuất/Nhập</label>
                                    <select chosen class="form-control" ng-model="vm.m.filter.warehouse_change_type" ng-init="vm.m.filter.warehouse_change_type = ''">
                                        <option value="">Tất cả</option>
                                        <option value="1">Nhập</option>
                                        <option value="2">Xuất</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select chosen class="form-control" ng-model="vm.m.filter.status" ng-init="vm.m.filter.status = ''">
                                        <option value="">Tất cả</option>
                                        <option value="1">Mới</option>
                                        <option value="2">Đồng ý</option>
                                        <option value="3">Từ chối</option>
                                        <option value="4">Hủy</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                                    <i class="fa fa-search fa-fw"></i>
                                    <span translate="COM_BTN_SEARCH"></span>
                                </button>
                                <button type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.resetFilter()">
                                    <i class="fa fa-eraser fa-fw"></i>
                                    <span translate="COM_BTN_RESET"></span>
                                </button>
                                <button ng-if="vm.can('screen.crm0920.download')" type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.download()">
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
                                <tr class="row">
                                    <th></th>
                                    <th>NO</th>
                                    <th>Ngày</td>
                                    <th>Xuất/Nhập</td>
                                    <th>Loại</td>
                                    <th>Vật phẩm</td>
                                    <th>Giá</td>
                                    <th>Số lượng</td>
                                    <th>Thành tiền</td>
                                    <th>Trạng thái</td>                        
                                    <th>Cửa hàng</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list.data' class="row" 
                                    ng-class="{
                                        'row-success': item.status == '1', 
                                        'row-info': item.status == '2',
                                        'row-danger': item.status == '3',
                                        'row-default': item.status == '4'
                                    }"
                                    >
                                    <td class="col-action">
                                        <div class="btn-group" uib-dropdown dropdown-append-to-body>
                                          <button type="button" class="btn btn-default btn-sm" uib-dropdown-toggle>
                                            <i class="fa fa-ellipsis-v"></i>
                                          </button>
                                          <ul class="dropdown-menu" uib-dropdown-menu role="menu" aria-labelledby="btn-append-to-body">
                                            <li ng-if="vm.can('screen.crm2540.update')" role="menuitem"><a ui-sref='app.crm2540({product_market_his_id: item.product_market_his_id})' translate="COM_BTN_EDIT"></a></li>
                                          </ul>
                                        </div>
                                    </td>
                                    <td>{{$index + vm.m.list.from}}</td>
                                    <td class="nowrap">{{item.changed_date}}</td>
                                    <td class="nowrap">
                                        <span ng-if="item.warehouse_change_type == 1" class="text-info"><i class="fa fa-long-arrow-right fa-fw"></i>Nhập</span>
                                        <span ng-if="item.warehouse_change_type == 2" class="text-success"><i class="fa fa-long-arrow-left fa-fw"></i>Xuất</span>
                                    </td>
                                    <td>
                                        <span ng-if="item.type == 1">Marketing</span>
                                        <span ng-if="item.type == 2">Văn phòng</span>
                                        <span ng-if="item.type == 3">In ấn</span>
                                    </td>
                                    <td class="nowrap">{{item.code}}<br/>{{item.name}}</td>
                                    <td class="text-right">{{item.price | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.amount | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.amount * item.price | currency: '' : 0}}</td>
                                    <td>
                                        <!-- // 1: NEW // 2: APPROVE // 3: DENY // 4: CANCEL -->
                                        <span ng-if="item.status == '1'"><span class="label label-success">Mới</span></span>
                                        <span ng-if="item.status == '2'"><span class="label label-info">Đồng ý</span></span>
                                        <span ng-if="item.status == '3'"><span class="label label-danger">Từ chối</span></span>
                                        <span ng-if="item.status == '4'"><span class="label label-default">Hủy</span></span>
                                    </td>
                                    <td>
                                        <span ng-if="item.store_name">{{item.store_name}}<span>
                                        <br/>
                                        <span ng-if="item.store_address">{{item.store_address}}<span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row" ng-if="vm.m.list.from > 0">
                        <div class="col-md-6 col-sm-12 text-left">
                            <p class="form-control-static">{{vm.m.list.from}} - {{vm.m.list.to}} / {{vm.m.list.total}}</p>                            
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <uib-pagination ng-show="vm.m.list.from > 0"
                                total-items="vm.m.list.total"
                                ng-model="vm.m.list.current_page"
                                items-per-page="vm.m.list.per_page"
                                ng-change="vm.doSearch(vm.m.list.current_page)"
                                class="pagination pagination-sm m-t-none m-b-none">
                            </uib-pagination>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
