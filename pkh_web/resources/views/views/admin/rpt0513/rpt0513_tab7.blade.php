<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Lợi nhuận sản phẩm</h3>
        <p>
            Tỉ giá: 23.500 VND
           <br>
           Purchase price: giá mua tại thời điểm hiện tại
           <br>
           Đơn vị: 1.000 VND
           <br>
             unit_price - purchase_price*23.500 - unit_price *(discount_1 + discount_2)/100 )*amount
        </p>
    </div>
    <div class="box-body form" >
        <form class="form" ng-submit="vm.loadData(vm.m.activeFlag)">
            <div class="row">
            
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="product_code">Tỉ giá</label>
                        <input type="number" class="form-control" id="product_code" ng-model="vm.m[vm.m.activeFlag].filter.current_rate" ng-change="vm.makePriceList()"/>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="product_code">PKH code</label>
                        <input type="text" class="form-control" id="product_code" ng-model="vm.m[vm.m.activeFlag].filter.product_code" />
                    </div>
                </div>
                
            </div>
            <div class="row">
               
               
               <div class="col-md-3 col-sm-6 m-b-xs">
                   <div class="form-group">
                       <label>Loại sản phẩm</label>
                           <select class="form-control"     
                           chosen                               
                           placeholder-text-single="'Chọn nơi xuất'"
                           ng-model="vm.m[vm.m.activeFlag].filter.product_cat_id"
                           ng-options="item.product_cat_id as item.name for item in vm.m.init.catList "
                           >
                           <option value="">Không có</option>
                           </select>
                   </div>
               </div>

               <div class="col-md-3 col-sm-6 m-b-xs">
                   <div class="form-group">
                       <label>Loại Handle</label>
                           <select class="form-control"     
                           chosen                               
                           placeholder-text-single="'Chọn nơi xuất'"
                           ng-model="vm.m[vm.m.activeFlag].filter.handle_id"
                           ng-options="item.handle_id as item.name for item in vm.m.init.handleList "
                           >
                           <option value="">Không có</option>
                           </select>
                   </div>
               </div>

               <div class="col-md-3 col-sm-6 m-b-xs">
                    <div class="form-group">
                        <label>Nhà cung ứng</label>
                        <select class="form-control"     
                            chosen                               
                            placeholder-text-single="'Chọn nhà cung ứng'"
                            ng-model="vm.m[vm.m.activeFlag].filter.supplier_id"
                            ng-options="item.supplier_id as item.name for item in vm.m.init.supplierList"
                            >
                            <option value="">Tất cả</option>
                        </select>
                    </div>
                </div>
             
  
           </div>
           
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                        <i class="fa fa-search fa-fw"></i>
                        <span translate="COM_BTN_SEARCH"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.resetFilter(vm.m.activeFlag)">
                        <i class="fa fa-eraser fa-fw"></i>
                        <span translate="COM_BTN_RESET"></span>
                    </button>
                    
                </div>
            </div>
        </form>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>      
                    <tr>        
                        <th>
                            No
                        </th>
                       <th> 
                            Product code
                        </th>
                        <th>
                            Selling price
                        </th>
                        <th class="text-right">
                            Purchase price
                        </th>
                        <th class="text-right">
                            Cost of goods sold
                        </th>
                        <th class="text-right">
                            44%
                        </th>
                        <th class="text-right">
                            47%
                        </th>
                        <th class="text-right"> 
                            50%
                        </th>
                        <th class="text-right">
                            53%
                        </th>
                        <th class="text-right">
                            56%
                        </th>
                        <th class="text-right">
                            59%
                        </th>
                        <th class="text-right">
                            62%
                        </th>
                        <th class="text-right">
                            67%
                        </th>
                    </tr>    
                    <tr>
                        <th>
                           
                        </th>
                       <th> 
                          
                        </th>
                        <th class="text-right" ng-click="vm.sort('selling_price',7);" class="sortable">
                            <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="selling_price"
                                           order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                        </th>
                        <th class="text-right" ng-click="vm.sort('purchase_price',7);" class="sortable">
                            <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="purchase_price"
                                           order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                        </th>
                        <th class="text-right" ng-click="vm.sort('cost',7);" class="sortable">
                            <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="cost"
                                           order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                        </th>
                        <th class="text-right" ng-click="vm.sort('v44',7);" class="sortable">
                            <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="v44"
                                           order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                        </th>
                        <th class="text-right" ng-click="vm.sort('v47',7);" class="sortable">
                            <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="v47"
                                           order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                        </th>
                        <th class="text-right" ng-click="vm.sort('v50',7);" class="sortable">
                            <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="v50"
                                           order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                        </th>
                        <th class="text-right" ng-click="vm.sort('v53',7);" class="sortable">
                            <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="v53"
                                           order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                        </th>
                        <th class="text-right" ng-click="vm.sort('v56',7);" class="sortable">
                            <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="v56"
                                           order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                        </th>
                        <th class="text-right" ng-click="vm.sort('v59',7);" class="sortable">
                            <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="v59"
                                           order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                        </th>
                        <th class="text-right" ng-click="vm.sort('v62',7);" class="sortable">
                            <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="v62"
                                           order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                        </th>
                        <th class="text-right" ng-click="vm.sort('v67',7);" class="sortable">
                            <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="v67"
                                           order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                        </th>
                    </tr>        
                   
                </thead>
                <tbody>
                    <tr ng-repeat='item3 in vm.m[vm.m.activeFlag].data'>

                        <td>{{$index +1}}</td>
                        <td>
                                {{item3.product_code}}
                                <br>
                                {{item3.stock_code}}
                        </td>  
                        <td>
                            <input type="text" style="width:70px;" ng-model="item3.selling_price" ng-change="vm.makePriceList()" />
                        </td> 
                        <td class="text-right">
                             {{item3.purchase_price}}
                        </td>     
                        <td class="text-right">
                             {{item3.cost | number:0}}
                        </td>    
                        <td class="text-right">
                            <span class="text-info"> {{item3.v44 | number:0}}</span>
                            <br>
                          <span class="text-danger">  {{item3.p44 | number:0}}% </span>
                        </td>   
                        <td class="text-right">
                            <span class="text-info">  {{item3.v47 | number:0}}</span>
                            <br>
                            <span class="text-danger">    {{item3.p47 | number:0}}%</span>
                        </td>  
                        <td class="text-right">
                            <span class="text-info"> {{item3.v50 | number:0}}</span>
                            <br>
                            <span class="text-danger">      {{item3.p50 | number:0}}%</span>
                        </td>  
                        <td class="text-right">
                            <span class="text-info"> {{item3.v53 | number:0}}</span>
                            <br>
                            <span class="text-danger">     {{item3.p53 | number:0}}%</span>
                        </td>  
                        <td class="text-right">
                            <span class="text-info">  {{item3.v56 | number:0}}</span>
                            <br>
                            <span class="text-danger">     {{item3.p56 | number:0}}%</span>
                        </td>  
                        <td class="text-right">
                            <span class="text-info">  {{item3.v59 | number:0}}</span>
                            <br>
                            <span class="text-danger">     {{item3.p59 | number:0}}%</span>
                        </td>   
                        <td class="text-right">
                            <span class="text-info">  {{item3.v62 | number:0}}</span>
                            <br>
                            <span class="text-danger">     {{item3.p62 | number:0}}%</span>
                        </td>  
                        <td class="text-right">
                            <span class="text-info">    {{item3.v67 | number:0}}</span>
                            <br>
                            <span class="text-danger">      {{item3.p67 | number:0}}%</span>
                        </td>  
                        
                    </tr>   
                </tbody>
            </table>
        </div>
    </div>
</div>