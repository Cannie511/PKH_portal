
<section class="content-header">
    <h1>Thêm giao hàng<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm1000"><span></span></a></li>
        <li class="active">Thêm giao hàng</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-7">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin giao hàng</h3>
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

                        <div class="form-group" ng-class="{ 'has-error': form.date.$invalid && ( vm.formSubmitted || form.name.$touched) }">
                               <label class="col-sm-2 control-label required">Ngày giao hàng</label>
                               <div class="col-sm-10">
                                    <p class="input-group">
                                        <input type="text" class="form-control" name="date" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.filter.delivery_date" is-open="vm.dp2Opened" datepicker-options="vm.m.dateOptions" close-text="Close"
                                        ng-model-options="{timezone: 'utc'}" required/>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" ng-click="vm.dp2Opened = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </p>
                                     <p ng-show="form.date.$error.required && ( vm.formSubmitted || form.date.$touched)" class="help-block">Vui lòng nhập ngày thanh toán</p>
                                </div>    
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': form.delivery_vendor_id.$invalid && ( vm.formSubmitted || form.delivery_vendor_id.$touched) }">
                            <label class="col-sm-2 control-label required">Tên người giao hàng</label>
                            <div class="col-sm-10">
                                <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn Tên người giao hàng'"
                                        ng-model="vm.m.filter.delivery_vendor_id"
                                        name="delivery_vendor_id"
                                        ng-options="item.id as item.delivery_vendor_name for item in vm.m.init.listVendor "
                                        required>
                                        <option value="">Không có tài khoản</option>
                                       
                                </select>
                                <p ng-show="form.delivery_vendor_id.$error.required && ( vm.formSubmitted || form.delivery_vendor_id.$touched)" class="help-block">Vui lòng nhập tên người giao hàng</p>
                            </div>
                        </div>

                       <div class="form-group" ng-class="{ 'has-error': form.price.$invalid && ( vm.formSubmitted || form.price.$touched) }">
                            <label class="col-sm-2 control-label required">Số tiền</label>
                            <div class="col-sm-10">
                                <input type="number"  class="form-control" ng-model="vm.m.filter.price" name="price" placeholder="" required/>
                                 <p ng-show="form.price.$error.required && ( vm.formSubmitted || form.price.$touched)" class="help-block">Vui lòng tiền giao hàng</p>
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
                        <a ui-sref="app.crm1000" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_NEW" ng-if="vm.m.delivery_id == null">Add New</button>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_UPDATE" ng-if="vm.m.delivery_id != null">Update</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>
