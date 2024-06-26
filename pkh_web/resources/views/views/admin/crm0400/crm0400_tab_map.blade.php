
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Bản đồ giao hàng - Phiếu xuất (Mới -> Xuất kho)</h3>
                    <div class="box-tools pull-right">
                        <a ng-click="vm.search()" class="btn btn-info btn-xs"><i class="fa fa-refresh"></i></a>
                    </div>
                </div>
                <div class="box-body">
                    <div map-lazy-load="https://maps.google.com/maps/api/js?key=<% env('GOOGLE_MAP_KEY')%>">
                        <ng-map center="10.737462,106.711953" zoom="5" style="height: 640px" default-style="false">
                          
                            <info-window id="myInfoWindow" >
                                <div ng-non-bindable>
                                    <span ng-if="vm.m.is_store"><b>{{vm.m.selected.name}}</b></span><br/>
                                    <span ng-if="!vm.m.is_store"><b>Chành {{vm.m.selected.name}}</b></span><br/>
                                    <small>{{vm.m.selected.address}} {{vm.m.selected.area2_name}} {{vm.m.selected.area1_name}}</small><br/>
                                    <small><b>Sale: </b>{{vm.m.selected.salesman_name}}</small><br/>
                                    <small><b>Amount: </b>{{vm.m.selected.amount| currency: '' : 0}} (VND)</small><br/>
                                    <small><b>Carton:</b> {{vm.m.selected.carton| currency: '' : 0}} (carton)</small><br/>
                                    <small><b>Vol:</b> {{vm.m.selected.volume| currency: '' : 2}} (m3)</small><br/>
                                </div> 
                            </info-window>
                        </ng-map>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
                           
                       
    <div class="col-md-8 col-sm-12" >
        <h3>Đặt hàng mới</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th> </th>
                    <th>Store</th>
                    <th>Store address</th>
                    <th>Chanh address</th>
                    <th class="text-right">Pending (h)</th>
                    <th class="text-right">Carton</th>
                    <th class="text-right">Volume m3</th>
                    <th class="text-right">Amount</th>
                    
                </tr>
            </thead>
            <tbody>
                
                <tr ng-repeat='item in vm.m[vm.m.activeFlag].data2'>
                    <td>{{$index+1}}</td>
                    <td>{{item.name}}</td>
                    <td>{{item.area1}} - {{item.area2}}</td>
                    <td>{{item.area1_c}} - {{item.area2_c}}</td>
                    <td class="text-right">{{item.pending | currency : '' : 2}}</td>
                    <td class="text-right">{{item.carton | currency : '' : 0}}</td>
                    <td class="text-right">{{item.volume | currency : '' : 2}}</td>
                    <td class="text-right">{{item.amount | currency : '' : 0}}</td>
                </tr>
            </tbody>
        </table>
    </div>        
    <div class="col-md-4 col-sm-12">
        <div class="col-md-6 col-sm-6 text-right">
            <label class="switch">
                <input type="checkbox"  ng-model="vm.m.is_store" ng-change="vm.loadMap()" checked> 
                Xem theo cửa hàng
            </label>
        </div>
        <div class="col-md-6 col-sm-6 text-right">
            <label class="switch">
                <input type="checkbox"  ng-model="vm.m.is_chanh" ng-change="vm.loadMap()" checked> 
                Xem theo chành
            </label>
        </div>
       
    </div>    
    <div class="col-md-7 col-sm-12" >
        <h3>Phiếu xuất (Mới -> Xuất kho)</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th> </th>
                    <th>Store</th>
                    <th>Store address</th>
                    <th>Chanh address</th>
                    <th class="text-right">Pending (h)</th>
                    <th class="text-right">Carton</th>
                    <th class="text-right">Volume m3</th>
                    <th class="text-right">Numb del</th>
                    <th class="text-right">Amount</th>
                    
                </tr>
            </thead>
            <tbody>
                
                <tr ng-repeat='item in vm.m[vm.m.activeFlag].data1'>
                    <td>{{$index+1}}</td>
                    <td>{{item.name}}</td>
                    <td>{{item.area1}} - {{item.area2}}</td>
                    <td ng-if="item.chanh_id">
                        <a class="btn btn-xs btn-warning" ui-sref="app.crm0352({chanh_id: item.chanh_id})">
                        {{item.area1_c}} - {{item.area2_c}}
                        </a>
                    </td>
                    <td ng-if="!item.chanh_id">      
                        {{item.area1_c}} - {{item.area2_c}}
                    </td>
                    <td class="text-right">{{item.pending | currency : '' : 2}}</td>
                    <td class="text-right">{{item.carton | currency : '' : 0}}</td>
                    <td class="text-right">{{item.volume | currency : '' : 2}}</td>
                    <td class="text-right">{{item.del_numb | currency : '' : 0}}</td>
                    <td class="text-right">{{item.amount | currency : '' : 0}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    
    <div class="col-md-5 col-sm-12" >
        <h3>Người vận chuyển</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th> </th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th class="text-right">Max vol</th>
                    <th class="text-right">Max carton</th>
                    <th class="text-right">Avg vol</th>
                    <th class="text-right">Avg carton</th>                    
                </tr>
            </thead>
            <tbody>
                
                <tr ng-repeat='item in vm.m[vm.m.activeFlag].data3'>
                    <td>{{$index+1}}</td>
                    <td>{{item.name}}</td>
                    <td>{{item.phone}} </td>
                    
                    <td class="text-right">{{item.max_vol | currency : '' : 2}}</td>
                    <td class="text-right">{{item.max_cart | currency : '' : 2}}</td>
                    <td class="text-right">{{item.avg_vol | currency : '' : 2}}</td>
                    <td class="text-right">{{item.avg_cart | currency : '' : 2}}</td>
                  
                </tr>
            </tbody>
        </table>
    </div>
   
</div>
</section>