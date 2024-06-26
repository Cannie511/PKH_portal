<div class="tab-pane" ng-class="{'active': vm.m.activeFlag == 5}">
    <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Giá trị hàng nợ chưa giao (Đơn vị tiền tệ: 1.000 VND)</h3>
                <p>
                    <br>
                    Line chart: Year - Tab name - store name 
                    <br>
                    Bar chart: Timemode - Tab name - column name - Vung - Tinh/thanh - NVBH
                </p>
            </div>
            <div class="box-body form">
                <form class="form" ng-submit="vm.loadData(vm.m.activeFlag)">
                    <div class="row">
                        
                        <div class="col-md-3 col-sm-6 m-b-xs">
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
                                <label for="branch_address">Store name</label>
                                <input type="text" class="form-control" id="store" ng-model="vm.m[vm.m.activeFlag].filter.store_name" />
                            </div>
                        </div>

                        
                       
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-6 m-b-xs">
                            <div class="form-group">
                                <label>Vùng</label>
                                <select class="form-control"     
                                    chosen                               
                                    placeholder-text-single="'Chọn tỉnh'"
                                    ng-model="vm.m[vm.m.activeFlag].filter.areaGroup"
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
                                    ng-options="item.area_id as item.name for item in vm.m.init.listArea1  | filter : {'area_group_id': vm.m[vm.m.activeFlag].filter.areaGroup}"
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
                            <button type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.download(vm.m.activeFlag)">
                                <i class="fa fa-download fa-fw"></i>
                                Download
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
                                <td ng-repeat ='itemArea in vm.m[vm.m.activeFlag].data.header' class="text-right">
                                    <button  class="btn btn-success btn-xs" ng-click="vm.draw_vertical(vm.m.activeFlag, itemArea)" ><i class="fa fa-bar-chart"></i></button>
                                </td>                                       
                            </tr>              
                            <tr>        
                                <td></td>   
                                <td><b>No</b></td>                        
                                <td ng-repeat ='itemArea in vm.m[vm.m.activeFlag].data.header' class="text-right"><b>{{itemArea}}</b></td>                                       
                            </tr>

                        </thead>
                        <tbody>
                            <tr ng-repeat='item3 in vm.m[vm.m.activeFlag].data.data'>
                               
                                <td >
                                    <button ng-if="$index>2 && vm.m[vm.m.activeFlag].filter.time_mode==0" class="btn btn-warning btn-xs" ng-click="vm.compare(item3)"><i class="fa fa-line-chart"></i></button>
                                    <button  class="btn btn-success btn-xs" ng-click="vm.line_chart(item3)"><i class="fa fa-bar-chart"></i></button>
                                </td>
                                <td>
                                   <span ng-if="$index>2"> {{$index-2}} </span>
                                </td>                                            
                                <td ng-repeat ='itemArea in vm.m[vm.m.activeFlag].data.header' class="text-right">
                                    <span ng-if="itemArea!='Product code'" > {{item3[itemArea]| currency: '' : 0 }} </span>
                                    <span ng-if="itemArea=='Name' " class="text-left"> 
                                            {{item3[itemArea]}} <br>
                                            
                                           
                                     </span>
                                    <span ng-if="itemArea=='Province' " class="text-left"> {{item3[itemArea]}} </span>
                                </td>                              
                            </tr>   
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>