<section class="content-header">
    <h1>Nhập hàng <small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Nhập hàng</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-9" >
            <div class="box box-warning"  ng-if="vm.m.requestList.length > 0">
                <div class="box-header with-border">
                    <h3 class="box-title" >Yêu cầu xử lý nhập hàng</h3>
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
                                            <button ng-if="vm.can('screen.crm1630.approve') && item.request_sts == 0" type="button" class="btn btn-primary btn-xs" ng-click="vm.accept(item)" title="Đồng ý"><i class="fa fa-check-square-o fa-fw"></i></button>
                                            <button ng-if="vm.can('screen.crm1630.deny') && item.request_sts == 0"  type="button" class="btn btn-danger btn-xs" ng-click="vm.deny(item)" title="Từ chối"><i class="fa fa-remove fa-fw"></i></button>
                                        </div>
                                    </td>
                                    <td>{{$index+1}}</td>
                                    <td>{{item.request_date | date:'yyyy-MM-dd'}} (#{{item.request_id}})</td>
                                    <td>
                                        <span class="label label-danger" ng-if="item.request_type == 4">Nhập hàng nhà máy</span>
                                        <span class="label label-danger" ng-if="item.request_type == 5">Nhập bảo hành</span>
                                        <span class="label label-danger" ng-if="item.request_type == 6">Nhập trả lại</span>
                                    </td>
                                    <td>
                                        <span class="label label-primary" ng-if="item.request_sts == 0">Chờ xác nhận</span>
                                        <span class="label label-success" ng-if="item.request_sts == 1">Đồng ý</span>
                                        <span class="label label-danger" ng-if="item.request_sts == 2">Từ chối</span>
                                    </td>
                                    <td>
                                        {{item.response_notes}}
                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box box-danger">
                <div class="box-header with-border"> 
                    <h3 class="box-title" ng-if="vm.m.import_wh_factory_id !=null "><span class="label label-danger">Nhập hàng từ nhà máy</span></h3>
                    <h3 class="box-title" ng-if="vm.m.import_type ==1 "><span class="label label-danger">Nhập hàng bảo hành</span></h3>
                    <h3 class="box-title" ng-if="vm.m.import_type ==2 "><span class="label label-danger">Nhập hàng trả về</span></h3>
                    <span ng-if="vm.m.importWhStore">{{vm.m.importWhStore.salesman_name}} - {{vm.m.importWhStore.import_date}}</span>
                    <div class="box-tools pull-right" ng-if="vm.m.import_wh_factory_id!=null || vm.m.import_wh_store_id!=null">
                        <button  type="button" class="btn btn-xs btn-info"   ng-click="vm.requestImport()" >
                            <span >Nhập kho bán hàng </span>
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="table-responsive" ng-if="vm.m.importDetail">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>NO</th>
                                    <th class="text-left">Mã PKH</th>
                                    <th class="text-left">Mã nhà máy</th>
                                    <th class="text-left">mô tả (vn)</th>
                                    <th class="text-right">Đóng gói</th>
                                    
                                    <th class="text-right" ng-if="vm.m.import_wh_factory_id != null ">Số lượng PI</th>
                                    <th >Số lượng kho xác nhận</th>
                                    <th ng-hide="vm.m.canEdit==true">Số nhập</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.importDetail'>
                                    <td><button ng-disabled="vm.m.canEdit==false" class="btn btn-danger btn-sm" ng-click="vm.removeProduct(item)"><i class="fa fa-minus-circle"></i></button></td>
                                    <td>{{$index + 1}}</td>
                                    <td class="text-left">{{item.product_code}}</td>
                                    <td class="text-left">{{item.stock_code}}</td>
                                    <td class="text-left" >{{item.product_name}}</td>
                                    <td class="text-right">{{item.standard_packing}}</td>
                                    <td class="text-right" ng-if="vm.m.import_wh_factory_id != null ">{{item.amount}}</td>
                                    <td ng-if="vm.m.import_wh_factory_id == null ">
                                        <input ng-disabled="vm.m.canEdit==false" type="text" style="width:80px;" class="form-control" ng-model="item.amount" min="0" ng-change="vm.calcOrderTotal()" />
                                    </td>
                                    <td ng-hide="vm.m.canEdit==true">
                                        <input type="text" style="width:80px;" class="form-control" ng-model="item.amountImport" min="0"  />
                                    </td>
                                    <td ng-hide="vm.m.import_wh_factory_id == null">
                                        <input type="text" style="width:80px;" class="form-control" ng-model="item.amountImport" min="0"  />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row" >
                        <div class="col-md-6">
                            <label>Vui lòng chọn kho để nhập</label>
                            <select class="form-control"     
                                    chosen                               
                                    placeholder-text-single="'Chọn kho'"
                                    ng-model="vm.m.warehouse_id"
                                    ng-options="item.warehouse_id as item.warehouse_name for item in vm.m.warehouseList"
                                    ng-disabled = "vm.m.import_wh_factory_id != null ||  vm.m.import_wh_store_id != null"
                                    >
                                    <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-md-12">
                            <label>Ghi chú</label>
                            <textarea class="form-control" row="5" ng-model="vm.m.notes"></textarea>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a ui-sref="app.crm1640" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                    <div class="pull-right">
                        <button type="button" class="btn btn-warning m-l" ng-if="vm.m.canEdit && vm.m.import_wh_factory_id == null" ng-disabled="vm.m.importDetail.length == 0 || vm.m.canEdit==false" ng-click="vm.clickSave()" ><i class="fa fa-save fa-fw"></i>Nhập kho</button> 
                        <button type="button" class="btn btn-danger m-l" ng-if="vm.can('screen.crm1630.update')" ng-disabled="vm.m.importDetail.length == 0 " ng-click="vm.clickSave()" ><i class="fa fa-save fa-fw"></i>Cập nhật</button> 
                    </div>
                </div> 
            </div>

            <div class="box box-info collapsed-box">
                <div class="box-header with-border">
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
                <div class="box-body" ng-if="vm.m.canEdit" style="display: none">
                    <div class="table-responsive" ng-if="vm.m.productList">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>Hình ảnh</td>
                                    <td>Mã SP</td>
                                    <td>Tên SP</td>
                                    <td class="text-right">Đóng thùng (cái)</td>
                                    <td class="text-right">Đơn giá</td> 
                                    <td>Tồn kho</td> 
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.productList' ng-if="item.hide!=true" >
                                    <td><button class="btn btn-primary btn-sm" ng-click="vm.addProduct(item)"><i class="fa fa-plus-circle"></i></button></td>
                                    <td>
                                    <img ng-if="item.noImage == 0" class="img-thumb-product" class="img-responsive" ng-src="<% env('URL_IMAGE', 'http://phankhangco.com/img/product/')%>{{item.product_code}}.png" />
                                    <img ng-if="item.noImage == 1" class="img-thumb-product" class="img-responsive" ng-src="<% env('URL_IMAGE', 'http://phankhangco.com/img/product/')%>WT0000.png" />
                                    </td>
                                    <td>{{item.product_code}}<br/><i>({{item.stock_code}})</i></td>
                                    <td>{{item.name}}<br/><i>({{item.name_origin}})</i></td>
                                    <td class="text-right">{{item.standard_packing}}</td>
                                    <td class="text-right">{{item.selling_price| currency: '': 0}} </td> 
                                    <td>Tồn kho</td>
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
                    <h3 class="box-title" ng-if="vm.m.infor.store != null ">Thông tin cửa hàng</h3>
                    <h3 class="box-title" ng-if="vm.m.infor.supplier != null && vm.m.supplier_delivery_id > 0">Thông tin nhà cung ứng</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <div class="box-body">
                    <div class="row" ng-if="vm.m.infor.store != null ">
                        <div class="col-md-12" ng-if="vm.m.infor.store.dealer_id">
                            <label>Đại lý</label>
                            <p class="form-control-static">{{vm.m.infor.store.dealer_name}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Tên</label>
                            <p class="form-control-static">{{vm.m.infor.store.name}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Khu vực</label>
                            <p class="form-control-static">{{vm.m.infor.store.area1_name}} {{vm.m.infor.store.area2_name}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Địa chỉ</label>
                            <p class="form-control-static">{{vm.m.infor.store.address}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Địa chỉ chành</label>
                            <p class="form-control-static">{{vm.m.infor.store.address_chanh}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Người liên hệ</label>
                            <p class="form-control-static">{{vm.m.infor.store.contact_name}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Fax</label>
                            <p class="form-control-static">{{vm.m.infor.store.contact_fax}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Điện thoại</label>
                            <p class="form-control-static">{{vm.m.infor.store.contact_mobile1}} {{vm.m.infor.store.contact_mobile2}} {{vm.m.infor.store.contact_tel}}</p>
                        </div>
                    </div>
                    <div class="row" ng-if="vm.m.infor.supplier != null ">
                        <div class="col-md-12">
                            <label>Tên</label>
                            <p class="form-control-static">{{vm.m.infor.supplier.name}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Pi_no</label>
                            <p class="form-control-static">{{vm.m.infor.supplier.pi_no}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9" >
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin chứng từ - hình ảnh giấy nhập hàng</h3>
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
                                        <a target="__blank" ng-href="<?php echo env('URL_IMAGE_PORTAL','//www.phankhangco.com/images'); ?>crm1630{{item}}">
                                            <img width="200" height="200" class="image-preview-list-small" src="<?php echo env('URL_IMAGE_PORTAL','//www.phankhangco.com/images'); ?>crm1630{{item}}"/>
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
