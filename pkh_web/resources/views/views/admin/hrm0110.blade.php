<section class="content-header">
    <h1>Lịch nghỉ phép<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Lịch nghỉ nghep</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Xin nghỉ phép</h3>
                    <div class="box-tools pull-right">
                        <!-- <div uib-dropdown class="btn-group">
                            <a ui-sref="app.crm0210" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a>
                        </div> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <div class="box-body form">
                    <form class="form" ng-submit="vm.save()">

                        <div class="col-md-12 m-b-xs">
                            <div class="form-group" ng-class="{'has-error': vm.errors['dayOffDate'].length > 0}">
                                <label>Ngày nghỉ</label>
                                <div class="input-group">
                                    <input id="monthPicker" class="form-control" datetimepicker ng-model="vm.m.form.dayOffDate" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <span class="help-block" ng-repeat="(i, err) in vm.errors['dayOffDate']">{{err}}</span>
                            </div>
                        </div>
                        <div class="col-md-12 m-b-xs">
                            <div class="form-group">
                                <label>Loại</label>
                                <!-- <select class="form-control"
                                        placeholder-text-single="'Chọn Loại'"
                                        ng-model="vm.m.form.leave_type"
                                        >
                                    <option value='1'>Phép năm</option>
                                    <option value='2'>Không phép</option>
                                </select> -->
                                <?php 
                                    echo(vh_dropdownlist(
                                        config('constants.LEAVE_TYPES'),
                                        [
                                            "cssClass" => "form-control",
                                            "placeholder" => "Chọn loại",
                                            "ngModel" => "vm.m.form.leave_type",
                                            "showAll" => false
                                        ]
                                    ));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-12 m-b-xs" ng-if="vm.m.form.leave_type == 1">
                            <div class="form-group"  ng-class="{'has-error': vm.errors['leave_allocation_id'].length > 0}">
                                <label class="control-label">Ngày phép</label>
                                <select class="form-control"
                                    placeholder-text-single="'Loại ngày phép'"
                                    ng-model="vm.m.form.leave_allocation_id"
                                    name="leave_allocation_id"
                                    ng-options="item.id as item.reason for item in vm.m.init.listAllocation"
                                    >
                                </select>
                                <span class="help-block" ng-repeat="(i, err) in vm.errors['leave_allocation_id']">{{err}}</span>
                            </div>
                        </div>
                        <div class="col-md-12 m-b-xs">
                            <div class="form-group">
                                <label>Thời gian</label>
                              <div class="radio">
                                <label>
                                  <input type="radio" name="dayOffType" id="optionsRadios1" value="1" checked="" ng-model="vm.m.form.dayOffType">
                                  Nghỉ buổi sáng
                                </label>
                              </div>
                              <div class="radio">
                                <label>
                                  <input type="radio" name="dayOffType" id="optionsRadios2" value="2"  ng-model="vm.m.form.dayOffType">
                                  Nghỉ buổi chiều
                                </label>
                              </div>
                              <div class="radio">
                                <label>
                                  <input type="radio" name="dayOffType" id="optionsRadios3" value="3"  ng-model="vm.m.form.dayOffType">
                                  Nghỉ cả ngày
                                </label>
                              </div>
                            </div>
                        </div>
                        <div class="col-md-12 m-b-xs">
                            <div class="form-group"  ng-class="{'has-error': vm.errors['reason'].length > 0}">
                                <label>Lý do</label>
                                <textarea class="form-control" ng-model="vm.m.form.reason" rows="5"></textarea>
                                <span class="help-block" ng-repeat="(i, err) in vm.errors['reason']">{{err}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                                    <i class="fa fa-search fa-fw"></i>
                                    <span>Đăng ký</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>

        <div class="col-md-9">
            <div class="nav-tabs-custom tab-info">
            <ul class="nav nav-tabs">
              <li ng-class="{'active': vm.activeTab == 1}"><a href="javascript:void(0)" data-toggle="tab" aria-expanded="true" ng-click="vm.openTab(1)">Lịch nghỉ</a></li>
              <li ng-class="{'active': vm.activeTab == 2}"><a href="javascript:void(0)" data-toggle="tab" aria-expanded="false" ng-click="vm.openTab(2)">Danh sách</a></li>
              <!-- <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li> -->
            </ul>
            <div class="tab-content">
                <div id="calendar" ui-calendar="vm.uiConfig.calendar" ng-model="vm.eventSources" ng-show="vm.activeTab == 1" calendar="myCalendar"></div>

                <div class="tab-pane" id="tab_2" ng-show="vm.activeTab == 2" ng-class="{'active': vm.activeTab == 2}">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ngày nghỉ</th>
                                    <th>Thời gian</th>
                                    <th>Loại</th>
                                    <th>Quỹ Phép</th>
                                    <th>Ngày đăng ký</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày duyệt</th>
                                    <th>Người duyệt</th>
                                    <th>Nội dung</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.list'>
                                    <td>{{$index + 1}}</td>
                                    <td nowrap>{{item.absent_date}}</td>
                                    <td>
                                        <span ng-if="item.absent_type == 1">Nghỉ buổi sáng</span>
                                        <span ng-if="item.absent_type == 2">Nghỉ buổi chiều</span>
                                        <span ng-if="item.absent_type == 3">Cả ngày</span>
                                    </td>
                                    <td nowrap>
                                        <span ng-if="item.leave_type == 1">Phép năm</span>
                                        <span ng-if="item.leave_type == 2">Không phép</span>
                                    </td>
                                    <td>
                                        {{item.allocation_reason}}
                                    </td>
                                    <td>{{item.created_at | date: 'yyyy-MM-dd HH:mm'}}</td>
                                    <td>
                                        <span class="label label-primary" ng-if="item.status == 0">Chờ duyệt</span>
                                        <span class="label label-success" ng-if="item.status == 1">Đồng ý</span>
                                        <span class="label label-danger" ng-if="item.status == 2">Từ chối</span>
                                        <span class="label label-default" ng-if="item.status == 3">Hủy</span>
                                    </td>
                                    <td>{{item.approve_ts | date: 'yyyy-MM-dd HH:mm'}}</td>
                                    <td>{{item.approve_name}}</td>
                                    <td>
                                        {{item.reason}}<hr ng-if="item.cmt"/>
                                        {{item.cmt}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
    </div>
</section>
