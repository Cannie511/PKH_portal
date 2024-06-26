<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Product delivered to customer</h3>
        
    </div>
    <div class="box-body form" >
        <form class="form" ng-submit="vm.loadData(vm.m.activeFlag)">
            <div class="row">
                <div ng-if="vm.m.activeFlag==2" class="col-md-3 col-sm-6 m-b-xs">
                    <div class="form-group">
                        <label>Loại Dữ liệu</label>
                        <select class="form-control" ng-model="vm.m[vm.m.activeFlag].filter.data_type"  ng-init="vm.m[vm.m.activeFlag].filter.type = '1'">
                            <!-- <option value="">Null</option> -->
                            <option value="1">Số lượng</option>
                            <option value="2">Số tiền chưa CK (1.000 VND)</option>    
                        </select>
                    </div>
                </div>

                <div ng-if="vm.m.activeFlag!=3" class="col-md-3 col-sm-6 m-b-xs">
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

                <div ng-if="vm.m.activeFlag==3" class="col-md-3 col-sm-6 m-b-xs">
                    <div class="form-group">
                        <label>Loại </label>
                        <select class="form-control" ng-model="vm.m[vm.m.activeFlag].filter.type" ng-init="vm.m[vm.m.activeFlag].filter.type = ''">
                            <option value="">Tất cả</option>
                            <option value="1">Nhập</option>
                            <option value="2">Xuất</option>    
                        </select>
                    </div>
                </div>
            </div>
            <div ng-if="vm.m.activeFlag==2" class="row">
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
                        <td ng-if="vm.m.activeFlag!=3"><button class="btn btn-warning btn-xs" ng-click="vm.compare(item3)"><i class="fa fa-line-chart"></i></button></td>
                        <td>{{$index+1}}</td>                                            
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