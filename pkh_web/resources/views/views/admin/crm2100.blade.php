<section class="content-header">
    <h1>Tỉnh<small></small></h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách Tỉnh/Quận</h3>
                    <div class="box-tools pull-right">
                        <div uib-dropdown class="btn-group">
                            <a ui-sref="app.crm2110" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a>
                       
                        </div>
                    </div>
                </div>
                <div class="box-body form">
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                            
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="area_name">Tên tỉnh</label>
                                    <input type="text" class="form-control" id="area_name" ng-model="vm.m.filter.area_name" />
                                </div>
                            </div>
                            
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="area_group">Vùng</label>
                                   <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn vùng'"
                                        ng-model="vm.m.filter.area_group_id"
                                        ng-options="item.area_group_id as item.name for item in vm.m.groupList "
                                        >
                                        <option value="">Không có</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="salesman">Salesman</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn salesman'"
                                        ng-model="vm.m.filter.salesman_id"
                                        ng-options="item.id as item.name for item in vm.m.salesmanList "
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
                                    <button type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.assign()">
                                    <i class="fa fa-check  fa-fw"></i>
                                    <span translate="COM_BTN_ASSIGN"></span>
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
                                    <th class="col-action"></th>
                                    <th>NO</th>
                                    <th ng-click="vm.sort('payment_date');" >
                                        <span>Tên</span>
                                      
                                    </th>
                                    <th ng-click="vm.sort('payment_type');" >
                                        <span>Vùng</span>
                                       
                                    </th>
                                    <th ng-click="vm.sort('store_id');" >
                                        <span>Salesman</span> 
                                    </th>
                                    <th ng-click="vm.sort('store_id');" >
                                        <span>Cập nhật</span> 
                                    </th>
                               
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data'>
                                    <td class="col-action">
                                       <a class="btn btn-xs btn-warning" ui-sref='app.crm2111({ area_id: item.area_id})'>
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    
                                    </td>
                                    <td>{{$index + vm.m.data.from}}</td>
                                   
                                    <td class="text-left">{{item.area_name}}</td>
                                    <td class="text-left">{{item.area_group_name}}</td>
                                    <td class="text-left">{{item.salesman_name}}</td>
                                    <td>
                                        {{item.updated_at}}<br/>
                                        <small><i>{{item.updated_by}}</i></small>
                                    </td>
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
