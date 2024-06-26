<section class="content-header">
    <h1>Thêm người giao hàng<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm1100">Danh sách người giao hàng</a></li>
        <li class="active">Thêm người giao hàng</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-7">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin người giao hàng</h3>
                    <div class="box-tools pull-right">
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <form class="form-horizontal" name="form" ng-submit="vm.save()" >
                    <div class="box-body">
                        <div ng-if="vm.alerts" class="alert alert-{{alert.type}}" ng-repeat="alert in vm.alerts">
                            <h4>{{alert.title}}</h4>
                            <p>{{alert.msg}}</p>
                        </div>
                        

                        <div class="form-group" ng-class="{ 'has-error': form.name.$invalid && ( vm.formSubmitted || form.name.$touched) }">
                            <label class="col-sm-2 control-label required">Tên người giao</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.filter.delivery_vendor_name" name="delivery_vendor_name" placeholder="" required>
                                <p ng-show="form.name.$error.required && ( vm.formSubmitted || form.name.$touched)" class="help-block">Vui lòng nhập Tên</p>
                            </div>
                        </div>

                        
                        <div class="form-group" >
                            <label class="col-sm-2 control-label">Người liên hệ</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.filter.contact_name" name="contact_name" placeholder="">
                                
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" ng-model="vm.m.filter.contact_email" name="contact_email" placeholder=""/>
                            </div>
                        </div>

                        <div class="form-group" >
                            <label class="col-sm-2 control-label ">Tel</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" ng-model="vm.m.filter.contact_tel" name="contact_tel" placeholder="" >
                               
                            </div>
                           
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Mobile 1</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" ng-model="vm.m.filter.contact_mobile1" name="contact_mobile1" placeholder="">
                            </div>
                            <label class="col-sm-2 control-label">Mobile 2</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" ng-model="vm.m.filter.contact_mobile2" name="contact_mobile2" placeholder="">
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-sm-2 control-label ">Ghi chú</label>
                            <div class="col-sm-10">
                        
                                <textarea rows="5" class="form-control" ng-model="vm.m.filter.notes" name="notes" placeholder=""></textarea>
                               
                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <a ui-sref="app.crm1100" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_NEW" ng-if="vm.m.delivery_vendor_id == null">Add New</button>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_UPDATE" ng-if="vm.m.delivery_vendor_id != null">Update</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>
