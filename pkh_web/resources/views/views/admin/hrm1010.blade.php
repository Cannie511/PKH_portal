<section class="content-header">
    <h1 ng-if="vm.m.init.id > 0">Cập nhật tin tức nội bộ<small></small></h1>
    <h1 ng-if="vm.m.init.id == 0">Thêm tin tức nội bộ<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.hrm1000">Tin tức nội bộ</a></li>
        <li ng-if="vm.m.init.id > 0" class="active">Cập nhật tin tức nội bộ</li>
        <li ng-if="vm.m.init.id == 0" class="active">Thêm tin tức nội bộ</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-9 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin tin tức nội bộ</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.hrm1010({ employee_id: vm.m.employee_id,contract_id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <form class="form" name="form" ng-submit="vm.save(form.$valid, form)" novalidate>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" ng-class="{ 'has-error': form.title.$invalid && ( vm.formSubmitted || form.title.$touched) || (vm.m.errors['title'].length > 0) }">
                                    <label class="control-label required">Tiêu đề</label>
                                    <input type="text" class="form-control" ng-model="vm.m.form.title" name="title" placeholder="Tiêu đề" required>
                                    <p ng-show="form.title.$error.required && ( vm.formSubmitted || form.title.$touched)" class="help-block">Vui lòng nhập Tiêu đề</p>
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['title']">{{err}}</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" ng-class="{ 'has-error': form.content.$invalid && ( vm.formSubmitted || form.content.$touched) || (vm.m.errors['content'].length > 0) }">
                                    <label class="control-label required">Nội dung</label>
                                    <text-angular ng-model="vm.m.form.content" name="content" ></text-angular>
                                    <!-- <textarea rows="5" type="text" class="form-control" ng-model="vm.m.form.content" name="content" placeholder="Nội dung" required/> -->
                                    <p ng-show="form.content.$error.required && ( vm.formSubmitted || form.content.$touched)" class="help-block">Vui lòng nhập Nội dung</p>
                                    <p class="help-block" ng-repeat="(i, err) in vm.m.errors['content']">{{err}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="pull-right">
                            <button ng-if="vm.m.form.id > 0 && vm.can('screen.hrm1010.delete')" type="button" class="btn btn-danger btn-min-width" ng-click="vm.delete()"><i class="fa fa-trash-o fa-fw"></i>{{'COM_BTN_DELETE' | translate}}</button>
                            <button ng-if="vm.m.form.id > 0" type="button" class="btn btn-warning btn-min-width" ng-click="vm.publish()"><i class="fas fa-paper-plane fa-fw"></i>Gửi</button>
                            <button type="submit" class="btn btn-primary btn-min-width"><i class="fas fa-save fa-fw"></i>{{'COM_BTN_UPDATE' | translate}}</button>
                        </div>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>