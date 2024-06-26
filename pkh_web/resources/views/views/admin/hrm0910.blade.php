<section class="content-header">
    <h1 ng-if="vm.m.init.id > 0">Cập nhật Ngày lễ<small></small></h1>
    <h1 ng-if="vm.m.init.id == 0">Thêm Ngày lễ<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.hrm0900">Ngày lễ</a></li>
        <li ng-if="vm.m.init.id > 0" class="active">Cập nhật Ngày lễ</li>
        <li ng-if="vm.m.init.id == 0" class="active">Thêm Ngày lễ</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin Ngày lễ</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.hrm0910({ employee_id: vm.m.employee_id,contract_id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <form class="form" name="form" ng-submit="vm.save(form.$valid, form)" novalidate>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group" ng-class="{ 'has-error': form.holiday_date.$invalid && ( vm.formSubmitted || form.holiday_date.$touched) || (vm.m.errors['holiday_date'].length > 0) }">
                                    <label class="control-label required">Ngày lễ</label>
                                    <div class="input-group">
                                        <input class="form-control" name="holiday_date" datetimepicker ng-model="vm.m.form.holiday_date" placeholder="YYYY-MM-DD" options="vm.m.dateOptions" required/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['holiday_date']">{{err}}</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group" ng-class="{ 'has-error': form.amount.$invalid && ( vm.formSubmitted || form.amount.$touched) || (vm.m.errors['amount'].length > 0) }">
                                    <label class="control-label required">Số ngày</label>
                                    <input type="number" class="form-control" ng-model="vm.m.form.amount" name="amount" placeholder="Số ngày" min="0" max="1.0" step="0.5" required>
                                    <p ng-show="form.amount.$error.required && ( vm.formSubmitted || form.amount.$touched)" class="help-block">Vui lòng nhập Số ngày</p>
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['amount']">{{err}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" ng-class="{ 'has-error': form.reason.$invalid && ( vm.formSubmitted || form.reason.$touched) || (vm.m.errors['reason'].length > 0) }">
                                    <label class="control-label required">Lý do</label>
                                    <input type="text" class="form-control" ng-model="vm.m.form.reason" name="reason" placeholder="Lý do" required>
                                    <p ng-show="form.reason.$error.required && ( vm.formSubmitted || form.reason.$touched)" class="help-block">Vui lòng nhập Lý do</p>
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['reason']">{{err}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="pull-right">
                            <button ng-if="vm.m.contract_id > 0 && vm.can('screen.hrm0910.delete')" type="button" class="btn btn-danger" ng-click="vm.delete()"><i class="fa fa-trash-o fa-fw"></i>{{'COM_BTN_DELETE' | translate}}</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save fa-fw"></i>{{'COM_BTN_UPDATE' | translate}}</button>
                        </div>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>