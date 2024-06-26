<section class="content-header">
    <h1>Tồn kho<small></small></h1>
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
                    <h3 class="box-title">Tồn kho vật phẩm</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body form">
                <form class="form" ng-submit="vm.search()">
                        <div class="row">
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
                            <!-- <div class="col-md-3 col-sm-6 m-b-xs">
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
                            </div> -->
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
                                    <th>NO</th>
                                    <th>Hình ảnh</th>
                                    <th>Loại</td>
                                    <th>Vật phẩm</td>
                                    <th>Số lượng nhập</td>
                                    <th>Số lượng xuất</td>
                                    <th>Số lượng còn lại</td>                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list.data' class="row">
                                    <td>{{$index + vm.m.list.from}}</td>
                                    <td>
                                        <img ng-if="item.img_path" class="img-thumb-product-2x" ng-src="/images{{item.img_path}}" />
                                    </td>
                                    <td>
                                        <span ng-if="item.type == 1">Marketing</span>
                                        <span ng-if="item.type == 2">Văn phòng</span>
                                        <span ng-if="item.type == 3">In ấn</span>
                                    </td>
                                    <td class="nowrap">{{item.code}}<br/>{{item.name}}</td>
                                    <td class="text-right">{{item.total_amount_in | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.total_amount_out | currency: '' : 0}}</td>
                                    <td class="text-right">{{(item.total_amount_in - item.total_amount_out) | currency: '' : 0}}</td>
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
