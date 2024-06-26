<section class="content-header">
    <h1>Download Management<small></small></h1>
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
                    <h3 class="box-title">Download management</h3>
            
                </div>
                <div class="box-body form">
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                            
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Nhân viên </label>
                                      <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn nhân viên'"
                                        ng-model="vm.m.filter.user_id"
                                        ng-options="item.id as item.name for item in vm.m.usersList "
                                        >
                                        <option value="">Không có</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="branch_address">screen</label>
                                    <input type="text" class="form-control" id="screen" ng-model="vm.m.filter.screen" />
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
                                    <th ng-click="vm.sort('payment_date');" >
                                        <span>Chức năng</span>
                                      
                                    </th>
                                    <th ng-click="vm.sort('payment_type');" >
                                        <span>Loại File</span>
                                       
                                    </th>
                                    <th ng-click="vm.sort('store_id');" >
                                        <span>Nhân viên</span> 
                                    </th>
                                    <th ng-click="vm.sort('store_id');" >
                                        <span>Thời gian</span> 
                                    </th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data'>
                                  
                                    <td>{{$index + vm.m.data.from}}</td>
                                   
                                    <td class="text-left">{{item.screen}}</td>
                                    <td class="text-left">{{item.descript}}</td>
                                    <td class="text-left">{{item.user_name}}</td>
                                    <td class="text-left">{{item.created_at}}</td>
                                   
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
