<section class="content-header">
    <h1>Thông tin bảo hành<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Danh sách thông tin bảo hành</li>
    </ol> 
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách thông tin bảo hành</h3>
                    <div class="box-tools pull-right">
                    </div>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body form" >
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                                                      
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" ng-model="vm.m.filter.email" />
                                </div>
                            </div>

                             <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="tel">Điện thoại</label>
                                    <input type="text" class="form-control" id="tel" ng-model="vm.m.filter.tel" />
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
                                    <th>NO</th>
                                    <th>Tỉnh/TP</th>
                                    <th>Quận/Huyện</th>
                                    <th>Ngày Mua</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Điện thoại</th>
                                    <th>Cửa hàng</th>
                                    <th>Ngày Tạo</th>
                                    <th>Sản phẩm</th>
                                    <th>Thông tin khác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list.data.data'>
                                    <td>{{vm.m.list.data.from + $index}}</td>
                                    <td class="text-left">{{item.area1_name}}</td>
                                   	<td class="text-left">{{item.area2_name}}</td>
                                    <td class="text-left">{{item.purchase_date}}</td>
                                    <td class="text-left">{{item.name }}</td>
                                    <td class="text-left">{{item.email}}</td>
                                    <td class="text-left">{{item.tel}}</td>
                                    <td class="text-left">{{item.store}}</td>
                                    <td class="text-left">{{item.created_at}}</td>
                                    <td class="text-left">{{item.product_code}}</td>
                                    <td class="text-left">{{item.ip}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row" ng-if="vm.m.list.data.from > 0">
                        <div class="col-md-6 col-sm-12 text-left">
                            <p class="form-control-static">{{vm.m.list.data.from}} - {{vm.m.list.data.to}} / {{vm.m.list.data.total}}</p>                            
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <uib-pagination ng-show="vm.m.list.data.from > 0"
                                total-items="vm.m.list.data.total"
                                ng-model="vm.m.data.current_page"
                                items-per-page="vm.m.list.data.per_page"
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
