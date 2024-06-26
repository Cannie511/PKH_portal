<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Hàng bảo hành và trả lại</h3>
          <p>
          Note:
          
            <br>
            Dữ liệu bảo hành và trả lại cho đại lý, nếu không chọn loại nhập thì số lượng là tổng của hai loại này.
            <br>   <br>
            Đối với loại dữ liệu là cửa hàng, vui lòng lưu ý trường hợp cửa hàng trùng nhau.
            <br> Ví dụ: số cửa hàng mua WT001Q và WT001I trong tháng 1-2019 có thể tập hợp giao nhau. 
            <br> Ví dụ: số cửa hàng mua WT001Q trong tháng 1-2019 và 2-2019 có thể giao nhau. 
            <br> Do đó việc lấy tổng cửa hàng trong màn hình này đối với cửa hàng theo tháng hay theo năm không thể tham khảo.
            <br>   <br>
            Đối với loại dữ liệu là tỉnh thành cũng tương tự như trên.
            <br>   <br>
            <br>
            Line chart: Tab name  - loai du lieu - product name - Vung - Tinh/thanh - NVBH
            <br>
            Bar chart: Timemode - Tab name - Loai nhap - Loai du lieu - Loai san pham  - column name - Vung - Tinh/thanh - NVBH 
            <br>   <br>
            Màn hình chi tiết tham khảo: https://portal.phankhangco.com/#/crm1640 (tab nhập hàng bảo hành - trả lại)
        </p>
    </div>
    <div class="box-body form" >
        <form class="form" ng-submit="vm.loadData(vm.m.activeFlag)">
            <div class="row">
               

                <div  class="col-md-3 col-sm-6 m-b-xs">
                    <div class="form-group">
                        <label>Year</label>
                        <p class="input-group">
                            <input class="form-control" datetimepicker ng-model="vm.m[vm.m.activeFlag].filter.year" placeholder="Year" options="vm.m.datetimepicker_options"/>
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </p>
                    </div> 
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="product_code">PKH code</label>
                        <input type="text" class="form-control" id="product_code" ng-model="vm.m[vm.m.activeFlag].filter.product_code" />
                    </div>
                </div>

            
            </div>
            <div  class="row">
                <div class="col-md-3 col-sm-6 m-b-xs">
                    <div class="form-group">
                        <label>Vùng</label>
                        <select class="form-control"     
                            chosen                               
                            placeholder-text-single="'Chọn tỉnh'"
                            ng-model="vm.m[vm.m.activeFlag].filter.area_group_id"
                            ng-options="item.area_group_id as item.name for item in vm.m.init.listAreaGroup"
                            >
                            <option value="">Tất cả</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 m-b-xs">
                    <div class="form-group">
                        <label>Tỉnh/Thành</label>
                        {{vm.m[vm.m.activeFlag].filter.area1}}
                        <select class="form-control"     
                            chosen                               
                            placeholder-text-single="'Chọn tỉnh'"
                            ng-model="vm.m[vm.m.activeFlag].filter.area1"
                            ng-options="item.area_id as item.name for item in vm.m.init.listArea1  | filter : {'area_group_id': vm.m[vm.m.activeFlag].filter.area_group_id}"
                            >
                            <option value="">Tất cả</option>
                        </select>
                    </div>
                </div>
                <div  class="col-md-3 col-sm-6 m-b-xs">
                    <div class="form-group">
                        <label>Nhân viên bán hàng</label>
                        <select class="form-control"     
                            chosen                               
                            placeholder-text-single="'Chọn chương trình'"
                            ng-model="vm.m[vm.m.activeFlag].filter.salesman_id"
                            ng-options="item.id as item.name for item in vm.m.init.salesmanList "
                            >
                            <option value="">Không có</option>
                            </select>
                    </div>
                </div>
               
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6 m-b-xs">
                    <div class="form-group"> 
                        <label>Loại dữ liệu</label>
                        <select class="form-control"     
                            chosen                               
                            placeholder-text-single="'Chọn loai'"
                            ng-model="vm.m[vm.m.activeFlag].filter.data_type"
                            ng-options="item.id as item.name for item in vm.m.init.listDataType"
                            >
                        </select>
                    
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 m-b-xs">
                    <div class="form-group">
                        <label>Loại sản phẩm</label>
                            <select class="form-control"     
                            chosen                               
                            placeholder-text-single="'Chọn nơi xuất'"
                            ng-model="vm.m[vm.m.activeFlag].filter.product_cat_id"
                            ng-options="item.product_cat_id as item.name for item in vm.m.init.catList "
                            >
                            <option value="">Không có</option>
                            </select>
                    </div>
                </div>

                
                <div class="col-md-3 col-sm-6 m-b-xs">
                    <div class="form-group">
                        <label>Loại Nhập</label>
                        <select class="form-control" ng-model="vm.m[vm.m.activeFlag].filter.import_type" ng-init="vm.m[vm.m.activeFlag].filter.import_type = ''">
                            <option value="">Tất cả</option>
                            <option value="1">Bảo Hành</option>
                            <option value="2">Trả Lại</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 m-b-xs">
                    <div class="form-group">
                        <label>Loại Handle</label>
                            <select class="form-control"     
                            chosen                               
                            placeholder-text-single="'Chọn nơi xuất'"
                            ng-model="vm.m[vm.m.activeFlag].filter.handle_id"
                            ng-options="item.handle_id as item.name for item in vm.m.init.handleList "
                            >
                            <option value="">Không có</option>
                            </select>
                    </div>
                </div>
              

            </div>
            <div class="row">
                <div  class="col-md-3 col-sm-6 m-b-xs">
                    <div class="form-group">
                        <label>Time mode</label>
                        <select class="form-control" ng-model="vm.m[vm.m.activeFlag].filter.time_mode"  >
                            <!-- <option value="">Null</option> -->
                            <option value="0">Xem theo tháng</option>
                            <option value="1">Xem theo năm</option>    
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 m-b-xs">
                    <div class="form-group">
                        <label>Chế độ xem</label>
                        <select class="form-control"     
                            chosen                               
                            placeholder-text-single="'Chọn view mode'"
                            ng-model="vm.m[vm.m.activeFlag].filter.view_mode"
                            ng-options="item.id as item.name for item in vm.m.init.listViewMode"
                            >
                            <option value="">Tất cả</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 m-b-xs">
                    <div class="form-group">
                        <label>Nhà cung ứng</label>
                        <select class="form-control"     
                            chosen                               
                            placeholder-text-single="'Chọn nhà cung ứng'"
                            ng-model="vm.m[vm.m.activeFlag].filter.supplier_id"
                            ng-options="item.supplier_id as item.name for item in vm.m.init.supplierList"
                            >
                            <option value="">Tất cả</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                        <i class="fa fa-search fa-fw"></i>
                        <span translate="COM_BTN_SEARCH"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.resetFilter(vm.m.activeFlag)">
                        <i class="fa fa-eraser fa-fw"></i>
                        <span translate="COM_BTN_RESET"></span>
                    </button>
                    
                </div>
            </div>
        </form>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>      
                    <tr>        
                        <td></td>   
                        <td></td>                        
                        <td ng-repeat ='item in vm.m[vm.m.activeFlag].data.header' class="text-right"><button ng-if="itemArea!='Product code' && itemArea!='Stock code'" ng-click="vm.draw_vertical(vm.m.activeFlag,item)" class="btn btn-success btn-xs"><i  class="fa fa-bar-chart fa-lg" ></i></button></td>                                       
                    </tr>            
                    <tr>        
                        <td></td>   
                        <td><b>No</b></td>                        
                        <td ng-repeat ='item in vm.m[vm.m.activeFlag].data.header' class="text-right"><b>{{item}}</b></td>                                       
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat='item3 in vm.m[vm.m.activeFlag].data.data'>
                        <td >
                            <button ng-if="$index>2 && vm.m[vm.m.activeFlag].filter.time_mode==0" class="btn btn-warning btn-xs" ng-click="vm.compare(item3)"><i class="fa fa-line-chart"></i></button>
                            <button  class="btn btn-success btn-xs" ng-click="vm.line_chart(item3)"><i class="fa fa-bar-chart"></i></button>
                        </td>
                        <td >
                            <span ng-if="$index>2">{{$index-2}}</span>
                        </td>                                            
                        <td ng-repeat ='itemArea in vm.m[vm.m.activeFlag].data.header' class="text-right">
                            <span ng-if="itemArea!='Name'" > {{item3[itemArea] | currency: '' : 0 }} </span>
                            <span ng-if="itemArea=='Name' " class="text-left"> {{item3[itemArea]}} </span>
                        </td>                              
                    </tr>   
                </tbody>
            </table>
        </div>
    </div>
</div>