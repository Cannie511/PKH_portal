<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>NO</th>
                <th>Mã đơn hàng</th>
                <th>
                    NCU
                </th>
                <th>Kho xuất</th>
                <th>Tên cửa hàng</th>
                <th>Chiết khấu</th>
                <th>Tổng tiền/<br/> Sau chiết khấu</th>
                <th>Tình trạng</th>
                <th>Ghi chú</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat='item in vm.m.deliveryToday'>
                <td>{{$index + 1}}</td>
                <td>
                    <a ui-sref='app.crm0411({store_delivery_id: item.store_delivery_id, store_order_id: item.store_order_id})'>#{{item.store_delivery_code}} ({{item.store_delivery_id}})</a>
                    <br/><small><i>{{item.salesman_name}}</i></small>
                    <br/><small><i>{{item.delivery_time | limitTo: 5: 11}}</i></small>
                </td>
                <td>
                    {{item.supplier_code}}
                </td>
                <td>
                    {{item.warehouse_name}}
                </td>
    
                <td>
                    <a ui-sref='app.rpt0514({store_id: item.store_id})'>{{item.store_name}}</a>
                    &nbsp;
                    <span class="badge badge-success" ng-if="item.is_review_valid && item.review_sts == 'VERIFIED'"><i class="fas fa-thumbs-up fa-fw"></i>&nbsp;{{item.review_expired_date}}</span>
                    <span class="badge badge-warning" ng-if="!item.is_review_valid && item.review_sts == 'VERIFIED'"><i class="fas fa-thumbs-up fa-fw"></i>&nbsp;{{item.review_expired_date}}</span>
                    <span class="badge badge-danger" ng-if="item.review_sts == 'BLACKLIST'"><i class="fas fa-thumbs-down"></i></span>
                    <br/>
                  
                    <small>Cấp: {{item.level}} </small><br/>
                    <small><i>{{item.address}}</i></small>
                    <small ng-if="item.order_type==1" class="text-danger"><br/>Đơn thường</small>
                    <small ng-if="item.order_type==3" class="text-danger"><br/>Đơn mẫu- Không tính doanh số</small>
                    <small ng-if="item.order_type==2" class="text-danger"><br/>Đơn bảo hành- Không tính doanh số</small>
                    <small ng-if="item.promotion_name" class="text-primary"><br/><i class="fa fa-gift fa-fw"/><i>{{item.promotion_name}}</i></small>
                </td>
                <td class="text-right">{{item.discount_1}}%<br/>{{item.discount_2}}%</td>
                <td class="text-right">{{item.total | currency: '' : 0}}<br/>{{item.total_with_discount | currency: '' : 0}}
                </td>                                    
                <td>
                    <span ng-repeat='state in vm.m.statusDeliveryList' ng-if="state.status_id == item.delivery_sts" > 
                        <span class="{{state.label}}">{{state.descript}}</span>
                    </span>
                </td>
                <td>
                    <p class="text-muted">{{item.notes}}</p>
                    <p class="text-danger">{{item.notes_cancel}}</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>