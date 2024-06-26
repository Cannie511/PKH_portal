<section class="content-header">
    <h1>Report<small></small></h1>
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
                    <h3 class="box-title">Report doanh số </h4>
                  
                </div>
                <div class="box-body form">
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="from_date">Ngày</label>
                                    <p class="input-group">
                                        <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.filter.date" is-open="vm.dp1Opened" datepicker-options="vm.m.dateOptions" close-text="Close"
                                        ng-model-options="{timezone: 'utc'}" />
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" ng-click="vm.dp1Opened = true"><i class="glyphicon glyphicon-calendar"></i></button>
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
                            </div>           
                        </div>                    
                    </form>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6" ng-repeat='item in vm.m.data.table1'>
                            <div class="table-responsive">
                                <h4>{{item.header}}</h4>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th colspan="2" class="text-center">Order</th>
                                            <th colspan="2" class="text-center">Deliveried</th>                                   
                                        </tr>
                                        <tr >
                                            <th></th>                                   
                                            <th class="text-right">Unit</th>
                                            <th class="text-right">Turn over</th>
                                            <th class="text-right">Unit</th>
                                            <th class="text-right">Turn over</th>                                  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat='item1 in item.data'>
                                            <td>{{item1.orderTime}}</td>
                                            <td class="text-right">{{item1.orderCount}}</td>
                                            <td class="text-right">{{item1.orderMoney | currency: '' : 0}}</td>
                                            <td class="text-right">{{item1.deliveryCount}}</td>
                                            <td class="text-right">{{item1.deliveryMoney| currency: '' : 0}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive" >
                        <h4>DOANH SỐ CÁC CẤP QUA TỪNG THÁNG (Delivery)</h4>
                        <table class="table table-striped table-border">
                            <thead>                             
                                <tr >
                                    <td> </td>   
                                    <td ng-repeat ='itemArea in vm.m.data.table2.header' class="text-right"><b>{{itemArea}}</b>&nbsp;<button ng-if="itemArea!='Time'" ng-click="vm.draw(2,vm.m.data.table2.data,itemArea,2,1,1,'','')" class="btn btn-success btn-xs"><i ng-if="itemArea!='Time'" class="fa fa-line-chart" ></i></button></td>        
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item2 in vm.m.data.table2.data'>
                                    <td>
                                        <button class="btn btn-success btn-xs" ng-click="vm.draw(2,item2,'',1,0,1,'',vm.m.data.table2.header)"><i class="fa fa-bar-chart"></i></button>
                                        <button class="btn btn-success btn-xs" ng-click="vm.draw(2,item2,'',3,0,1,'',vm.m.data.table2.header)"><i class="fa fa-pie-chart"></i></button>
                                    </td>
                                    <td ng-repeat ='itemArea in vm.m.data.table2.header' class="text-right">
                                        <span ng-if="itemArea!='Time'"> {{item2[itemArea] | currency: '' : 0 }} </span>
                                        <span ng-if="itemArea=='Time'"><b> {{item2[itemArea] }} </b></span>
                                    </td>                           
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
