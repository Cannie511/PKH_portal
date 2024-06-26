<section class="content-header">
    <h1>Tạo phiếu xuất hàng <small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm0400"><span translate="CRM0400_TITLE"></span></a></li>
        <li class="active">Tạo phiếu xuất</li>
    </ol>
</section>
<section class="content crm0000 crm0410">
    <div class="row">

        <div class="col-md-9">

            <div class="box box-warning"  ng-if="vm.m.requestList.length > 0">
                <div class="box-header with-border">
                    <h3 class="box-title" >Yêu cầu xử lý đơn hàng</h3>
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
                                            <button ng-if="vm.can('screen.crm0410.approve') && item.request_sts == 0" type="button" class="btn btn-primary btn-xs" ng-click="vm.accept(item)" title="Đồng ý"><i class="fa fa-check-square-o fa-fw"></i></button>
                                            <button ng-if="vm.can('screen.crm0410.deny') && item.request_sts == 0"  type="button" class="btn btn-danger btn-xs" ng-click="vm.deny(item)" title="Từ chối"><i class="fa fa-remove fa-fw"></i></button>
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
                <div class="box-header with-border">
                    <h3 class="box-title" ng-if="vm.m.order.store_delivery_code != null && vm.m.order.store_delivery_code.length > 0">{{vm.m.order.store_delivery_code}}<small ng-if="vm.m.store_delivery_id">#{{vm.m.store_delivery_id}}</small>
                        &nbsp;<small ng-if="vm.m.order.delivery_date">{{vm.m.order.delivery_date}}</small>
                    </h3>
                    <h3 class="box-title" ng-if="vm.m.order.store_order_code == null || vm.m.order.store_order_code.length == 0">Phiếu xuất mới</h3>
                    <div class="box-tools pull-right">
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                        <!-- <button type="button" class="btn btn-info btn-box-tool" ng-if="vm.m.order.store_order_id > 0" ng-click="vm.clickPrintOrder()"><i class="fa fa-print fa-fw"></i>Đơn hàng</button>  -->
                        <button type="button" class="btn btn-xs btn-primary"  ng-if=" vm.m.store_delivery_id > 0 && vm.m.order.delivery_sts =='1'" ng-click="vm.clickCreateExport()" ><i class="fa fa-exchange fa-fw"></i>&nbsp;Hỗ trợ hóa đơn</button>
                        <button type="button" class="btn btn-xs btn-info" ng-if=" vm.m.store_delivery_id > 0 && (vm.m.order.delivery_sts =='7' || vm.m.order.delivery_sts == '1')"  ng-click="vm.clickPrintDelivery()"><i class="fa fa-print fa-fw"></i>Phiếu giao hàng</button>
                        <button type="button" class="btn btn-xs btn-info" ng-if=" vm.m.store_delivery_id > 0 && (vm.m.order.delivery_sts == '0' || vm.m.order.delivery_sts == '6')" ng-click="vm.clickPrintPacking()"><i class="fa fa-print fa-fw"></i>Phiếu soạn hàng</button>
                        <button type="button" class="btn btn-xs btn-info" ng-if=" vm.m.store_delivery_id > 0 && (vm.m.order.delivery_sts == '1' )" ng-click="vm.clickShipping()"><i class="fa fa-print fa-fw"></i>Vận chuyển</button>
                        <button type="button" class="btn btn-xs btn-info" ng-if=" vm.m.store_delivery_id > 0 && (vm.m.order.delivery_sts == '8' )" ng-click="vm.clickReceive()"><i class="fa fa-print fa-fw"></i>Khách nhận</button>
                        <button type="button" class="btn btn-xs btn-info" ng-if=" vm.m.store_delivery_id > 0 && vm.m.order.delivery_sts == '9'" ng-click="vm.clickFinish()" ><i class="fa fa-check-square-o fa-fw"></i>Hoàn tất</button>
                    </div>
                </div>


                    <div class="box-header with-border form-horizontal">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Tạo đơn:</label>
                                <div class="col-sm-8">
                                <a ui-sref='app.crm0211({store_id: vm.m.order.store_id, store_order_id: vm.m.order.store_order_id})'>#{{vm.m.order.store_order_code }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Trạng thái đơn:</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static">
                                        <span ng-if="vm.m.order_type==1"> Đơn thường - </span>
                                        <span ng-if="vm.m.order_type==3"> Đơn hàng mẫu - </span>
                                        <span ng-if="vm.m.order_type==2"> Đơn bảo hành - </span>
                                        <small ng-repeat="state in vm.m.statusList" ng-if="vm.m.order.delivery_sts == state.status_id">
                                            <span class="{{state.label}}">{{state.descript}}</span>
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Phụ trách đơn:</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static">{{vm.m.delivery.salesman_name}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Tạo đơn:</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static">{{vm.m.delivery.create_by}}</b> - {{vm.m.delivery.created_at}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Chỉnh sửa cuối:</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static">{{vm.m.delivery.update_by}}</b> - {{vm.m.delivery.updated_at}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Nơi xuất:</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static">{{vm.m.order.branch_name}}</p>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-md-6 col-xs-12" ng-if=" vm.m.store_delivery_id > 0 && vm.m.order.delivery_sts == '1'"> -->
                        <div class="col-md-6 col-xs-12">
                            <label class="col-sm-4 control-label">Chọn cách vận chuyển:</label>
                            <span class="col-sm-8">
                            <select class="form-control"
                                chosen
                                placeholder-text-single="'Chọn chi nhánh'"
                                ng-model="vm.m.filter.shipping_id"
                                ng-options="item.id as item.name for item in vm.m.shippingList "
                                >
                                <option value="">Không có</option>
                                </select>
                            </span>
                        </div>


                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Nhà cung ứng:</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static">{{vm.m.delivery.supplier_name}}</p>
                                </div>
                            </div>
                        </div>


                    </div>

                <div class="callout callout-info no-border-radius" ng-if="vm.m.order.promotion_name">
                    <span>{{vm.m.order.promotion_name}}</span>
                </div>
                <div class="box-body">
                    <div class="table-responsive" ng-if="vm.m.orderDetail">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>NO</th>
                                    <th>Sản phẩm</th>
                                    <th class="text-right">Đóng gói</th>
                                    <th class="text-right">Đặt còn lại</th>
                                    <th>Số lượng xuất</th>
                                    <th ng-if="vm.m.store_delivery_id > 0 && vm.m.order.delivery_sts == '6'">Số lượng xác nhận</th>
                                    <th class="text-right">Đơn giá</th>
                                    <th class="text-right">Thành tiền</th>
                                    <th class="text-right">Carton </th>
                                    <th class="text-right">Vol </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.orderDetail'>
                                    <td><button class="btn btn-danger btn-sm" ng-click="vm.removeProduct(item)"><i class="fa fa-minus-circle"></i></button></td>
                                    <td>{{$index + 1}}</td>
                                    <td>
                                        {{item.product_code}} <br/>
                                        {{item.product_name}}
                                    </td>
                                    <td class="text-right">{{item.standard_packing}}</td>
                                    <td class="text-right">{{item.amount}}</td>
                                    <td>
                                        <input type="text" ng-model="item.amountExport" min="0" max="{{item.amount}}" ng-change="vm.calcOrderTotal()" ng-disabled="vm.m.order.delivery_sts > 0"/>
                                    </td>
                                    <td ng-if="vm.m.store_delivery_id > 0 && vm.m.order.delivery_sts == '6'" >
                                        <input type="text" style="width:60px;" ng-init="item.amountConfirm=item.amountExport" ng-model="item.amountConfirm" min="0" max="{{item.amount}}" />
                                    </td>
                                    <td class="text-right">{{item.unit_price | currency : '' : 0 }}</td>
                                    <td class="text-right">{{item.amountExport * item.unit_price  | currency : '' : 0  }}</td>
                                    <td class="text-right">{{item.amountExport  / item.standard_packing | number  : 1}}</td>
                                    <td class="text-right">{{item.amountExport * item.volume / item.standard_packing | number  : 3 }}</td>
                                    <!-- <td class="text-right">{{item.volume | number  : 3 }}</td> -->

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row" ng-if="vm.m.order">
                        <div class="col-md-6">
                            <label>Chiết khấu chính sách (%)</label>
                            <p class="form-control-static">{{vm.m.order.discount_1}}%</p>
                        </div>
                        <div class="col-md-6">
                            <label>Tổng tiền</label>
                            <p class="form-control-static">{{vm.m.order.total | currency : '' : 0 }}</p>
                        </div>
                        <div class="col-md-6">
                            <label>Chiết khấu thêm (%)</label>
                            <p class="form-control-static">{{vm.m.order.discount_2}}%</p>
                        </div>
                        <div class="col-md-6">
                            <label>Tổng Chiết khấu</label>
                            <p class="form-control-static">{{ vm.getSumMoneyDiscount() | currency : '' : 0  }}</p>
                        </div>
                        <div class="col-md-6">
                            <label >Tổng Chiết khấu (%)</label>
                            <p class="form-control-static" style="color:red">{{vm.m.order.discount_1 + vm.m.order.discount_2}}%</p>
                        </div>
                        <div class="col-md-6">
                            <label>Thành tiền (Sau chiết khấu)</label>
                            <p class="form-control-static" style="color:red">{{(vm.m.order.total - vm.getSumMoneyDiscount())  | currency : '' : 0 }} (VND)</p>
                        </div>
                        <div class="col-md-6">
                            <label>Tổng số thùng</label>
                            <p class="form-control-static" style="color:red">{{ vm.m.order.carton | number  : 1 }} (thùng)</p>
                        </div>
                        <div class="col-md-6">
                            <label>Tổng thể tích</label>
                            <p class="form-control-static" style="color:red">{{ vm.m.order.volume | number  : 3 }} (m3)</p>
                        </div>
                        <div class="col-md-6">
                            <label>Vui lòng chọn kho để xuất</label>
                            <select class="form-control"
                                    chosen
                                    placeholder-text-single="'Chọn kho xuất hàng'"
                                    ng-model="vm.m.order.warehouse_id"
                                    ng-options="item.warehouse_id as item.warehouse_name for item in vm.m.warehouseList"
                                    ng-disabled = "vm.m.order.delivery_sts && vm.m.order.delivery_sts !=0 "
                                    >
                                    <option value=""></option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label>Ghi chú</label>
                            <textarea class="form-control" row="5" ng-model="vm.m.order.notes"></textarea>
                        </div>
                        <div class="col-md-12" ng-if="vm.m.order.notes_cancel">
                            <label>Lý do hủy</label>
                            <p class="form-control-static">{{vm.m.order.notes_cancel}}</p>
                        </div>
                        <div class="col-md-12" ng-if="vm.m.signList.length > 0">
                            <label>Chữ ký phiếu giao hàng</label>
                            <p class="form-control-static">
                            <ul class="list-inline">
                                <li ng-repeat="img in vm.m.signList">
                                    <a target="__blank" ng-href="/images{{img.img_path}}">
                                        <img ng-src="/images{{img.img_path | imgThumb}}" class="img-rounded img-thumb-product-2x"/>
                                        <small class="img-thumb-description-2x">{{img.description}}</small>
                                    </a>
                                </li>
                            </ul>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a ui-sref="app.crm0400" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                    <div class="pull-right">

                        <button type="button" class="btn btn-danger m-l" ng-if="vm.m.order.delivery_sts != '5' && vm.m.store_delivery_id > 0 && vm.can('screen.crm0410.cancel')" ng-click="vm.clickRequestCancel()" ><i class="fa fa-remove fa-fw"></i>Hủy</button>
                        <!-- <button type="button" class="btn btn-info m-l" ng-if="vm.m.order.store_order_id > 0 && vm.m.orderDetail.length > 0" ng-click="vm.clickCreateExport()" ><i class="fa fa-opencart fa-fw"></i>Tạo phiếu xuất</button> -->
                        <button type="button" class="btn btn-warning m-l" ng-if="vm.m.canEdit && (!vm.m.order.delivery_sts || vm.m.order.delivery_sts < 1)" ng-disabled="vm.m.orderDetail.length == 0" ng-click="vm.clickSave(false, 1)" ><i class="fa fa-save fa-fw"></i>Lưu</button>
                        <button type="button" class="btn btn-warning m-l" ng-if="vm.m.store_delivery_id > 0 && vm.m.order.delivery_sts == '6'" ng-click="vm.clickConfirm()" ><i class="fa fa-save fa-fw"></i>Xác nhận</button>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin cửa hàng</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <div class="box-body">
                    <div class="row" ng-if="vm.m.store">
                        <div class="col-md-12" ng-if="vm.m.store.dealer_id">
                            <label>Đại lý</label>
                            <p class="form-control-static">{{vm.m.store.dealer_name}}</p>
                        </div>

                        <div class="col-md-12">
                            <label>Tên</label>
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

                        <div class="col-md-12" ng-if="vm.m.storeSignList.length > 0">
                            <label>Chữ ký phiếu giao hàng</label>
                            <p class="form-control-static">
                            <ul class="list-inline">
                                <li ng-repeat="img in vm.m.storeSignList">
                                    <a target="__blank" ng-href="/images{{img.img_path}}">
                                        <img ng-src="/images{{img.img_path | imgThumb}}" class="img-rounded img-thumb-product-2x"/>
                                        <small class="img-thumb-description-2x">{{img.description}}</small>
                                    </a>
                                </li>
                            </ul>
                            </p>
                        </div>
                   </div>
               </div>
           </div>
       </div>
        <div class="col-md-9">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin chứng từ - Giấy xác nhận nhận hàng của khách</h3>
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
                                        <a target="__blank" ng-href="<?php echo env('URL_IMAGE_PORTAL','//www.phankhangco.com/images'); ?>crm0410{{item}}">
                                            <img width="200" height="200" class="image-preview-list-small" src="<?php echo env('URL_IMAGE_PORTAL','//www.phankhangco.com/images'); ?>crm0410{{item}}"/>
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
        
   
       <div class="col-md-3">
           <div class="box box-info">
               <div class="box-header with-border">
                    <h3 class="box-title">Thông tin phiếu xuất</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <div class="box-body">
                    <div class="row" ng-if="vm.m.store">
                        <div class="col-md-12" >
                            <label>Order -> Xuất hàng :</label>
                            <p class="form-control-static">{{vm.m.delivery.del_order}}</p>
                        </div>
                        <div class="col-md-12" >
                            <label>Order -> Vận chuyển :</label>
                            <p class="form-control-static">{{vm.m.delivery.ship_order}}</p>
                        </div>
                        <div class="col-md-12" >
                            <label>Mới -> Soạn hàng :</label>
                            <p class="form-control-static">{{vm.m.delivery.create_pack}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Soạn hàng  -> Xác nhận : </label>
                            <p class="form-control-static">{{vm.m.delivery.pack_conf}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Xác nhận -> Xuất kho:</label>
                            <p class="form-control-static"> {{vm.m.delivery.conf_del}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Xuất kho -> Vận chuyển:</label>
                            <p class="form-control-static">{{vm.m.delivery.del_ship}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Vận chuyển -> Khách nhận:</label>
                            <p class="form-control-static">{{vm.m.delivery.ship_rec}}</p>
                        </div>
                        <div class="col-md-12" >
                            <label>Soạn hàng:</label>
                            <p class="form-control-static">{{vm.m.delivery.packing_time}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Xác nhận: </label>
                            <p class="form-control-static">{{vm.m.delivery.confirm_time}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Xuất kho:</label>
                            <p class="form-control-static"> {{vm.m.delivery.delivery_time}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Vận chuyển:</label>
                            <p class="form-control-static">{{vm.m.delivery.shipping_time}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Khách nhận:</label>
                            <p class="form-control-static">{{vm.m.delivery.receive_time}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Thanh toán:</label>
                            <p class="form-control-static">{{vm.m.store.finish_time}}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
