<section class="content-header">
    <h1>Tạo đơn đặt hàng <small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm1300">Danh sách đơn hàng </a></li>
        <li class="active">Tạo đơn hàng</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        
        <div class="col-md-9" >
            <div class="box box-info">  
                <div class="box-body">
                    <div class="table-responsive" ng-if="vm.m.orderDetail">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>NO</th>
                                    <th >Mã sản phẩm</th>
                                    <th >Tên sản phẩm</th>
                                    <th> Mô tả </th>
                                    <th >Đóng gói</th>
                                    <th >Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Loại đóng gói</th>
                                    <th >Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.orderDetail'>
                                    <td><button ng-disabled="vm.m.canEdit==false" class="btn btn-danger btn-sm" ng-click="vm.removeProduct(item)"><i class="fa fa-minus-circle"></i></button></td>
                                    <td>{{$index + 1}}</td>
                                    <td >{{item.product_code}}</td>
                                    <td  >{{item.product_name}}</td>
                                    <td>{{item.describes}}</td>
                                    <td>{{item.pakaging}}</td>
                                    <td  >  <input type="text"  style="width:80px;" class="form-control" ng-model="item.unit_price" min="0" ng-change="vm.calcOrderTotal()" /></td>
                                    <td>
                                        <input type="text"  style="width:80px;" class="form-control" ng-model="item.amount" min="0" ng-change="vm.calcOrderTotal()" />
                                    </td>
                                    <td>{{item.pakaging_type}}</td>
                                   
                                    <td >{{item.amount * item.unit_price | currency : '' : 0 }}</td>
                                    
                                   
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    
                    <div class="row" ng-if="vm.m.order">
                         <div class="col-md-6">
                            <label>Chiết khấu thêm (%)</label>
                            <input type="text" class="form-control" ng-model="vm.m.order.discount" ng-change="vm.calcOrderTotal()"/>
                        </div>
                
                                         
                        <div class="col-md-6">
                            <label>Thành tiền (Sau chiết khấu)</label>
                            <p class="form-control-static">{{vm.m.order.total | currency : '' : 0 }}</p>
                        </div>
                        
                        <div class="col-md-6">
                            <label>Thành tiền sau chiết khấu</label>
                            <p class="form-control-static">{{vm.m.order.total_with_discount | currency : '' : 0 }}</p>
                        </div>

                        
                        
                    </div>
                    <div class="row" >
                         <div class="col-md-6">
                            <label>Khách đưa ({{vm.m.cpayment_money | currency : '' : 0 }})</label>
                            <input type="text" class="form-control" ng-model="vm.m.cpayment_money" />
                        </div>
                
                                         
                        <div class="col-md-6">
                            <label>Dư</label>
                            <p class="form-control-static">{{vm.m.order.total_with_discount - vm.m.cpayment_money | currency : '' : 0}}</p>
                        </div>
                       
                    </div>
                </div>
                <div class="box-footer">
                    <a ui-sref="app.crm1920" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                    <div class="pull-right">
         
                        <button type="button" class="btn btn-info m-l"  ng-if="vm.m.supplier_order_id > 0 && vm.m.orderDetail.length > 0 && vm.m.form.order_sts  == '1'" ng-click="vm.clickCreateExport()" ><i class="fa fa-opencart fa-fw"></i>Tạo PI</button>
                        <button type="button" class="btn btn-warning m-l" ng-disabled="vm.m.orderDetail.length == 0 || vm.m.order.length > 0" ng-click="vm.clickSave()" ><i class="fa fa-save fa-fw"></i>Lưu</button> 
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
                                    <td> </td>
                                    <td>Mã SP</td>
                                    <td>Tên SP</td>
                                    <td>Đóng thùng (cái)</td>
                                    <td>Đơn giá (USD$)</td>
                                    <td>Còn lại</td>
                                    <td>Tồn kho</td> 
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.productList' ng-if="item.hide != true">
                                    <td><button class="btn btn-primary btn-sm" ng-click="vm.addProduct(item)"><i class="fa fa-plus-circle"></i></button></td>
                                   
                                    <td>{{item.product_code}}</td>
                                    <td class = "text-left">{{item.product_name}}</td>
                                    <td>{{item.pakaging}}</td>
                                    <td>{{item.selling_price | currency: '': 0}}</td>
                                   
                                    
                                    <td>Còn lại</td>
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
        <h3 class="box-title">Thông tin khách hàng</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
        </div>
    </div>
    <div class="box-body">
        <div class="row" >
            <div class="col-md-12">
                <label>Mã Khách hàng</label>
                <p class="form-control-static"><a ui-sref='app.crm2600({store_id: vm.m.store_id})'>#{{vm.m.store.store_id}}</a></p>
            </div>
            <div class="col-md-12" >
                <label>Tên Khách hàng</label>
                <p class="form-control-static">{{vm.m.store.name}}</p>
            </div>
            
            <div class="col-md-12">
                <label>Địa chỉ</label>
                <p class="form-control-static">{{vm.m.store.address}}</p>
            </div>
         
            <div class="col-md-12">
                <label>Discount</label>
                <p class="form-control-static">{{vm.m.store.discount}}</p>
            </div>
            
            <div class="col-md-12">
                <label>Điện thoại</label>
                <p class="form-control-static">{{vm.m.store.contact_tel}}</p>
            </div>
            <div class="col-md-12">
                <label>Email</label>
                <p class="form-control-static">{{vm.m.store.contact_email}} </p>
            </div>
            

           
        </div>
    </div>
</div>




</div>

    </div>
</section>
