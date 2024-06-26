<section class="content-header">
    <h1>Thêm thông tin theo dõi cửa hàng<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm0330"><span>Theo dõi cửa hàng</span></a></li>
        <li class="active">Thêm thông tin theo dõi cửa hàng</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-7">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin theo dõi cửa hàng</h3>
                    <div class="box-tools pull-right">
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <form class="form-horizontal" name="form" ng-submit="vm.save(form.$valid, form)" novalidate>
                    <div class="box-body">
                        <div ng-if="vm.alerts" class="alert alert-{{alert.type}}" ng-repeat="alert in vm.alerts">
                            <h4>{{alert.title}}</h4>
                            <p>{{alert.msg}}</p>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label required">Tên cửa hàng</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" ng-model="vm.m.form.storeName" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label required">Tên NVBH</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" ng-model="vm.m.form.listSalesman" disabled>
                            </div>
                        </div>
                        <div class="form-group" ng-class="{ 'has-error': form.notes.$invalid && ( vm.formSubmitted || form.notes.$touched) }">
                            <label class="col-sm-3 control-label required">Ghi chú</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" ng-model="vm.m.form.notes" name="notes" placeholder="" required rows="5" />
                                <p ng-show="form.notes.$error.required && ( vm.formSubmitted || form.notes.$touched)" class="help-block">Vui lòng nhập ghi chú</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Thêm ảnh</label>
                            <div class="col-sm-9">
                                <input id="file" type="file" enctype="mutipart/form-data">
                                <div id="imgPreview" class="text-center">
                                    <img class="img-preview" ng-if="vm.m.form.file" ng-attr-src="{{vm.m.form.file}}" />
                                    <img class="img-preview" ng-if="(vm.m.form.pathFile) && !(vm.m.form.file)" ng-src="/images/{{vm.m.form.pathFile}}" /> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a ui-sref="app.crm0330" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_NEW" ng-if="!(vm.m.form.storeWorkingId > 0)">Add New</button>
                        <button type="submit" class="btn btn-warning pull-right" translate="COM_BTN_UPDATE" ng-if="vm.m.form.storeWorkingId > 0" >Update</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>
