<!--<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>-->
<section class="content-header">
    <h1>Chi tiết kiểm kho <small>Dành cho nhân viên kho</small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Kiểm kho</li>
    </ol>
</section>
<section class="content crm0810">
    <div class="row">
        <div class="col-md-9">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin chứng từ - Giấy kiểm kho</h3>
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
                                        <a target="__blank" ng-href="<?php echo env('URL_IMAGE_PORTAL','//www.phankhangco.com/images'); ?>crm0810{{item}}">
                                            <img width="200" height="200" class="image-preview-list-small" src="<?php echo env('URL_IMAGE_PORTAL','//www.phankhangco.com/images'); ?>crm0810{{item}}"/>
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
       <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách sản phẩm</h3>
                    <div class="box-tools pull-right">
                        <!--<input type="checkbox" checked data-toggle="toggle" 
                        ng-model="vm.m.productActive" ng-true-value="1" ng-false-value="0" ng-change="vm.doSearch()">-->
                        Sản phẩm đang bán
                        <input type="checkbox" ng-model="vm.m.productActive" ng-true-value="1" ng-false-value="0">
                    </div>
                </div>
                  <div  class="box-header with-border">
                     <div  class="col-md-12 col-sm-12">
                        <span class="col-md-2 col-sm-2">
                            Người kiểm: {{vm.m.info.update_by}}
                        </span>
                        <span class="col-md-10 col-sm-10">
                          <b class="label label-success">{{vm.m.info.updated_at}} </b>
                        </span>
                    </div>
                    <div  class="col-md-12 col-sm-12">
                        <span class="col-md-2 col-sm-2">
                            Trang thai:
                        </span>
                        <span ng-if="vm.m.info.checking_sts == 0" class="label label-success">Mới</span> 
                        <span ng-if="vm.m.info.checking_sts == 1" class="label label-primary">Xác nhận</span> 
                        <span ng-if="vm.m.info.checking_sts == 5" class="label label-default">Hủy</span>
        
                    </div> 
                    <div  class="col-md-12 col-sm-12">
                        <span class="col-md-2 col-sm-2">
                            chi nhánh:
                        </span>
                        <span class="col-md-10 col-sm-10">
                          {{vm.m.info.branch_name}}
                        </span>
                    </div> 
                    <div  class="col-md-12 col-sm-12">
                        <span class="col-md-2 col-sm-2">
                            Kho:
                        </span>
                        <span class="col-md-10 col-sm-10">
                          {{vm.m.info.warehouse_name}}
                        </span>
                    </div> 
                </div>
                <div class="box-body">
                    <form class="form" ng-submit="vm.save()">
                        <!--<div class="checkbox">
                             <label>
                                <input type="checkbox" ng-model="vm.m.productActive" ng-true-value="1" ng-false-value="0">
                                Các sản phẩm hiện đang bán
                            </label>
                        </div>-->
                                <!--<div class="form-group">
                                    <label>NVBH</label>
                                    <select class="form-control"   
                                        ng-model="vm.m.productActive"
                                        ng-options="item.id as item.name for item in vm.m.init.listSalesman track by item.id"
                                        >
                                    </select>
                                </div>-->
                        <div class="table-responsive">
                            <table class="table table-striped product-list">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Hình ảnh</th>
                                        <th ng-click="vm.sort('product_code');" class="sortable">
                                            <span translate="CRM0130_LABEL_PRODUCT_CODE"></span>
                                            <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="product_code"
                                                order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                        </th>
                                        <th ng-click="vm.sort('product_name');" class="sortable">
                                            <span translate="CRM0130_LABEL_PRODUCT_NAME"></span>
                                            <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="product_name"
                                                order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                        </th>
                                        <th style="width:120px;">Số lượng</th>
                                        <th>Ghi chú</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat='item in vm.m.list | crm0810Price : vm.m.productActive'>
                                        <td>{{$index + 1}}</td>
                                        <td>
                                            <img class="img-thumb" class="img-responsive" ng-src="{{item.imgUrl}}" />
                                        </td>
                                        <td>{{item.product_code}}</td>
                                        <td>{{item.name}}</td>
                                        <td>
                                            <input type="number" ng-init="0" class="form-control ng-pristine ng-valid ng-empty ng-touched" id="checkWarehose_amount" 
                                            ng-model="item.amount" style="">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control ng-pristine ng-valid ng-empty ng-touched" id="checkWarehouse_notes" 
                                        ng-model="item.notes" style="">
                                        <!--{{item | json}}-->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label required">Ngày kiểm</label>
                                <div class="input-group col-md-2 m-b-xs" >
                                    <input id="checkDate" class="form-control" datetimepicker ng-model="vm.m.checkDate" placeholder="YYYY-MM-DD" options="vm.m.dateOptions" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="required">Vui lòng chọn kho để nhập kiểm kho</label>
                                <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn kho xuất hàng'"
                                        ng-model="vm.m.warehouse_id"
                                        ng-options="item.warehouse_id as item.warehouse_name for item in vm.m.warehouseList"
                                        >
                                        <option value=""></option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Ghi chú:</label>
                                    <textarea class="form-control" ng-model="vm.m.checkWarehouseNote" rows="5" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row"></div>
                        <div class="pull-right row">
                            <div class="col-md-12 ">
                            
                                <button ng-if="vm.m.info.checking_sts != '5'" type="submit" class="btn btn-primary btn-sm btn-width-default">
                                    <i class="fa fa-save fa-fw"></i>
                                    <span> Lưu lại</span>
                                </button>
                                <button type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.download()">
                                    <i class="fa fa-file-excel-o fa-fw"></i>
                                    <span>Tải excel</span>
                                </button>
                                <button  ng-if="vm.can('screen.crm0810.cancel') && vm.m.info.checking_sts == '0'" type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.clickCancel()">
                                    <i class="fa fa-file-excel-o fa-fw"></i>
                                    <span>Huỷ</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
