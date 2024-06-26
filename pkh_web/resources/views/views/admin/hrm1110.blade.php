<section class="content-header">
    <h1 ng-if="vm.m.init.id > 0">Cập nhật bảng lương<small></small></h1>
    <h1 ng-if="vm.m.init.id == 0">Thêm bảng lương<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.hrm1100">Danh sách bảng lương</a></li>
        <li ng-if="vm.m.init.id > 0" class="active">Cập nhật bảng lương</li>
        <li ng-if="vm.m.init.id == 0" class="active">Thêm bảng lương</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin bảng lương</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.hrm1110({ employee_id: vm.m.employee_id,contract_id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <form class="form" name="form" ng-submit="vm.save(form.$valid, form)" novalidate>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group" ng-class="{ 'has-error': form.salary_month.$invalid && ( vm.formSubmitted || form.salary_month.$touched) || (vm.m.errors['salary_month'].length > 0) }">
                                    <label class="control-label required">Tháng</label>
                                    <div class="input-group">
                                        <input class="form-control" name="salary_month" datetimepicker ng-model="vm.m.form.salary_month" placeholder="YYYY-MM" options="vm.m.dateMonthOptions" required/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['salary_month']">{{err}}</p>
                                </div>
                            </div>
                            <!-- <div class="col-md-3 col-sm-12">
                                <div class="form-group" ng-class="{ 'has-error': form.from_date.$invalid && ( vm.formSubmitted || form.from_date.$touched) || (vm.m.errors['from_date'].length > 0) }">
                                    <label class="control-label required">Từ ngày</label>
                                    <div class="input-group">
                                        <input class="form-control" name="from_date" datetimepicker ng-model="vm.m.form.from_date" placeholder="YYYY-MM-DD" options="vm.m.dateOptions" required/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['from_date']">{{err}}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group" ng-class="{ 'has-error': form.to_date.$invalid && ( vm.formSubmitted || form.to_date.$touched) || (vm.m.errors['to_date'].length > 0) }">
                                    <label class="control-label required">Đến ngày</label>
                                    <div class="input-group">
                                        <input class="form-control" name="to_date" datetimepicker ng-model="vm.m.form.to_date" placeholder="YYYY-MM-DD" options="vm.m.dateOptions" required/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['to_date']">{{err}}</p>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="pull-right">
                            <button ng-if="vm.m.form.id > 0 && vm.can('screen.hrm1010.delete')" type="button" class="btn btn-danger btn-min-width" ng-click="vm.delete()"><i class="fa fa-trash-o fa-fw"></i>{{'COM_BTN_DELETE' | translate}}</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save fa-fw"></i>{{'COM_BTN_UPDATE' | translate}}</button>
                        </div>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>