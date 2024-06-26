<section class="content-header">
    <h1>Thông tin bảo hành<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">In QR</li>
    </ol> 
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">In QR</h3>
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
                                    <label for="size">Kích thước</label>
                                    <input type="number" class="form-control" id="size" ng-model="vm.m.form.size" />
                                </div>
                            </div>

                             <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="amount">Số lượng</label>
                                    <input type="number" class="form-control" id="amount" ng-model="vm.m.form.amount" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                                    <i class="fa fa-search fa-fw"></i>
                                    <span translate="COM_BTN_SEARCH"></span>
                                </button>
                                <button type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.resetFilter()">
                                    <i class="fa fa-eraser fa-fw"></i>
                                    <span translate="COM_BTN_RESET"></span>
                                </button> -->
                                <button type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.download()">
                                    <i class="fa fa-file-excel-o fa-fw"></i>
                                    <span>In QR</span>
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
                                    <th>Hình ảnh</th>
                                    <th>Mã SP</th>
                                    <th>Tên SP</th>
                                    <th>Đóng thùng (cái)</th>
                                    <th>Đơn giá</th>
                                    <th>Tồn kho</th>
                                    <th>Đang đặt</th>
                                    <th>Còn lại</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.products'>
                                    <td>{{$index + 1}}</td>
                                    <td><button class="btn btn-danger btn-sm" ng-click="vm.removeProduct(item)"><i class="fa fa-minus"></i></button></td>
                                    <td>
                                        <img ng-if="item.noImage == 0" class="img-thumb-product" class="img-responsive" ng-src="<% env('URL_IMAGE', 'http://phankhangco.com/img/product/')%>{{item.product_code | substr:0:6}}.png" />
                                        <img ng-if="item.noImage == 1" class="img-thumb-product" class="img-responsive" ng-src="<% env('URL_IMAGE', 'http://phankhangco.com/img/product/')%>WT0000.png" />
                                    </td>
                                    <td><b style="color:blue;">{{item.product_code}}</b><br/><i>({{item.stock_code}})</i></td>
                                    <td>{{item.name}}<br/><i>({{item.name_origin}})</i></td>
                                    <td>{{item.standard_packing}}</td>
                                    <td>{{item.selling_price | currency: '': 0}}</td>
                                    <td>Tồn kho</td>
                                    <td>Đang đặt</td>
                                    <td>Còn lại</td>
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

            <div class="box box-info collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Sản phẩm</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <!-- <div class="box-body form" style="display: none">
                    <form role="form" ng-submit="vm.searchProduct()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Mã SP</label>
                                    <input type="text" ng-model="vm.m.filter.product_code" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Tên sản phẩm</label>
                                    <input type="text" ng-model="vm.m.filter.product_name" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Mã Nhà Máy</label>
                                    <input type="text" ng-model="vm.m.filter.supplier_code" class="form-control"/>
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
                </div> -->
                
                <div class="box-body" >
                    <div class="table-responsive" ng-if="vm.m.init.productList">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>Hình ảnh</td>
                                    <td>Mã SP</td>
                                    <td>Tên SP</td>
                                    <td>Đóng thùng (cái)</td>
                                    <td>Đơn giá</td>
                                    <td>Tồn kho</td>
                                    <td>Đang đặt</td>
                                    <td>Còn lại</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.init.productList' ng-if="item.hide != true">
                                    <td><button class="btn btn-primary btn-sm" ng-click="vm.addProduct(item)"><i class="fa fa-plus-circle"></i></button></td>
                                    <td>
                                        <img ng-if="item.noImage == 0" class="img-thumb-product" class="img-responsive" ng-src="<% env('URL_IMAGE', 'http://phankhangco.com/img/product/')%>{{item.product_code | substr:0:6}}.png" />
                                        <img ng-if="item.noImage == 1" class="img-thumb-product" class="img-responsive" ng-src="<% env('URL_IMAGE', 'http://phankhangco.com/img/product/')%>WT0000.png" />
                                    </td>
                                    <td><b style="color:blue;">{{item.product_code}}</b><br/><i>({{item.stock_code}})</i></td>
                                    <td>{{item.name}}<br/><i>({{item.name_origin}})</i></td>
                                    <td>{{item.standard_packing}}</td>
                                    <td>{{item.selling_price | currency: '': 0}}</td>
                                    <td>Tồn kho</td>
                                    <td>Đang đặt</td>
                                    <td>Còn lại</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
