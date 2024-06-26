<div class="tab-pane" ng-class="{'active': vm.m.activeFlag == 1}">
    <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Doanh số cửa hàng sau chiết khấu</h3>
        
            </div>
            <div class="box-body form">
                <form class="form" ng-submit="vm.doSearch(vm.m.activeFlag,1)">
                    <div class="row">
                        
                        <div class="col-md-3 col-sm-6 m-b-xs">
                            <div class="form-group">
                                <label>Area </label>
                                    <select class="form-control"     
                                    chosen                               
                                    placeholder-text-single="'Pick area'"
                                    ng-model="vm.m[vm.m.activeFlag].filter.area_id"
                                    ng-options="item.area_id as item.name for item in vm.m.init.listArea1 "
                                    >
                                    <option value="">None</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="branch_address">Store name</label>
                                <input type="text" class="form-control" id="screen" ng-model="vm.m[vm.m.activeFlag].filter.store_name" />
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
                            <button type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.download(vm.m.activeFlag)">
                                <i class="fa fa-download fa-fw"></i>
                                Download
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
                                
                                <th>NO</th>
                                <th ng-click="vm.sort('payment_date');" >
                                    <span>Store name</span>
                                    
                                </th>
                                <th ng-click="vm.sort('payment_type');" >
                                    <span>Province</span>
                                    
                                </th>
                                <th ng-click="vm.sort('store_id');" >
                                    <span>First order</span> 
                                </th>
                                <th class="text-right" ng-click="vm.sort('store_id');" >
                                    <span>2016 TurnOver</span> 
                                </th>
                                <th class="text-right" ng-click="vm.sort('store_id');" >
                                    <span>2017 TurnOver</span> 
                                </th>
                                <th class="text-right" ng-click="vm.sort('store_id');" >
                                    <span>2018 TurnOver</span> 
                                </th>
                                <th class="text-right" ng-click="vm.sort('store_id');" >
                                    <span>2019 TurnOver</span> 
                                </th>
                                <th class="text-right" ng-click="vm.sort('store_id');" >
                                    <span>Total</span> 
                                </th>
                                <th class="text-right" ng-click="vm.sort('store_id');" >
                                    <span>Month Purchase</span> 
                                </th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data'>
                                
                                <td>{{$index + vm.m[vm.m.activeFlag].data.from}}</td>
                                
                                <td class="text-left">{{item.store_name}}</td>
                                <td class="text-left">{{item.province}}</td>
                                <td class="text-left">{{item.first_order}}</td>
                                <td class="text-right">{{item.Y2016_discount/1000 | currency: '' : 0 }}</td>
                                <td class="text-right">{{item.Y2017_discount/1000 | currency: '' : 0 }}</td>
                                <td class="text-right">{{item.Y2018_discount/1000 | currency: '' : 0 }}</td>
                                <td class="text-right">{{item.Y2019_discount/1000 | currency: '' : 0 }}</td>
                                <td class="text-right">{{item.total/1000 | currency: '' : 0 }}</td>
                                <td class="text-right">{{item.month_purchase | currency: '' : 0 }}/{{item.month_working | currency: '' : 0 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row" ng-if="vm.m[vm.m.activeFlag].data.from > 0">
                    <div class="col-md-6 col-sm-12 text-left">
                        <p class="form-control-static">{{vm.m[vm.m.activeFlag].data.from}} - {{vm.m[vm.m.activeFlag].data.to}} / {{vm.m[vm.m.activeFlag].data.total}}</p>                            
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <uib-pagination ng-show="vm.m[vm.m.activeFlag].data.from > 0"
                            total-items="vm.m[vm.m.activeFlag].data.total"
                            ng-model="vm.m[vm.m.activeFlag].data.current_page"
                            items-per-page="vm.m[vm.m.activeFlag].data.per_page"
                            ng-change="vm.doSearch(vm.m.activeFlag,vm.m[vm.m.activeFlag].data.current_page)"
                            class="pagination pagination-sm m-t-none m-b-none">
                        </uib-pagination>    
                    </div>
                </div>
            </div>
        </div>
    </div>