<section class="content-header">
    <h1>Thông tin bảng lương<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.hrm1100">Bảng lương</a></li>
        <li class="active">Bảng lương</li>
    </ol>
</section>
<section class="content hrm1111">
    <div class="row">
        <div class="col-md-7 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin bảng lương</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.hrm1111({ employee_id: vm.m.employee_id,contract_id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <form class="form" name="form" ng-submit="vm.save(form.$valid, form)" novalidate>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Tháng</label>
                                    <p class="form-control-static">{{vm.m.form.salaryInfo.salary_month  | date: 'yyyy-MM'}}</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Từ ngày</label>
                                    <p class="form-control-static">{{vm.m.form.salaryInfo.from_date  | date: 'yyyy-MM-dd'}}</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Đến ngày</label>
                                    <p class="form-control-static">{{vm.m.form.salaryInfo.to_date  | date: 'yyyy-MM-dd'}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Trạng thái</label>
                                    <p class="form-control-static">
                                        <span ng-if="vm.m.form.salaryInfo.salary_sts == '0'" class="badge badge-pill badge-light"">DRAFT</span>
                                        <span ng-if="vm.m.form.salaryInfo.salary_sts == '1'" class="badge badge-pill badge-warning"">IN REVIEW</span>
                                        <span ng-if="vm.m.form.salaryInfo.salary_sts == '2'" class="badge badge-pill badge-success"">APPROVE</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Số ngày làm việc</label>
                                    <p class="form-control-static">{{vm.m.form.salaryInfo.total_days  | currency : '' : 1}}</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Số giờ chuẩn</label>
                                    <p class="form-control-static">{{vm.m.form.salaryInfo.total_hours  | currency : '' : 2}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group" ng-class="{ 'has-error': form.notes.$invalid && ( vm.formSubmitted || form.notes.$touched) || (vm.m.errors['notes'].length > 0) }">
                                    <label class="control-label">Ghi chú</label>
                                    <textarea ng-if="vm.m.form.salaryInfo.salary_sts != '2'" rows="3" type="text" class="form-control" ng-model="vm.m.form.salaryInfo.notes" name="notes" placeholder="Ghi chú"/>
                                    <pre ng-if="vm.m.form.salaryInfo.salary_sts == '2'" class="form-control-static pre-format">{{vm.m.form.salaryInfo.notes}}</pre>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button ng-if="vm.m.form.salaryInfo.salary_sts == '1'" type="button" class="btn btn-primary" ng-click="vm.clickApprove()"><i class="fas fa-thumbs-up fa-fw"></i>Đồng ý</button>
                        <button ng-if="vm.m.form.salaryInfo.salary_sts == '1'" type="button" class="btn btn-danger"  ng-click="vm.clickDeny()"><i class="fas fa-ban fa-fw"></i>Từ chối</button>
                        &nbsp;
                        <div class="pull-right">
                            <!-- <button ng-if="vm.m.form.id > 0 && vm.can('screen.hrm1010.delete')" type="button" class="btn btn-danger btn-min-width" ng-click="vm.delete()"><i class="fa fa-trash-o fa-fw"></i>{{'COM_BTN_DELETE' | translate}}</button> -->
                            <button ng-if="vm.m.form.salaryInfo.salary_sts == '0'" type="button" class="btn btn-primary"  ng-click="vm.clickSend()"><i class="fas fa-paper-plane fa-fw"></i>Trình duyệt</button>
                            <button ng-if="vm.m.form.salaryInfo.salary_sts == '0' || vm.m.form.salaryInfo.salary_sts == '1'" type="submit" class="btn btn-warning"><i class="fas fa-save fa-fw"></i>{{'COM_BTN_UPDATE' | translate}}</button>
                        </div>
                    </div> 
                </form>
            </div>
        </div>
        <div class="col-md-5 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Nhân viên</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.hrm1111({ employee_id: vm.m.employee_id,contract_id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="control-label">BHXH</label>
                                <p class="form-control-static">{{vm.m.form.salaryInfo.total_bhxh  | currency : '' : 0}} ({{vm.m.form.salaryInfo.tax_bhxh_percent  | currency : '' : 1}}%)</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="control-label">BHYT</label>
                                <p class="form-control-static">{{vm.m.form.salaryInfo.total_bhyt  | currency : '' : 0}} ({{vm.m.form.salaryInfo.tax_bhyt_percent  | currency : '' : 1}}%)</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="control-label">BHTN</label>
                                <p class="form-control-static">{{vm.m.form.salaryInfo.total_bhtn  | currency : '' : 0}} ({{vm.m.form.salaryInfo.tax_bhtn_percent  | currency : '' : 1}}%)</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Tổng cộng (Nhân viên)</label>
                                <p class="form-control-static"><b>{{vm.m.form.salaryInfo.total_amount  | currency : '' : 0}}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Công ty</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.hrm1111({ employee_id: vm.m.employee_id,contract_id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="control-label">BHXH</label>
                                <p class="form-control-static">{{vm.m.form.salaryInfo.total_com_bhxh  | currency : '' : 0}} ({{vm.m.form.salaryInfo.com_tax_bhxh_percent  | currency : '' : 1}}%)</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="control-label">BHYT</label>
                                <p class="form-control-static">{{vm.m.form.salaryInfo.total_com_bhyt  | currency : '' : 0}} ({{vm.m.form.salaryInfo.com_tax_bhyt_percent  | currency : '' : 1}}%)</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="control-label">BHTN</label>
                                <p class="form-control-static">{{vm.m.form.salaryInfo.total_com_bhtn  | currency : '' : 0}} ({{vm.m.form.salaryInfo.com_tax_bhtn_percent  | currency : '' : 1}}%)</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Tổng cộng (Công ty)</label>
                                <p class="form-control-static"><b>{{vm.m.form.salaryInfo.total_com_amount  | currency : '' : 0}}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách nhân viên</h3>
                    <div class="box-tools pull-right">
                        <!-- <button class="btn btn-info btn-xs" ng-click="vm.onAddEmployee()"><i class="fa fa-plus fa-fw"></i>Thêm nhân viên</button> -->
                        <select
                            placeholder-text-single="'Nhân viên'"
                            ng-model="vm.m.form.newEmployee"
                            ng-options="item.employee_id as item.display for item in vm.m.init.listEmployee2"
                            name="newEmployee"
                            chosen
                            >
                        </select>
                        <button type="button" class="btn btn-primary btn-sm btn-width-default"  ng-click="vm.onAddEmployee()" >
                            <i class="fa fa-plus fa-fw"></i>
                            Thêm nhân viên
                        </button>
                        <button type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.download()">
                            <i class="fa fa-download fa-fw"></i>
                            Tải về
                        </button>
                        <button type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.sendAll()">
                            <i class="fa fa-send fa-fw"></i>
                            Gửi mail
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive table-scroll slim-scrollbar">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="min-width: 30px; vertical-align:middle" class="freeze-col-header">NO</th>
                                    <th rowspan="2" style="min-width: 170px; vertical-align:middle" class="freeze-col-header freeze-col-2">Nhân viên</th>
                                    <th rowspan="2" style="min-width: 70px; vertical-align:middle">Giới tính</th>
                                    <th rowspan="2" style="min-width: 80px; vertical-align:middle">Ngày sinh</th>
                                    <th rowspan="2" class="text-right" style="min-width: 65px; vertical-align:middle">Số ngày LV</th>
                                    <th rowspan="2" class="text-right" style="min-width: 65px; vertical-align:middle">Số giờ LV</th>
                                    <th rowspan="2" class="text-right" style="min-width: 100px; vertical-align:middle">Lương GROSS</th>
                                    <th rowspan="2" class="text-right" style="min-width: 100px; vertical-align:middle">Lương cơ bản</th>
                                    <th rowspan="2" class="text-right" style="min-width: 100px; vertical-align:middle">Lương thực tế</th>
                                    <th rowspan="2" class="text-right" style="min-width: 100px; vertical-align:middle">Tăng ca</th>
                                    <th rowspan="2" class="text-right" style="min-width: 100px; vertical-align:middle">Thưởng + Hoa Hồng</th>
                                    <th rowspan="2" class="text-right" style="min-width: 100px; vertical-align:middle">Tổng thu nhập</th>
                                    <th class="text-center" colspan="3">Các khoản khấu trừ</th>
                                    <th rowspan="2" class="text-right" style="min-width: 100px; vertical-align:middle">Thuế TNCN</th>
                                    <th rowspan="2" class="text-right" style="min-width: 100px; vertical-align:middle">Các khoản khác (Phạt)</th>
                                    <th rowspan="2" class="text-right" style="min-width: 100px; vertical-align:middle">Tạm ứng</th>
                                    <th rowspan="2" class="text-right" style="min-width: 100px; vertical-align:middle">Thực nhận</th>
                                    <th class="text-center" colspan="4">Khoản công ty trả</th>
                                    <th rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th class="freeze-row-2" style="min-width: 100px;">BHXH ({{vm.m.form.salaryInfo.tax_bhxh_percent  | currency : '' : 1}}%)</th>
                                    <th class="freeze-row-2" style="min-width: 100px;">BHYT ({{vm.m.form.salaryInfo.tax_bhyt_percent  | currency : '' : 1}}%)</th>
                                    <th class="freeze-row-2" style="min-width: 100px;">BHTN ({{vm.m.form.salaryInfo.tax_bhtn_percent  | currency : '' : 1}}%)</th>
                                    <th class="freeze-row-2" style="min-width: 100px;">BHXH ({{vm.m.form.salaryInfo.com_tax_bhxh_percent  | currency : '' : 1}}%)</th>
                                    <th class="freeze-row-2" style="min-width: 100px;">BHYT ({{vm.m.form.salaryInfo.com_tax_bhyt_percent  | currency : '' : 1}}%)</th>
                                    <th class="freeze-row-2" style="min-width: 100px;">BHTN ({{vm.m.form.salaryInfo.com_tax_bhtn_percent  | currency : '' : 1}}%)</th>
                                    <th class="freeze-row-2" style="min-width: 100px;">Tổng cộng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.form.listEmployee'>
                                    <td class="freeze-col" style="vertical-align:middle">{{$index + 1}}</td>
                                    <td class="freeze-col freeze-col-2" style="min-width: 170px; vertical-align:middle">
                                        <span ng-if="!vm.can('screen.hrm1111')">[{{item.employee_code}}]<br/>{{item.fullname}}</span>
                                        <a ng-if="vm.can('screen.hrm1111')" ui-sref="app.hrm1112({id: item.id})">
                                            [{{item.employee_code}}]<br/>{{item.fullname}}
                                        </a>
                                    </td>
                                    <td>
                                        <span ng-if="item.gender == 'MALE'">Nam</span>
                                        <span ng-if="item.gender == 'FEMALE'">Nữ</span>
                                    </td>
                                    <td>{{item.dob | date: 'yyyy-MM-dd'}}</td>
                                    <td class="text-right">{{item.total_days | currency : '' : 1}}</td>
                                    <td class="text-right">{{item.total_hours | currency : '' : 2}}</td>
                                    <td class="text-right">{{item.gross_salary | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.basic_salary | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.real_salary | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.overtime_salary | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.bonus | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.total_income | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.tax_bhxh | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.tax_bhyt | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.tax_bhtn | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.tax_pit | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.minus_amount | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.advance | currency : '' : 0}}</td>
                                    <td class="text-right"><b>{{item.net_salary | currency : '' : 0}}</b></td>
                                    <td class="text-right">{{item.com_tax_bhxh | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.com_tax_bhyt | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.com_tax_bhtn | currency : '' : 0}}</td>
                                    <td class="text-right"><b>{{item.com_total | currency : '' : 0}}</b></td>
                                    <!-- <td>
                                        <a ng-if="vm.can('screen.hrm1111')" class="btn btn-xs btn-info" ui-sref="app.hrm1111({id: item.id})"><i class="fa fa-eye fa-fw"/></a>
                                    </td> -->
                                    <td>
                                        <button ng-if="vm.m.form.salaryInfo.salary_sts == '0'" class="btn btn-xs btn-danger" ng-click="vm.delete(item)">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfooter>
                                <tr>
                                    <td class="freeze-col"></td>
                                    <td class="freeze-col"><b>Tổng cộng</b></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right">{{vm.m.form.summary.total_days | currency : '' : 1}}</td>
                                    <td class="text-right">{{vm.m.form.summary.total_hours | currency : '' : 2}}</td>
                                    <td class="text-right">{{vm.m.form.summary.gross_salary | currency : '' : 0}}</td>
                                    <td class="text-right">{{vm.m.form.summary.basic_salary | currency : '' : 0}}</td>
                                    <td class="text-right">{{vm.m.form.summary.real_salary | currency : '' : 0}}</td>
                                    <td class="text-right">{{vm.m.form.summary.overtime_salary | currency : '' : 0}}</td>
                                    <td class="text-right">{{vm.m.form.summary.bonus | currency : '' : 0}}</td>
                                    <td class="text-right">{{vm.m.form.summary.total_income | currency : '' : 0}}</td>
                                    <td class="text-right">{{vm.m.form.summary.tax_bhxh | currency : '' : 0}}</td>
                                    <td class="text-right">{{vm.m.form.summary.tax_bhyt | currency : '' : 0}}</td>
                                    <td class="text-right">{{vm.m.form.summary.tax_bhtn | currency : '' : 0}}</td>
                                    <td class="text-right">{{vm.m.form.summary.tax_pit | currency : '' : 0}}</td>
                                    <td class="text-right">{{vm.m.form.summary.minus_amount | currency : '' : 0}}</td>
                                    <td class="text-right">{{vm.m.form.summary.advance | currency : '' : 0}}</td>
                                    <td class="text-right"><b>{{vm.m.form.summary.net_salary | currency : '' : 0}}</b></td>
                                    <td class="text-right">{{vm.m.form.summary.com_tax_bhxh | currency : '' : 0}}</td>
                                    <td class="text-right">{{vm.m.form.summary.com_tax_bhyt | currency : '' : 0}}</td>
                                    <td class="text-right">{{vm.m.form.summary.com_tax_bhtn | currency : '' : 0}}</td>
                                    <td class="text-right"><b>{{vm.m.form.summary.com_total | currency : '' : 0}}</b></td>
                                    <td></td>
                                </tr>
                            </tfooter>
                        </table>
                    </div>
                    <!-- <div class="row text-right">
                        <div class="col-md-12">
                            <uib-pagination ng-show="vm.m.list.from > 0"
                                total-items="vm.m.list.total"
                                ng-model="vm.m.list.current_page"
                                items-per-page="vm.m.list.per_page"
                                ng-change="vm.doSearch(vm.m.list.current_page)"
                                class="pagination pagination-sm m-t-none m-b-none">
                            </uib-pagination>    
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>