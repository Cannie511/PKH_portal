<section class="content-header">
    <h1>Thêm chương trình<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm1700">Chương trình</a></li>
        <li class="active">Thêm chương trình</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-7">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin chương trình</h3>
                    <div class="box-tools pull-right">
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <form class="form-horizontal" name="form" ng-submit="vm.save()" >
                    <div class="box-body">
                       

                        <div class="form-group" >
                            <label class="col-sm-2 control-label required">Tên chương trình</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" ng-model="vm.m.filter.promotion_name" name="name" placeholder="" />
                            </div>
                        </div>


                       
                        <div class="form-group" ng-class="{ 'has-error': form.date.$invalid && ( vm.formSubmitted || form.name.$touched) }">
                               <label class="col-sm-2 control-label required">Ngày bắt đầu</label>
                               <div class="col-sm-10">
                                    <p class="input-group">
                                        <input type="text" class="form-control" name="date1" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.filter.from_date" is-open="vm.dp2Opened1" datepicker-options="vm.m.dateOptions" close-text="Close"
                                        ng-model-options="{timezone: 'utc'}" required/>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" ng-click="vm.dp2Opened1 = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </p>
                                     <p ng-show="form.date.$error.required && ( vm.formSubmitted || form.date.$touched)" class="help-block">Vui lòng nhập ngày thanh toán</p>
                                </div>
                                
                        </div>

                           <div class="form-group" ng-class="{ 'has-error': form.date.$invalid && ( vm.formSubmitted || form.name.$touched) }">
                               <label class="col-sm-2 control-label required">Ngày kết thúc</label>
                               <div class="col-sm-10">
                                    <p class="input-group">
                                        <input type="text" class="form-control" name="date2" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.filter.to_date" is-open="vm.dp2Opened2" datepicker-options="vm.m.dateOptions" close-text="Close"
                                        ng-model-options="{timezone: 'utc'}" required/>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" ng-click="vm.dp2Opened2 = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </p>
                                     <p ng-show="form.date.$error.required && ( vm.formSubmitted || form.date.$touched)" class="help-block">Vui lòng nhập ngày thanh toán</p>
                                </div>
                                
                        </div>
                        
                        <div class="form-group" ng-class="{ 'has-error': form.type.$invalid && ( vm.formSubmitted || form.type.$touched) }">
                            <label class="col-sm-2 control-label required">Loại chương trình</label>
                            <div class="col-sm-10">
                                <select class="form-control" ng-model="vm.m.filter.promotion_type"  name="type" ng-init="vm.m.filter.promotion_type = '0'" >
                                           
                                    <option value='0'>Không có</option>
                                    <option value='1'>Loại 1</option>
                                    <option value='2'>Loại 2</option>
                                    </select>
                            </div>              
                        </div>

                         <div class="form-group" ng-class="{ 'has-error': form.type.$invalid && ( vm.formSubmitted || form.type.$touched) }">
                            <label class="col-sm-2 control-label required">Trạng thái</label>
                            <div class="col-sm-10">
                                <select class="form-control" ng-model="vm.m.filter.promotion_sts"  name="sts" >
                                    
                                    <option value="0">open</option>
                                    <option value="1">close</option>
                                </select>
                            </div>              
                        </div>
                        
                    

                        <div class="form-group" >
                            <label class="col-sm-2 control-label ">Ghi chú</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" ng-model="vm.m.filter.description" name="notes" placeholder="" />
                            </div>
                        </div>

                         <div class="form-group" >
                            <label class="col-sm-2 control-label ">Meta data</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="10" ng-model="vm.m.filter.meta_data"></textarea>
                              
                            </div>
                        </div>
                                          
                    </div>
                    <div class="box-footer">
                        <a ui-sref="app.crm0700" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_NEW" ng-if="!vm.m.promotion_id" >Thêm mới</button>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_UPDATE" ng-if="vm.m.promotion_id">Cập nhật</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>
