<section class="content-header">
    <h1>Tồn kho<small></small></h1>
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
                    <h3 class="box-title">Danh sách hàng tồn kho</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
               
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ID</th>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Loại sản phẩm</th>
                                    <th>Dòng sản phẩm</th>
                                   
                                    <!--<th ng-click="vm.sort('supplier_name');" class="sortable">
                                        <span translate="CRM0130_LABEL_SUPPLIER_NAME"></span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="supplier_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>-->
                                    
                                    <!--<th ng-click="vm.sort('stock_code');" class="sortable">
                                        <span translate="CRM0130_LABEL_STOCK_CODE"></span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="stock_code"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>-->
                                    <!--<th ng-click="vm.sort('price');" class="sortable">
                                        <span translate="CRM0130_LABEL_PRICE"></span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="price"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>-->
                                    <th ng-click="vm.sort('remain');" class="sortable">
                                        <span>Số lượng nhập</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="remain"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>

                                   
                                    <th>
                                      <span class="text-danger"> Số lượng đã xuất</span>
                                       
                                    </th>
                                    
                                  
                                    <th ng-click="vm.sort('ordering');">
                                        Còn lại
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list'>
                                    <td>{{$index + 1}}</td>
                                    <!--<td>
                                        {{item.supplier_name}}
                                    </td>-->
                                    <td >{{item.product_id}}</td>
                                    <td class= "text-info">{{item.product_code}}</td>
                                    <td>{{item.product_name}}</td>
                                    <td>{{item.type_name1}} </td>
                                    <td>{{item.type_name2}} </td>
                                    <td class= "text-info">{{item.tk}} </td>
                                    <td class= "text-danger">{{item.xuat}}</td>
                                    <td style="color:green;">{{item.tk - item.xuat}}</td>
                                   
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row" ng-if="vm.m.data.from > 0">
                        <div class="col-md-6 col-sm-12 text-left">
                            <p class="form-control-static">{{vm.m.data.from}} - {{vm.m.data.to}} / {{vm.m.data.total}}</p>                            
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <uib-pagination ng-show="vm.m.data.from > 0"
                                total-items="vm.m.data.total"
                                ng-model="vm.m.data.current_page"
                                items-per-page="vm.m.data.per_page"
                                ng-change="vm.doSearch(vm.m.data.current_page)"
                                class="pagination pagination-sm m-t-none m-b-none">
                            </uib-pagination>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
