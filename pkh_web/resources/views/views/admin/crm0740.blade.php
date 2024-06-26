<section class="content-header">
    <h1>Hỗ trợ tạo hóa đơn <small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Hỗ trợ tạo hóa đơn</li>
    </ol>
</section>
<section class="content crm0000">
    <div class="row">
        
        <div class="col-md-9">

            <div class="box box-info">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-info btn-xs btn-width-default" ng-click="vm.download()">
                                            <i class="fa fa-download fa-fw"></i>
                                            Tải về
                                        </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-body">
                    <div class="table-responsive" ng-if="vm.m.orderDetail">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>NO</th>
                                    <th>Mã Sp</th>
                                    <th>Tên SP</th>
                                    <th>Đóng gói</th>
                                    <th>Số lượng tồn</th>
                                    <th>Đơn giá kế toán</th>
                                    <th>Số lượng xuất</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.orderDetail'>
                                    <td><button ng-disabled="vm.m.canEdit==false" class="btn btn-danger btn-sm" ng-click="vm.removeProduct(item)"><i class="fa fa-minus-circle"></i></button></td>
                                    <td>{{$index + 1}}</td>
                                    <td>{{item.product_code}}</td>
                                    <td>{{item.product_name}}</td>
                                    <td>{{item.standard_packing}}</td>
                                    <td>
                                        <input type="number" style="width:80px;" ng-model="item.balance" min="0"  />
                                    </td>
                                    <td>
                                        <input type="number" style="width:80px;" ng-model="item.unit_price" min="0" ng-change="vm.calcOrderTotal()" />
                                    </td>
                                    <td>
                                        <input type="number" style="width:80px;" ng-model="item.amount" min="0" ng-change="vm.calcOrderTotal()" />
                                    </td>
                                    <td>{{item.amount * item.unit_price  | currency : '' : 0  }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row" >
                       
                        <div class="col-md-6">
                            <label>Số tiền tổng</label>
                            <input type="number" class="form-control"  ng-model="vm.m.order.asked_money" />
                            <p style="color:red;"  ng-show="!vm.m.order.asked_money">Vui lòng nhập số tiền </p>
                        </div>
                        
                        <div class="col-md-12">
                            <label>Tổng tiền hóa đơn</label>
                            <p class="form-control-static">{{vm.m.order.result_money | currency : '' : 0 }}</p>
                        </div>
                    
                     
                    </div>
                    
                </div>
                <div class="box-footer">
                    <p style="color:red;"  >{{vm.m.message}} </p>
                    <div class="pull-right">
                        <button type="button" class="btn btn-warning m-l" ng-if="vm.m.canEdit" ng-click="vm.clickCreate()" ><i class="fa fa-save fa-fw"></i>Tạo</button> 
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
                                    <td>Đơn giá kế toán</td>
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
                                    <td>{{item.product_code}}<br/><i>({{item.stock_code}})</i></td>
                                    <td>{{item.name}}<br/><i>({{item.name_origin}})</i></td>
                                    <td>{{item.standard_packing}}</td>
                                    <td>{{item.accountant_price | currency: '': 0}}</td>
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
                    </div>
                </div>
            </div>
        </div>

     

    </div>
</section>
