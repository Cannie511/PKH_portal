<section class="content-header">
    <h1>Tiêu thụ công<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Tiêu thụ công</li>
    </ol>
</section>
<section class="content crm0914">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Tiêu thụ công</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.hrm0716({ employee_id: vm.m.employee_id,contract_id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <!-- <div class="box-body form">
                    <form role="form" ng-submit="vm.search()">
                        <div class="row">
                            
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
                            </div>
                        </div>
                    </form>
                </div> -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>PI NO</th>
                                    <th>Ngày nhập</th>
                                    <th class="text-right">Số Loại Nhập</th>
                                    <th class="text-right">Đã bán hết</th>
                                    <th class="text-right">Còn lại</th>
                                    <th class="text-right">Số ngày</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list.data'>
                                    <td>{{$index + vm.m.list.from}}</td>
                                    <td>
                                        <a ui-sref="app.crm0915({pi_no: item.pi_no})">{{item.pi_no}}</a>
                                    </td>
                                    <td>{{item.comming_pkh_date}}</td>
                                    <td class="text-right">{{item.total_product | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.count_sold_out | currency : '' : 0}}</td>
                                    <td class="text-right">
                                        <span ng-if="item.count_remain > 0">{{item.count_remain | currency : '' : 0}}</span>
                                    </td>
                                    <td class="text-right">{{item.max_days  | currency : '' : 0}}</td>
                                    <td class="text-right" nowrap>
                                        <div class="progress progress-bar-info">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{item.count_remain * 100 / item.total_product}}"
                                            aria-valuemin="0" aria-valuemax="100" style="width:{{item.count_remain * 100 / item.total_product}}%">
                                                {{(item.count_remain * 100 / item.total_product) | currency: '' : 1}}%
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