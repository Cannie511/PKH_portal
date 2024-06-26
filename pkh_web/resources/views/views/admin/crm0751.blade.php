<section class="content-header">
    <h1>Thưởng thanh toán trước<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm0750">Thanh toán trước</a></li>
        <li class="active">Thêm thanh toán </li>
    </ol>
</section>
<section class="content">
    <div class="row">

        <div class="col-sm-12 col-md-7">
             <div class="box box-warning" ng-if="vm.can('screen.crm0751.accept')&&(vm.m.filter.payment_sts==1)">
                <div class="box-body">
                    <h3 class="box-title" >Yêu cầu duyệt chi thưởng</h3>
                    
                    <div class="form-group">
                        <label  class="col-sm-2 control-label required">Ghi chú duyệt</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" cols="30" rows="10" ng-model="vm.m.filter.confirm_notes" name="store note" placeholder="Ghi chú duyêt" required></textarea>
                        </div>
                    </div>   
                    <div class="form-group col-sm-12">
                        <button type="button" class="btn btn-warning pull-right"   ng-click="vm.accpet()" >
                            Duyệt
                        </button>
                        <button type="button" class="btn btn-primary pull-right"   ng-click="vm.deny()" >
                            Không Duyệt
                        </button>
                    </div>
                </div>
               
            </div>
        </div>
        <div class="col-sm-12 col-md-7">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin thanh toán trước</h3>
                    <div class="box-tools pull-right">
                        <span class="label label-success" ng-if="vm.m.filter.payment_sts == '0'" >Mới</span> 
                        <span class="label label-primary" ng-if="vm.m.filter.payment_sts == '1'" >Chờ duyệt</span> 
                        <span class="label label-primary" ng-if="vm.m.filter.payment_sts == '2'" >Đã duyệt</span> 
                        <span class="label label-danger" ng-if="vm.m.filter.payment_sts == '3'" >Từ chối</span>         
                        <span class="label label-info" ng-if="vm.m.filter.payment_sts == '4'" >Chi thưởng</span>   
                        <span class="label label-default" ng-if="vm.m.filter.payment_sts == '5'" >Huỷ</span>         

                    </div>
                </div>
                <form class="form-horizontal" name="form" ng-submit="vm.save()" >
                    <div class="box-body">
                        <div class="form-group" >
                            <label class="col-sm-2 control-label ">Mã đơn hàng</label>
                            <div class="col-sm-10">
                                <a ui-sref='app.crm0211({store_id: vm.m.filter.store_id, store_order_id: vm.m.filter.store_order_id})'>#{{vm.m.filter.store_order_code}}}</a>

                                <!-- <input type="text" ng-disabled="true" class="form-control" ng-model="vm.m.filter.store_order_code" name="store_order_code" placeholder="" /> -->
                            </div>
                        </div>

                        <div class="form-group" >
                            <label class="col-sm-2 control-label ">Trạng thái đơn</label>
                            <div class="col-sm-10">
                                <input type="text" ng-disabled="true" class="form-control" ng-model="vm.m.filter.order_sts" name="order_sts" placeholder="" />
                            </div>
                        </div>

                        <div class="form-group" >
                            <label class="col-sm-2 control-label ">Tên cửa hàng</label>
                            <div class="col-sm-10">
                                <input type="text" ng-disabled="true" class="form-control" ng-model="vm.m.filter.name" name="name" placeholder="" />
                            </div>
                        </div>

                        <div class="form-group" >
                            <label class="col-sm-2 control-label ">Địa chỉ</label>
                            <div class="col-sm-10">
                                <input type="text" ng-disabled="true" class="form-control" ng-model="vm.m.filter.address" name="address" placeholder="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nhân viên sale phụ trách</label>
                            <div class="col-sm-10">
                                <input type="text" ng-disabled="true" class="form-control" ng-model="vm.m.filter.salesman_name" name="sale_name" placeholder="" />
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': form.date.$invalid && ( vm.formSubmitted || form.name.$touched) }">
                               <label class="col-sm-2 control-label required">Ngày đặt hàng</label>
                               <div class="col-sm-10">
                                    <p class="input-group">
                                        <input  ng-disabled="true" type="text" class="form-control" name="date" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.filter.order_date" is-open="vm.dp2Opened" datepicker-options="vm.m.dateOptions" close-text="Close"
                                        ng-model-options="{timezone: 'utc'}" required/>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" ng-click="vm.dp2Opened = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </p>
                                     <!-- <p ng-show="form.date.$error.required && ( vm.formSubmitted || form.date.$touched)" class="help-block">Vui lòng nhập ngày thanh toán</p> -->
                                </div>
                                
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': form.date.$invalid && ( vm.formSubmitted || form.name.$touched) }" ng-if="vm.m.filter.delivery_date">
                               <label class="col-sm-2 control-label required">Ngày giao hàng</label>
                               <div class="col-sm-10">
                                    <p class="input-group">
                                        <input  ng-disabled="true" type="text" class="form-control" name="date" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.filter.delivery_date" is-open="vm.dp2Opened" datepicker-options="vm.m.dateOptions" close-text="Close"
                                        ng-model-options="{timezone: 'utc'}" required/>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" ng-click="vm.dp2Opened = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </p>
                                     <!-- <p ng-show="form.date.$error.required && ( vm.formSubmitted || form.date.$touched)" class="help-block">Vui lòng nhập ngày thanh toán</p> -->
                                </div>
                                
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Doanh số trước CK</label>
                            <div class="col-sm-10">
                                {{vm.m.filter.total | currency: '' : 0}} VND
                                <!-- <input type="text" ng-disabled="true" class="form-control" ng-model="vm.m.filter.total" name="total" placeholder="" /> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Chiết khấu (CK)</label>
                            <div class="col-sm-10">
                                {{vm.m.filter.discount_1 | currency: '' : 0}}%
                                <!-- <input type="text" ng-disabled="true" class="form-control" ng-model="vm.m.filter.discount_1" name="discount_1" placeholder="" /> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Doanh số sau CK</label>
                            <div class="col-sm-10">
                            {{vm.m.filter.total_with_discount | currency: '' : 0}} VND
                                <!-- <input type="text" ng-disabled="true" class="form-control" ng-model="vm.m.filter.total_with_discount" name="total_with_discount" placeholder="" /> -->
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': form.payment_money.$invalid && ( vm.formSubmitted || form.payment_money.$touched) }">
                            <label class="col-sm-2 control-label required">Thưởng thanh toán</label>
                            <div class="col-sm-10">
                                {{vm.m.filter.payment_money | currency: '' : 0}} VND ( 1% Dso trước CK - 1% thuế)
                                <!-- <input type="number"  class="form-control" ng-model="vm.m.filter.payment_money" name="payment_money" placeholder="" required currency/> -->
                                 <p ng-show="form.payment_money.$error.required && ( vm.formSubmitted || form.payment_money.$touched)" class="help-block">Vui lòng nhập tiền</p>
                            </div>
                           
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': form.payment_money.$invalid && ( vm.formSubmitted || form.payment_money.$touched) }">
                            <label class="col-sm-2 control-label required">Thanh toán còn lại</label>
                            <div class="col-sm-10">
                                {{vm.m.filter.total_with_discount- vm.m.filter.payment_money | currency: '' : 0}} VND
                                <!-- <input type="number"  class="form-control" ng-model="vm.m.filter.payment_money" name="payment_money" placeholder="" required currency/> -->
                                 <p ng-show="form.payment_money.$error.required && ( vm.formSubmitted || form.payment_money.$touched)" class="help-block">Vui lòng nhập tiền</p>
                            </div>
                           
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': form.date.$invalid && ( vm.formSubmitted || form.name.$touched) }">
                               <label class="col-sm-2 control-label required">Ngày thanh toán</label>
                               <div class="col-sm-10">
                                    <p class="input-group">
                                        <input type="text" class="form-control" name="date" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.filter.payment_date" is-open="vm.dp2Opened" datepicker-options="vm.m.dateOptions" close-text="Close"
                                        ng-model-options="{timezone: 'utc'}" required/>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" ng-click="vm.dp2Opened = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </p>
                                     <p ng-show="form.date.$error.required && ( vm.formSubmitted || form.date.$touched)" class="help-block">Vui lòng nhập ngày thanh toán</p>
                                </div>
                                
                        </div>
                        
                        <!-- <div class="form-group" ng-class="{ 'has-error': form.type.$invalid && ( vm.formSubmitted || form.type.$touched) }">
                            <label class="col-sm-2 control-label required">Hình thức thanh toán</label>
                            <div class="col-sm-10">
                                <select class="form-control" ng-model="vm.m.filter.payment_type"  name="type" ng-init="vm.m.filter.payment_type = '1'" >
                                        <option value="1">Chuyển khoản</option>
                                        <option value="0">Tiền mặt</option>
                                        <option value="3">Điều chỉnh tăng</option>
                                        <option value="4">Điều chỉnh giảm</option>
                                    </select>
                            </div>              
                        </div> -->
                        
                    
                        
                        <!-- <div ng-hide="vm.m.filter.payment_type!=1">
            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tài khoản thanh toán</label>
                                <div class="col-sm-10">
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn tài khoản ngân hàng'"
                                        ng-model="vm.m.filter.bank_account_id"
                                        ng-options="item.bank_account_id as item.bank_account_no for item in vm.m.init.listAccount "
                                        >
                                        <option value="">Không có tài khoản</option>
                                    </select>
                                </div>
                            </div>
                        </div> -->

                          <div class="form-group" >
                                <label class="col-sm-2 control-label ">Ghi chú</label>
                                <div class="col-sm-10">
                                    <input type="text"  class="form-control" ng-model="vm.m.filter.notes" name="notes" placeholder="" />
                                </div>
                            </div>
                                          
                    </div>
                    <div class="box-footer">
                        <a ui-sref="app.crm0750" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_NEW" ng-if="!vm.m.payment_id" >Thêm mới</button>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_UPDATE" ng-if="vm.m.payment_id&&vm.m.filter.payment_sts == 0">Cập nhật</button>
                        <button type="button" class="btn btn-warning pull-right"   ng-if="vm.m.payment_id&&vm.m.filter.payment_sts == 0" ng-click="vm.sendRequest()" >
                            <i class="fa fa-save fa-fw"></i>Đề nghị duyệt
                        </button> 
                        <button type="button" class="btn btn-warning pull-right"   ng-if="vm.can('screen.crm0751.confirm')&&(vm.m.payment_id)&&(vm.m.filter.payment_sts == 2)" ng-click="vm.accountantConfirm()" >
                            <i class="fa fa-save fa-fw"></i>Kế toán chi
                        </button> 
                        <!-- <button type="button" class="btn btn-danger m-l"  ng-if="vm.can('screen.crm1831.cancel')" ng-click="vm.clickRequestCancel()" title="Hủy phiếu khi nhập sai" ><i class="fa fa-remove fa-fw" ></i>Hủy phiếu</button> -->

                    </div> 
                </form>
            </div>
        </div>

        <div class="col-sm-12 col-md-5">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin chứng từ - xác nhận thanh toán của khách</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <form class="form form-horizontal" name="form" ng-submit="vm.upload()" novalidate>
                    <div class="box-body">         
                        <div class="form-group"> 
                            <div class="col-sm-12"> 
                                <input id="fileUpload" type="file" enctype="mutipart/form-data"/> 
                                <br>
                                <div id="imgPreviewUpload" class="text-center"> 
                                    <img  ng-if="vm.m.formUpload.file" ng-attr-src="{{vm.m.formUpload.file}}" class="img-preview"/>
                                </div> 
                            </div>
                        </div>        
                        <div class="form-group"> 
                            <div class="col-sm-12"> 
                                <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                                    <i class="fa fa-upload fa-fw"></i>
                                    <span>Upload</span>
                                </button>
                            </div> 
                        </div> 
                    </div>
                </form>
                <div class="box-body">
                    <div class="table-responsive" ng-if="vm.m.formUpload.images.length > 0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Hình ảnh</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.formUpload.images'>
                                    <td class="text-center">{{$index + 1}}</td>
                                    <td>
                                        <a target="__blank" ng-href="<?php echo env('URL_IMAGE_PORTAL','//www.phankhangco.com/images'); ?>crm0210{{item}}">
                                            <img width="200" height="200" class="image-preview-list-small" src="<?php echo env('URL_IMAGE_PORTAL','//www.phankhangco.com/images'); ?>crm0751{{item}}"/>
                                        </a>
                                    </td>
                                    <td>
                                        
                                        <button class="btn btn-xs btn-danger" ng-click="vm.removeImage(item)">
                                            <i class="fa fa-trash-o"></i>
                                        </button>&nbsp;
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div>
</section>
