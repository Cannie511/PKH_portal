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
                                    
                                        <th>
                                            <span>Loại</span>
                                        </th>

                                        <th>
                                            <span>Trạng thái</span>
                                        </th>
                                        <th>Ghi chú</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat='item in vm.m.importToday'>
                                        <td>{{$index + 1}}</td>
                                        <td>
                                            {{item.store_name}}
                                            <br/><small><i>{{item.store_address}}</i></small>
                                        </td>
                                        <td>
                                            {{item.salesman_name}}
                                        
                                        </td>   
                                                                    
                                        <td>
                                            <span ng-if="item.import_type==1 "  class="label label-warning">Bảo hành</span> 
                                            <span ng-if="item.import_type==2" class="label label-danger">Trả lại</span> 
                                        </td>
                                        <td >
                                            <span ng-if="item.import_sts == 0" class="label label-success">Mới</span> 
                                            <span ng-if="item.import_sts == 1" class="label label-primary">Đã nhập</span> 
                                        </td>
                                        <td>
                                            <p class="text-muted">{{item.notes}}</p>
                                        
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>