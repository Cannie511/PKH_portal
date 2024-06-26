<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Kiểm hàng còn nợ (theo số lượng)</h3>
        <p>
            <br>
            Line chart: Tab name  - product name - NVBH
            <br>
            Bar chart: Timemode - Tab name - column name - NVBH 
            <br>   <br>
            Màn hình chi tiết tham khảo: 
            <br>
            https://portal.phankhangco.com/#/crm0220
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
                        <select class="form-control" ng-model="vm.m[vm.m.activeFlag].filter.time_mode" >
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
                        <td ng-repeat ='item in vm.m[vm.m.activeFlag].data.header' class="text-right"><button ng-if="itemArea!='Product code' && itemArea!='Stock code'" ng-click="vm.draw_vertical(vm.m.activeFlag,item)" class="btn btn-success btn-xs"><i  class="fa fa-bar-chart fa-lg" ></i></button></td>                                       
                    </tr>            
                    <tr>        
                        
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