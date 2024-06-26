<section class="content-header">
    <h1>Danh sách Nhà cung ứng<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Danh sách các nhà cung ứng</li>
    </ol> 
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách các nhà cung ứng</h3>
                    <div class="box-tools pull-right">
                        <a ui-sref="app.crm2521({})" class="btn btn-success btn-xs">
                            <i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}
                        </a>
                    </div>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body form" >
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                                                      
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="delivery_vendor_name">Tên nhà cung ứng</label>
                                    <input type="text" class="form-control" id="supplier_name" ng-model="vm.m.filter.supplier_name" />
                                </div>
                            </div>

                             <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="delivery_vendor_name">Số điện thoại liên hệ</label>
                                    <input type="text" class="form-control" id="contact_tel" ng-model="vm.m.filter.contact_tel" />
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
                                    <th>Tên Nhà cung ứng</th>
                                    <th>Mã Nhà cung ứng</th>
                                    <th>Người liên hệ</th>
                                    <th>Contact email</th>
                                    <th>Contact phone</th>
                                    <th>Địa chỉ</th>
                                   
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
                                            <li role="menuitem"><a ui-sref='app.crm2521({supplier_id: item.supplier_id})'>Sửa nhà cung cấp</a></li>
                                            <li role="menuitem"><a ui-sref='app.crm1310({supplier_id: item.supplier_id})'>Thêm đơn</a></li>
                                          </ul>
                                        </div>
                                    </td>

                                    <td>{{vm.m.list.from + $index}}</td>
                                    <td class="text-left">{{item.name}}</td>
                                   	<td class="text-left">{{item.supplier_code}}</td>
                                       <td class="text-left">{{item.contact_name}}</td>   
                                    <td class="text-left">{{item.contact_email}}</td>
                                    <td class="text-left">{{item.contact_tel }}</td>
                                    <td>{{item.address}}</td>
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
