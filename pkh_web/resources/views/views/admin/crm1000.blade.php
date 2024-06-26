<section class="content-header">
    <h1>Giao hàng<small></small></h1>
    <!-- <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Lịch nghỉ nghep</li>
    </ol> -->
</section>
<section id="crm1000" class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách giao hàng</h3>
                    <div class="box-tools pull-right">
                        <a ui-sref="app.crm1010" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a>
                        
                    </div>
                </div>
                <div class="box-body form" >
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Từ ngày</label>
                                    <p class="input-group">
                                        <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.filter.delivery_start_date" is-open="vm.dp1Opened" datepicker-options="vm.m.dateOptions" close-text="Close"
                                        ng-model-options="{timezone: 'utc'}" />
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" ng-click="vm.dp1Opened = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </p>
                                </div> 
                            </div>

                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Đến ngày</label>
                                    <p class="input-group">
                                        <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.filter.delivery_end_date" is-open="vm.dp2Opened" datepicker-options="vm.m.dateOptions" close-text="Close"
                                        ng-model-options="{timezone: 'utc'}" />
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" ng-click="vm.dp2Opened = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </p>
                                </div> 
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="delivery_vendor_name">Người giao hàng</label>
                                    <input type="text" class="form-control" id="delivery_vendor_name" ng-model="vm.m.filter.delivery_vendor_name" />
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
                                     <i class="fa fa-file-excel-o fa-fw"></i>
                                    <span>Tải excel</span>
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
                                   
                                    <th ng-click="vm.sort('delivery_date');" class="sortable">
                                        <span >Ngày giao</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="delivery_date"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                  
                                    <th ng-click="vm.sort('delivery_vendor_name');" class="sortable">
                                        <span >Tên người giao hàng</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="delivery_vendor_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                  
                                    <th ng-click="vm.sort('money');" class="sortable" class="text-right">
                                        <span >Số tiền</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="money"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th>
                                        Giá trị hàng (CK)
                                    </th>
                                    <th>
                                        Số thùng
                                    </th>
                                    <th>
                                        Thể tích
                                    </th>
                                    <th  class="sortable">
                                        <span >Ghi chú</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="notes"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list.data'>
                                    <td class="col-action">
                                        <div class="btn-group" uib-dropdown dropdown-append-to-body>
                                          <button type="button" class="btn btn-default btn-sm" uib-dropdown-toggle>
                                            <i class="fa fa-ellipsis-v"></i>
                                          </button>
                                          <ul class="dropdown-menu" uib-dropdown-menu role="menu" aria-labelledby="btn-append-to-body">
                                            <li role="menuitem"><a ui-sref='app.crm1010({delivery_id: item.id})'>Sửa giao hàng</a></li>
                                          </ul>
                                        </div>
                                    </td>

                                    <td>{{$index + vm.m.list.from}}</td>
                                  
                                    <td>{{item.delivery_date| date:'yyyy-MM-dd'}}</td>
                                   
                                    <td>{{item.delivery_vendor_name}}</td>
                                    
                                    <td class="text-right">{{item.price | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.total_discount | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.carton | number :2}}</td>
                                    <td class="text-right">{{item.volume | number :2}}</td>
                                    <td><pre>{{item.notes}}</pre></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row" ng-if="vm.m.list.from > 0">
                        <div class="col-md-6 col-sm-12 text-left">
                            <p class="form-control-static">{{vm.m.list.from}} - {{vm.m.list.to}} / {{vm.m.list.total}}</p>                            
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <uib-pagination ng-show="vm.m.list.from > 0"
                                total-items="vm.m.list.total"
                                ng-model="vm.m.data.current_page"
                                items-per-page="vm.m.list.per_page"
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
