<div >

    
        <div class="col-sm-12 col-md-5">
            <div class="box box-info">
                 <div class="box-header with-border">
                    <h3 class="box-title">Store information</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-12" >
                            <label>Cửa hàng</label>
                            <p class="form-control-static">
                            <a ui-sref='app.crm2600({store_id: item.store_id})'>#Detail</a>
                            {{vm.m.init.store.name}}</p>
                    </div>
                    <div class="col-md-12">
                            <label>Khu vực</label>
                            <p class="form-control-static">{{vm.m.init.store.area1_name}} {{vm.m.init.store.area2_name}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Địa chỉ</label>
                            <p class="form-control-static">{{vm.m.init.store.address}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Cấp cửa hàng</label>
                            <p class="form-control-static">{{vm.m.init.store.level}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Chiết khấu chính sách</label>
                            <p class="form-control-static">{{vm.m.init.store.discount}} %</p>
                        </div>
                        <div class="col-md-12">
                            <label>Ghi chú</label>
                            <p class="form-control-static">{{vm.m.init.store.notes}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Địa chỉ chành</label>
                            <p class="form-control-static">{{vm.m.init.store.address_chanh}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Người liên hệ</label>
                            <p class="form-control-static">{{vm.m.init.store.contact_name}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Fax</label>
                            <p class="form-control-static">{{vm.m.init.store.contact_fax}}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Điện thoại</label>
                            <p class="form-control-static">{{vm.m.init.store.contact_mobile1}} {{vm.m.init.store.contact_mobile2}} {{vm.m.init.store.contact_tel}}</p>
                        </div>
                         <div class="col-md-12">
                            <label>Phụ trách hiện tại (Salesman)</label>
                            <p class="form-control-static">{{vm.m.init.store.salesman_name}}</p>
                        </div>

                </div>
            </div>
        </div>

        <div class="col-md-6" ng-if="vm.m.chart.chartStatisticDelivery">
            <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Doanh số sau CK</h3>
                  <div class="box-tools pull-right">
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                  </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                        
                            <div class="chart">
                                <canvas id="chartDelivery" class="chart chart-bar" 
                                    chart-data="vm.m.chart.chartStatisticDelivery.data" 
                                    chart-labels="vm.m.chart.chartStatisticDelivery.labels" 
                                    chart-legend="false" 
                                    chart-series="vm.m.chart.chartStatisticDelivery.series" 
                                    chart-options="vm.m.chart.chartStatisticDelivery.options" 
                                    chart-colors ="vm.m.chart.chartStatisticDelivery.colors"
                                   >
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div  ng-if="vm.m[1].data" class="table-responsive col-sm-12">
            <div class="box box-info">
                <h3>Doanh số (1000 VND)</h3> 
                <table class="table table-striped">
                    <thead>
                        <tr >
                            <th>No </th>
                            <th>Year </th>
                            <th ng-repeat='item in vm.m.init.month' class="text-right">{{item.month}}</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='item in vm.m.init.year'>
                            
                            <td>{{$index+1}}</td>        
                            <td>{{item["year"]}}</td>
                            <td ng-repeat ='itemSales in vm.m.init.month' class="text-right">
                                {{vm.m[1].data.turnover[item['year']][itemSales['month']]| currency: '' : 0}}
                                <!-- {{vm.m.data3[itemSales['id']][item["product_id"]]| currency: '' : 0}} -->
                            </td>
                            <td class="text-right">
                            {{vm.m[1].data.turnover[item['year']]['total']| currency: '' : 0}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div  ng-if="vm.m[1].data" class="table-responsive col-sm-12">
            <div class="box box-info">
                <h3>  Tỉ lệ chuyển khoản thanh toán (%)</h3> 
                <table class="table table-striped">
                    <thead>
                        <tr >
                            <th>No </th>
                            <th>Year </th>
                            <th ng-repeat='item in vm.m.init.month' class="text-right">{{item.month}}</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='item in vm.m.init.year'>
                            
                            <td>{{$index+1}}</td>        
                            <td>{{item["year"]}}</td>
                            <td ng-repeat ='itemSales in vm.m.init.month' class="text-right">
                                {{vm.m[1].data.paymentck[item['year']][itemSales['month']]| currency: '' : 0}}
                                <!-- {{vm.m.data3[itemSales['id']][item["product_id"]]| currency: '' : 0}} -->
                            </td>
                            <td class="text-right">
                            {{vm.m[1].data.paymentck[item['year']]['total']| currency: '' : 0}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div  ng-if="vm.m[1].data" class="table-responsive col-sm-12">
            <div class="box box-info">
                <h3>Thời hạn thanh toán (days)</h3> 
                <table class="table table-striped">
                    <thead>
                        <tr >
                            <th>No </th>
                            <th>Year </th>
                            <th ng-repeat='item in vm.m.init.month' class="text-right">{{item.month}}</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='item in vm.m.init.year'>
                            
                            <td>{{$index+1}}</td>        
                            <td>{{item["year"]}}</td>
                            <td ng-repeat ='itemSales in vm.m.init.month' class="text-right">
                                {{vm.m[1].data.payment[item['year']][itemSales['month']]| currency: '' : 2}}
                                <!-- {{vm.m.data3[itemSales['id']][item["product_id"]]| currency: '' : 0}} -->
                            </td>
                            <td class="text-right">
                            {{vm.m[1].data.payment[item['year']]['total']| currency: '' : 2}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div  ng-if="vm.m[1].data" class="table-responsive col-sm-12">
            <div class="box box-info">
                <h3>Checkin (lần)</h3> 
                <table class="table table-striped">
                    <thead>
                        <tr >
                            <th>No </th>
                            <th>Year </th>
                            <th ng-repeat='item in vm.m.init.month' class="text-right">{{item.month}}</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='item in vm.m.init.year'>
                            
                            <td>{{$index+1}}</td>        
                            <td>{{item["year"]}}</td>
                            <td ng-repeat ='itemSales in vm.m.init.month' class="text-right">
                                {{vm.m[1].data.checkin[item['year']][itemSales['month']]| currency: '' : 0}}
                                <!-- {{vm.m.data3[itemSales['id']][item["product_id"]]| currency: '' : 0}} -->
                            </td>
                            <td class="text-right">
                            {{vm.m[1].data.checkin[item['year']]['total']| currency: '' : 0}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div  ng-if="vm.m[1].data" class="table-responsive col-sm-12">
            <div class="box box-info">
                <h3>CS (lần)</h3> 
                <table class="table table-striped">
                    <thead>
                        <tr >
                            <th>No </th>
                            <th>Year </th>
                            <th ng-repeat='item in vm.m.init.month' class="text-right">{{item.month}}</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='item in vm.m.init.year'>
                            
                            <td>{{$index+1}}</td>        
                            <td>{{item["year"]}}</td>
                            <td ng-repeat ='itemSales in vm.m.init.month' class="text-right">
                                {{vm.m[1].data.cs[item['year']][itemSales['month']]| currency: '' : 0}}
                                <!-- {{vm.m.data3[itemSales['id']][item["product_id"]]| currency: '' : 0}} -->
                            </td>
                            <td class="text-right">
                            {{vm.m[1].data.cs[item['year']]['total']| currency: '' : 0}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

       


</div>