<section class="content-header">
    <h1>Cấp ngày phép<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Ngày phép</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Cấp ngày phép</h3>
                    <div class="box-tools pull-right">
                        <a ui-sref="app.hrm0810()" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a>
                    </div>
                </div>
                <div class="box-body form">
                    <form role="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Nhân viên</label>
                                    <select class="form-control"
                                        placeholder-text-single="'Nhân viên'"
                                        ng-model="vm.m.filter.employee_id"
                                        name="employee_id"
                                        ng-options="item.employee_id as item.display for item in vm.m.init.listEmployee"
                                        chosen
                                        >
                                        <option value>Tất cả</option>
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
                                    <th>Employee code</th>
                                    <th>Name</th>
                                    <th>Loại phép</th>
                                    <th>Số ngày</th>
                                    <th>Hết hạn</th>
                                    <th>Còn lại</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list.data'>
                                    <td>{{$index + vm.m.list.from}}</td>
                                    <td>{{item.employee_code}}</td>
                                    <td>{{item.fullname}}</td>
                                    <td>{{item.reason}}</td>
                                    <td>{{item.num_days}}</td>
                                    <td>{{item.expired_date}}</td>
                                    <td>{{item.num_days - item.used}}</td>
                                    <td>
                                        <a ng-if="vm.can('screen.hrm0810')" class="btn btn-xs btn-info" ui-sref="app.hrm0810({id: item.id})"><i class="fa fa-eye fa-fw"/></a>
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