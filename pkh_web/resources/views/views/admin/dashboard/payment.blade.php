<div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th ng-click="vm.sort('store_name');" class="sortable">
                                            <span>Tên cửa hàng</span>
                                        </th>
                                        <th>
                                            <span>Tên nhân viên</span>
                                        </th>
                                        <th class="text-right">
                                            <span>Số tiền</span>
                                        </th>
                                        <th>
                                            <span>Loại</span>
                                        </th>
                                        <th>Ghi chú</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat='item in vm.m.paymentToday'>
                                        <td>{{$index + 1}}</td>
                                        <td>
                                        <a ui-sref='app.rpt0514({store_id: item.store_id})'>{{item.store_name}}</a>
                                            <br/><small><i>{{item.store_address}}</i></small>
                                        </td>
                                        <td>
                                            {{item.salesman_name}}
                                        
                                        </td>   
                                    
                                        <td class="text-right">
                                            {{item.payment_money | currency: '' : 0}}
                                        </td>                                    
                                        <td>
                                            <span ng-if="item.payment_type == 0" class="label label-success">Tiền mặt</span> 
                                            <span ng-if="item.payment_type == 1" class="label label-primary">Chuyển khoản</span> 
                                        
                                        </td>
                                        <td>
                                            <p class="text-muted">{{item.notes}}</p>
                                        
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>