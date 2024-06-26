<div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách chăm sóc khách hàng</h3>
                    <div class="box-tools pull-right">
                        <!--<a ui-sref="app.crm0331({store_id: item.store_id})" class="btn btn-success btn-xs">-->
                        <!--<a ui-sref="app.crm0331({store_id: 26})" class="btn btn-success btn-xs">-->
                        <a ui-sref="app.crm0331" class="btn btn-success btn-xs">
                        <i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a>
                    </div>
                </div>
                <div class="box-body form">
                    <form class="form" ng-submit="vm.doSearch(vm.m.activeFlag,1)">
                        <div class="row">
                          
                           
                        <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Vùng</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn tỉnh'"
                                        ng-model="vm.m[vm.m.activeFlag].filter.areaGroup"
                                        ng-options="item.area_group_id as item.name for item in vm.m.init.listAreaGroup"
                                        >
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Tỉnh/Thành</label>
                                    {{vm.m.filter.area1}}
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn tỉnh'"
                                        ng-model="vm.m[vm.m.activeFlag].filter.area1"
                                        ng-options="item.area_id as item.name for item in vm.m.init.listArea1  | filter : {'area_group_id': vm.m.filter.areaGroup}"
                                        >
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group" ng-if="vm.m[vm.m.activeFlag].filter.area1">
                                    <label>Quận/Huyện</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn tỉnh'"
                                        ng-model="vm.m.filter.area2"
                                        ng-options="item.area_id as item.name for item in vm.m.init.listArea2 | filter : {'parent_area_id': vm.m.filter.area1}"
                                        >
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Tên cửa hàng</label>
                                    <input type="text" ng-model="vm.m[vm.m.activeFlag].filter.store_name" class="form-control"/>
                                </div>
                            </div>
                          
                        </div>
                        <div class="row">
                          
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>NVBH</label>
                                    <select class="form-control"   
                                        chosen
                                        placeholder-text-single="'Chọn NVBH'"
                                        ng-model="vm.m[vm.m.activeFlag].filter.salesman_id"
                                        ng-options="item.id as item.name for item in vm.m.init.salesmanList "
                                        >
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="from_date">Từ ngày</label>
                                    <p class="input-group">
                                        <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m[vm.m.activeFlag].filter.from_date" is-open="vm.dp1Opened" datepicker-options="vm.m.dateOptions" close-text="Close"
                                        ng-model-options="{timezone: 'utc'}" />
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" ng-click="vm.dp1Opened = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="to_date">Đến ngày</label>
                                    <p class="input-group">
                                        <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m[vm.m.activeFlag].filter.to_date" is-open="vm.dp2Opened" datepicker-options="vm.m.dateOptions" close-text="Close"
                                        ng-model-options="{timezone: 'utc'}" />
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" ng-click="vm.dp2Opened = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </p>
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
                                    <th ng-if= "vm.m.activeFlag==2"></th>
                                    <th>NO</th>
                                    <th>Area</th>
                                   
                                    
                                    <th>Store</th>
                                    
                                    <th ng-if= "vm.m.activeFlag==1"></th>
                                    <th>Rating</th>
                                    <th>Review</th>
                                    <th ng-if= "vm.m.activeFlag==2">Resolve</th>
                                    <th ng-if= "vm.m.activeFlag==2">Complete</th>
                                    <th ng-if= "vm.m.activeFlag==2">Delay</th>

                                    <th ng-if= "vm.m.activeFlag==1">Deadline</th>
                                    <th ng-if= "vm.m.activeFlag==1">Pending hours</th>
                                    <th>Created_by</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data'>
                                    <td ng-if= "vm.m.activeFlag==2"> 
                                        <span >
                                            <button type="button" class="btn btn-primary btn-xs btn-width-default" ng-click="vm.finish(item, false)">
                                             D
                                            </button>
                                        </span>
                                    </td>
                                    <td>{{$index + vm.m[vm.m.activeFlag].data.from}}</td>
                                    <td>
                                        {{item.area1 }} <br> 
                                        {{item.area2 }}
                                    </td>
                                   
                                    
                                    <td style="width:200px">
                                        {{item.store_name}}
                                        <br>
                                        PIC: {{item.salesman_name}}
                                    </td>
                                    <td ng-if= "vm.m.activeFlag==1"> 
                                        <span >
                                            <button type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.finish(item, true)">
                                            Finish
                                            </button>
                                        </span>
                                    </td>
                                     <td>
                                        {{item.cus_rating}}/5
                                       
                                    </td>
                                     <td style="width:300px">{{item.cus_review}}</td>
                                     
                                     <td ng-if= "vm.m.activeFlag==2" style="width:300px">{{item.com_resolve}}</td>
                                     <td ng-if= "vm.m.activeFlag==2">{{item.complete_hour}} (h)</td>

                                     <td ng-if= "vm.m.activeFlag==2">{{item.delay_hour}} (h)</td>

                                     <td ng-if= "vm.m.activeFlag==1">{{item.deadline}}</td>
                                     <td ng-if= "vm.m.activeFlag==1">{{item.pending_hour}} (h)</td>
                                     <td>
                                        {{item.created_by}}
                                        <br>
                                        {{item.created_at}}
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
                                ng-change="vm.doSearch(vm.m.activeFlag, vm.m[vm.m.activeFlag].data.current_page)"
                                class="pagination pagination-sm m-t-none m-b-none">
                            </uib-pagination>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>