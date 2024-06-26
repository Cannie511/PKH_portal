<section class="content-header">
    <h1>Thêm loại sản phẩm<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm0120"><span>Loại sản phẩm</span></a></li>
        <li class="active">Thêm loại sản phẩm</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-7">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Loại sản phẩm</h3>
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

                      

                        <div class="form-group" ng-class="{ 'has-error': (form.supplier_id.$invalid && ( vm.formSubmitted || form.supplier_id.$touched)) || (vm.m.errors['supplier_id'].length > 0) }">
                            <label class="col-sm-2 control-label required">Nhà sản xuất</label>
                            <div class="col-sm-10">
                                <select class="form-control"     
                                    chosen                               
                                    placeholder-text-single="'Chọn nhà sản xuất'"
                                    ng-model="vm.m.form.supplier_id"
                                    ng-options="item.supplier_id as item.name for item in vm.m.init.listSupplier"
                                    >
                                    <option value=""></option>
                                </select>
                                <p ng-show="form.supplier_id.$error.required && ( vm.formSubmitted || form.supplier_id.$touched)" class="help-block">Vui lòng chọn nhà sản xuất</p>
                                <span class="help-block" ng-repeat="(i, err) in vm.m.errors['supplier_id']">{{err}}</span>
                            </div>
                        </div>

                       
                        <div class="form-group">
                            <label class="col-sm-2 control-label required">Tên dòng sản phẩm</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.form.name" name="name" placeholder="" required>
                                <p ng-show="form.name.$error.required && ( vm.formSubmitted || form.name.$touched)" class="help-block">Vui lòng nhập tên dòng sản phẩm</p>
                            </div>
                        </div>

                        <div class="form-group" ng-if="vm.m.form.product_cat1_id > 0">
                            <label class="col-sm-2 control-label required">Tên loại sản phẩm</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.form.name1" name="name1" placeholder="" required>
                                <p ng-show="form.name.$error.required && ( vm.formSubmitted || form.name.$touched)" class="help-block">Vui lòng nhập tên loại sản phẩm</p>
                                
                            </div>
                        </div>

                        

                       
                    </div>
                    <div class="box-footer">
                        <a ui-sref="app.crm0120" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_NEW" ng-if="!(vm.m.form.product_cat1_id > 0)">Add New</button>
                        <button type="submit" class="btn btn-warning pull-right" translate="COM_BTN_UPDATE" ng-if="vm.m.form.product_cat1_id > 0" >Update</button> 
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>
