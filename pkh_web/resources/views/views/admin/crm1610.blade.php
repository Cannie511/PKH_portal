<section class="content-header">
    <h1>Chi tiết PI <small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm1600">Danh sách packing list invoice</a></li>
        <li class="active">Chi tiết PI</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        
        <div class="col-md-12" >
            <div class="box box-info">
                 
                <div class="box-header with-border">
                    <h3 class="box-title">PI</h3>                   
                     <div class="box-tools pull-right">
                        <div uib-dropdown class="btn-group">
                            <a ng-click="vm.downloadForWarehouse()"  class="btn btn-success btn-xs"><i class="fa fa-download"></i>Tải excel cho kho</a>                      
                        </div>
                    </div>
                </div>
                
                <div class="box-body">
                    <div class="col-sm-12"  >
                        <div class="box-header with-border">
                            <h4 class=" panel-heading">Trạng thái 
                                <span ng-if="vm.m.form.delivery_sts == 0" class="label bg-purple btn-flat margin">Mới</span> 
                                <span ng-if="vm.m.form.delivery_sts == 1" class="label label-warning">Thanh toán lần 1</span> 
                                <span ng-if="vm.m.form.delivery_sts == 2" class="label label-info">Nhà máy sản xuất xong</span> 
                                <span ng-if="vm.m.form.delivery_sts == 3" class="label label-primary">Bắt đầu vận chuyển từ Malaysia</span>
                                <span ng-if="vm.m.form.delivery_sts == 4" class="label label-danger">Hàng đến cảng</span>
                                <span ng-if="vm.m.form.delivery_sts == 5" class="label label-default">Nhập kho</span>
                                <span ng-if="vm.m.form.delivery_sts == 6" class="label label-success">Thanh toán lần 2</span>
                            </h4>
                            <div class="box-tools pull-right">
                                <button type="button" ng-disabled="vm.m.form.supplier_delivery_id==0" class="btn btn-xs btn-info"  ng-click="vm.choose(0)"><i class="fa fa-plus"></i></button>                                    
                            </div>
                        </div>
                        <div class="panel-group" ng-hide="vm.m.check_status[0]==1">
                            <div class="panel ">
                                <div class=" panel-heading bg-primary text-white">
                                    <button type="button" class="btn btn-xs btn-warning" ng-hide="vm.m.form.delivery_sts + 1 != 1"  ng-click="vm.confirm(1)"><i class="fa fa-check"></i>Confirm</button>                                    
                                    Thanh toán 1 - {{vm.m.form.payment_1_date}}
                                    <div class="box-tools pull-right">
                                         
                                        <button type="button" class="btn btn-xs btn-info"  ng-click="vm.choose(1)"><i class="fa fa-plus"></i></button>                                    
                                    </div>
                                </div>
                                <div class="panel-body" ng-hide="vm.m.check_status[1]==1">
                                   
                                    <div class="form-group">
                                        <div class="col-md-12 form-group">
                                            <label class="col-sm-2 control-label">Tiền thanh toán</label>
                                            <div class="col-sm-3">
                                                <input type="string" class="form-control" ng-model="vm.m.form.payment" name="payment_1" placeholder="" required/>
                                                
                                            </div>
                                            <label class="col-sm-2 control-label">Contract no</label>
                                            <div class="col-sm-3">
                                                <input type="string" class="form-control" ng-model="vm.m.form.contract_no" name="contract_no" placeholder="" maxlen="32" required/>
                                                <p style="color:red;"  ng-show="vm.m.test[0] == 1">Vui lòng nhập mã hợp đồng</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label class="col-sm-2 control-label">Phần trăm thanh toán lần 1 (%)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" ng-model="vm.m.form.payment_1_percent" name="payment_1_percent" placeholder="" required/>
                                                <p style="color:red;"  ng-show="vm.m.test[1] == 1">Vui lòng nhập thành phần trăm thanh toán lần 1</p>
                                            </div>
                                            <label class="col-sm-2 control-label">Thời hạn thanh toán lần 2 (ngày)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" ng-model="vm.m.form.payment_2_duration" name="payment_2_duration" placeholder="" required/>
                                                <p style="color:red;"  ng-show="vm.m.test[2] == 1">Vui lòng nhập thời hạn thanh toán đợt 2</p>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label>Tiền bằng chữ</label>
                                            <textarea class="form-control" row="5" ng-model="vm.m.form.payment_desc"></textarea>
                                            <p style="color:red;"  ng-show="vm.m.test[3] == 1">Vui lòng nhập diễn giải tiếng anh của số tiền thanh toán</p>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="box-footer pull-right">
                                                <div uib-dropdown class="btn-group">
                                                    <a ng-click="vm.downloadForAdmin()"  class="btn btn-success btn-xs"><i class="fa fa-download"></i>Tải excel cho admin</a>                      
                                                </div>
                                                
                                                <button type="button" class="btn btn-info m-l"  ng-click="vm.clickPrintCheck()"><i class="fa fa-print fa-fw"></i>Xuất Sale Contract</button>                                      
                                            </div>
                                        </div>
                                    </div>

                                
                                </div>
                            </div>

                            <div class="panel ">
                                <div class="panel-heading  bg-success text-white">
                                    <button type="button" class="btn btn-xs btn-warning" ng-hide="vm.m.form.delivery_sts + 1 != 2"  ng-click="vm.confirm(2)"><i class="fa fa-check"></i>Confirm</button>   
                                    Sản xuất xong  -  {{vm.m.form.finish_cont_date}}
                                      
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-xs btn-info"  ng-click="vm.choose(2)"><i class="fa fa-plus"></i></button>                                    
                                    </div>
                                </div>
                                <div class="panel-body" ng-hide="vm.m.check_status[2]==1">
                                    <div class="col-md-12 form-group">
                                        <div class="col-sm-6 m-b-xs">
                                            <label class="col-sm-4 control-label">Ngày sản xuất xong (dự kiến)</label>
                                            <p class="input-group">
                                                <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.form.finish_cont_expected_date" is-open="vm.dp1Opened.finish_cont_date" datepicker-options="vm.m.dateOptions" close-text="Close"
                                                ng-model-options="{timezone: 'utc'}" />
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default" ng-click="vm.dp1Opened.finish_cont_date = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-12">
                                        
                                        <div class="box-footer pull-right">
                                            <button type="button" class="btn btn-info m-l" ng-click="vm.clickSaveDate(2)" ><i class="fa fa-check-square-o fa-fw"></i>Lưu ngày dự kiến</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel ">
                                <div class="panel-heading bg-info text-white">
                                    <button type="button" class="btn btn-xs btn-warning"  ng-hide="vm.m.form.delivery_sts + 1 != 3" ng-click="vm.confirm(3)"><i class="fa fa-check"></i>Confirm</button>   
                                    Bắt đầu Vận chuyển  - {{vm.m.form.deliver_cont_date}}
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-xs btn-info"  ng-click="vm.choose(3)"><i class="fa fa-plus"></i></button>                                    
                                    </div>
                                </div>
                                <div class="panel-body" ng-hide="vm.m.check_status[3]==1">
                                    <div class="col-md-12 form-group">
                                        <div class="col-sm-6 m-b-xs">
                                            <label class="col-sm-4 control-label">Bắt đầu vận chuyển (dự kiến)</label>
                                            <p class="input-group">
                                                <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.form.deliver_cont_expected_date" is-open="vm.dp1Opened.deliver_cont_date" datepicker-options="vm.m.dateOptions" close-text="Close"
                                                ng-model-options="{timezone: 'utc'}" />
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default" ng-click="vm.dp1Opened.deliver_cont_date = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="box-footer pull-right">
                                            <button type="button" class="btn btn-info m-l" ng-click="vm.clickSaveDate(3)" ><i class="fa fa-check-square-o fa-fw"></i>Lưu ngày dự kiến</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel ">
                                <div class="panel-heading bg-warning text-white">
                                    <button type="button" class="btn btn-xs btn-warning" ng-hide="vm.m.form.delivery_sts + 1 != 4" ng-click="vm.confirm(4)"><i class="fa fa-check"></i>Confirm</button>   
                                    Hàng đến cảng  -  {{vm.m.form.arrive_port_date}}
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-xs btn-info"  ng-click="vm.choose(4)"><i class="fa fa-plus"></i></button>                                    
                                    </div>
                                </div>
                                <div class="panel-body" ng-hide="vm.m.check_status[4]==1">
                                    <div class="col-md-12 form-group">
                                        <div class="col-sm-6 m-b-xs">
                                            <label class="col-sm-4 control-label">Hàng đến cảng (Dự kiến)</label>
                                            <p class="input-group">
                                                <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.form.arrive_port_expected_date" is-open="vm.dp1Opened.arrive_port_date" datepicker-options="vm.m.dateOptions" close-text="Close"
                                                ng-model-options="{timezone: 'utc'}" />
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default" ng-click="vm.dp1Opened.arrive_port_date = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                        <div class="box-footer pull-right">
                                             <button type="button" class="btn btn-info m-l" ng-click="vm.clickSaveDate(4)" ><i class="fa fa-check-square-o fa-fw"></i>Lưu ngày dự kiến</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel">
                                <div class="panel-heading bg-danger text-white">
                                    <button type="button" class="btn btn-xs btn-warning" ng-hide="vm.m.form.delivery_sts + 1 != 5" ng-click="vm.confirm(5)"><i class="fa fa-check"></i>Confirm</button>   
                                    Nhập kho  -  {{vm.m.form.comming_pkh_date}}
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-xs btn-info"  ng-click="vm.choose(5)"><i class="fa fa-plus"></i></button>                                    
                                    </div>
                                </div>
                                <div class="panel-body" ng-hide="vm.m.check_status[5]==1">
                                    <div class="col-md-12 form-group">
                                        <div class="col-sm-6 m-b-xs">
                                            <label class="col-sm-4 control-label">Nhập kho (Dự kiến)</label>
                                            <p class="input-group">
                                                <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.form.comming_pkh_expected_date" is-open="vm.dp1Opened.comming_pkh_date" datepicker-options="vm.m.dateOptions" close-text="Close"
                                                ng-model-options="{timezone: 'utc'}" />
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default" ng-click="vm.dp1Opened.comming_pkh_date = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                                </span>
                                            </p>
                                        </div>

                                        <div class="col-sm-6 m-b-xs">
                                            <label>Vui lòng chọn kho để nhập</label>
                                            <select class="form-control"     
                                                    chosen                               
                                                    placeholder-text-single="'Chọn kho'"
                                                    ng-model="vm.m.form.warehouse_id"
                                                    ng-options="item.warehouse_id as item.warehouse_name for item in vm.m.warehouseList"
                                                    >
                                                    <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="box-footer pull-right">
                                             <button type="button" class="btn btn-info m-l" ng-click="vm.clickSaveDate(5)" ><i class="fa fa-check-square-o fa-fw"></i>Lưu ngày dự kiến</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel  panel-default"> 
                                 <div class="panel-heading bg-inverse text-white">
                                    <button type="button" class="btn btn-xs btn-warning" ng-hide="vm.m.form.delivery_sts + 1 != 6" ng-click="vm.confirm(6)"><i class="fa fa-check"></i>Confirm</button>   
                                    Thanh toán lần 2  - {{vm.m.form.payment_2_date}}
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-xs btn-info"  ng-click="vm.choose(6)"><i class="fa fa-plus"></i></button>                                    
                                    </div>
                                </div>
                                <div class="panel-body " ng-hide="vm.m.check_status[6]==1">
                                     <div class="form-group">
                                        <!--label class="col-sm-2 control-label">Tiền thanh toán</label>
                                        <div class="col-sm-3">
                                            <input type="string" class="form-control" ng-model="vm.m.form.payment_2" name="payment_2" placeholder="" required/>
                                        </div-->
                                        <div class="col-md-12 form-group">
                                            <div class="col-sm-6 m-b-xs">
                                                <label class="col-sm-4 control-label">Thanh toán 2 (Dự kiến)</label>
                                                <p class="input-group">
                                                    <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.form.payment_2_expected_date" is-open="vm.dp1Opened.payment_2_date" datepicker-options="vm.m.dateOptions" close-text="Close"
                                                    ng-model-options="{timezone: 'utc'}" />
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default" ng-click="vm.dp1Opened.payment_2_date = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="box-footer pull-right">
                                                  <button type="button" class="btn btn-info m-l" ng-click="vm.clickSaveDate(6)" ><i class="fa fa-check-square-o fa-fw"></i>Lưu ngày dự kiến</button>                                     
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel  panel-default"  ng-disabled="!vm.m.form.supplier_delivery_id"> 
                                 <div class="panel-heading bg-inverse text-white">
                                    ---------
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-xs btn-info"  ng-click="vm.choose(7)"><i class="fa fa-plus"></i></button>                                    
                                    </div>
                                </div>
                                <div class="panel-body " ng-hide="vm.m.check_status[7]==1">
                                     <div class="form-group">
                                    
                                        <div class="col-md-12 form-group">
                                            <div class="col-sm-6 m-b-xs">
                                                <label class="col-sm-4 control-label">Thanh toán 1</label>
                                                <p class="input-group">
                                                    <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.form.payment_1_date" is-open="vm.dp1Opened.payment_1_datea" datepicker-options="vm.m.dateOptions" close-text="Close"
                                                    ng-model-options="{timezone: 'utc'}" />
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default" ng-click="vm.dp1Opened.payment_1_datea = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <div class="col-sm-6 m-b-xs">
                                                <label class="col-sm-4 control-label">Sản xuất xong</label>
                                                <p class="input-group">
                                                    <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.form.finish_cont_date" is-open="vm.dp1Opened.finish_cont_datea" datepicker-options="vm.m.dateOptions" close-text="Close"
                                                    ng-model-options="{timezone: 'utc'}" />
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default" ng-click="vm.dp1Opened.finish_cont_datea = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                         <div class="col-md-12 form-group">
                                            <div class="col-sm-6 m-b-xs">
                                                <label class="col-sm-4 control-label">Vận chuyển</label>
                                                <p class="input-group">
                                                    <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.form.deliver_cont_date" is-open="vm.dp1Opened.deliver_cont_datea" datepicker-options="vm.m.dateOptions" close-text="Close"
                                                    ng-model-options="{timezone: 'utc'}" />
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default" ng-click="vm.dp1Opened.deliver_cont_datea = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                         <div class="col-md-12 form-group">
                                            <div class="col-sm-6 m-b-xs">
                                                <label class="col-sm-4 control-label">Đến cảng</label>
                                                <p class="input-group">
                                                    <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.form.arrive_port_date" is-open="vm.dp1Opened.arrive_port_datea" datepicker-options="vm.m.dateOptions" close-text="Close"
                                                    ng-model-options="{timezone: 'utc'}" />
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default" ng-click="vm.dp1Opened.arrive_port_datea = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>

                                         <div class="col-md-12 form-group">
                                            <div class="col-sm-6 m-b-xs">
                                                <label class="col-sm-4 control-label">Nhập kho</label>
                                                <p class="input-group">
                                                    <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.form.comming_pkh_date" is-open="vm.dp1Opened.comming_pkh_datea" datepicker-options="vm.m.dateOptions" close-text="Close"
                                                    ng-model-options="{timezone: 'utc'}" />
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default" ng-click="vm.dp1Opened.comming_pkh_datea = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                         <div class="col-md-12 form-group">
                                            <div class="col-sm-6 m-b-xs">
                                                <label class="col-sm-4 control-label">Thanh toán 2</label>
                                                <p class="input-group">
                                                    <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.form.payment_2_date" is-open="vm.dp1Opened.payment_2_datea" datepicker-options="vm.m.dateOptions" close-text="Close"
                                                    ng-model-options="{timezone: 'utc'}" />
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default" ng-click="vm.dp1Opened.payment_2_datea = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="box-footer pull-right">
                                                  <button type="button" class="btn btn-info m-l" ng-click="vm.saveActualDate()" ><i class="fa fa-check-square-o fa-fw"></i>Save date</button>                                     
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row box-header with-border">
                        <div class="form-group"  ng-class="{ 'has-error': form.name.$invalid && ( vm.formSubmitted || form.name.$touched) }">
                                <label class="col-sm-2 control-label required">Nhà cung ứng</label>
                                <div class="col-sm-8">
                                    <select class="form-control"     
                                            chosen                               
                                            placeholder-text-single="'Chọn Tên nhà cung ứng'"
                                            ng-model="vm.m.form.supplier_id"
                                            ng-options="item.supplier_id as item.name for item in vm.m.init.listSupplier "
                                            ng-disabled="1==1"
                                            required
                                            >                             
                                    </select>
                                    <p ng-show="form.name.$error.required && ( vm.formSubmitted || form.name.$touched)" class="help-block">Vui lòng nhập tên người giao hàng</p>
                                </div>
                        </div>
                </div>

                <div class="box-body">
                    <div class="table-responsive" ng-if="vm.m.deliveryDetail">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>NO</th>
                                    <th class="text-left">Mã PKH</th>
                                    <th class="text-left">Mã nhà máy</th>
                                    <th class="text-left">Mô tả (eng)</th>
                                    <th class="text-right">Đóng gói</th>
                                    <th class="text-right">Đơn giá (USD)</th>
                                    <th>Đơn vị thể tích </th>
                                    <th class="text-right">Số lượng PO</th>
                                    <th class="text-right">Số lượng PI</th>
                                    <th class="text-right">Duty tax (%)[0;100]</th>
                                    <th class="text-right">Số thùng</th>
                                    <th class="text-right">Thể tích</th>
                                    <th class="text-right">Thành tiền (USD)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.deliveryDetail'>
                                    <td><button ng-disabled="vm.m.canEdit==false || vm.m.form.delivery_sts>0" class="btn btn-danger btn-sm" ng-click="vm.removeProduct(item)"><i class="fa fa-minus-circle"></i></button></td>
                                    <td>{{$index + 1}}</td>
                                    <td class="text-left">{{item.product_code}}</td>
                                    <td class="text-left">{{item.stock_code}}</td>
                                    <td class="text-left"  >{{item.product_name}}</td>
                                    <td class="text-right">{{item.standard_packing}}</td>
                                    <td>
                                        <input type="string" ng-disabled="vm.m.form.delivery_sts>0" style="width:80px;" class="form-control" ng-model="item.unit_price" min="0" ng-change="vm.calcOrderTotal()" step="0.01" />
                                    </td>
                                    <td>{{item.packaging}}</td>
                                    <td class="text-right">{{item.amountOrder}}</td>
                                    <td>
                                        <input type="text" ng-disabled="vm.m.form.delivery_sts>0" style="width:80px;" class="form-control" ng-model="item.amount" min="0" ng-change="vm.calcDeliveryTotal()" />
                                    </td>
                                    <td>
                                        <input type="text" ng-disabled="vm.m.form.delivery_sts>0" style="width:60px;" class="form-control" ng-model="item.duty_tax"  />
                                    </td>
                                    <td class="text-right">{{item.amount/item.standard_packing | number : 2}} </td>
                                    <td class="text-right"> {{item.amount/item.standard_packing*item.length/1000*item.width/1000*item.height/1000 | number : 2}}</th>
                                    <td class="text-right">{{item.amount * item.unit_price  | currency : '' : 2 }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <form class="form-horizontal">
                        <div class="form-group">
                                <label class="col-sm-1 control-label">Tỉ giá USD</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" ng-model="vm.m.form.rate" name="rate" placeholder="" required/>
                                    <p style="color:red;"  ng-show="vm.m.testForm[0] == 1">Vui lòng nhập tỉ giá USD</p>
                                </div>
                                <label class="col-sm-1 control-label">VAT tax (%) [0;100]</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" ng-model="vm.m.form.vat_tax" name="vat_tax" placeholder=""  required/>
                                    <p style="color:red;"  ng-show="vm.m.testForm[2] == 1">Vui lòng nhập VAT Tax</p>
                                </div>
                        </div>
                        <div class="form-group">
                                <label class="col-sm-1 control-label">Frieght cost (VND)</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" ng-model="vm.m.form.frieght_cost" name="frieght_cost" placeholder="" required/>
                                    <p style="color:red;"  ng-show="vm.m.testForm[3] == 1">Vui lòng nhập frieght cost (VND)</p>
                                </div>
                                <label class="col-sm-1 control-label">Landed cost (VND)</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" ng-model="vm.m.form.landed_cost" name="landed_cost" placeholder="" required/>
                                    <p style="color:red;"  ng-show="vm.m.testForm[4] == 1">Vui lòng nhập landed cost (VND)</p>
                                </div>               
                                  <label class="col-sm-1 control-label">Insurance cost (VND)</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" ng-model="vm.m.form.insurance_cost" name="insurance_cost" placeholder=""  required/>
                                    <p style="color:red;"  ng-show="vm.m.testForm[5] == 1">Vui lòng nhập insurance cost (VND)</p>
                                </div>                           
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Pi no</label>                          
                            <div class="col-sm-3">
                                  <input type="text" class="form-control"  ng-model="vm.m.form.pi_no"/>
                                    <p style="color:red;"  ng-show="vm.m.testForm[6] == 1">Vui lòng nhập pi no</p>
                            </div>                                
                        </div>
                    </form>
              
                    <div class="row" ng-if="vm.m.delivery">
                        <div class="col-md-4">
                            <label>Ngày đặt</label>
                            <p class="form-control-static">{{vm.m.form.order_date}}</p>
                        </div>
                        <div class="col-md-4">
                            <label>Ngày giao</label>
                            <p class="form-control-static">{{vm.m.form.delivery_date}}</p>
                        </div>
                        <div class="col-md-4">
                            <label>_</label>
                            <p class="form-control-static">_</p>
                        </div>
                        <div class="col-md-4">
                            <label>Tổng tiền hàng USD (chưa tính duty tax)</label>
                            <p class="form-control-static">{{vm.m.delivery.total | currency : '' : 2 }}</p>
                        </div>
                        <div class="col-md-4">
                            <label>Tổng tiền VND (chưa tính duty tax)</label>
                            <p class="form-control-static">{{vm.m.delivery.total*vm.m.form.rate | currency : '' : 2 }}</p>
                        </div>
                        <div class="col-md-4">
                            <label>Tổng thể tích (mét khối)</label>
                            <p class="form-control-static">{{ vm.m.delivery.totalVolume | number : 2 }}</p>
                        </div>
                         <div class="col-md-4">
                            <label>Thuế GTGT (VND)</label>
                            <p class="form-control-static">{{ vm.m.delivery.totalVAT | number : 2 }}</p>
                        </div>
                         <div class="col-md-4">
                            <label>chi phí nhập (VND)</label>
                            <p class="form-control-static">{{ vm.m.delivery.importCost | number : 2 }}</p>
                        </div>
                          <div class="col-md-4">
                            <label>Vốn (VND)</label>
                            <p class="form-control-static">{{ vm.m.delivery.von | number : 2 }}</p>
                        </div>
                      
                        <div class="col-md-12">
                            <label>Ghi chú</label>
                            <textarea class="form-control" row="5" ng-model="vm.m.form.notes"></textarea>
                        </div>

                        <div class="col-md-12" ng-if="vm.m.delivery.notes_cancel">
                            <label>Lý do hủy</label>
                            <p class="form-control-static">{{vm.m.delivery.notes_cancel}}</p>
                        </div>
                        </div>
                    </div>
                <div class="box-footer">
                    <a ui-sref="app.crm1600" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                    <div class="pull-right">
                        <button type="button" class="btn btn-info m-l" ng-if="vm.m.delivery.store_order_id > 0" ng-click="vm.clickFinish()" ><i class="fa fa-check-square-o fa-fw"></i>Hoàn tất</button>
                        <button type="button" class="btn btn-danger m-l" ng-if="vm.m.delivery.store_order_id > 0" ng-click="vm.clickCancel()" ><i class="fa fa-remove fa-fw" ng-if="vm.m.order.order_sts != '5'"></i>Hủy</button>
                        <button type="button" class="btn btn-info m-l" ng-if="vm.m.delivery.store_order_id > 0 && vm.m.orderDetail.length > 0 && vm.m.order.order_sts > '0'" ng-click="vm.clickCreateExport()" ><i class="fa fa-opencart fa-fw"></i>Tạo phiếu xuất</button>
                        <button type="button" class="btn btn-warning m-l" ng-if="vm.m.canEdit" ng-click="vm.clickSave()" ><i class="fa fa-save fa-fw"></i>Lưu</button> 
                    </div>
                </div> 
            </div>


            <div class="box box-info collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Sản phẩm</h3>
                    <div class="box-tools pull-right">
                        <button type="button" ng-disabled="vm.m.form.delivery_sts>0" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <div class="box-body form" style="display: none">
                    <form role="form" ng-submit="vm.searchProduct()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Mã SP</label>
                                    <input type="text" ng-model="vm.m.filter.product_code" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Tên sản phẩm</label>
                                    <input type="text" ng-model="vm.m.filter.product_name" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Mã Nhà Máy</label>
                                    <input type="text" ng-model="vm.m.filter.supplier_code" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                                    <i class="fa fa-search fa-fw"></i>
                                    <span translate="COM_BTN_SEARCH"></span>
                                </button>
                                <button type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.resetFilter()">
                                    <i class="fa fa-eraser fa-fw"></i>
                                    <span translate="COM_BTN_RESET"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="box-body" ng-if="vm.m.canEdit"  style="display: none">
                    <div class="table-responsive" ng-if="vm.m.productList">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>Hình ảnh</td>
                                    <td>Mã SP</td>
                                    <td>Tên SP</td>
                                    <td>Đóng thùng (cái)</td>
                                    <td>Đơn giá (USD$)</td>
                                    <td>Ngày nhập gần nhất</td>
                                                                     
                                    <td>Thể tích</td>
                                    <td>Còn lại</td>
                                    <td>Tồn kho</td> 
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.productList' ng-if="item.hide != true">
                                    <td><button class="btn btn-primary btn-sm" ng-click="vm.addProduct(item)"><i class="fa fa-plus-circle"></i></button></td>
                                    <td>
                                        <img ng-if="item.noImage == 0" class="img-thumb-product" class="img-responsive" ng-src="<% env('URL_IMAGE', 'http://phankhangco.com/img/product/')%>{{item.product_code}}.png" />
                                        <img ng-if="item.noImage == 1" class="img-thumb-product" class="img-responsive" ng-src="<% env('URL_IMAGE', 'http://phankhangco.com/img/product/')%>WT0000.png" />
                                    </td>
                                    <td>{{item.product_code}}<br/><i>({{item.stock_code}})</i></td>
                                    <td>{{item.name}}<br/><i>({{item.name_origin}})</i></td>
                                    <td>{{item.standard_packing}}</td>
                                    <td>{{item.selling_price | currency: '': 2}}</td>
                                    <td>{{item.import_date| date:'yyyy-MM-dd'}}</td>
                                    <td>{{item.packaging}}</td>
                                    
                                    <td>Còn lại</td>
                                    <td>Tồn kho</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        </div>

    </div>
</section>
