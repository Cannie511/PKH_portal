<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Danh sách Xuất-Nhập giữa các kho</h3>
        <div class="box-tools pull-right">
            <div uib-dropdown class="btn-group">
                <a ui-sref="app.crm2310({ })" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a>
            </div>
        </div>
    </div>
    <div class="box-body form">
        <form class="form" ng-submit="vm.search(vm.m.activeFlag, 1)">
            <div class="row">
                
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="day">Từ ngày</label>
                        <div class="input-group">
                            <input class="form-control" datetimepicker ng-model="vm.m[vm.m.activeFlag].filter.from_date" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div> 
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="day">Đến ngày</label>
                        <div class="input-group">
                            <input class="form-control" datetimepicker ng-model="vm.m[vm.m.activeFlag].filter.to_date" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div> 
                <div class="col-md-3 col-sm-6 m-b-xs">
                    <div class="form-group">
                        <label>Kho xuất</label>
                            <select class="form-control"     
                            chosen                               
                            placeholder-text-single="'Chọn kho'"
                            ng-model="vm.m[vm.m.activeFlag].filter.from_warehouse_id"
                            ng-options="item.warehouse_id as item.warehouse_name for item in vm.m.init.warehouseList "
                            >
                            <option value="">Không có</option>
                            </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 m-b-xs">
                    <div class="form-group">
                        <label>Kho nhập</label>
                            <select class="form-control"     
                            chosen                               
                            placeholder-text-single="'Chọn kho'"
                            ng-model="vm.m[vm.m.activeFlag].filter.to_warehouse_id"
                            ng-options="item.warehouse_id as item.warehouse_name for item in vm.m.init.warehouseList "
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
                    <button type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.resetFilter(vm.m.activeFlag)">
                        <i class="fa fa-eraser fa-fw"></i>
                        <span translate="COM_BTN_RESET"></span>
                    </button>
                    
                </div>
            </div>
        </form>
    </div>
</div>

<div class="box-body">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-action"></th>
                    <th>NO</th>
                    
                    <th>
                        <span>Code</span>                                       
                    <!-- </th>
                        <th>
                        <span>Mã</span>                                     
                    </th> -->
                    <th >
                        <span>Nơi xuất</span> 
                    </th>
                    <th >
                        <span>Nơi Nhập</span> 
                    </th>
                    <th  class="text-right">
                        <span>Giá trị hàng</span> 
                    </th>
                    <th>
                        <span>Volume</span> 
                    </th>
                    <th>
                        <span>Carton</span> 
                    </th>
                    <th>
                        <span>Trạng thái</span> 
                    </th>
                    <th>
                        <span>Ghi chú</span> 
                    </th>
                    <th>
                        <span>Cập nhật</span> 
                    </th>
                
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data'>
                    <td class="col-action">
                        <a class="btn btn-xs btn-warning" ui-sref='app.crm2311({warehouse_exim_id: item.warehouse_exim_id})'>
                            <i class="fa fa-edit"></i>
                        </a>
                    
                    </td>
                    <td>{{$index + vm.m[vm.m.activeFlag].data.from}}</td>
                    
                    <td class="text-left">
                        Code: {{item.warehouse_exim_code}} <br>
                        Create: {{item.created_at}}
                    </td>
                        <!-- <td class="text-left">{{item.branch_export_code}}</td> -->
                    <td  class="text-left">{{item.from_warehouse_name}}</td>
                    <td  class="text-left">{{item.to_warehouse_name}}</td>

                    <!-- <td  ng-if="vm.m.vm.m.activeFlag ==2" class="text-left">{{item.branch_id_from}}</td> -->
                    <td class="text-right">{{item.total  | currency: '' : 0}}</td>
                    <td class="text-right">{{item.volume | number : 2}}</td>
                    <td class="text-right">{{item.carton  |number : 2}}</td>
                    <td  >
                        <span ng-repeat='state in vm.m.init.eximStatusList' ng-if="state.status_id == item.exim_sts" > 
                            <span class="{{state.label}}">{{state.descript}}</span>
                        </span>
                      
                    </td>
                   
                    
                    <td class="text-left">{{item.notes}}</td>
                    <td>
                        {{item.updated_at}}<br/>
                        <small><i>{{item.updated_by}}</i></small>
                    </td>
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
                ng-change="vm.doSearch(vm.m[vm.m.activeFlag].data.current_page)"
                class="pagination pagination-sm m-t-none m-b-none">
            </uib-pagination>    
        </div>
    </div>
</div>

