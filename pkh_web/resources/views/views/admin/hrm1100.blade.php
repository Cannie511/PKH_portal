<section class="content-header">
    <h1>Bảng lương<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Bảng lương</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách bảng lương</h3>
                    <div class="box-tools pull-right">
                        <a ui-sref="app.hrm1110({ id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a>
                    </div>
                </div>
                <div class="box-body form">
                    <form role="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Năm</label>
                                    <select class="form-control"
                                        placeholder-text-single="'Năm'"
                                        ng-model="vm.m.filter.year"
                                        name="year"
                                        ng-options="item.year as item.year for item in vm.m.init.listYear"
                                        >
                                        <option value="">ALL</option>
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
                                <!-- <button type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.download()">
                                    <i class="fa fa-download fa-fw"></i>
                                    Tải về
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
                                    <th>Month</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Trạng thái</th>
                                    <th>Số nhân viên</th>
                                    <th>Total (For Employee)</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list.data'>
                                    <td>{{$index + vm.m.list.from}}</td>
                                    <td>{{item.salary_month | date: 'yyyy-MM'}}</td>
                                    <td>{{item.from_date | date: 'yyyy-MM-dd'}}</td>
                                    <td>{{item.to_date | date: 'yyyy-MM-dd'}}</td>
                                    <td>
                                        <span ng-if="item.salary_sts == '0'" class="badge badge-pill badge-light"">DRAFT</span>
                                        <span ng-if="item.salary_sts == '1'" class="badge badge-pill badge-warning"">IN REVIEW</span>
                                        <span ng-if="item.salary_sts == '2'" class="badge badge-pill badge-success"">APPROVE</span>
                                    </td>
                                    <td>{{item.count_employee | currency : '' : 0}}</td>
                                    <td>{{item.total_amount | currency : '' : 0}}</td>
                                    <td>{{item.total_com_amount | currency : '' : 0}}</td>
                                    <td>
                                        <a ng-if="vm.can('screen.hrm1111')" class="btn btn-xs btn-info" ui-sref="app.hrm1111({id: item.id})"><i class="fa fa-eye fa-fw"/></a>
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