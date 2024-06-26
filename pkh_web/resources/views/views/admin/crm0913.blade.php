<section class="content-header">
    <h1>Tồn kho (ngày) {{vm.m.title}} <small ng-if="vm.m.warehouseCheck.checking_sts == 1">Đã xác nhận</small></h1>
    <!-- <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Lịch nghỉ nghep</li>
    </ol> -->
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 ng-if="vm.m.mode == 0" class="box-title">Danh sách hàng tồn kho theo ngày</h3>
                    <h3 ng-if="vm.m.mode == 1" class="box-title">Xác nhận kiểm kho  </h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                  
                <div class="box-body form">
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label for="day">Chọn ngày</label> 
                                    <div class="input-group"> 
                                        <input class="form-control" ng-disabled = "vm.m.mode ==1 " datetimepicker ng-model="vm.m.filter.check_date" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/> 
                                        <span class="input-group-addon"> 
                                            <span class="glyphicon glyphicon-calendar"></span> 
                                        </span> 
                                    </div>
                                </div> 
                            </div> 

                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Loại sản phẩm</label>
                                      <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn nơi xuất'"
                                        ng-model="vm.m.filter.product_cat_id"
                                        ng-options="item.product_cat_id as item.name for item in vm.m.init.catList "
                                        >
                                        <option value="">Không có</option>
                                        </select>
                                </div>
                            </div>


                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Mã SP</label>
                                    <input type="text" ng-model="vm.m.filter.product_code" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Kho</label>
                                      <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn nơi xuất'"
                                        ng-model="vm.m.filter.warehouse_id"
                                        ng-options="item.warehouse_id as item.warehouse_name for item in vm.m.init.warehouseList "
                                        ng-disabled = "vm.m.mode ==1 "
                                        >
                                        <option value="">Không có</option>
                                        </select>
                                </div>
                            </div>
                          
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Nhà cung ứng</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn nhà cung ứng'"
                                        ng-model="vm.m.filter.supplier_id"
                                        ng-options="item.supplier_id as item.name for item in vm.m.init.supplierList"
                                        >
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                           
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                                    <i class="fa fa-search fa-fw"></i>
                                    <span translate="COM_BTN_SEARCH"></span>
                                </button>
                                <button type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.resetFilter()">
                                    <i class="fa fa-eraser fa-fw"></i>
                                    <span translate="COM_BTN_RESET"></span>
                                </button>
                                <button ng-if="vm.can('screen.crm0913.download')" type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.download()">
                                    <i class="fa fa-download fa-fw"></i>
                                    Tải về
                                </button>
                            </div>
                            <div class="col-md-4 text-right">
                                <button  ng-if="vm.m.mode == 1 && vm.m.warehouseCheck.checking_sts!=1" type="button" class="btn btn-primary btn-sm btn-width-default" ng-click="vm.confirmWarehouse()">
                                    <i class="fa fa-save fa-fw"></i>
                                    <span> Xác nhận</span>
                                </button>
                                <button ng-if="vm.can('screen.crm0913.save')"  ng-click="vm.save()" class="btn btn-warning btn-sm btn-width-default" ng-disabled = "vm.m.is_check == false">
                                    <i class="fa fa-save fa-fw"></i>
                                    <span> Lưu lại</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-body">
                    
                        <div class="row">
                            <div class="col-md-6 col-sm-6" >
                                Tổng thể tích: {{vm.m.sumWarehouseVol| currency : '' : 2}} (m3) - Tổng giá trị: {{vm.m.sumWarehouse| currency : '' : 0}} - Tổng thùng: {{vm.m.sumWarehouseCart| currency : '' : 0}}
                            </div>
                        
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th ng-click="vm.sort('product_cat_name');" class="sortable">
                                        <span translate="CRM0130_LABEL_PRODUCT_CAT_NAME"></span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="product_cat_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th ng-click="vm.sort('product_code');" class="sortable">
                                        <span translate="CRM0130_LABEL_PRODUCT_CODE"></span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="product_code"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <!-- <th ng-click="vm.sort('product_name');" class="sortable">
                                        <span translate="CRM0130_LABEL_PRODUCT_NAME"></span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="product_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th> -->
                                    <th>
                                        Giá bán
                                    </th>
                                    <th>
                                        Đầu ngày
                                    </th>
                                    <th>
                                       
                                        <span class="text-primary"> Nhập nhà máy</span>
                                    </th>
                                    <th>
                                        <span class="text-primary">Nhập bảo hành</span>
                                        
                                    </th>
                                    <th>
                                        <span class="text-primary"> Nhập trả lại</span>
                                       
                                    </th>
                                  
                                    <th>
                                        <span class="text-primary">Nhập kho khác</span>
                                        
                                    </th>
                                    <th>
                                        <span class="text-primary">Điều chỉnh (+)</span>
                                    </th>
                                    <th>
                                        
                                        <span class="text-danger"> Xuất bán</span>
                                    </th>
                                    <th>
                                      <span class="text-danger"> Xuất kho khác</span>
                                       
                                    </th>
                                    
                                    <th>
                                        <span class="text-danger">Điều chỉnh (-)</span>
                                    </th>
                                    <th>
                                        Cuối ngày
                                    </th>
                                    <th>
                                        Thực tế
                                    </th>
                                    <th>
                                        Chênh lệch
                                    </th>
                                    <th>
                                        Giá trị
                                    </th>
                                    <th>
                                        Ghi chú
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list'>
                                    <td>{{$index + 1}}</td>
                                    <td>{{item.product_cat_name}}</td>
                                    <td>{{item.product_code}}<br/>
                                        <small>({{item.stock_code}})</small>
                                    </td>
                                    <!-- <td>{{item.name}}</td> -->
                                    <td>{{item.selling_price | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.start_num | currency : '' : 0}}</td>
                                    <td class="text-right "><span ng-if="item.in_num > 0" class="text-primary">+ {{item.in_num | currency : '' : 0}}</span></td>
                                    <td class="text-right "><span ng-if="item.in_num_warranty > 0" class="text-primary">+ {{item.in_num_warranty | currency : '' : 0}}</span></td>
                                    <td class="text-right "><span ng-if="item.in_num_return > 0" class="text-primary">+ {{item.in_num_return | currency : '' : 0}}</span></td>
                                    <td class="text-right"><span ng-if="item.in_num_warehouse > 0" class="text-primary">+{{item.in_num_warehouse| currency : '' : 0}}</span></td>
                                    <td class="text-right"><span ng-if="item.in_num_edit > 0" class="text-primary">+{{item.in_num_edit | currency : '' : 0}}</span></td>

                                    <td class="text-right "><span ng-if="item.out_num > 0"class="text-danger">-{{item.out_num | currency : '' : 0}}</span></td>
                                    <td class="text-right "><span ng-if="item.out_num_warehouse > 0"class="text-danger">-{{item.out_num_warehouse | currency : '' : 0}}</span></td>
                                    <td class="text-right"><span ng-if="item.out_num_edit > 0"class="text-danger">-{{item.out_num_edit | currency : '' : 0}}</span></td>


                                    <td class="text-right">{{item.end_num | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.amount | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.differrence | currency : '' : 0}}</td>
                                    <td>{{item.selling_price*item.end_num | currency : '' : 0}}</td>
                                    <!-- <td class="text-left">{{item.notes}}</td> -->
                                    <td>
                                        <input type="text" class="form-control ng-pristine ng-valid ng-empty text-left" ng-disabled = "vm.m.is_check == false"
                                            ng-model="item.notes" style="">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row text-right">
                        <div class="col-md-12">
                            <uib-pagination ng-show="vm.m.data.from > 0"
                                total-items="vm.m.data.total"
                                ng-model="vm.m.data.current_page"
                                items-per-page="vm.m.data.per_page"
                                ng-change="vm.doSearch(vm.m.data.current_page)"
                                class="pagination pagination-sm m-t-none m-b-none">
                            </uib-pagination>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
