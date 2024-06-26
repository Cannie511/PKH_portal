<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="vm.cancel()"><span aria-hidden="true">&times;</span></button>
    <div class="modal-title">
        {{vm.m.item.name}}<br>
        <small>{{vm.m.item.address}}</small><br>
        <small>Phụ trách hiện tại: {{vm.m.item.salesman_name}}</small>
    </div>
    <div>
        <p style="color:red;"> Thời gian thanh toán trung bình {{vm.m.AVG | number : 2}} ngày</p>
        <p style="color:red;"> Còn nợ:  {{vm.m.item.remain | currency : '' : 0}}</p>
    </div>
        
    <div>
        <button ng-click="vm.showDetail()" ><i class="fa fa-superpowers" >Chi tiết</i></button>
    </div>
</div>
<div class="modal-body">
   <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>   
                    <th></th>
                    <th>NO</th>
                    <th class="text-right">Ngày giao</th>
                    <th class="text-right">Doanh số</th>
                    <th class="text-right">Ngày thanh toán</th>
                    <th class="text-right">Độ trễ</th>
                    <th class="text-right"  ng-if="vm.m.detail ==-1">Tổng doanh số</th>
                    <th class="text-right"  ng-if="vm.m.detail ==-1">Tổng thanh toán</th>
                   
                </tr>
            </thead>
            <!--  ng-if="(item.old_total >0) || (item.new_total >0)"-->
            <tbody>
                <tr ng-repeat='item1 in vm.m.data'>
                    <td class="col-action">
                        <span> <a ui-sref='app.crm0411({store_delivery_id: item1.store_delivery_id, store_order_id: item1.store_order_id})'>>></a></span>
                    </td>
                    <td>{{$index +1}}</td>
                    <td class="text-right">{{item1.delivery_date}}</td>
                    <td class="text-right">{{item1.total_with_discount | currency : '' : 0}}</td>
                    <td class="text-right">{{item1.payment_date}}</td>
                    <td class="text-right">{{item1.diff | currency : '' : 0}} - ngày</td>
                    <td class="text-right" ng-if="vm.m.detail ==-1">{{item1.deliveryTotal | currency : '' : 0}}</td>
                    <td class="text-right"  ng-if="vm.m.detail ==-1">{{item1.paymentTotal | currency : '' : 0}}</td>
                  
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success" data-dismiss="modal" ng-click="vm.cancel()">Đóng</button>
</div>