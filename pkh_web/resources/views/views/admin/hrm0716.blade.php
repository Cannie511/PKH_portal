<section class="content-header">
    <h1>Hợp đồng nhân viên<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.hrm0715({id: vm.m.employee_id})"><span>Nhân viên</span></a></li>
        <li class="active">Hợp đồng</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin hợp đồng</h3>
                    <div class="box-tools pull-right">
                        <div class="box-tools pull-right">
                            <!-- <a ui-sref="app.hrm0710({id: vm.m.employee_id})" class="btn btn-warning btn-xs"><i class="fa fa-remove"></i>&nbsp;{{'COM_BTN_CANCEL' | translate}}</a> -->
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <form name="form" ng-submit="vm.save(form.$valid, form)">
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <p class="form-control-static">{{vm.m.employee.email}}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Tên</label>
                                        <p class="form-control-static">{{vm.m.employee.fullname}}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Ngày sinh</label>
                                        <p class="form-control-static">{{vm.m.employee.dob}}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group" ng-class="{ 'has-error': form.contract_no.$invalid && ( vm.formSubmitted || form.contract_no.$touched) || (vm.m.errors['contract_no'].length > 0) }">
                                        <label class="control-label required">Mã hợp đồng</label>
                                        <input type="text" class="form-control" ng-model="vm.m.form.contract_no" name="contract_no" placeholder="" required>
                                        <p ng-show="form.contract_no.$error.required && ( vm.formSubmitted || form.contract_no.$touched)" class="help-block">Vui lòng nhập Mã hợp đồng</p>
                                        <p class="help-block" ng-repeat="(i, err) in vm.m.errors['contract_no']">{{err}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group" ng-class="{ 'has-error': form.contract_type.$invalid && ( vm.formSubmitted || form.contract_type.$touched) }">
                                        <label class="control-label required">Loại</label>
                                        <select class="form-control"
                                            placeholder-text-single="'Loại'"
                                            ng-model="vm.m.form.contract_type"
                                            name="contract_type"
                                            required
                                            >
                                            <option value="PART_TIME">Bán thời gian</option>
                                            <option value="FULL_TIME">Toàn thời gian</option>
                                            <option value="PROBATION">Thử việc</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group" ng-class="{ 'has-error': form.start_date.$invalid && ( vm.formSubmitted || form.start_date.$touched) }">
                                        <label class="control-label required">Bắt đầu</label>
                                        <div class="input-group">
                                            <input class="form-control" name="start_date" datetimepicker ng-model="vm.m.form.start_date" placeholder="YYYY-MM-DD" options="vm.m.dateOptions" required/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group" ng-class="{ 'has-error': form.end_date.$invalid && ( vm.formSubmitted || form.end_date.$touched) }">
                                        <label class="control-label required">Kết thúc</label>
                                        <div class="input-group">
                                            <input class="form-control" name="end_date" datetimepicker ng-model="vm.m.form.end_date" placeholder="YYYY-MM-DD" options="vm.m.dateOptions" required/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group" ng-class="{ 'has-error': form.title.$invalid && ( vm.formSubmitted || form.title.$touched) || (vm.m.errors['title'].length > 0) }">
                                        <label class="control-label required">Vị trí</label>
                                        <input type="text" class="form-control" ng-model="vm.m.form.title" name="title" placeholder="Vị trí" required>
                                        <p ng-show="form.title.$error.required && ( vm.formSubmitted || form.title.$touched)" class="help-block">Vui lòng nhập Vị trí</p>
                                        <p class="help-block" ng-repeat="(i, err) in vm.m.errors['title']">{{err}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group" ng-class="{ 'has-error': form.salary.$invalid && ( vm.formSubmitted || form.salary.$touched) || (vm.m.errors['salary'].length > 0) }">
                                        <label class="control-label required">Mức lương (GROSS)</label>
                                        <input type="text" class="form-control" ng-model="vm.m.form.salary" name="salary" placeholder="Mức lương (GROSS)" required>
                                        <p ng-show="form.salary.$error.required && ( vm.formSubmitted || form.salary.$touched)" class="help-block">Vui lòng nhập Mức lương (GROSS)</p>
                                        <p class="help-block" ng-repeat="(i, err) in vm.m.errors['salary']">{{err}}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group" ng-class="{ 'has-error': form.basic_salary.$invalid && ( vm.formSubmitted || form.basic_salary.$touched) || (vm.m.errors['basic_salary'].length > 0) }">
                                        <label class="control-label required">Mức lương căn bản</label>
                                        <input type="text" class="form-control" ng-model="vm.m.form.basic_salary" name="basic_salary" placeholder="Mức lương căn bản" required>
                                        <p ng-show="form.basic_salary.$error.required && ( vm.formSubmitted || form.basic_salary.$touched)" class="help-block">Vui lòng nhập Mức lương căn bản</p>
                                        <p class="help-block" ng-repeat="(i, err) in vm.m.errors['basic_salary']">{{err}}</p>
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Ghi Chú</label>
                                        <textarea rows="5" type="text" class="form-control" ng-model="vm.m.form.notes" name="notes" placeholder="Ghi Chú"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="pull-right">
                                <button ng-if="vm.m.contract_id > 0 && vm.can('screen.hrm0716.delete')" type="button" class="btn btn-danger" ng-click="vm.delete()"><i class="fa fa-trash-o fa-fw"></i>{{'COM_BTN_DELETE' | translate}}</button>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save fa-fw"></i>{{'COM_BTN_UPDATE' | translate}}</button>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>