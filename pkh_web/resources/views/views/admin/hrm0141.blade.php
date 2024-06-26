<section class="content-header">
    <h1>Thời gian làm việc <small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Thời gian làm việc</li>
    </ol>
</section>
<section class="content hrm0141">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thời gian làm việc</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.crm0310" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <div class="box-body form">
                    <form role="form" ng-submit="vm.search()">
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
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Nhân viên</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn nhân viên'"
                                        ng-model="vm.m.filter.user_id"
                                        ng-options="item.employee_id as item.display for item in vm.m.init.users "
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
                                <button type="button" class="btn btn-warning btn-sm btn-width-default" ng-click="vm.clickExecute()">
                                    <i class="fa fa-play"></i>
                                    <span>Tính lại</span>
                                </button>
                                <button type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.download()">
                                    <i class="fa fa-download fa-fw"></i>
                                    Tải về
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div ng-if="vm.m.mode == 'ONE'" class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Ngày</th>
                                    <th>Thứ</th>
                                    <th class="text-right">Sớm nhất</th>
                                    <th class="text-right">Trễ nhất</th>
                                    <th class="text-right">Bắt đầu</th>
                                    <th class="text-right">Kết thúc</th>
                                    <th class="text-right">Thời gian</th>
                                    <th>Ghi chú</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list.data' ng-class="{'bg-weekend': item.day == 0, 'bg-holiday': item.is_holiday == 1}">
                                    <td>{{$index + 1}}</td>
                                    <td>{{item.date}}</td>
                                    <td>{{item.date | dayOfWeek}}</td>
                                    <td class="text-right">{{item.first_time}}</td>
                                    <td class="text-right">{{item.last_time}}</td>
                                    <td class="text-right">{{item.start_time}}</td>
                                    <td class="text-right">{{item.end_time}}</td>
                                    <td class="text-right">{{item.working_hour_min}}</td>
                                    <td>
                                        <span ng-if="item.leave_type == '1'">AL&nbsp;-&nbsp;</span>
                                        <span ng-if="item.leave_type == '2'">NP&nbsp;-&nbsp;</span>

                                        <span ng-if="item.absent_type == '1'">AM</span>
                                        <span ng-if="item.absent_type == '2'">PM</span>
                                        <span ng-if="item.absent_type == '3'">ALL DAY</span>
                                        <small ng-if="item.absent_reason">&nbsp;({{item.absent_reason}})</small>

                                        <span ng-if="item.holiday_reason">&nbsp;{{item.holiday_reason}}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row" ng-if="vm.m.summary">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 pull-right">
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Số ngày trong tháng:</b> <a class="pull-right">{{vm.m.summary.totalDays}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Số ngày lễ:</b> <a class="pull-right">{{vm.m.summary.todayHoliday}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Số giờ chuẩn trong tháng:</b> <a class="pull-right">{{vm.m.summary.totalStandardHours}} hours</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Số ngày nghỉ có phép:</b> <a class="pull-right">{{vm.m.summary.todayAbsent}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Số ngày nghỉ không phép:</b> <a class="pull-right">{{vm.m.summary.todayAbsentNo}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Số ngày đi làm:</b> <a class="pull-right">{{vm.m.summary.totalWorkingDays}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Số giờ làm:</b> <a class="pull-right">{{vm.m.summary.totalWorkingHoursString}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div ng-if="vm.m.mode == 'MULTI'" class="box-body">
                    <div class="table-responsive table-scroll slim-scrollbar">
                        <table class="table table-striped table-hover ">
                            <thead>
                                <tr class="tr-head">
                                    <th class="text-center text-v-mid freeze-col" rowspan="2" style="vertical-align:middle;z-index:5">NO</th>
                                    <th class="text-center text-v-mid freeze-col-2" rowspan="2" style="vertical-align:middle;z-index:5">Nhân viên</th>
                                    <th class="text-center" colspan="{{vm.m.data.calendar.length}}">{{vm.m.data.calendar[0].date | date: 'yyyy-MM'}}</th>
                                </tr>
                                <tr>
                                    <th class="text-center" ng-repeat='item in vm.m.data.calendar' ng-class="{'bg-weekend': item.workday == 0, 'bg-holiday': item.is_holiday == 1}">
                                        {{item.date | date : 'dd'}} <br/>
                                        {{item.date | dayOfWeek}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='employeeCall in vm.m.data.listEmployeeCal'>
                                    <th class="freeze-col">{{$index + 1}}</th>
                                    <th class="freeze-col-2" nowrap>
                                        <a href="javascript:void(0)" ng-click="vm.selectEmployee(employeeCall)">
                                        {{employeeCall.code | limitTo: 6}} <br/>
                                        {{employeeCall.fullname}}
                                        </a>
                                    </th>

                                    <td class="text-center" ng-repeat='dayInfo in employeeCall.days'  ng-class="{'bg-weekend': dayInfo.workday == 0, 'bg-holiday': dayInfo.is_holiday == 1}">
                                        <span ng-if="dayInfo.is_holiday == 1">HO</span>
                                        
                                        <span ng-if="dayInfo.leave_type == '1'">AL</span>
                                        <span ng-if="dayInfo.leave_type == '2'">NP</span>
                                        <span ng-if="dayInfo.absent_type == '1'">(AM)</span>
                                        <span ng-if="dayInfo.absent_type == '2'">(PM)</span>

                                        <span ng-if="dayInfo.working_hour_min && dayInfo.working_hour_min != '00:00'">X ({{dayInfo.working_hour_min}})</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="box-footer with-border">
                    <ul class="list-inline">
                        <li class="list-inline-item text-muted">AL: Annual Leave</li>
                        <li class="list-inline-item text-muted">NP: Unpaid Leave</li>
                        <li class="list-inline-item text-muted">ML: Maternity Leave</li>
                        <li class="list-inline-item text-muted">HO: Holiday</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>