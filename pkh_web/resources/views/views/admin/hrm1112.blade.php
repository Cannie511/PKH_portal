<section class="content-header">
    <h1>Thông tin bảng lương<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.hrm1100">Bảng lương</a></li>
        <li><a ui-sref="app.hrm1111({id:vm.m.form.salary_id})">{{vm.m.form.salary_month | date: 'yyyy-MM'}}</a></li>
        <li class="active">{{vm.m.form.fullname}}</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Bảng lương {{vm.m.form.salary_month | date: 'yyyy-MM'}}</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.hrm1112({ employee_id: vm.m.employee_id,contract_id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <form class="form" name="form" ng-submit="vm.save(form.$valid, form)" novalidate>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Mã nhân viên</label>
                                    <p class="form-control-static">{{vm.m.form.employee_code}}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Tên nhân viên</label>
                                    <p class="form-control-static">{{vm.m.form.fullname}}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Từ ngày</label>
                                    <p class="form-control-static">{{vm.m.form.from_date}}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Đến ngày</label>
                                    <p class="form-control-static">{{vm.m.form.to_date}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div ng-if="vm.m.form.salary_sts == '0'" class="form-group" ng-class="{ 'has-error': form.total_days.$invalid && ( vm.formSubmitted || form.total_days.$touched) || (vm.m.errors['total_days'].length > 0) }">
                                    <label class="control-label required">Số ngày LV</label>
                                    <input type="text" class="form-control" ng-model="vm.m.form.total_days" name="total_days" placeholder="Số ngày LV" required>
                                    <p ng-show="form.total_days.$error.required && ( vm.formSubmitted || form.total_days.$touched)" class="help-block">Vui lòng nhập Số ngày LV</p>
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['total_days']">{{err}}</p>
                                </div>
                                <div ng-if="vm.m.form.salary_sts != '0'" class="form-group">
                                    <label class="control-label">Số ngày LV</label>
                                    <p class="form-control-static">{{vm.m.form.total_days | currency: '': 0}}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div ng-if="vm.m.form.salary_sts == '0'" class="form-group" ng-class="{ 'has-error': form.total_hours.$invalid && ( vm.formSubmitted || form.total_hours.$touched) || (vm.m.errors['total_hours'].length > 0) }">
                                    <label class="control-label required">Số giờ LV</label>
                                    <input type="text" class="form-control" ng-model="vm.m.form.total_hours" name="total_hours" placeholder="Số giờ LV" required>
                                    <p ng-show="form.total_hours.$error.required && ( vm.formSubmitted || form.total_hours.$touched)" class="help-block">Vui lòng nhập Số giờ LV</p>
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['total_hours']">{{err}}</p>
                                </div>
                                <div ng-if="vm.m.form.salary_sts != '0'" class="form-group">
                                    <label class="control-label">Số giờ LV</label>
                                    <p class="form-control-static">{{vm.m.form.total_hours | currency: '': 0}}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Số ngày chuẩn</label>
                                    <p class="form-control-static">{{vm.m.form.standard_days}}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Số giờ chuẩn</label>
                                    <p class="form-control-static">{{vm.m.form.standard_hours | currency: '': 2}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div ng-if="vm.m.form.salary_sts == '0'" class="form-group" ng-class="{ 'has-error': form.gross_salary.$invalid && ( vm.formSubmitted || form.gross_salary.$touched) || (vm.m.errors['gross_salary'].length > 0) }">
                                    <label class="control-label required">Lương gross</label>
                                    <input type="number" class="form-control" ng-model="vm.m.form.gross_salary" name="gross_salary" placeholder="Lương cơ bản" required step="10000">
                                    <p ng-show="form.gross_salary.$error.required && ( vm.formSubmitted || form.gross_salary.$touched)" class="help-block">Vui lòng nhập Lương cơ bản</p>
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['gross_salary']">{{err}}</p>
                                </div>
                                <div ng-if="vm.m.form.salary_sts != '0'" class="form-group">
                                    <label class="control-label">Lương gross</label>
                                    <p class="form-control-static">{{vm.m.form.gross_salary | currency: '': 0}}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div ng-if="vm.m.form.salary_sts == '0'" class="form-group" ng-class="{ 'has-error': form.basic_salary.$invalid && ( vm.formSubmitted || form.basic_salary.$touched) || (vm.m.errors['basic_salary'].length > 0) }">
                                    <label class="control-label required">Lương cơ bản</label>
                                    <input type="number" class="form-control" ng-model="vm.m.form.basic_salary" name="basic_salary" placeholder="Lương cơ bản" required>
                                    <p ng-show="form.basic_salary.$error.required && ( vm.formSubmitted || form.basic_salary.$touched)" class="help-block">Vui lòng nhập Lương cơ bản</p>
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['basic_salary']">{{err}}</p>
                                </div>
                                <div ng-if="vm.m.form.salary_sts != '0'" class="form-group">
                                    <label class="control-label">Lương cơ bản</label>
                                    <p class="form-control-static">{{vm.m.form.basic_salary | currency: '': 0}}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div ng-if="vm.m.form.salary_sts == '0'" class="form-group" ng-class="{ 'has-error': form.count_dependent_person.$invalid && ( vm.formSubmitted || form.count_dependent_person.$touched) || (vm.m.errors['count_dependent_person'].length > 0) }">
                                    <label class="control-label required">Số người phụ thuộc</label>
                                    <input type="number" class="form-control" ng-model="vm.m.form.count_dependent_person" name="count_dependent_person" placeholder="Lương cơ bản" required>
                                    <p ng-show="form.count_dependent_person.$error.required && ( vm.formSubmitted || form.count_dependent_person.$touched)" class="help-block">Vui lòng nhập số người phụ thuộc</p>
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['count_dependent_person']">{{err}}</p>
                                </div>
                                <div ng-if="vm.m.form.salary_sts != '0'" class="form-group">
                                    <label class="control-label">Số người phụ thuộc</label>
                                    <p class="form-control-static">{{vm.m.form.count_dependent_person | currency: '': 0}}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div ng-if="vm.m.form.salary_sts == '0'"  class="form-group" ng-class="{ 'has-error': form.tax_pit_edit.$invalid && ( vm.formSubmitted || form.tax_pit_edit.$touched) || (vm.m.errors['tax_pit_edit'].length > 0) }">
                                    <label class="control-label required">Điều chỉnh PIT</label>
                                    <input type="number" class="form-control" ng-model="vm.m.form.tax_pit_edit" name="tax_pit_edit" placeholder="Điều chỉnh PIT" required>
                                    <p ng-show="form.tax_pit_edit.$error.required && ( vm.formSubmitted || form.tax_pit_edit.$touched)" class="help-block">Vui lòng nhập Điều chỉnh PIT</p>
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['tax_pit_edit']">{{err}}</p>
                                </div>
                                <div ng-if="vm.m.form.salary_sts != '0'" class="form-group">
                                    <label class="control-label">Điều chỉnh PIT</label>
                                    <p class="form-control-static">{{vm.m.form.tax_pit_edit | currency: '': 0}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div ng-if="vm.m.form.salary_sts == '0'"  class="form-group" ng-class="{ 'has-error': form.overtime_salary.$invalid && ( vm.formSubmitted || form.overtime_salary.$touched) || (vm.m.errors['overtime_salary'].length > 0) }">
                                    <label class="control-label required">Tăng ca</label>
                                    <input type="number" class="form-control" ng-model="vm.m.form.overtime_salary" name="overtime_salary" placeholder="Tăng ca" required>
                                    <p ng-show="form.overtime_salary.$error.required && ( vm.formSubmitted || form.overtime_salary.$touched)" class="help-block">Vui lòng nhập Tăng ca</p>
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['overtime_salary']">{{err}}</p>
                                </div>
                                <div ng-if="vm.m.form.salary_sts != '0'" class="form-group">
                                    <label class="control-label">Tăng ca</label>
                                    <p class="form-control-static">{{vm.m.form.overtime_salary | currency: '': 0}}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div ng-if="vm.m.form.salary_sts == '0'"  class="form-group" ng-class="{ 'has-error': form.bonus.$invalid && ( vm.formSubmitted || form.bonus.$touched) || (vm.m.errors['bonus'].length > 0) }">
                                    <label class="control-label required">Thưởng + Hoa hồng</label>
                                    <input type="number" class="form-control" ng-model="vm.m.form.bonus" name="bonus" placeholder="Thưởng + Hoa hồng" required>
                                    <p ng-show="form.bonus.$error.required && ( vm.formSubmitted || form.bonus.$touched)" class="help-block">Vui lòng nhập Thưởng + Hoa hồng</p>
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['bonus']">{{err}}</p>
                                </div>
                                <div ng-if="vm.m.form.salary_sts != '0'" class="form-group">
                                    <label class="control-label">Thưởng + Hoa hồng</label>
                                    <p class="form-control-static">{{vm.m.form.bonus | currency: '': 0}}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div ng-if="vm.m.form.salary_sts == '0'"  class="form-group" ng-class="{ 'has-error': form.minus_amount.$invalid && ( vm.formSubmitted || form.minus_amount.$touched) || (vm.m.errors['minus_amount'].length > 0) }">
                                    <label class="control-label required">Các khoản phạt</label>
                                    <input type="number" class="form-control" ng-model="vm.m.form.minus_amount" name="minus_amount" placeholder="Các khoản phạt" required>
                                    <p ng-show="form.minus_amount.$error.required && ( vm.formSubmitted || form.minus_amount.$touched)" class="help-block">Vui lòng nhập Các khoản phạt</p>
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['minus_amount']">{{err}}</p>
                                </div>
                                <div ng-if="vm.m.form.salary_sts != '0'" class="form-group">
                                    <label class="control-label">Các khoản phạt</label>
                                    <p class="form-control-static">{{vm.m.form.minus_amount | currency: '': 0}}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div ng-if="vm.m.form.salary_sts == '0'"  class="form-group" ng-class="{ 'has-error': form.advance.$invalid && ( vm.formSubmitted || form.advance.$touched) || (vm.m.errors['advance'].length > 0) }">
                                    <label class="control-label required">Tạm ứng</label>
                                    <input type="number" class="form-control" ng-model="vm.m.form.advance" name="advance" placeholder="Tạm ứng" required>
                                    <p ng-show="form.advance.$error.required && ( vm.formSubmitted || form.advance.$touched)" class="help-block">Vui lòng nhập Tạm ứng</p>
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['advance']">{{err}}</p>
                                </div>
                                <div ng-if="vm.m.form.salary_sts != '0'" class="form-group">
                                    <label class="control-label">Tạm ứng</label>
                                    <p class="form-control-static">{{vm.m.form.advance | currency: '': 0}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer" ng-if="vm.m.form.salary_sts == '0'">
                        <div class="pull-right">
                            <!-- <button ng-if="vm.m.form.id > 0 && vm.can('screen.hrm1010.delete')" type="button" class="btn btn-danger btn-min-width" ng-click="vm.delete()"><i class="fa fa-trash-o fa-fw"></i>{{'COM_BTN_DELETE' | translate}}</button> -->
                            <button ng-if="vm.m.form.salary_sts == '0'" type="submit" class="btn btn-primary"><i class="fas fa-save fa-fw"></i>{{'COM_BTN_UPDATE' | translate}}</button>
                        </div>
                    </div> 
                </form>
            </div>
        </div>
        <div class="col-md-7 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Diễn giải chi tiết</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.hrm1112({ employee_id: vm.m.employee_id,contract_id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Mục</th>
                                    <th>Công thức</th>
                                    <th class="text-right">Giá trị</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Lương GROSS</td>
                                    <td>(1)</td>
                                    <td class="text-right">{{vm.m.form.gross_salary | currency: '': 0}} VND</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Lương cơ bản</td>
                                    <td>(2)</td>
                                    <td class="text-right">{{vm.m.form.basic_salary | currency: '': 0}} VND</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Số ngày làm việc</td>
                                    <td></td>
                                    <td class="text-right">{{vm.m.form.total_days}}/{{vm.m.form.standard_days}} ({{vm.m.form.total_hours}}/{{vm.m.form.standard_hours}})</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Lương thực tế</td>
                                    <td>(4)</td>
                                    <td class="text-right">{{vm.m.form.real_salary | currency: '': 0}} VND</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Tăng ca</td>
                                    <td>(5)</td>
                                    <td class="text-right">{{vm.m.form.overtime_salary | currency: '': 0}} VND</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Thưởng + Hoa Hồng</td>
                                    <td>(6)</td>
                                    <td class="text-right">{{vm.m.form.bonus | currency: '': 0}} VND</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Tổng thu nhập</td>
                                    <td>(7) = (4) + (5) + (6)</td>
                                    <td class="text-right">{{vm.m.form.total_income | currency: '': 0}} VND</td>
                                </tr>
                                <!-- <tr>
                                    <td rowspan="3">CÁC KHOẢN KHẤU TRỪ
                                    </td>
                                </tr> -->
                                <tr>
                                    <td>8</td>
                                    <td>Bảo hiểm xã hội ({{vm.m.form.tax_bhxh_percent}}%)</td>
                                    <td>(8) = (2) * {{vm.m.form.tax_bhxh_percent}}%</td>
                                    <td class="text-right">{{vm.m.form.tax_bhxh | currency: '': 0}} VND</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>Bảo hiểm y tế ({{vm.m.form.tax_bhyt_percent}}%)</td>
                                    <td>(9) = (2) * {{vm.m.form.tax_bhyt_percent}}%</td>
                                    <td class="text-right">{{vm.m.form.tax_bhyt | currency: '': 0}} VND</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>Bảo hiểm thất nghiệp ({{vm.m.form.tax_bhtn_percent}}%)</td>
                                    <td>(10) = (2) * {{vm.m.form.tax_bhtn_percent}}%</td>
                                    <td class="text-right">{{vm.m.form.tax_bhtn | currency: '': 0}} VND</td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>Thuế TNCN</td>
                                    <td>(11) (*)</td>
                                    <td class="text-right">{{(vm.m.form.tax_pit + vm.m.form.tax_pit_edit) | currency: '': 0}} VND</td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td>Các khoản phạt khác</td>
                                    <td>(12)</td>
                                    <td class="text-right">{{vm.m.form.minus_amount | currency: '': 0}} VND</td>
                                </tr>
                                <tr>
                                    <td>13</td>
                                    <td>Tạm ứng</td>
                                    <td>(13)</td>
                                    <td class="text-right">{{vm.m.form.advance | currency: '': 0}} VND</td>
                                </tr>
                                <tr>
                                    <td>14</td>
                                    <td>Thực nhận</td>
                                    <td>(14) = (7) - (8) - (9) - (10) - (11) - (12) - (13)</td>
                                    <td class="text-right"><b>{{vm.m.form.net_salary | currency: '': 0}} VND</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Công ty trả</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.hrm1112({ employee_id: vm.m.employee_id,contract_id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Mục</th>
                                    <th class="text-right">Giá trị</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Lương thực tế</td>
                                    <td class="text-right">{{vm.m.form.real_salary | currency: '': 0}} VND</td>
                                </tr>
                                <tr>
                                    <td>Bảo hiểm xã hội ({{vm.m.form.com_tax_bhxh_percent}}%)</td>
                                    <td class="text-right">{{vm.m.form.com_tax_bhxh | currency: '': 0}} VND</td>
                                </tr>
                                <tr>
                                    <td>Bảo hiểm y tế ({{vm.m.form.com_tax_bhyt_percent}}%)</td>
                                    <td class="text-right">{{vm.m.form.com_tax_bhyt | currency: '': 0}} VND</td>
                                </tr>
                                <tr>
                                    <td>Bảo hiểm thất nghiệp ({{vm.m.form.com_tax_bhtn_percent}}%)</td>
                                    <td class="text-right">{{vm.m.form.com_tax_bhtn | currency: '': 0}} VND</td>
                                </tr>
                                <tr>
                                    <td><b>Tổng cộng</b></td>
                                    <td class="text-right"><b>{{vm.m.form.com_total | currency: '': 0}} VND</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thuế thu nhập cá nhân (*)</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.hrm1112({ employee_id: vm.m.employee_id,contract_id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th>Tổng thu nhập</th>
                                    <td class="text-right">{{vm.m.form.total_income | currency: '': 0}} VND</td>
                                </tr>
                                <tr>
                                    <th>Giảm trừ gia cảnh</th>
                                    <td class="text-right">{{vm.m.form.total_dependent_amount | currency: '': 0}} VND</td>
                                </tr>
                                <tr>
                                    <th>Thu nhập chịu thuế</th>
                                    <td class="text-right"><b>{{vm.m.form.total_in_tax | currency: '': 0}} VND</b></td>
                                </tr>
                                <tr>
                                    <th>Thuế thu nhập cá nhân</th>
                                    <td class="text-right"><b>{{vm.m.form.pits.amount | currency: '': 0}} VND</b></td>
                                </tr>
                                <tr>
                                    <th>Điều chỉnh</th>
                                    <td class="text-right"><b>{{vm.m.form.tax_pit_edit | currency: '': 0}} VND</b></td>
                                </tr>
                                <tr>
                                    <th>Tổng cộng</th>
                                    <td class="text-right"><b>{{(vm.m.form.pits.amount + vm.m.form.tax_pit_edit) | currency: '': 0}} VND</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Mức chịu thuế</th>
                                    <th>Thuế suất</th>
                                    <th class="text-right">Giá trị</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Đến 5 triệu VND</td>
                                    <td class="text-right">5%</td>
                                    <td class="text-right">
                                        <span ng-if="vm.m.form.pits.details[0]">{{vm.m.form.pits.details[0].pit | currency: '': 0}} VND</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Trên 5 triệu VND đến 10 triệu VND</td>
                                    <td class="text-right">10%</td>
                                    <td class="text-right">
                                        <span ng-if="vm.m.form.pits.details[1]">{{vm.m.form.pits.details[1].pit | currency: '': 0}} VND</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Trên 10 triệu VND đến 18 triệu VND</td>
                                    <td class="text-right">15%</td>
                                    <td class="text-right">
                                        <span ng-if="vm.m.form.pits.details[2]">{{vm.m.form.pits.details[2].pit | currency: '': 0}} VND</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Trên 18 triệu VND đến 32 triệu VND</td>
                                    <td class="text-right">20%</td>
                                    <td class="text-right">
                                        <span ng-if="vm.m.form.pits.details[3]">{{vm.m.form.pits.details[3].pit | currency: '': 0}} VND</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Trên 32 triệu VND đến 52 triệu VND</td>
                                    <td class="text-right">25%</td>
                                    <td class="text-right">
                                        <span ng-if="vm.m.form.pits.details[4]">{{vm.m.form.pits.details[4].pit | currency: '': 0}} VND</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Trên 52 triệu VND đến 80 triệu VND</td>
                                    <td class="text-right">30%</td>
                                    <td class="text-right">
                                        <span ng-if="vm.m.form.pits.details[5]">{{vm.m.form.pits.details[5].pit | currency: '': 0}} VND</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Trên 80 triệu VND</td>
                                    <td class="text-right">35%</td>
                                    <td class="text-right">
                                    <td class="text-right">
                                        <span ng-if="vm.m.form.pits.details[6]">{{vm.m.form.pits.details[6].pit | currency: '': 0}} VND</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>