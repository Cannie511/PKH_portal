<section class="content-header">
    <h1>Kiểm gia giao hàng<small></small></h1>
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
                    <h3 class="box-title">Danh sách hàng giao chưa đủ</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body form">
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="month">Tháng</label>
                                    <div class="input-group">
                                        <input id="monthPicker" class="form-control" datetimepicker ng-model="vm.m.filter.month" placeholder="YYYY-MM" options="vm.m.datetimepicker_options"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="store_order_code">Mã đơn hàng</label>
                                    <input type="text" class="form-control" id="store_order_code" ng-model="vm.m.filter.store_order_code" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="store_name">Cửa hàng</label>
                                    <input type="text" class="form-control" id="store_name" ng-model="vm.m.filter.store_name" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="product_code">Mã SP</label>
                                    <input type="text" class="form-control" id="product_code" ng-model="vm.m.filter.product_code" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Loại</label>
                                    <select class="form-control"
                                        placeholder-text-single="'Chọn Loại'"
                                        ng-model="vm.m.filter.search_type"
                                        >
                                        <option value='1'>Sản Phẩm</option>
                                        <option value='2'>Đơn hàng</option>
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
                                <button ng-if="vm.can('screen.crm0220.download')" type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.download()">
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
                                    <th>NO</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Ngày đặt</th>
                                    <th>Cửa hàng</th>
                                    <th ng-if="vm.m.search_type == '1'">Mã sản phẩm</th>
                                    <th ng-if="vm.m.search_type == '1'">Tên sản phầm</th>
                                    <th ng-if="vm.m.search_type == '1'">Giá</th>
                                    <th ng-if="vm.m.search_type == '1'">SL Đặt</th>
                                    <th ng-if="vm.m.search_type == '1'">SL Giao</th>
                                    <th ng-if="vm.m.search_type == '1'">Còn lại</th>
                                    <th>NVBH</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data'>
                                    <td>{{$index + vm.m.data.from}}</td>                                    
                                    <td>
                                        <a ui-sref='app.crm0211({store_id: item.store_id, store_order_id: item.store_order_id})'>#{{item.store_order_code}}</a>
                                    </td>
                                    <td>{{item.order_date}}</td>
                                    <td>{{item.store_name}}</td>
                                    <td ng-if="vm.m.search_type == '1'">{{item.product_code}}</td>
                                    <td ng-if="vm.m.search_type == '1'">{{item.product_name}}</td>
                                    <td ng-if="vm.m.search_type == '1'" class="text-right">{{item.unit_price | currency : '' : 0}}</td>
                                    <td ng-if="vm.m.search_type == '1'" class="text-right">{{item.order_amount | currency : '' : 0}}</td>
                                    <td ng-if="vm.m.search_type == '1'" class="text-right">{{item.delivery_amount | currency : '' : 0}}</td>
                                    <td ng-if="vm.m.search_type == '1'" class="text-right">
                                        <span ng-if="item.order_amount < item.delivery_amount" class="text-danger">{{item.order_amount - item.delivery_amount | currency : '' : 0}}</span>
                                        <span ng-if="item.order_amount >= item.delivery_amount" class="text-warning">{{item.order_amount - item.delivery_amount | currency : '' : 0}}</span>
                                    </td>
                                    <td>{{item.salesman_name}}</td>
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
