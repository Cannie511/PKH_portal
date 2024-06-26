<section class="content-header">
    <h1>Checkin/Checkout<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Checkin/Checkout</li>
    </ol>
</section>
<section class="content hrm0153">
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Checkin/Checkout</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.hrm0716({ employee_id: vm.m.employee_id,contract_id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <div class="box-body">
                    <button class="btn btn-lg btn-info btn-block btn-checkin" ng-click="vm.checkin()" ng-disabled="vm.m.disableCheckin"><i class="fas fa-sign-in-alt"></i>Checkin</button>
                    <br/>
                    <button class="btn btn-lg btn-danger btn-block btn-checkout" ng-click="vm.checkout()" ng-disabled="vm.m.disableCheckout"><i class="fas fa-sign-out-alt"></i>Checkout</button>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Lịch sử hôm nay</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.hrm0716({ employee_id: vm.m.employee_id,contract_id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Giờ</th>
                                    <th>Loại</th>
                                    <th>IP</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list.data'>
                                    <td>{{$index + vm.m.list.from}}</td>
                                    <td>{{item.working_time}}</td>
                                    <td>
                                        <span ng-class="{'text-success': item.event_name == 'CHECKIN', 'text-danger': item.event_name == 'CHECKOUT'}">
                                            <i class="fas" ng-class="{'fa-sign-in-alt': item.event_name == 'CHECKIN', 'fa-sign-out-alt': item.event_name == 'CHECKOUT'}" ></i> {{item.event_name}}
                                        </span>
                                    </td>
                                    <td>
                                        {{item.ip}}
                                        <br/>
                                        <small>{{item.ip_city}} - </small>
                                        <small>({{item.agent}})</small>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- <div class="row text-right">
                        <div class="col-md-12">
                            <uib-pagination ng-show="vm.m.list.from > 0"
                                total-items="vm.m.list.total"
                                ng-model="vm.m.list.current_page"
                                items-per-page="vm.m.list.per_page"
                                ng-change="vm.doSearch(vm.m.list.current_page)"
                                class="pagination pagination-sm m-t-none m-b-none">
                            </uib-pagination>    
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>