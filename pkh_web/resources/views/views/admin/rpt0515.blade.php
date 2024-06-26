<section class="content-header">
     <h1>Báo cáo chương trình<small></small></h1>
    <!-- <ol class="breadcrumb">
    <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
    <li class="active">Lịch nghỉ nghep</li>
    </ol> -->
</section>
<section class="content">
    
    <div class="tab-content" style="margin-top: 3px">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body form">
                        <form role="form" ng-submit="vm.search(vm.m.filter.promotion_id,vm.m.activeFlag)">
                            <div class="row">
                                <div class="col-md-3 col-sm-6 m-b-xs">
                                    <div class="form-group">
                                        <label>Chương trình</label>
                                        <select class="form-control"     
                                            chosen                               
                                            placeholder-text-single="'Chọn chương trình'"
                                            ng-model="vm.m.filter.promotion_id"
                                            ng-options="item.promotion_id as item.promotion_name for item in vm.m.listPromotion "
                                            >
                                            <option value="">Không có</option>
                                            </select>
                                    </div>                                   
                                </div>
                                <div class="col-md-3 col-sm-6 m-b-xs">
                                    <div class="form-group">
                                        <label>Từ ngày</label>
                                        <p class="input-group">
                                            <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.filter.start_date" is-open="vm.dp1Opened" datepicker-options="vm.m.dateOptions" close-text="Close"
                                            ng-model-options="{timezone: 'utc'}" />
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default" ng-click="vm.dp1Opened = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                            </span>
                                        </p>
                                    </div> 
                                </div>

                                <div class="col-md-3 col-sm-6 m-b-xs">
                                    <div class="form-group">
                                        <label>Đến ngày</label>
                                        <p class="input-group">
                                            <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.filter.end_date" is-open="vm.dp2Opened" datepicker-options="vm.m.dateOptions" close-text="Close"
                                            ng-model-options="{timezone: 'utc'}" />
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default" ng-click="vm.dp2Opened = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                            </span>
                                        </p>
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
                    <div class="box-header with-border">
                        <ul class="nav nav-tabs">
                            <li ng-class="{'active': vm.m.activeFlag == 1}"><a href="javascript:void(0)" ng-click="vm.choose(1)"><h4>Nhân viên bán hàng</h4></a></li>
                            <li ng-class="{'active': vm.m.activeFlag == 2 }"><a href="javascript:void(0)" ng-click="vm.choose(2)"><h4>Khu vực</h4></a></li>
                            <li ng-class="{'active': vm.m.activeFlag == 3 }"><a href="javascript:void(0)" ng-click="vm.choose(3)"><h4>Cấp</h4></a></li>
                            <li ng-class="{'active': vm.m.activeFlag == 4 }"><a href="javascript:void(0)" ng-click="vm.choose(4)"><h4>Sản phẩm</h4></a></li>
                            <li ng-class="{'active': vm.m.activeFlag == 5 }"><a href="javascript:void(0)" ng-click="vm.choose(5)"><h4>Cửa hàng</h4></a></li>
                        </ul>
                    </div>
                    
                    <div ng-if="vm.m.activeFlag == 1">
                        <div class="table-responsive" >
                            <h4></h4>

                            <table class="table table-striped table-border">
                                <thead>  
                                     <tr>
                                        <th></th>
                                        <th></th>
                                        
                                        <th colspan="3" class="text-center">Đặt hàng</th>
                                        <th colspan="3" class="text-center">Giao hàng</th>                                   
                                    </tr>                
                                    <tr>        
                                        <th>No</th>
                                        <th>Nhân viên kinh doanh</th>
                                        <th class="text-right">Số đơn</th>
                                        <th class="text-right">Doanh số (0CK)</th>
                                        <th class="text-right">Doanh số (CK)</th>
                                        <th class="text-right"> Số đơn</th>
                                        <th class="text-right">Doanh số (0CK)</th>
                                        <th class="text-right">Doanh số (CK)</th>
                                    </tr>
                                </thead>
                                <tbody>                         
                                    <tr ng-repeat='itemTab1 in vm.m[vm.m.filter.promotion_id][vm.m.activeFlag].data'>
                                        <td>{{$index+1}}</td>                                            
                                        <td>{{itemTab1.name}}</td>
                                        <td class="text-right">{{itemTab1.orderCount | currency: '' : 0}}</td> 
                                        <td class="text-right">{{itemTab1.orderSum | currency: '' : 0}}</td> 
                                        <td class="text-right">{{itemTab1.orderSumDis | currency: '' : 0}}</td> 
                                        <td class="text-right">{{itemTab1.deliveryCount | currency: '' : 0 }}</td> 
                                        <td class="text-right">{{itemTab1.deliverySum | currency: '' : 0}}</td>  
                                        <td class="text-right">{{itemTab1.deliverySumDis | currency: '' : 0}}</td>                         
                                    </tr>                                     
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div ng-if="vm.m.activeFlag == 2">
                        <div class="table-responsive" >
                            <h4></h4>

                            <table class="table table-striped table-border">
                                <thead>  
                                     <tr>
                                        <th></th>
                                        <th></th>
                                        
                                        <th colspan="3" class="text-center">Đặt hàng</th>
                                        <th colspan="3" class="text-center">Giao hàng</th>                                   
                                    </tr>                
                                    <tr>        
                                        <th>No</th>
                                        <th>Tỉnh</th>
                                        <th class="text-right">Số đơn</th>
                                        <th class="text-right">Doanh số (0CK)</th>
                                        <th class="text-right">Doanh số (CK)</th>
                                        <th class="text-right"> Số đơn</th>
                                        <th class="text-right">Doanh số (0CK)</th>
                                        <th class="text-right">Doanh số (CK)</th>
                                    </tr>
                                </thead>
                                <tbody>                         
                                    <tr ng-repeat='itemTab1 in vm.m[vm.m.filter.promotion_id][vm.m.activeFlag].data'>
                                        <td>{{$index+1}}</td>                                            
                                        <td>{{itemTab1.name}}</td>
                                        <td class="text-right">{{itemTab1.orderCount | currency: '' : 0}}</td> 
                                        <td class="text-right">{{itemTab1.orderSum | currency: '' : 0}}</td> 
                                        <td class="text-right">{{itemTab1.orderSumDis | currency: '' : 0}}</td> 
                                        <td class="text-right">{{itemTab1.deliveryCount | currency: '' : 0 }}</td> 
                                        <td class="text-right">{{itemTab1.deliverySum | currency: '' : 0}}</td>  
                                        <td class="text-right">{{itemTab1.deliverySumDis | currency: '' : 0}}</td>                         
                                    </tr>                                     
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div ng-if="vm.m.activeFlag == 3">
                        Waiting is happiness
                    </div>
                    <div ng-if="vm.m.activeFlag == 4">
                        <div class="table-responsive" >
                            <h4></h4>

                            <table class="table table-striped table-border">
                                <thead>  
                                    
                                    <tr>        
                                        <th>No</th>
                                        <th>Mã sản phẩm</th>
                                        <th class="text-right">Lượng đặt</th>
                                        <th class="text-right">Lượng giao</th>
                                    </tr>
                                </thead>
                                <tbody>                         
                                    <tr ng-repeat='itemTab1 in vm.m[vm.m.filter.promotion_id][vm.m.activeFlag].data'>
                                        <td>{{$index+1}}</td>                                            
                                        <td>{{itemTab1.name}}</td>
                                        <td class="text-right">{{itemTab1.orderQty | currency: '' : 0}}</td> 
                                        <td class="text-right">{{itemTab1.deliveryQty | currency: '' : 0}}</td> 
                                       
                                    </tr>                                     
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div ng-if="vm.m.activeFlag == 5">
                        <div class="table-responsive" >
                            <h4></h4>

                            <table class="table table-striped table-border">
                                <thead>  
                                     <tr>
                                        <th></th>
                                        <th></th>
                                        
                                        <th colspan="3" class="text-center">Đặt hàng</th>
                                        <th colspan="3" class="text-center">Giao hàng</th>                                   
                                    </tr>                
                                    <tr>        
                                        <th>No</th>
                                        <th>Cửa hàng</th>
                                        <th class="text-right">Số đơn</th>
                                        <th class="text-right">Doanh số (0CK)</th>
                                        <th class="text-right">Doanh số (CK)</th>
                                        <th class="text-right"> Số đơn</th>
                                        <th class="text-right">Doanh số (0CK)</th>
                                        <th class="text-right">Doanh số (CK)</th>
                                    </tr>
                                </thead>
                                <tbody>                         
                                    <tr ng-repeat='itemTab5 in vm.m[vm.m.filter.promotion_id][vm.m.activeFlag].data'>
                                        <td>{{$index+1}}</td>                                            
                                        <td>{{itemTab5.name}}<br>
                                            <small>{{itemTab5.address}}</small>
                                        </td>
                                        <td class="text-right">{{itemTab5.orderCount | currency: '' : 0}}</td> 
                                        <td class="text-right">{{itemTab5.orderSum | currency: '' : 0}}</td> 
                                        <td class="text-right">{{itemTab5.orderSumDis | currency: '' : 0}}</td> 
                                        <td class="text-right">{{itemTab5.deliveryCount | currency: '' : 0 }}</td> 
                                        <td class="text-right">{{itemTab5.deliverySum | currency: '' : 0}}</td>  
                                        <td class="text-right">{{itemTab5.deliverySumDis | currency: '' : 0}}</td>                         
                                    </tr>                                     
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</section>
