<section class="content-header">
    <h1>Add customer sevice record<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm0500">Customer service list</a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-7">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Customer sevice record information</h3>
                    <div class="box-tools pull-right">
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <form class="form-horizontal" name="form" ng-submit="vm.clickSave()" >
                    <div class="box-body">
                       

                       
                       
                        
                        <div class="form-group" ng-class="{ 'has-error': form.type.$invalid && ( vm.formSubmitted || form.type.$touched) }">
                            <label class="col-sm-2 control-label required">Rating</label>
                            <div class="col-sm-10">
                                <select class="form-control" ng-model="vm.m.form.cus_rating"  name="type" ng-init="vm.m.form.cus_rating = '3'" > 
                                        <option value="1">Bất mãn</option>
                                        <option value="2">Không hài lòng</option>
                                        <option value="3">Bình thường</option>
                                        <option value="4">Hài lòng</option>
                                        <option value="5">Rất hài lòng</option>
                                    </select>
                            </div>              
                        </div>
                        
                     
                      

                        <div class="form-group" >
                            <label class="col-sm-2 control-label required">Customer feedback</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" cols="30" rows="10" ng-model="vm.m.form.cus_review" name="store note" placeholder="store note" required></textarea>
                            </div>
                           
                        </div>

                        <div class="form-group"  ng-class="{ 'has-error': form.date.$invalid && ( vm.formSubmitted || form.name.$touched) }">
                               <label class="col-sm-2 control-label required">Deadline</label>
                               <div class="col-sm-4">
                                    <p class="input-group">
                                        <input type="text" class="form-control" name="date" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.form.deadline" is-open="vm.dp2Opened" datepicker-options="vm.m.dateOptions" close-text="Close"
                                        ng-model-options="{timezone: 'utc'}" required/>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" ng-click="vm.dp2Opened = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </p>
                                     <p ng-show="form.date.$error.required && ( vm.formSubmitted || form.date.$touched)" class="help-block">Input deadline please</p>
                                </div>
                                
                        </div>
                        

                    
                                          
                    </div>
                    <div class="box-footer">
                        <a ui-sref="app.crm0500" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_NEW" ng-if="!vm.m.payment_id" >Thêm mới</button>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_UPDATE" ng-if="vm.m.payment_id">Cập nhật</button>
                    </div> 
                </form>
            </div>
        </div>

        <div class="col-sm-12 col-md-5">
            <div class="box box-info">
                 <div class="box-header with-border">
                    <h3 class="box-title">Store information</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-12" >
                            <label>Cửa hàng</label>
                            <p class="form-control-static">{{vm.m.store.name}}</p>
                    </div>
                    <div class="col-md-12">
                            <label>Khu vực</label>
                            <p class="form-control-static">{{vm.m.store.area1_name}} {{vm.m.store.area2_name}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Địa chỉ</label>
                            <p class="form-control-static">{{vm.m.store.address}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Cấp cửa hàng</label>
                            <p class="form-control-static">{{vm.m.store.level}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Chiết khấu chính sách</label>
                            <p class="form-control-static">{{vm.m.store.discount}} %</p>
                        </div>
                        <div class="col-md-12">
                            <label>Ghi chú</label>
                            <p class="form-control-static">{{vm.m.store.notes}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Địa chỉ chành</label>
                            <p class="form-control-static">{{vm.m.store.address_chanh}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Người liên hệ</label>
                            <p class="form-control-static">{{vm.m.store.contact_name}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Fax</label>
                            <p class="form-control-static">{{vm.m.store.contact_fax}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Điện thoại</label>
                            <p class="form-control-static">{{vm.m.store.contact_mobile1}} {{vm.m.store.contact_mobile2}} {{vm.m.store.contact_tel}}</p>
                        </div>
                         <div class="col-md-12">
                            <label>Phụ trách hiện tại (Salesman)</label>
                            <p class="form-control-static">{{vm.m.store.salesman_name}}</p>
                        </div>

                </div>
            </div>
        </div>
    </div>
</section>
