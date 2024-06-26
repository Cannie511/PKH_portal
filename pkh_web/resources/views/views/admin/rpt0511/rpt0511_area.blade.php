<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Area</h3>
        
    </div>
    <div class="box-body form" >
        <form class="form" ng-submit="vm.loadData(vm.m.activeFlag)">
            <div class="row">

                <div ng-if="vm.m.init.isSale==0" class="col-md-3 col-sm-6 m-b-xs">
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
                            <span  ng-if="itemArea!='Name'"> {{item3[itemArea] | currency: '' : 0 }} </span>
                            <span ng-if="itemArea=='Name'" class="text-left"> {{item3[itemArea]}} </span>
                        </td>                              
                    </tr>   
                </tbody>
            </table>
        </div>
    </div>
</div>