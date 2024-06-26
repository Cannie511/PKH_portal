<div class="table-responsive">
    <p>Lớn hơn 20 ngày kể từ lúc giao gần nhất</p>
    <table class="table table-striped">
        <thead>
                <tr>
                <th></th>
                <th></th>
                <th>              
                </th>
                <th>              
                </th>
                <th colspan="2" class="text-center">Đặt hàng gần nhất</th>
                <th colspan="2" class="text-center">Giao hàng gần nhất</th>
            </tr>
            <tr>
                <th>
                </th>
                <th>NO</th>
                <th >
                    <span>Tên cửa hàng</span>
                    
                </th>
                <th >
                    <span>Cấp</span>
                    
                </th>
                    <th >
                    <span>Khu vực</span>
                    </th>
                <th >
                    <span>Phụ trách hiện tại</span>
                
                </th>
                <th>
                    <span>Ngày</span>
                </th>
                <th>
                    <span>Số ngày</span>
                    
                </th>
                    <th>
                    <span>Ngày</span>
                </th>
                <th>
                    <span>Số ngày</span>
                    
                </th>
            </tr>
            <tr>
                <th>
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                </th>
                <th  ng-click="vm.sort('order_day');" class="sortable">
                    <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="order_day"
                        order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                </th>
                    <th>
                </th>
                    <th  ng-click="vm.sort('delivery_day');" class="sortable">
                    <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="delivery_day"
                        order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat='item in vm.m.storeNeedOrder'>
                <td class="col-action">
                    <a class="btn btn-xs btn-warning" ui-sref='app.rpt0514({store_id: item.store_id})'>
                        <i class="fa fa-edit"></i>
                    </a>
                </td>
                
                <td>{{$index + vm.m.data.from}}</td>
                
                <td>
                <a ui-sref='app.rpt0514({store_id: item.store_id})'>{{item.store_name}}</a>
                    <br/><small><i>{{item.address}}</i></small>
                    <br/>SDT: <i>{{item.contact_tel}}- {{item.contact_mobile1}}</i>

                </td>
                <td>
                    {{item.level}}
                </td>
                    <td>
                    {{item.area1_name}}   
                    <br/>{{item.area2_name}}   
                </td>     
                <td>
                    {{item.salesman_name}}   
                </td>                             
                <td>
                    {{item.order_date}}                                     
                </td>
                    <td>
                    {{item.order_day}}                                     
                </td>
                    <td>
                    {{item.delivery_date}}                                     
                </td>
                    <td>
                    {{item.delivery_day}}                                     
                </td>
            </tr>
        </tbody>
    </table>
</div>