<section class="content-header">
    <h1>Thêm chi phí<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm1830">chi phí</a></li>
        <li class="active">Thêm chi phí</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        
        <div class="col-sm-12 col-md-7">
            <div class="box box-warning" ng-if="vm.m.form.cost_sts=='1'&&vm.can('screen.crm1831.accept')">
                <div class="box-body">
                    <h3 class="box-title" >Yêu cầu duyệt chi phí </h3>
                    
                    <div class="form-group">
                        <label  class="col-sm-2 control-label required">Ghi chú duyệt</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" cols="30" rows="10" ng-model="vm.m.form.confirm_notes" name="store note" placeholder="Ghi chú duyêt" required></textarea>
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

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin chi phí</h3>
                    <div>
                        <span ng-if="vm.m.form.cost_sts == 0" class="label bg-purple btn-flat margin">Mới</span> 
                        <span ng-if="vm.m.form.cost_sts == 1" class="label label-warning">Chờ xác nhận</span> 
                        <span ng-if="vm.m.form.cost_sts == 2" class="label label-info">Xác nhận</span> 
                        <span ng-if="vm.m.form.cost_sts == 3" class="label label-primary">không xác nhận</span>
                        <span ng-if="vm.m.form.cost_sts == 4" class="label label-primary">Huỷ</span>
                        <span ng-if="vm.m.form.cost_sts == 5" class="label label-primary">Kế toán chi trả</span>
                    </div>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-xs btn-primary" title="Update status" ng-if ="vm.can('screen.crm1831.confirm')&&vm.m.form.cost_sts == '2'"  ng-click="vm.accountantConfirm()" ><i class="fa fa-opencart fa-fw"></i>&nbsp; Kế toán xác nhận</button>
                         <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <form class="form-horizontal" name="form" ng-submit="vm.save()" >
                    <div class="box-body">
                        <div class="form-group" >
                            <label class="col-sm-2 control-label required">Số chứng từ</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.form.voucher" name="voucher" placeholder="" />
                            </div>
                        </div>
                        
                        <div class="form-group" ng-class="{ 'has-error': form.date.$invalid && ( vm.formSubmitted || form.name.$touched) }">
                               <label class="col-sm-2 control-label required">Ngày nhập</label>
                               <div class="col-sm-10">
                                    <p class="input-group">
                                        <input name="date" class="form-control" datetimepicker ng-model="vm.m.form.cost_date" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
                                         <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </p>
                                </div>   
                        </div>
                        <div class="form-group" >
                            <label class="col-sm-2 control-label required">Diễn giải</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" ng-model="vm.m.form.description" name="description" placeholder="" />
                            </div>
                        </div>
                         <div class="form-group" >
                            <label class="col-sm-2 control-label required">Tài khoản đối ứng</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" ng-model="vm.m.form.contra_account" name="contra_account" placeholder="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label required">Loại chi phí</label>
                            <div class="col-sm-10">
                                <select class="form-control"     
                                    chosen                               
                                    placeholder-text-single="'Chọn loại chi phí'"
                                    ng-model="vm.m.form.cost_cat_id"
                                    ng-options="item.cost_cat_id as item.name for item in vm.m.init.costcats "
                                    >
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label required">Phòng ban</label>
                            <div class="col-sm-10">
                                <select class="form-control"     
                                    chosen                               
                                    placeholder-text-single="'Chọn phòng ban'"
                                    ng-model="vm.m.form.department_id"
                                    ng-options="item.department_id as item.name for item in vm.m.init.departments "
                                    >
                                    <option value=""></option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group" >
                            <label class="col-sm-2 control-label required">Số tiền</label>
                            <div class="col-sm-10">
                                <input type="number"  class="form-control" ng-model="vm.m.form.amount"  placeholder="" required currency/>
                            </div>
                        </div>     
                        <div class="form-group">
                            <label  class="col-sm-2 control-label required">Ghi chú cho đề nghị duyệt</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" cols="30" rows="10" ng-model="vm.m.form.request_notes" name="store note" placeholder="đề nghị duyệt ghi chú" required></textarea>
                            </div>
                        </div>           
                    </div>
                    <div class="box-footer">
                        <a ui-sref="app.crm1830" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_NEW" ng-if="!vm.m.cost_id" >Thêm mới</button>
                            <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_UPDATE" ng-if="vm.m.cost_id&&vm.m.form.cost_sts == 0">Cập nhật</button>
                            <button type="button" class="btn btn-warning pull-right"   ng-if="vm.m.cost_id&&vm.m.form.cost_sts == '0'" ng-click="vm.sendRequest()" >
                                <i class="fa fa-save fa-fw"></i>Đề nghị duyệt
                            </button> 
                            <button type="button" class="btn btn-danger m-l"  ng-if="vm.can('screen.crm1831.cancel')" ng-click="vm.clickRequestCancel()" title="Hủy phiếu khi nhập sai" ><i class="fa fa-remove fa-fw" ></i>Hủy phiếu</button>
                        </div>

                    </div> 
                </form>
            </div>
        </div>
        <div class="col-md-5">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin cửa hàng</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <div class="box-body">
                    <div class="row" >
                        <div class="col-md-12">
                            <label>Người đề nghị</label>
                            <p class="form-control-static">#{{vm.m.form.created_by}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Thời gian đề nghị</label>
                            <p class="form-control-static">#{{vm.m.form.created_at}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Thời gian xác nhận</label>
                            <p class="form-control-static">#{{vm.m.form.confirm_time}}</p>
                        </div>
                        <div class="col-md-12" ng-if="vm.m.store.dealer_id">
                            <label>Trạng thái</label>
                            <p class="form-control-static">{{vm.m.store.dealer_name}}</p>
                        </div>
                        <div class="col-md-12" >
                            <label>Confirm notes</label>
                            <p class="form-control-static">{{vm.m.form.confirm_notes}}</p>
                        </div>
                        <div class="col-md-12" ng-if="vm.m.form.cost_sts == 4">
                            <label>Thời gian huỷ</label>
                            <p class="form-control-static">#{{vm.m.form.cancel_time}}</p>
                        </div>
                        <div class="col-md-12" ng-if="vm.m.form.cost_sts == 4">
                            <label>Cancel notes</label>
                            <p class="form-control-static">{{vm.m.form.cancel_notes}} </p>
                        </div>
                        <div class="col-md-12">
                            <label>Người duyệt</label>
                            <p class="form-control-static">{{vm.m.form.confirm_by}}</p>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
