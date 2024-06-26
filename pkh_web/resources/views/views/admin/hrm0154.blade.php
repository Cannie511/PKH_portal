<section class="content-header">
    <h1>Checkin/Checkout<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Thời gian Checkin/Checkout</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Checkin/Checkout</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.hrm0716({ employee_id: vm.m.employee_id,contract_id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <div class="box-body form">
                    <form role="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label class="control-label">Nhân viên</label>
                                    <select class="form-control" name="employee_id"
                                        placeholder-text-single="'Nhân viên'"
                                        ng-model="vm.m.filter.employee_id"
                                        name="employee_id"
                                        ng-options="item.employee_id as item.display for item in vm.m.init.listEmployee"
                                        chosen
                                        >
                                        <option value="">ALL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label class="control-label">Từ ngày</label>
                                    <div class="input-group">
                                        <input class="form-control" name="start_date" datetimepicker ng-model="vm.m.filter.start_date" placeholder="YYYY-MM-DD" options="vm.m.dateOptions"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label class="control-label">Đến ngày</label>
                                    <div class="input-group">
                                        <input class="form-control" name="end_date" datetimepicker ng-model="vm.m.filter.end_date" placeholder="YYYY-MM-DD" options="vm.m.dateOptions"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
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
                                    <th>Giờ</th>
                                    <th>Mã NV</th>
                                    <th>Tên</th>
                                    <th>Loại</th>
                                    <th>IP</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list.data'>
                                    <td>{{$index + vm.m.list.from}}</td>
                                    <td>{{item.working_time}}</td>
                                    <td>{{item.employee_code}}</td>
                                    <td>{{item.fullname}}</td>
                                    <td>
                                        <span ng-class="{'text-success': item.event_name == 'CHECKIN', 'text-danger': item.event_name == 'CHECKOUT'}">
                                            <i class="fas" ng-class="{'fa-sign-in-alt': item.event_name == 'CHECKIN', 'fa-sign-out-alt': item.event_name == 'CHECKOUT'}" ></i> {{item.event_name}}
                                        </span>
                                    </td>
                                    <td>
                                        {{item.ip}}
                                        <br/>
                                        <small>{{item.ip_city}} - </small>
                                        <small>({{item.agent}})</small>
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