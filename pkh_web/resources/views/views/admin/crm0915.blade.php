<section class="content-header">
    <h1>Tiêu thụ sản phẩm<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm0914">Tiêu thụ công</a></li>
        <li class="active">Tiêu thụ sản phẩm</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Tiêu thụ sản phẩm</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.hrm0716({ employee_id: vm.m.employee_id,contract_id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <div class="box-body form">
                    <form role="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">PI NO</label>
                                    <input type="text" class="form-control" ng-model="vm.m.filter.pi_no" name="pi_no" placeholder="PI9999">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Mã SP</label>
                                    <input type="text" class="form-control" ng-model="vm.m.filter.product_code" name="product_code" placeholder="WT9999">
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
                                    <th>PI NO</th>
                                    <th>Ngày nhập</th>
                                    <th>Mã SP</th>
                                    <th>Tên SP</th>
                                    <th class="text-right">Giá nhập VND</th>
                                    <th class="text-right">Chi phí SP VND</th>
                                    <th class="text-right">Giá vốn</th>
                                    <th class="text-right">Số lượng nhập</th>
                                    <th class="text-right">Còn lại</th>
                                    <th class="text-right">Giá trị còn lại</th>
                                    <th class="text-right">Số ngày</th>
                                    <th>Còn lại (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list.data'>
                                    <td>{{$index + vm.m.list.from}}</td>
                                    <td>{{item.pi_no}}</td>
                                    <td>{{item.comming_pkh_date}}</td>
                                    <td>{{item.product_code}}</td>
                                    <td>{{item.name}}</td>
                                    <td class="text-right">{{item.price | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.cost_per_1pro | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.price+item.cost_per_1pro | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.amount | currency : '' : 0}}</td>
                                    <td class="text-right">
                                    {{item.remain | currency : '' : 0}}
                                    </td>
                                    <td class="text-right">
                                    {{item.remain*(item.price+item.cost_per_1pro) | currency : '' : 0}}
                                    </td>
                                    <td class="text-right">{{item.max_days | currency : '' : 0}}</td>
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
                        </table>
                    </div>
                    <div class="row text-right">
                        <div class="col-md-12">
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