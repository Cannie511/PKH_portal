<section class="content-header">
    <h1>{{vm.m.title}} <small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm2300"><span translate="CRM2300_TITLE"></span></a></li>
        <li class="active">{{vm.m.title}}</li>
    </ol>
</section>
<section class="content crm0000">
    <div class="row">
        
        <div class="col-md-9">

            <div class="box box-warning"  ng-if="vm.m.requestList.length > 0">
                <div class="box-header with-bwarehouse">
                    <h3 class="box-title" >Yêu cầu xử lý huỷ</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width:80px"></th>
                                    <th style="width:30px">NO</th>
                                    <th style="width:120px">Ngày yêu cầu</th>
                                    <th style="width:140px">Yêu cầu</th>
                                    <th style="width:120px">Trạng thái</th>
                                    <th>Ghi chú</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.requestList'>
                                    <td>
                                        <div class="btn-group mr-2" role="group">
                                        <!-- ng-if="vm.can('screen.crm0410.approve') && item.request_sts == 0" -->
                                            <button  type="button" class="btn btn-primary btn-xs" ng-click="vm.accept(item)" title="Đồng ý"><i class="fa fa-check-square-o fa-fw"></i></button>
                                            <!-- ng-if="vm.can('screen.crm0410.deny') && item.request_sts == 0" -->
                                            <button   type="button" class="btn btn-danger btn-xs" ng-click="vm.deny(item)" title="Từ chối"><i class="fa fa-remove fa-fw"></i></button>
                                        </div>
                                    </td>
                                    <td>{{$index+1}}</td>
                                    <td>{{item.request_date | date:'yyyy-MM-dd'}} (#{{item.request_id}})</td>
                                    <td>
                                        <span class="label label-danger" ng-if="item.request_type == 2">Hủy phiếu xuất</span>
                                    </td>
                                    <td>
                                        <span class="label label-primary" ng-if="item.request_sts == 0">Chờ xác nhận</span>
                                        <span class="label label-success" ng-if="item.request_sts == 1">Đồng ý</span>
                                        <span class="label label-danger" ng-if="item.request_sts == 2">Từ chối</span>
                                    </td>
                                    <td>
                                        {{item.request_notes}}
                                        <hr/>
                                        {{item.response_notes}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="box box-info">
                <div class="box-header with-bwarehouse">
                    <h3 class="box-title" ng-if="vm.m.warehouse.store_delivery_code != null && vm.m.warehouse.store_delivery_code.length > 0">{{vm.m.warehouse.store_delivery_code}}<small ng-if="vm.m.store_delivery_id">#{{vm.m.store_delivery_id}}</small>
                        &nbsp;<small ng-if="vm.m.warehouse.delivery_date">{{vm.m.warehouse.delivery_date}}</small>
                    </h3>
                    <div class="box-tools pull-right">
                         <button type="button" class="btn btn-xs btn-primary"  ng-if=" vm.m.warehouse.exim_sts =='0'" ng-click="vm.createExport()" ><i class="fa fa-exchange fa-fw"></i>&nbsp;Xuất kho</button>
                         <button type="button" class="btn btn-xs btn-primary"  ng-if="vm.m.warehouse.exim_sts =='1'" ng-click="vm.createImport()" ><i class="fa fa-exchange fa-fw"></i>&nbsp;Nhập kho</button>

                    </div>
                </div>
               
                 <div class="box-header with-bwarehouse">
                    <div  class="col-md-12 col-sm-12">
                        <span class="col-md-2 col-sm-2">
                            Trạng thái:
                        </span>
                        <span  class="col-md-10 col-sm-10" ng-repeat="state in vm.m.eximStatusList" ng-if="vm.m.warehouse.exim_sts == state.status_id">
                            <span class="{{state.label}}">{{state.descript}}</span> 
                        </span>
                    </div>
                    <div  class="col-md-12 col-sm-12">
                        <span class="col-md-2 col-sm-2">
                            Tạo đơn:
                        </span>
                        <span class="col-md-10 col-sm-10">
                          <b class="label label-success">{{vm.m.warehouse.created_by}}</b> - {{vm.m.warehouse.created_at}}
                        </span>
                    </div>
                    <div  class="col-md-12 col-sm-12">
                        <span class="col-md-2 col-sm-2">
                            Chỉnh sửa cuối:
                        </span>
                        <span class="col-md-10 col-sm-10">
                          <b class="label label-success">{{vm.m.warehouse.updated_by}}</b> - {{vm.m.warehouse.updated_at}}
                        </span>
                    </div>
                
                </div>
             
                <div class="box-body">
                    <div class="table-responsive" ng-if="vm.m.warehouseDetail">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>NO</th>
                                    <th>Mã Sp</th>
                                    <th>Tên SP</th>
                                    <th>Đóng gói</th>
                                   
                                    <th>Số lượng xuất</th>
                                    <th ng-if="vm.m.store_delivery_id > 0 && vm.m.data.infor.delivery_sts == '6'">Số lượng xác nhận</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                    <th>Carton</th>
                                    <th>Vol</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.warehouseDetail'>
                                    <td><button class="btn btn-danger btn-sm" ng-click="vm.removeProduct(item)"><i class="fa fa-minus-circle"></i></button></td>
                                    <td>{{$index + 1}}</td>
                                    <td>{{item.product_code}}</td>
                                    <td>{{item.product_name}}</td>
                                    <td>{{item.standard_packing}}</td>
                                    <td>
                                        <input type="text" ng-model="item.amount" min="0"  ng-change="vm.calcWarehouseTotal()" ng-disabled="vm.m.warehouse.exim_sts > 0"/>
                                    </td>
                                    <td ng-if="vm.m.store_delivery_id > 0 && vm.m.warehouse.delivery_sts == '6'" >
                                        <input type="text" style="width:60px;" ng-init="item.amountConfirm=item.amountExport" ng-model="item.amountConfirm" min="0" max="{{item.amount}}" />
                                    </td>
                                    <td>{{item.unit_price | currency : '' : 0 }}</td>
                                    <td>{{item.amount * item.unit_price  | currency : '' : 0  }}</td>
                                    <td>{{item.amount  / item.standard_packing | number  : 1}}</td>
                                    <td>{{item.amount * item.volume / item.standard_packing | number  : 3 }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row" >
                      
                        <div class="col-md-4">
                            <label>Tổng tiền</label>
                            <p class="form-control-static">{{vm.m.warehouse.total | currency : '' : 0 }} (VND)</p>
                        </div>


                        <div class="col-md-4">
                            <label>Tổng thùng</label>
                            <p class="form-control-static">{{vm.m.warehouse.carton | number : 1 }} (thùng)</p>
                        </div>


                        <div class="col-md-4">
                            <label>Tổng thể tích</label>
                            <p class="form-control-static">{{vm.m.warehouse.volume | number : 2 }} (m3)</p>
                        </div>

                        <div class="col-md-6">
                            <label>Vui lòng chọn kho xuất</label>
                            <select class="form-control"     
                                    chosen                               
                                    placeholder-text-single="'Chọn kho xuất'"
                                    ng-model="vm.m.warehouse.from_warehouse_id"
                                    ng-options="item.warehouse_id as item.warehouse_name for item in vm.m.warehouseList"
                                    ng-disabled="vm.m.warehouse.exim_sts > 0"
                                    >
                                    <option value=""></option>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label>Vui lòng chọn kho nhập</label>
                            <select class="form-control"     
                                    chosen                               
                                    placeholder-text-single="'Chọn kho nhập'"
                                    ng-model="vm.m.warehouse.to_warehouse_id"
                                    ng-options="item.warehouse_id as item.warehouse_name for item in vm.m.warehouseList"
                                    ng-disabled="vm.m.warehouse.exim_sts > 0"        
                            >
                                    <option value=""></option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label>Ghi chú</label>
                            <textarea class="form-control" row="5" ng-model="vm.m.warehouse.notes"></textarea>
                        </div>
                        <div class="col-md-12" ng-if="vm.m.warehouse.notes_cancel">
                            <label>Lý do hủy</label>
                            <p class="form-control-static">{{vm.m.warehouse.notes_cancel}}</p>
                        </div>
                       
                    </div>
                </div>
                <div class="box-footer">
                    <a ui-sref="app.crm0400" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                    <div class="pull-right">
                    <!-- && vm.can('screen.crm0410.cancel') -->
                        <button type="button" class="btn btn-danger m-l" ng-if="vm.m.warehouse.exim_sts != '5' && vm.m.warehouse_exim_id > 0 " ng-click="vm.clickRequestCancel()" ><i class="fa fa-remove fa-fw"></i>Hủy</button>
                        <!-- <button type="button" class="btn btn-info m-l" ng-if="vm.m.warehouse.store_warehouse_id > 0 && vm.m.warehouseDetail.length > 0" ng-click="vm.clickCreateExport()" ><i class="fa fa-opencart fa-fw"></i>Tạo phiếu xuất</button> -->
                        <button type="button" class="btn btn-warning m-l" ng-if="vm.m.canEdit && (!vm.m.warehouse.exim_sts || vm.m.warehouse.exim_sts < 1)" ng-disabled="vm.m.warehouseDetail.length == 0" ng-click="vm.clickSave(false, 1)" ><i class="fa fa-save fa-fw"></i>Lưu</button>                         
                    </div>
                </div> 
            </div>

            <div class="box box-info collapsed-box">
                <div class="box-header with-bwarehouse">
                    <h3 class="box-title">Sản phẩm</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
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
                                    <td>Đơn giá</td>
                                    <td>Tồn kho</td>
                                    <td>Đang đặt</td>
                                    <td>Còn lại</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.productList' ng-if="item.hide != true">
                                    <td><button class="btn btn-primary btn-sm" ng-click="vm.addProduct(item)"><i class="fa fa-plus-circle"></i></button></td>
                                    <td>
                                        <img ng-if="item.noImage == 0" class="img-thumb-product" class="img-responsive" ng-src="<% env('URL_IMAGE', 'http://phankhangco.com/img/product/')%>{{item.product_code}}.png" />
                                        <img ng-if="item.noImage == 1" class="img-thumb-product" class="img-responsive" ng-src="<% env('URL_IMAGE', 'http://phankhangco.com/img/product/')%>WT0000.png" />
                                    </td>
                                    <td><b style="color:blue;">{{item.product_code}}</b><br/><i>({{item.stock_code}})</i></td>
                                    <td>{{item.name}}<br/><i>({{item.name_origin}})</i></td>
                                    <td>{{item.standard_packing}}</td>
                                    <td>{{item.selling_price | currency: '': 0}}</td>
                                    <td>Tồn kho</td>
                                    <td>Đang đặt</td>
                                    <td>Còn lại</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9" >
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin chứng từ - xuất nhập hàng</h3>
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
                                
                                <div id="imgPreviewUpload" class="text-center"> 
                                    <img ng-if="vm.m.formUpload.file" ng-attr-src="{{vm.m.formUpload.file}}" class="img-preview"/>
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
                                        <a target="__blank" ng-href="<?php echo env('URL_IMAGE_PORTAL','//www.phankhangco.com/images'); ?>crm2310{{item}}">
                                            <img width="200" height="200" class="image-preview-list-small" src="<?php echo env('URL_IMAGE_PORTAL','//www.phankhangco.com/images'); ?>crm2310{{item}}"/>
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
    <!-- </div> -->
        

    
</section>