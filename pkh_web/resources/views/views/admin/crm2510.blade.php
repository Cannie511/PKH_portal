<section class="content-header">
    <h1 ng-if="!(vm.m.form.product_market_id > 0)">Thêm vật phẩm<small></small></h1>
    <h1 ng-if="vm.m.form.product_market_id > 0">Cập nhật vật phẩm<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li ng-if="!(vm.m.form.product_market_id > 0)" class="active">Thêm vật phẩm</li>
        <li ng-if="vm.m.form.product_market_id > 0" class="active">Cập nhật vật phẩm</li>
    </ol>
</section>
<section id="crm2510" class="content">
    <div class="row">
        <div class="col-sm-12 col-md-7">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Vật phẩm</h3>
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

                        <div class="form-group" ng-class="{ 'has-error': (form.type.$invalid && ( vm.formSubmitted || form.type.$touched)) || (vm.m.errors['type'].length > 0) }">
                            <label class="col-sm-2 control-label required">Loại</label>
                            <div class="col-sm-10">
                                <select class="form-control"
                                    chosen
                                    placeholder-text-single="'Chọn Loại'"
                                    ng-model="vm.m.form.type"
                                    >
                                    <option value=''></option>
                                    <option value='1'>Vật phẩm marketing</option>
                                    <option value='2'>Văn phòng</option>
                                    <option value='3'>In ấn</option>
                                </select>
                                <p ng-show="form.type.$error.required && ( vm.formSubmitted || form.type.$touched)" class="help-block">Vui lòng chọn loại</p>
                                <span class="help-block" ng-repeat="(i, err) in vm.m.errors['type']">{{err}}</span>
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': (form.code.$invalid && ( vm.formSubmitted || form.code.$touched)) || (vm.m.errors['code'].length > 0) }">
                            <label class="col-sm-2 control-label required">Mã vật phẩm</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.form.code" name="code" placeholder="" required maxlengh="32">
                                <p ng-show="form.code.$error.required && ( vm.formSubmitted || form.code.$touched)" class="help-block">Vui lòng nhập mã vật phẩm</p>
                                <span class="help-block" ng-repeat="(i, err) in vm.m.errors['code']">{{err}}</span>
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': (form.name.$invalid && ( vm.formSubmitted || form.name.$touched)) || (vm.m.errors['name'].length > 0) }">
                            <label class="col-sm-2 control-label required">Tên vật phẩm</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.form.name" name="name" placeholder="" required>
                                <p ng-show="form.name.$error.required && ( vm.formSubmitted || form.name.$touched)" class="help-block">Vui lòng nhập tên vật phẩm</p>
                                <span class="help-block" ng-repeat="(i, err) in vm.m.errors['name']">{{err}}</span>
                            </div>
                        </div>
                      
                        <div class="form-group" ng-class="{ 'has-error': (form.description.$invalid && ( vm.formSubmitted || form.description.$touched)) || (vm.m.errors['description'].length > 0) }">
                            <label class="col-sm-2 control-label">Mô tả</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" ng-model="vm.m.form.description" name="description" placeholder="" rows=10></textarea>
                                <span class="help-block" ng-repeat="(i, err) in vm.m.errors['description']">{{err}}</span>
                            </div>
                        </div>

                        <div class="form-group"> 
                            <label class="col-sm-2 control-label">Hình ảnh</label>
                            <div class="col-sm-10">
                                <input id="file" type="file" enctype="mutipart/form-data"> 
                                <div id="imgPreview" class="text-center img-preview"> 
                                    <img ng-if="vm.m.form.file" ng-attr-src="{{vm.m.form.file}}"/>
                                </div>
                            </div>
                        </div>        

                    </div>

                    <div class="box-footer">
                        <a ui-sref="app.crm0300" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_NEW" ng-if="!(vm.m.form.product_market_id > 0)">Add New</button>
                        <button type="submit" class="btn btn-warning pull-right" translate="COM_BTN_UPDATE" ng-if="vm.m.form.product_market_id > 0" >Update</button> 
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
