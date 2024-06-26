<section class="content-header">
    <h1>Danh sách khách hàng đặt hàng qua web<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Danh sách khách hàng đặt hàng qua web</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách khách hàng đặt hàng qua web</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body form">
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                           
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="name">Tên khách hàng</label>
                                    <input type="text" class="form-control" id="name" ng-model="vm.m.filter.name" />
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="phone_number">Số điện thoại</label>
                                    <input type="text" class="form-control" id="phone_number" ng-model="vm.m.filter.phone_number" />
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
                        <table class="table table-striped product-list">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Họ tên</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th>Thời gian khởi tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data'>
                                    <td>{{$index + vm.m.data.from}}</td>
                                    <td>{{item.name}}</td>
                                    <td>{{item.phone_number}}</td>
                                    <td >{{item.email}}</td>
                                    <td >{{item.created_at}}</td>
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