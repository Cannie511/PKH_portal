<section class="content-header">
    <h1>Thêm chành<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm0300"><span translate="CRM0300_TITLE"></span></a></li>
        <li class="active">Thêm cửa hàng</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-7">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin chành</h3>
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
                            <label class="col-sm-2 control-label">Tỉnh/TP</label>
                            <div class="col-sm-4">
                                <select class="form-control"     
                                    chosen                               
                                    placeholder-text-single="'Chọn tỉnh'"
                                    ng-model="vm.m.form.area1"
                                    ng-options="item.area_id as item.name for item in vm.m.init.area1List"
                                    >
                                    <option value=""></option>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">Quận/Huyện</label>
                            <div class="col-sm-4" ng-if="vm.m.form.area1">
                                <select class="form-control"     
                                    chosen                               
                                    placeholder-text-single="'Chọn tỉnh'"
                                    ng-model="vm.m.form.area2"
                                    ng-options="item.area_id as item.name for item in vm.m.init.area2List | filter : {'parent_area_id': vm.m.form.area1}"
                                    >
                                </select>
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': form.name.$invalid && ( vm.formSubmitted || form.name.$touched) }">
                            <label class="col-sm-2 control-label required">Tên</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.form.name" name="name" placeholder="" required>
                                <p ng-show="form.name.$error.required && ( vm.formSubmitted || form.name.$touched)" class="help-block">Vui lòng nhập Tên</p>
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': form.address.$invalid && ( vm.formSubmitted || form.address.$touched) }">
                            <label class="col-sm-2 control-label required">Địa chỉ</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.form.address" name="address" placeholder="" required>
                                <p ng-show="form.address.$error.required && ( vm.formSubmitted || form.address.$touched)" class="help-block">Vui lòng nhập địa chỉ</p>
                            </div>
                        </div>
                        
                        <div class="form-group" ng-class="{ 'has-error': form.contact_name.$invalid && ( vm.formSubmitted || form.contact_name.$touched) }">
                            <label class="col-sm-2 control-label required">Người liên hệ</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.form.contact_name" name="contact_name" placeholder="" required>
                                <p ng-show="form.contact_name.$error.required && ( vm.formSubmitted || form.contact_name.$touched)" class="help-block">Vui lòng nhập Người liên hệ</p>
                            </div>
                        </div>
                       
                        <div class="form-group" ng-class="{ 'has-error': form.contact_email.$invalid && ( vm.formSubmitted || form.contact_email.$touched) }">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.form.contact_email" name="contact_email" placeholder=""/>
                            </div>
                        </div>
                        <div class="form-group" ng-class="{ 'has-error': form.contact_tel.$invalid && ( vm.formSubmitted || form.contact_tel.$touched) }">
                            <label class="col-sm-2 control-label required">Tel</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" ng-model="vm.m.form.contact_tel" name="contact_tel" placeholder="" required>
                                <p ng-show="form.contact_tel.$error.required && ( vm.formSubmitted || form.contact_tel.$touched)" class="help-block">Vui lòng nhập số điện thoại</p>
                            </div>
                            <label class="col-sm-2 control-label">Fax</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" ng-model="vm.m.form.contact_fax" name="contact_fax" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Mobile 1</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" ng-model="vm.m.form.contact_mobile1" name="contact_mobile1" placeholder="">
                            </div>
                            <label class="col-sm-2 control-label">Mobile 2</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" ng-model="vm.m.form.contact_mobile2" name="contact_mobile2" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Lat</label>
                            <div class="col-sm-4">
                                <input type="text" value="{{ number_expression | number : 2}}" class="form-control" ng-model="vm.m.form.gps_lat" name="lat" placeholder="">
                            </div>
                            <label class="col-sm-2 control-label">Long</label>
                            <div class="col-sm-4">
                                <input type="text" value="{{ number_expression | number : 2}}" class="form-control" ng-model="vm.m.form.gps_long" name="long" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a ui-sref="app.crm0300" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_NEW" ng-if="!(vm.m.form.chanh_id > 0)">Add New</button>
                        <button type="submit" class="btn btn-warning pull-right" translate="COM_BTN_UPDATE" ng-if="vm.m.form.chanh_id > 0" >Update</button> 
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>
