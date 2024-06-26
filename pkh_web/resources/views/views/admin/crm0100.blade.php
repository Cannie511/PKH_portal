<section class="content-header">
    <h1>Danh sách sản phẩm <small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Danh sách sản phẩm</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách sản phẩm</h3>
                    <div class="box-tools pull-right">
                        <a ui-sref="app.crm0110({product_id: 0})" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a>
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <div class="box-body form">
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="product_code">Mã PKH</label>
                                    <input type="text" class="form-control" id="product_code" ng-model="vm.m.filter.product_code" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="name">Tên SP</label>
                                    <input type="text" class="form-control" id="product_name" ng-model="vm.m.filter.product_name" />
                                </div>
                            </div>
                           
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Nhà cung ứng</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn nhà cung ứng'"
                                        ng-model="vm.m.filter.supplier_id"
                                        ng-options="item.supplier_id as item.name for item in vm.m.init.supplierList"
                                        >
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div  class="row">
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Dòng sản phẩm</label>
                                        <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn nơi xuất'"
                                        ng-model="vm.m.filter.product_cat2_id"
                                        ng-options="item.product_cat2_id as item.name for item in vm.m.init.catList "
                                        >
                                        <option value="">Không có</option>
                                        </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Loại sản phẩm</label>
                                        <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn nơi xuất'"
                                        ng-model="vm.m.filter.product_cat1_id"
                                        ng-options="item.product_cat1_id as item.name for item in vm.m.init.handleList "
                                        >
                                        <option value="">Không có</option>
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
                                <button type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.resetFilter()">
                                    <i class="fa fa-eraser fa-fw"></i>
                                    <span translate="COM_BTN_RESET"></span>
                                </button>
                                <button type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.download()">
                                    <i class="fa fa-download fa-fw"></i>
                                     Tải về
                                </button>
                                <button type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.priority()">
                                    <i class="glyphicon glyphicon-star"></i>
                                     Priority
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped product-list">
                            <thead>
                                <tr>
                                    <th class="col-action"></th>
                                    <th>NO</th>
                                   
                                    <th >
                                        <span translate="CRM0130_LABEL_PRODUCT_CODE"></span>
                                       
                                    </th>
                                    <th >
                                        <span> Tên sản phẩm</span>
                                      
                                    </th>
                                   
                                   
                                    
                                    <th >
                                        <!-- <span translate="CRM0130_LABEL_PRODUCT_NAME"></span> -->
                                       NCU
                                    </th>
                                    <!-- <th >
                                        <span translate="CRM0130_LABEL_SUPPLIER_NAME"></span>
                                        
                                    </th> -->
                                    <th >
                                        <span>Loại sản phẩm</span>
                                  
                                    </th>
                                    <th >
                                        <span>Dòng sản phẩm</span>
                                       
                                    </th>
                                    <th >
                                        <span>Color</span>
                                       
                                    </th>
                                    <th >
                                        <span>Mô tả</span>
                                       
                                    </th>

                                  
                                    
                                    <th >
                                        <span>Đóng gói</span>
                                    </th>

                                  
                                    
                                    
                                    <th >
                                        <span> Giá nhập</span>
                                        
                                    </th>
                                    <th >
                                        <span> Giá bán </span>
                                        
                                    </th>
                                    <!-- <th>
                                        <span>Hàng mẫu</span>
                                  
                                    </th>
                                    <th >
                                        <span>Giá thuế</span>
                                      
                                    </th> -->

                                    <th>Ngày cập nhật</th>
                                
                                </tr>
                                
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data'>
                                    <td class="col-action">
                                        <div class="btn-group" uib-dropdown dropdown-append-to-body>
                                          <button type="button" class="btn btn-default btn-sm" uib-dropdown-toggle>
                                            <i class="fa fa-ellipsis-v"></i>
                                          </button>
                                          <ul class="dropdown-menu" uib-dropdown-menu role="menu" aria-labelledby="btn-append-to-body">
                                            <li ng-if="vm.can('screen.crm0110')" role="menuitem"><a ui-sref='app.crm0110({product_id: item.product_id})' translate="COM_BTN_EDIT"></a></li>
                                            <li ng-if="vm.can('screen.crm0100.update_price')" role="menuitem"><a href="javascript:void(0)" ng-click="vm.clickSetupPrice(item)">Thiết lập giá</a></li>
                                            <!--<li role="menuitem"><a ui-sref='app.crm0210({store_id: item.store_id})'>Nhập đơn hàng</a></li>-->
                                            <!--<li role="menuitem"><a ng-click="clickShowUpdatePrice()">Thiết lập giá</a></li>-->
                                            <!-- <li class="divider"></li> -->
                                            <!-- <li role="menuitem"><a href="#">Separated link</a></li> -->
                                          </ul>
                                        </div>
                                    </td>
                                    <td>{{$index + vm.m.data.from}}</td>
                                    
                                    <td>
                                        {{item.product_code}} <br>
                                       
                                    </td>
                                    <td>{{item.product_name}}</td>
                                  
                                   
                                    <td>{{item.supplier_code}} </td>
                                    <!-- <td>{{item.supplier_name}}</td> -->
                                    <td>{{item.typename1}}</td>
                                    <td>{{item.typename2}}</td>
                                    <td>{{item.color}}</td>
                                    <td>{{item.describes}}</td>
                                    <td>{{item.pakaging}} / {{item.pakagingType}}</td>
                                    <td>{{item.import_price}}</td>
                                    <td>{{item.selling_price}}</td>
                                   
                                    <td>{{item.updated_at}}</td>
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