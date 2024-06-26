<section class="content-header">
    <h1>Chương trình khuyến mãi<small></small></h1>
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
                    <h3 class="box-title">Chương trình khuyến mãi</h3>
                    <div class="box-tools pull-right">
                        <div uib-dropdown class="btn-group">
                            <a ui-sref="app.crm1710" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a>
                         
                        </div>
                  
                    </div>
                </div>
                <div class="box-body form">
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                            
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="salesman_name">Tên chương trình</label>
                                    <input type="text" class="form-control"  ng-model="vm.m.filter.promotion_name" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="payment_type">Status</label>
                                    <select class="form-control" ng-model="vm.m.filter.promotion_sts" ng-init="vm.m.filter.promotion_sts = ''">
                                        <option value="">Tất cả</option>
                                        <option value="0">opening</option>
                                        <option value="1">closed</option>
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
                                <!--button type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.download()">
                                    <i class="fa fa-download fa-fw"></i>
                                    Tải về
                                </button-->
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
                                    <th ng-click="vm.sort('store_name');">
                                        <span>Tên chương trình</span>
                                        
                                    </th>

                                    <th ng-click="vm.sort('payment_date');" >
                                        <span>Ngày bắt đầu</span>
                                      
                                    </th>
                                   
                                    <th ng-click="vm.sort('store_id');" >
                                        <span>Ngày kết thúc</span>
                                       
                                    </th>
                                  
                                    <th ng-click="vm.sort('bank_account_no');" >
                                        <span>Trạng thái</span>
                                       
                                    </th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data'>
                                    <td class="col-action">
                                         <a class="btn btn-xs btn-warning" ui-sref='app.crm1710({ promotion_id: item.promotion_id})'>
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>{{$index + vm.m.data.from}}</td>
                                 
                                    <td>{{item.promotion_name}}</td>
                                     <td>{{item.from_date}}</td>
                                     <td>{{item.to_date}}</td>
                                    <td>
                                        <span ng-if="item.promotion_sts == 0" >opening</span> 
                                        <span ng-if="item.promotion_sts == 1">closed</span> 
                                     
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
