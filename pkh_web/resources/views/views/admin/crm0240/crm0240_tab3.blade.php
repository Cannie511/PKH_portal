<div class="row" ng-if="vm.m.activeFlag == 3" >
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách yêu cầu nhập kho hàng nhà máy</h3>
                    <div class="box-tools pull-right">
                        <div uib-dropdown class="btn-group">
                        
                        </div>
                  
                    </div>
                </div>
             
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width:30px">NO</th>
                                    <th style="width:120px">Ngày yêu cầu</th>
                                    <th style="width:100px">Yêu cầu</th>
                                    <th style="width:100px">Trạng thái</th>
                                    <th style="width:240px">Nhà máy</th>
                                    <th style="width:240px">Kho nhập</th>
                                    <th style="width:100px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data'>
                                    <td>{{$index + vm.m[vm.m.activeFlag].data.from}}</td>
                                    <td>
                                        #{{item.request_id}} - {{item.request_date | date:'yyyy-MM-dd'}}
                                        <br/>
                                        <small>({{item.created_user_name}})</small>
                                    </td>
                                    <td>
                                        <span class="label label-warning" ng-if="item.request_type == 4">Nhập nhà máy</span>
                                    </td>
                                    <td>
                                        <span class="label label-primary" ng-if="item.request_sts == 0">Chờ xác nhận</span>
                                        <span class="label label-success" ng-if="item.request_sts == 1">Đồng ý</span>
                                        <span class="label label-danger" ng-if="item.request_sts == 2">Từ chối</span>
                                    </td>
                                    <td >        
                                        {{item.factory_name}}           
                                    </td>
                                    <td >        
                                        {{item.warehouse_name}}           
                                    </td>
                                    <td>
                                        <a ui-sref='app.crm1631({type:1, import_wh_id: item.ref_id})'>Chi tiết>></a>
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
                                ng-change="vm.doSearch(3, vm.m[vm.m.activeFlag].data.current_page)"
                                class="pagination pagination-sm m-t-none m-b-none">
                            </uib-pagination>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   