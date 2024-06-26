<section class="content-header">
    <h1 ng-if="vm.m.init.id > 0">Cập nhật ngày phép<small></small></h1>
    <h1 ng-if="vm.m.init.id == 0">Thêm ngày phép<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.hrm0800">Ngày phép</a></li>
        <li ng-if="vm.m.init.id > 0" class="active">Cập nhật ngày phép</li>
        <li ng-if="vm.m.init.id == 0" class="active">Thêm ngày phép</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-9 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin ngày phép</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.hrm0716({ employee_id: vm.m.employee_id,contract_id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <form class="form" name="form" ng-submit="vm.save(form.$valid, form)">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group" ng-class="{ 'has-error': form.employee_id.$invalid && ( vm.formSubmitted || form.employee_id.$touched) || (vm.m.errors['employee_id'].length > 0) }">
                                    <label class="control-label required">Nhân viên</label>
                                    <select class="form-control" name="employee_id"
                                        placeholder-text-single="'Nhân viên'"
                                        ng-model="vm.m.form.employee_id"
                                        ng-options="item.employee_id as item.display for item in vm.m.init.listEmployee"
                                        name="employee_id"
                                        chosen
                                        required
                                        >
                                    </select>
                                    <p ng-show="form.employee_id.$error.required && ( vm.formSubmitted || form.employee_id.$touched)" class="help-block">Vui lòng chọn nhân viên</p>
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['employee_id']">{{err}}</p>
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-12">
                                <div class="form-group" ng-class="{ 'has-error': form.num_days.$invalid && ( vm.formSubmitted || form.num_days.$touched) || (vm.m.errors['num_days'].length > 0) }">
                                    <label class="control-label required">Số ngày</label>
                                    <input type="number" class="form-control" ng-model="vm.m.form.num_days" name="num_days" placeholder="Số ngày" min="0" step="0.5" max="20" required>
                                    <p ng-show="form.num_days.$error.required && ( vm.formSubmitted || form.num_days.$touched)" class="help-block">Vui lòng nhập Số ngày</p>
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['num_days']">{{err}}</p>
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-12">
                                <div class="form-group" ng-class="{ 'has-error': form.expired_date.$invalid && ( vm.formSubmitted || form.expired_date.$touched) || (vm.m.errors['expired_date'].length > 0) }">
                                    <label class="control-label required">Hết hạn</label>
                                    <div class="input-group">
                                        <input class="form-control" name="expired_date" datetimepicker ng-model="vm.m.form.expired_date" placeholder="YYYY-MM-DD" options="vm.m.dateOptions" required/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['expired_date']">{{err}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-xs-12">
                                <div class="form-group" ng-class="{ 'has-error': form.reason.$invalid && ( vm.formSubmitted || form.reason.$touched) || (vm.m.errors['reason'].length > 0) }">
                                    <label class="control-label required">Lý do</label>
                                    <input type="text" class="form-control" ng-model="vm.m.form.reason" name="reason" placeholder="Lý do" required>
                                    <p ng-show="form.reason.$error.required && ( vm.formSubmitted || form.reason.$touched)" class="help-block">Vui lòng nhập Lý do</p>
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['reason']">{{err}}</p>
                                </div>
                            </div>

                            <div class="col-md-12 col-xs-12">
                                <div class="form-group" ng-class="{ 'has-error': form.notes.$invalid && ( vm.formSubmitted || form.notes.$touched) || (vm.m.errors['notes'].length > 0) }">
                                    <label class="control-label">Ghi chú</label>
                                    <input type="text" class="form-control" ng-model="vm.m.form.notes" name="notes" placeholder="Ghi chú">
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['notes']">{{err}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="pull-right">
                            <button ng-if="vm.m.init.id > 0 && vm.can('screen.hrm0800.delete')" type="button" class="btn btn-danger" ng-click="vm.delete()"><i class="fa fa-trash-o fa-fw"></i>{{'COM_BTN_DELETE' | translate}}</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save fa-fw"></i>{{'COM_BTN_UPDATE' | translate}}</button>
                        </div>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>