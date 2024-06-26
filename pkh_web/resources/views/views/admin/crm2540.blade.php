<section class="content-header">
    <h1>Nhập/Xuất vật phẩm<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Nhập/Xuất vật phẩm</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-7">
            <div class="box" ng-class='{"box-info": vm.m.form.warehouse_change_type == 1,"box-warning": vm.m.form.warehouse_change_type ==2}'>
                <div class="box-header with-border">
                    <h3 class="box-title">Nhập/Xuất vật phẩm</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <form class="form-horizontal" name="form" ng-submit="vm.save(form.$valid, form)" novalidate>
                    <div class="box-body">
                        <div ng-if="vm.alerts" class="alert alert-{{alert.type}}" ng-repeat="alert in vm.alerts">
                            <h4>{{alert.title}}</h4>
                            <p>{{alert.msg}}</p>
                        </div>

                        <div class="callout" ng-class='{"callout-info": vm.m.form.warehouse_change_type == 1,"callout-warning": vm.m.form.warehouse_change_type ==2}'>
                            <p ng-if="vm.m.form.warehouse_change_type == 1">NHẬP KHO</p>
                            <p ng-if="vm.m.form.warehouse_change_type == 2">XUẤT KHO</p>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': (form.changed_date.$invalid && ( vm.formSubmitted || form.changed_date.$touched)) || (vm.m.errors['changed_date'].length > 0) }">
                            <label class="col-sm-2 control-label required">Ngày</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input class="form-control" datetimepicker ng-model="vm.m.form.changed_date" placeholder="YYYY-MM-DD" options="vm.m.dateOptions"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <p ng-show="form.changed_date.$error.required && ( vm.formSubmitted || form.changed_date.$touched)" class="help-block">Vui lòng nhập ngày</p>
                                <span class="help-block" ng-repeat="(i, err) in vm.m.errors['changed_date']">{{err}}</span>
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': (form.type.$invalid && ( vm.formSubmitted || form.type.$touched)) || (vm.m.errors['type'].length > 0) }">
                            <label class="col-sm-2 control-label required">Loại sản phẩm</label>
                            <div class="col-sm-10">
                                <select class="form-control"     
                                    chosen                               
                                    placeholder-text-single="'Chọn loại'"
                                    ng-model="vm.m.form.type"
                                    >
                                    <option value=""></option>
                                    <option value="1">Marketing</option>
                                    <option value="2">Văn phòng</option>
                                    <option value="3">In ấn</option>
                                </select>
                                <p ng-show="form.type.$error.required && ( vm.formSubmitted || form.type.$touched)" class="help-block">Vui lòng chọn loại</p>
                                <span class="help-block" ng-repeat="(i, err) in vm.m.errors['type']">{{err}}</span>
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': (form.product_market_id.$invalid && ( vm.formSubmitted || form.product_market_id.$touched)) || (vm.m.errors['product_market_id'].length > 0) }">
                            <label class="col-sm-2 control-label required">Sản phẩm</label>
                            <div class="col-sm-10">
                                <select class="form-control"     
                                    chosen                               
                                    placeholder-text-single="'Chọn sản phẩm'"
                                    ng-model="vm.m.form.product_market_id"
                                    ng-options="item.product_market_id as item.name for item in vm.m.init.listProduct | filter: {type: vm.m.form.type}"
                                    >
                                    <option value=""></option>
                                </select>
                                <p ng-show="form.product_market_id.$error.required && ( vm.formSubmitted || form.product_market_id.$touched)" class="help-block">Vui lòng chọn sản phẩm</p>
                                <span class="help-block" ng-repeat="(i, err) in vm.m.errors['product_market_id']">{{err}}</span>
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': (form.price.$invalid && ( vm.formSubmitted || form.price.$touched)) || (vm.m.errors['price'].length > 0) }">
                            <label class="col-sm-2 control-label required">Giá</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.form.price" name="price" placeholder="" required>
                                <p ng-show="form.price.$error.required && ( vm.formSubmitted || form.price.$touched)" class="help-block">Vui lòng nhập giá</p>
                                <span class="help-block" ng-repeat="(i, err) in vm.m.errors['price']">{{err}}</span>
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': (form.amount.$invalid && ( vm.formSubmitted || form.amount.$touched)) || (vm.m.errors['amount'].length > 0) }">
                            <label class="col-sm-2 control-label required">Số lượng</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.form.amount" name="amount" placeholder="" required>
                                <p ng-show="form.amount.$error.required && ( vm.formSubmitted || form.amount.$touched)" class="help-block">Vui lòng nhập số lượng</p>
                                <span class="help-block" ng-repeat="(i, err) in vm.m.errors['amount']">{{err}}</span>
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': (form.amount.$invalid && ( vm.formSubmitted || form.amount.$touched)) || (vm.m.errors['amount'].length > 0) }">
                            <label class="col-sm-2 control-label required">Thành tiền</label>
                            <div class="col-sm-10 form-control-static">
                                <span class="form-control-static">{{(vm.m.form.amount * vm.m.form.price) | currency: "" : 0}}</span>
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': (form.store_id.$invalid && ( vm.formSubmitted || form.store_id.$touched)) || (vm.m.errors['store_id'].length > 0) }">
                            <label class="col-sm-2 control-label">Mã cửa hàng</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.form.store_id" name="store_id" placeholder="100" maxlengh="8">
                                <span class="help-block" ng-repeat="(i, err) in vm.m.errors['store_id']">{{err}}</span>
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': (form.description.$invalid && ( vm.formSubmitted || form.description.$touched)) || (vm.m.errors['description'].length > 0) }">
                            <label class="col-sm-2 control-label">Ghi chú</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" ng-model="vm.m.form.description" name="description" placeholder="" rows=10></textarea>
                                <span class="help-block" ng-repeat="(i, err) in vm.m.errors['description']">{{err}}</span>
                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <a ui-sref="app.crm2530" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_NEW" ng-if="!(vm.m.form.product_market_his_id > 0)">Add New</button>
                        <button type="submit" class="btn btn-warning pull-right" translate="COM_BTN_UPDATE" ng-if="vm.m.form.product_market_his_id > 0 && vm.m.form.status == 1" >Update</button> 
                    </div>

                </form>
            </div>
        </div>
        <div class="col-sm-12 col-md-5" ng-if="vm.m.form.product_market_his_id > 0">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Xác nhận</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <form class="form-horizontal" name="form">
                    <div class="box-body">
                        <div class="callout" ng-class='{"callout-info": vm.m.form.warehouse_change_type == 1,"callout-warning": vm.m.form.warehouse_change_type ==2}'>
                            <p ng-if="vm.m.form.warehouse_change_type == 1">NHẬP KHO</p>
                            <p ng-if="vm.m.form.warehouse_change_type == 2">XUẤT KHO</p>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': (form.description_approve.$invalid && ( vm.formSubmitted || form.description_approve.$touched)) || (vm.m.errors['description_approve'].length > 0) }">
                            <label class="col-sm-2 control-label">Ghi chú</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" ng-model="vm.m.form.description_approve" name="description_approve" placeholder="" rows=10></textarea>
                                <span class="help-block" ng-repeat="(i, err) in vm.m.errors['description_approve']">{{err}}</span>
                            </div>
                        </div>

                    </div>
                    <div class="box-footer" ng-if="vm.can('screen.crm2540.approve')">
                        <button type="button" class="btn btn-primary" ng-click="vm.updateStatus(2)">Approve</button>
                        <button type="button" class="btn btn-warning" ng-click="vm.updateStatus(3)">Deny</button>
                        <button type="button" class="btn " ng-click="vm.updateStatus(4)">Cancel</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>