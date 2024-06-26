                        <div class="row">
                           
                       
                       
                            <div class="col-md-6 col-sm-6" >
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Warehouse</th>
                                            <th class="text-right">Carton</th>
                                            <th class="text-right">Volume m3</th>
                                            <th class="text-right">Amount</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat='item in vm.m.warehouseList'>
                                            <td>{{item.warehouse_name}}</td>
                                            <td class="text-right">{{vm.m.sumWarehouseCart_no[item.warehouse_id] | currency : '' : 0}}</td>
                                            <td class="text-right">{{vm.m.sumWarehouseVol_no[item.warehouse_id] | currency : '' : 2}}</td>
                                            <td class="text-right">{{vm.m.sumWarehouse_no[item.warehouse_id] | currency : '' : 0}}</td>
                                            
                                        </tr>
                                      
                                        <tr>
                                            <td>Total</td>
                                            <td class="text-right">{{vm.m.sumWarehouseCart | currency : '' : 0}}</td>
                                            <td class="text-right">{{vm.m.sumWarehouseVol | currency : '' : 2}}</td>
                                            <td class="text-right">{{vm.m.sumWarehouse | currency : '' : 0}}</td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label class="switch">
                                        <input type="checkbox"  ng-model="vm.m.is_carton" checked> 
                                        Xem theo thùng 
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 text-left">
                                    <button ng-if="vm.can('screen.das0100.download-warehouse')" class="btn btn-sm btn-info" ng-click="vm.download()"><i class="fa fa-download fa-fw"></i>&nbsp;Download</button>
                                </div>
                                
                                <div class="col-md-6 col-sm-6 m-b-xs">
                                    <div class="form-group">
                                        <label>Nhà cung ứng</label>
                                        <select class="form-control"     
                                            chosen                               
                                            placeholder-text-single="'Chọn nhà cung ứng'"
                                            ng-model="vm.m.supplier_id_wh"
                                            ng-options="item.supplier_id as item.name for item in vm.m.supplierList"
                                            ng-change="vm.recalculate()"
                                            >
                                            <option value="">Tất cả</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div >
                            <div  class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Mã SP</th>
                                            <th>Tên SP</th>
                                            <th>Nhà cung ứng</th>
                                            <th>Đóng gói</th>
                                            <th class="text-right">Giá</th>
                                            <th ng-repeat='item in vm.m.warehouseList'  class="text-right">{{item.warehouse_name}}</th>
                                            <!-- <th class="text-right">Kho SEC</th>
                                            <th class="text-right">Kho TIKI</th>
                                            <th class="text-right">Kho Nhất Việt</th>
                                            <th class="text-right">Kho Sotrans</th> -->
                                            <th class="text-right">Tổng tồn</th>
                                            <th class="text-right">Tổng Giá trị</th>
                                            <th class="text-right">Pre-order</th>
                                            <th class="text-right">Còn lại</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat='item in vm.m.warehouse' ng-if="item.hide != true">
                                            <td>{{$index + 1}}</td>
                                            <td>{{item.product_code}}<br/><small><i>{{item.stock_code}}</i></small></td>
                                            <td>{{item.name}}<br/><small><i>{{item.name_origin}}</i></small></td>
                                            <td>{{item.supplier_code}}</td>
                                            <td>{{item.standard_packing}}</td>
                                            <td class="text-right">{{item.selling_price | currency : '' : 0}}</td>
                                            <!-- Kho PKH -->

                                            <td ng-repeat='item_wh in vm.m.warehouseList' class="text-right">
                                                <span class="btn btn-xs btn-danger" ng-if ="!vm.m.is_carton&&item[item_wh.warehouse_label]<0">
                                                    {{item[item_wh.warehouse_label] | currency : '' : 0}}
                                                </span>
                                                <span  ng-if ="!vm.m.is_carton&&item[item_wh.warehouse_label]>0">
                                                    {{item[item_wh.warehouse_label] | currency : '' : 0}}
                                                </span>
                                                <span class="btn btn-xs btn-danger" ng-if ="vm.m.is_carton&&item[item_wh.warehouse_label]<0">
                                                    {{item[item_wh.warehouse_label]/item.standard_packing| currency : '' : 0}} -{{item[item_wh.warehouse_label]%item.standard_packing| currency : '' : 0}}
                                                </span>
                                                <span  ng-if ="vm.m.is_carton&&item[item_wh.warehouse_label]>0">
                                                    {{item[item_wh.warehouse_label] /item.standard_packing| currency : '' : 0}}-{{item[item_wh.warehouse_label]%item.standard_packing| currency : '' : 0}}
                                                </span>
                                            </td>
                                          
                                            <!-- Kho SEC -->
                                            <!-- <td ng-if="!vm.m.is_carton" class="text-right">
                                                <span class="btn btn-xs btn-danger" ng-if ="item.amount_2<0">
                                                    {{item.amount_2 | currency : '' : 0}}
                                                </span>
                                                <span  ng-if ="item.amount_2>0">
                                                    {{item.amount_2 | currency : '' : 0}}
                                                </span>
                                            </td> -->
                                            <!-- Kho TIKI -->
                                            <!-- <td ng-if="!vm.m.is_carton" class="text-right">
                                                <span class="btn btn-xs btn-danger" ng-if ="item.amount_3<0">
                                                    {{item.amount_3 | currency : '' : 0}}
                                                </span>
                                                <span  ng-if ="item.amount_3>0">
                                                    {{item.amount_3 | currency : '' : 0}}
                                                </span>
                                            </td> -->
                                            <!-- Kho Nhat Viet -->
                                            <!-- <td ng-if="!vm.m.is_carton" class="text-right">
                                                <span class="btn btn-xs btn-danger" ng-if ="item.amount_4<0">
                                                    {{item.amount_4 | currency : '' : 0}}
                                                </span>
                                                <span  ng-if ="item.amount_4>0">
                                                    {{item.amount_4 | currency : '' : 0}}
                                                </span>
                                            </td> -->
                                             <!-- Kho Sotrans -->
                                             <!-- <td ng-if="!vm.m.is_carton" class="text-right">
                                                <span class="btn btn-xs btn-danger" ng-if ="item.amount_5<0">
                                                    {{item.amount_5 | currency : '' : 0}}
                                                </span>
                                                <span  ng-if ="item.amount_4>0">
                                                    {{item.amount_5 | currency : '' : 0}}
                                                </span>
                                            </td>
                                            <td ng-if="vm.m.is_carton" class="text-right">
                                                <span class="btn btn-xs btn-danger" ng-if ="item.amount_2<0">
                                                    {{item.amount_2/item.standard_packing | currency : '' : 0}}-{{item.amount_2%item.standard_packing | currency : '' : 0}}
                                                </span>
                                                <span  ng-if ="item.amount_2>0">
                                                    {{item.amount_2 /item.standard_packing| currency : '' : 0}}-{{item.amount_2%item.standard_packing | currency : '' : 0}}
                                                </span>
                                            </td> -->
                                            <!-- Kho tong -->
                                            <td ng-if="!vm.m.is_carton" class="text-right">
                                                <span class="btn btn-xs btn-danger" ng-if ="item.amount<0">
                                                    {{item.amount | currency : '' : 0}}
                                                </span>
                                                <span  ng-if ="item.amount>0">
                                                    {{item.amount | currency : '' : 0}}
                                                </span>
                                            </td>
                                            <td ng-if="vm.m.is_carton" class="text-right">
                                                <span class="btn btn-xs btn-danger" ng-if ="item.amount<0">
                                                    {{item.amount /item.standard_packing| currency : '' : 0}}-{{item.amount %item.standard_packing| currency : '' : 0}}
                                                </span>
                                                <span  ng-if ="item.amount>0">
                                                    {{item.amount /item.standard_packing| currency : '' : 0}}-{{item.amount %item.standard_packing| currency : '' : 0}}
                                                </span>
                                            </td>
                                            <td class="text-right">{{ (item.selling_price * item.amount) | currency : '' : 0}}</td>
                                             <!-- Kho tong -->
                                             <td ng-if="!vm.m.is_carton" class="text-right">
                                                <span class="btn btn-xs btn-danger" ng-if ="item.amount<0">
                                                    {{item.amount_pre | currency : '' : 0}}
                                                </span>
                                                <span  ng-if ="item.amount>0">
                                                    {{item.amount_pre | currency : '' : 0}}
                                                </span>
                                            </td>
                                            <td ng-if="!vm.m.is_carton" class="text-right">
                                                <span class="btn btn-xs btn-danger" ng-if ="item.amount<0">
                                                    {{item.amount - item.amount_pre | currency : '' : 0}}
                                                </span>
                                                <span  ng-if ="item.amount>0">
                                                    {{item.amount - item.amount_pre | currency : '' : 0}}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                 

                    
                  