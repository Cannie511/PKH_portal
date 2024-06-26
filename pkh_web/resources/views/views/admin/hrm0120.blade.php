<section class="content-header">
    <h1>Duyệt đơn<small></small></h1>
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
                    <h3 class="box-title">Danh sách đơn</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body form">
                    <form role="form" ng-submit="vm.search()">
                        <div class="row">    
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Nhân viên</label>
                                    {{vm.m.filter.user_id}}
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn nhân viên'"
                                        ng-model="vm.m.filter.user_id"
                                        ng-options="item.employee_id as item.display for item in vm.m.init.listStaff "
                                        >
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Từ khóa</label>
                                    <input type="text" ng-model="vm.m.filter.keyword" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Từ ngày</label>
                                    <p class="input-group">
                                        <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.filter.startDate" is-open="vm.dp1Opened" datepicker-options="vm.m.dateOptions" close-text="Close"
                                        ng-model-options="{timezone: 'utc'}" />
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" ng-click="vm.dp1Opened = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </p>
                                </div> 
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Đến ngày</label>
                                    <p class="input-group">
                                        <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.filter.endDate" is-open="vm.dp2Opened" datepicker-options="vm.m.dateOptions" close-text="Close"
                                        ng-model-options="{timezone: 'utc'}" />
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" ng-click="vm.dp2Opened = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </p>
                                </div> 
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select class="form-control" ng-model="vm.m.filter.status" ng-init="vm.m.filter.order_sts = ''">
                                        <option value="">Tất cả</option>
                                        <option value="0">Mới</option>
                                        <option value="1">Đồng ý</option>
                                        <option value="2">Từ chối</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Loại</label>
                                    <select class="form-control" ng-model="vm.m.filter.type" ng-init="vm.m.filter.type = ''">
                                        <option value="">Tất cả</option>
                                        <option value="1">Buổi sáng</option>
                                        <option value="2">Buổi chiều</option>
                                        <option value="3">Cả ngày</option>
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
                                <button type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.download()">
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
                                    <th>STT</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày nghỉ</th>
                                    <th>Loại</th>
                                    <th>Ngày phép</th>
                                    <th>Đăng ký</th>
                                    <th>Duyệt đơn</th>
                                    <th>Nội dung</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data'>
                                    <td>{{$index + 1}}</td>
                                    <td>
                                        <span class="label label-primary" ng-if="item.status == 0">Chờ duyệt</span>
                                        <span class="label label-success" ng-if="item.status == 1">Đồng ý</span>
                                        <span class="label label-danger" ng-if="item.status == 2">Từ chối</span>
                                        <span class="label label-default" ng-if="item.status == 3">Hủy</span>
                                    </td>
                                    <td>{{item.absent_date}}</td>
                                    <td>
                                        <span ng-if="item.absent_type == 1">Nghỉ buổi sáng</span>
                                        <span ng-if="item.absent_type == 2">Nghỉ buổi chiều</span>
                                        <span ng-if="item.absent_type == 3">Cả ngày</span>
                                    </td>
                                    <td>{{item.leave_allocation_name}}</td>
                                    <td>
                                        {{item.created_at | date: 'yyyy-MM-dd HH:mm'}}
                                        <br/>
                                        [{{item.employee_code}}] {{item.user_name}}
                                    </td>
                                    <td>
                                        <button ng-if="item.status == 0" type="button" class="btn btn-primary btn-xs" ng-click="vm.accept(item)">Chấp nhận</button>
                                        <button ng-if="item.status == 0" type="button" class="btn btn-danger btn-xs" ng-click="vm.deny(item)">Từ chối</button>
                                        <br ng-if="item.status == 0"/>
                                        {{item.approve_ts | date: 'yyyy-MM-dd HH:mm'}}
                                        <br/>
                                        <span ng-if="item.approve_user_code">
                                        [{{item.approve_user_code}}] {{item.approve_name}}
                                        <span>
                                    </td>
                                    <td>
                                        {{item.reason}}<hr ng-if="item.cmt"/>
                                        {{item.cmt}}
                                    </td>
                                </tr>
                            </tbody>
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
