
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <div class="box-tools pull-right">
                        <!--<a ui-sref="app.crm0331({store_id: item.store_id})" class="btn btn-success btn-xs">-->
                        <!--<a ui-sref="app.crm0331({store_id: 26})" class="btn btn-success btn-xs">-->
                        <a ui-sref="app.crm0510" class="btn btn-success btn-xs">
                        <i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a>
                    </div>
                </div>
                <div class="box-body form">
                    <form class="form" ng-submit="vm. doSearch(vm.m.activeFlag, 1)">
                      
                        <div class="row">
                          
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
                                <button type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.resetFilter()">
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
                                    <th>NO</th>
                                    <th>Area</th>
                                   
                                    
                                    <th>Store</th>
                                    
                                    <th>Status</th>
                                    <th>Rating</th>
                                    <th>Review</th>
                                    <th>Resolve</th>
                                     
                                    <th>Created_by</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data'>
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
                                    
                                    <!-- """
                                    0: pending 
                                    1: done
                                    2: black list
                                    """ -->
                                     <td>
                                        <span ng-if="item.status==0">Pending</span>
                                        <span ng-if="item.status==1">Done</span>
                                        <span ng-if="item.status==2">Blacklist</span>
                                    </td>
                                     <td>
                                        {{item.cus_rating}}/5
                                       
                                    </td>
                                     <td style="width:300px">{{item.cus_review}}</td>
                                     <td style="width:300px">{{item.com_resolve}}</td>
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
                                ng-change="vm.doSearch(vm.m[vm.m.activeFlag].data.current_page)"
                                class="pagination pagination-sm m-t-none m-b-none">
                            </uib-pagination>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

