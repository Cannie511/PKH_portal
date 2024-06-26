<section class="content-header">
    <h1>Thêm nhà cung cấp<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm2520"><span>Sản phẩm</span></a></li>
        <li class="active">Thêm Nhà cung cấp</li>
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
                <form class="form-horizontal" name="form" ng-submit="vm.save()" novalidate>
                    <div class="box-body">
                        <div ng-if="vm.alerts" class="alert alert-{{alert.type}}" ng-repeat="alert in vm.alerts">
                            <h4>{{alert.title}}</h4>
                            <p>{{alert.msg}}</p>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': form.name.$invalid && ( vm.formSubmitted || form.name.$touched) }">
                            <label class="col-sm-2 control-label required">Tên Nhà cung cấp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.filter.name" name="name" placeholder="" required>
                                <p ng-show="form.name.$error.required && ( vm.formSubmitted || form.name.$touched)" class="help-block">Vui lòng nhập Tên</p>
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-sm-2 control-label required">Mã Nhà cung cấp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.filter.supplier_code" name="supplier_code" placeholder="">
                                
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-sm-2 control-label required">Người liên hệ</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.filter.contact_name" name="contact_name" placeholder="">
                                
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-sm-2 control-label required">Địa chỉ</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.filter.address" name="address" placeholder="">
                                
                            </div>
                        </div>

                        
                        <div class="form-group" >
                            <label class="col-sm-2 control-label required">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" ng-model="vm.m.filter.contact_email" name="contact_email" placeholder=""/>
                            </div>
                        </div>

                        <div class="form-group" >
                            <label class="col-sm-2 control-label required ">Tel</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" ng-model="vm.m.filter.contact_tel" name="contact_tel" placeholder="" >
                               
                            </div>
                           
                        </div>
                        
                     

                       

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

                    
                    <div class="box-footer">
                        <a ui-sref="app.crm2520" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_NEW" ng-if="!vm.m.supplier_id">Add New</button>
                        <button type="submit" class="btn btn-warning pull-right" translate="COM_BTN_UPDATE" ng-if="vm.m.supplier_id" >Update</button> 
                    </div>



                </form>
            </div>
        </div>
    </div>
</section>
