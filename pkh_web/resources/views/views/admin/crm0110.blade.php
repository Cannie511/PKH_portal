<section class="content-header">
    <h1>Thêm sản phẩm<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm0100"><span>Sản phẩm</span></a></li>
        <li class="active">Thêm sản phẩm</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-7">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Sản phẩm</h3>
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
                                    ng-options="item.supplier_id as item.display for item in vm.m.init.listSupplier"
                                    >
                                    <option value=""></option>
                                </select>
                                <p ng-show="form.supplier_id.$error.required && ( vm.formSubmitted || form.supplier_id.$touched)" class="help-block">Vui lòng chọn nhà sản xuất</p>
                                <span class="help-block" ng-repeat="(i, err) in vm.m.errors['supplier_id']">{{err}}</span>
                            </div>
                        </div>

                        
                        <div class="form-group" ng-class="{ 'has-error': (form.product_cat1_id.$invalid && ( vm.formSubmitted || form.product_cat1_id.$touched)) || (vm.m.errors['product_cat1_id'].length > 0) }">
                            <label class="col-sm-2 control-label required">Chọn loại sản phẩm</label>
                            <div class="col-sm-10">
                                <select class="form-control"     
                                    chosen                               
                                    placeholder-text-single="'Chọn dòng sản phẩm'"
                                    ng-model="vm.m.form.product_cat1_id"
                                    ng-options="item.product_cat1_id as item.name for item in vm.m.init.listCat1"
                                    >
                                </select>
                                <p ng-show="form.product_cat1_id.$error.required && ( vm.formSubmitted || form.product_cat1_id.$touched)" class="help-block">Vui lòng nhóm sản phẩm</p>
                                <span class="help-block" ng-repeat="(i, err) in vm.m.errors['product_cat1_id']">{{err}}</span>
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': (form.product_cat2_id.$invalid && ( vm.formSubmitted || form.product_cat2_id.$touched)) || (vm.m.errors['product_cat2_id'].length > 0) }">
                            <label class="col-sm-2 control-label required">Chọn dòng sản phẩm</label>
                            <div class="col-sm-10">
                                <select class="form-control"     
                                    chosen                               
                                    placeholder-text-single="'Chọn loại sản phẩm'"
                                    ng-model="vm.m.form.product_cat2_id"
                                    ng-options="item.product_cat2_id as item.name for item in vm.m.init.listCat2"
                                    >
                                </select>
                                <p ng-show="form.product_cat2_id.$error.required && ( vm.formSubmitted || form.product_cat2.$touched)" class="help-block">Vui lòng nhóm sản phẩm</p>
                                <span class="help-block" ng-repeat="(i, err) in vm.m.errors['product_cat2']">{{err}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label required">Màu sắc</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.form.color" name="color" placeholder="">  
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label required">Dạng đóng gói</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.form.pakagingType" name="pakagingType" placeholder="">  
                            </div>
                        </div>


                        <div ng-if="vm.m.form.product_id == 0" class="form-group" ng-class="{ 'has-error': (form.product_code.$invalid && ( vm.formSubmitted || form.product_code.$touched)) || (vm.m.errors['product_code'].length > 0) }">
                            <label class="col-sm-2 control-label required">Mã sản phẩm</label>
                            <div class="col-sm-10">
                                
                                <input type="text" class="form-control" ng-model="vm.m.form.product_code" name="product_code" placeholder="" required>
                                
                                <p ng-show="form.product_code.$error.required && ( vm.formSubmitted || form.product_code.$touched)" class="help-block">Vui lòng nhập mã sản phẩm</p>
                                <span class="help-block" ng-repeat="(i, err) in vm.m.errors['product_code']">{{err}}</span>
                            </div>
                        </div>

                        <div ng-if="vm.m.form.product_id > 0" class="form-group" ng-class="{ 'has-error': (form.product_code.$invalid && ( vm.formSubmitted || form.product_code.$touched)) || (vm.m.errors['name'].length > 0) }">
                            <label class="col-sm-2 control-label required">Mã sản phẩm</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.form.product_code" name="product_code" placeholder="" required>
                                <p class="help-text"><em>VD: WT002W-6HDVX-1</em></p>
                                <p ng-show="form.product_code.$error.required && ( vm.formSubmitted || form.product_code.$touched)" class="help-block">Vui lòng nhập mã sản phẩm</p>
                                <span class="help-block" ng-repeat="(i, err) in vm.m.errors['product_code']">{{err}}</span>
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': (form.name.$invalid && ( vm.formSubmitted || form.name.$touched)) || (vm.m.errors['name'].length > 0) }">
                            <label class="col-sm-2 control-label required">Tên sản phẩm</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.form.name" name="name" placeholder="" required>
                                <p class="help-text"><em>VD: Vòi lavabo Pillar Victoria XQ301</em></p>
                                <p ng-show="form.name.$error.required && ( vm.formSubmitted || form.name.$touched)" class="help-block">Vui lòng nhập tên sản phẩm</p>
                                <span class="help-block" ng-repeat="(i, err) in vm.m.errors['name']">{{err}}</span>
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': (form.warranty.$invalid && ( vm.formSubmitted || form.warranty.$touched)) || (vm.m.errors['warranty'].length > 0) }">
                            <label class="col-sm-2 control-label required">Số năm bảo hành</label>
                            <div class="col-sm-10">
                                <select class="form-control"     
                                    chosen                               
                                    placeholder-text-single="'Chọn năm'"
                                    ng-model="vm.m.form.warranty"
                                    ng-options="item as item for item in vm.m.init.listWarranty"
                                    name="warranty"
                                    >
                                </select>
                                <p ng-show="form.warranty.$error.required && ( vm.formSubmitted || form.warranty.$touched)" class="help-block">Vui lòng nhóm sản phẩm</p>
                                <span class="help-block" ng-repeat="(i, err) in vm.m.errors['warranty']">{{err}}</span>
                            </div>
                        </div>

                        <div class="form-group" >
                            <label class="col-sm-2 control-label required">Đóng gói</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" ng-model="vm.m.form.pakaging" name="pakaging" placeholder="" min="1" required>
                               
                              
                            </div>
                        </div>

                        
                        <!-- <div class="form-group">
                            <label class="col-sm-2 control-label">Màu</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.form.color" name="color" placeholder="" required>
                            </div>
                        </div> -->

                        <!-- <div class="form-group"> 
                            <div class="col-md-4"> 
                                <input id="file" type="file" enctype="mutipart/form-data"> 
                                <div id="imgPreview" class="text-center"> 
                                    <img ng-if="vm.m.form.file" ng-attr-src="{{vm.m.form.file}}" heigh="100px" weight="100px"/>
                                </div> 
                            </div>
                        </div>         -->
                        <!-- <div class="form-group" ng-class="{ 'has-error': form.title.$invalid && ( vm.formSubmitted || form.title.$touched) }">
                            <label class="col-sm-2 control-label required">Tên file</label>
                         
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.form.title" name="title" required>
                                <p ng-show="form.title.$error.required && ( vm.formSubmitted || form.title.$touched)" class="help-block">Vui lòng nhập tiêu đề</p>
                            </div>
                        </div> -->

                    </div>
                    <div class="box-footer">
                        <a ui-sref="app.crm0300" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_NEW" ng-if="!(vm.m.form.product_id > 0)">Add New</button>
                        <button type="submit" class="btn btn-warning pull-right" translate="COM_BTN_UPDATE" ng-if="vm.m.form.product_id > 0" >Update</button> 
                    </div>



                </form>
            </div>
        </div>
    </div>
</section>
