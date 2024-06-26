<section class="content-header">
    <h1>Danh sách tài khoản ngân hàng<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Danh sách tài khoản ngân hàng</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách tài khoản ngân hàng</h3>
                    <div class="box-tools pull-right">
                        <div uib-dropdown class="btn-group">
                            <a ui-sref="app.crm0210" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a>
                        </div>
                    </div>
                </div>
                <div class="box-body form">
                    <form role="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Tên ngân hàng<ng></ng></label>
                                    <input type="text" ng-model="vm.m.filter.bank_name" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Tên cửa hàng</label>
                                    <input type="text" ng-model="vm.m.filter.store_name" class="form-control"/>
                                </div>
                                </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Mã tài khoản</label>
                                    <input type="text" ng-model="vm.m.filter.bank_account_no" class="form-control"/>
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
                                    <i class="fa fa-download fa-fw"></i>
                                    Tải về
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
                                    <th>No</th>
                                    <th>Cửa hàng</th>
                                    <th>NVBH</th>                         
                                    <th>Ngân hàng</th>
                                    <th>Chi nhánh</th>
                                    <th>Mã số tài khoản</th>
                                    <th>Tên tài khoản</th>
                                    <th>Ghi chú</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data'>
                                    <td class="col-action">
                                        <div class="btn-group" uib-dropdown dropdown-append-to-body>
                                          <button type="button" class="btn btn-default btn-sm" uib-dropdown-toggle>
                                            <i class="fa fa-ellipsis-v"></i>
                                          </button>
                                          <ul class="dropdown-menu" uib-dropdown-menu role="menu" aria-labelledby="btn-append-to-body">
                                            <li role="menuitem"><a ui-sref='app.crm1210({store_id:item.store_id,bank_account_id: item.bank_account_id})' translate="COM_BTN_EDIT"></a></li>
                                          </ul>
                                        </div>
                                    </td>
                                    <td>{{vm.m.data.from+$index}}</td>
                                    <td>{{item.name}}<br/><small><i>{{item.address}}</i></small></td>
                                    <td>{{item.salesman_name}}</td>
                                    <td>{{item.bank_name}}</td>
                                    <td>{{item.bank_branch}}</td>
                                    <td>{{item.bank_account_no}}</td>
                                    <td>{{item.bank_account_name}}</td>
                                    <td>{{item.notes}}</td>
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
