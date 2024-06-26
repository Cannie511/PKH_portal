<section class="content-header">
    <h1>Danh sách sản phẩm <small>Dành cho nhân viên bán hàng</small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Danh sách sản phẩm</li>
    </ol>
</section>
<section class="content crm0130">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách sản phẩm</h3>
                    <div class="box-tools pull-right">
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <div class="box-body">
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="product_code">Mã PKH</label>
                                    <input type="text" class="form-control" id="product_code" ng-model="vm.m.filter.product_code" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="name">Tên SP</label>
                                    <input type="text" class="form-control" id="name" ng-model="vm.m.filter.name" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="stock_code">Mã NSX</label>
                                    <input type="text" class="form-control" id="stock_code" ng-model="vm.m.filter.stock_code" />
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
                    <div class="table-responsive">
                        <table class="table table-striped product-list">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Hình ảnh</th>
                                    <th ng-click="vm.sort('supplier_name');" class="sortable">
                                        <span translate="CRM0130_LABEL_SUPPLIER_NAME"></span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="supplier_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th ng-click="vm.sort('product_cat_name');" class="sortable">
                                        <span translate="CRM0130_LABEL_PRODUCT_CAT_NAME"></span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="product_cat_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th ng-click="vm.sort('product_code');" class="sortable">
                                        <span translate="CRM0130_LABEL_PRODUCT_CODE"></span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="product_code"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th ng-click="vm.sort('product_name');" class="sortable">
                                        <span translate="CRM0130_LABEL_PRODUCT_NAME"></span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="product_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th ng-click="vm.sort('stock_code');" class="sortable">
                                        <span translate="CRM0130_LABEL_STOCK_CODE"></span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="stock_code"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th ng-click="vm.sort('price');" class="sortable">
                                        <span translate="CRM0130_LABEL_PRICE"></span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="price"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th ng-click="vm.sort('price_sample');" class="sortable">
                                        <span>Hàng mẫu</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="price_sample"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th ng-click="vm.sort('remain');" class="sortable">
                                        <span translate="CRM0130_LABEL_REMAIN"></span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="remain"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th ng-click="vm.sort('ordering');" class="sortable">
                                        <span translate="CRM0130_LABEL_ORDERING"></span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="ordering"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list'>
                                    <td>{{$index + 1}}</td>
                                    <td>
                                        <img class="img-thumb" class="img-responsive" ng-src="{{item.imgUrl}}" />
                                    </td>
                                    <td>{{item.supplier_name}}</td>
                                    <td>{{item.product_cat_name}}</td>
                                    <td>{{item.product_code}}</td>
                                    <td>{{item.name}}</td>
                                    <td>{{item.stock_code}}</td>
                                    <td>{{item.selling_price | currency : '' : 0}}</td>
                                    <td>{{item.selling_price_sample | currency : '' : 0}}</td>
                                    <td ng-class="{'text-danger': item.amount_remain < 0 }">{{item.amount_remain | currency : '' : 0}}</td>
                                    <td>{{item.in_order}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
