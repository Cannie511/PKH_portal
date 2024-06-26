<section class="content-header">
    <h1>Số ngày tồn kho<small></small></h1>
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
                    <h3 class="box-title">Số ngày tồn kho của sản phẩm</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body form">
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Số ngày tối thiểu (> X)</label>
                                    <input type="number" class="form-control" ng-model="vm.m.filter.days"/>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Mã sản phẩm</label>
                                    <input type="text" class="form-control" ng-model="vm.m.filter.product_code"/>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Nhà cung ứng</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn nhà cung ứng'"
                                        ng-model="vm.m.filter.supplier_id"
                                        ng-options="item.supplier_id as item.name for item in vm.m.init.supplierList"
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
                                <button ng-if="vm.can('screen.crm0912.download')" type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.download()">
                                    <i class="fa fa-download fa-fw"></i>
                                    Tải về
                                </button>
                                <!-- <button ng-if="vm.can('screen.crm0912.exec')" type="button" class="btn btn-warning btn-sm btn-width-default" ng-click="vm.run()">
                                    <i class="fa fa-play fa-fw"></i>
                                    Tính lại
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
                                    <th>NO</th>
                                    <th>Ngày</th>
                                    <th>PI NO</th>
                                    <th>Nhà cung ứng</th>
                                    <th>Sản phẩm</th>
                                    <th class="text-right">SL nhập<br/>(cái)</th>
                                    <th class="text-right">Còn lại<br/>(cái)</th>
                                    <th class="text-right">Đơn giá<br/>(VND)</th>
                                    <th class="text-right">Tồn kho<br/>(Ngày)</th>
                                    <th class="text-right">Giá trị<br/>(VND)</th>
                                    <th class="text-right">Còn lại<br/>(%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list'>
                                    <td>{{$index + 1}}</td>
                                    <td nowrap>{{item.in_date}}</td>
                                    <td><a ui-sref="app.crm0915({pi_no: item.pi_no})">{{item.pi_no}}</a></td>
                                    <td>{{item.supplier_code}}</td>
                                    <td>{{item.product_code}}<br/>{{item.name}}</td>
                                    <td class="text-right">{{item.amount | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.remain | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.selling_price | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.spent | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.selling_price * item.remain  | currency: '' : 0}}</td>
                                    <td class="text-right">
                                        <div class="progress progress-bar-info">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{item.remain * 100 / item.amount}}"
                                            aria-valuemin="0" aria-valuemax="100" style="width:{{item.remain * 100 / item.amount}}%">
                                                {{(item.remain * 100 / item.amount) | currency: '' : 1}}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot ng-if="vm.m.list">
                                <tr>
                                    <td colspan="8"></span>
                                    <td class="text-right">{{vm.m.totalMoney | currency: '': 0 }}</span>
                                    <td></span>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="row text-right">
                        <div class="col-md-12">
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
