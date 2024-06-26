<section class="content-header">
    <h1>Thêm chi nhánh<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm2000">Chi nhánh</a></li>
        <li class="active">Thêm chi nhánh</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-7">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin chi nhánh</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <form class="form-horizontal" name="form" ng-submit="vm.save()" >
                    <div class="box-body">
                       
                        <div class="form-group" >
                            <label class="col-sm-2 control-label ">Tên chi nhánh</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" ng-model="vm.m.filter.branch_name" name="name" placeholder="Tên cửa hàng" required/>
                            </div>
                        </div>

                        <div class="form-group" >
                            <label class="col-sm-2 control-label ">Địa chỉ</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" ng-model="vm.m.filter.branch_address" name="address" placeholder="" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Liên hệ</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.filter.branch_contact" name="contact" placeholder="" required/>
                                <p ng-show="form.contact.$error.required && ( vm.formSubmitted || form.contact.$touched)" class="help-block">Vui lòng nhập liên hệ</p>
                            </div>
                        </div>
                        <div class="form-group" ng-class="{ 'has-error': form.date.$invalid && ( vm.formSubmitted || form.name.$touched) }">
                               <label class="col-sm-2 control-label required">Ngày bắt đầu</label>
                               <div class="col-sm-10">
                                    <p class="input-group">
                                        <input type="text" class="form-control" name="date" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.filter.started_date" is-open="vm.dp2Opened" datepicker-options="vm.m.dateOptions" close-text="Close"
                                        ng-model-options="{timezone: 'utc'}" required/>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" ng-click="vm.dp2Opened = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </p>
                                     <p ng-show="form.date.$error.required && ( vm.formSubmitted || form.date.$touched)" class="help-block">Vui lòng nhập ngày bắt đầu</p>
                                </div>
                        </div>
                               
                    </div>
                    <div class="box-footer">
                        <a ui-sref="app.crm2000" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_NEW" ng-if="!vm.m.branch_id" >Thêm mới</button>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_UPDATE" ng-if="vm.m.branch_id">Cập nhật</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>
