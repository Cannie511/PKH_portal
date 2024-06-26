<section class="content-header">
    <h1>Chi tiết cửa hàng<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm0300"><span>Cửa hàng</span></a></li>
        <li><a ui-sref="app.crm2600({store_id: vm.m.store_id})"><span>#{{vm.m.store_id}}</span></a></li>
        <li class="active">Sản phẩm cửa hàng</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12 col-md-3 col-lg-2">
            <crm2601/>
            <crm2602/>
        </div>
        <div class="col-xs-12 col-md-9 col-lg-10">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Sản phẩm cửa hàng</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body form">
                    <form role="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Từ ngày</label>
                                    <div class="input-group">
                                        <input class="form-control" datetimepicker ng-model="vm.m.filter.from_date" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Đến ngày</label>
                                    <div class="input-group">
                                        <input class="form-control" datetimepicker ng-model="vm.m.filter.to_date" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
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
                                <!-- <button type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.download()">
                                    <i class="fa fa-download fa-fw"></i>
                                    Tải về
                                </button> -->
                            </div>
                        </div>
                    </form>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>NO</th>
                                    <th>Nhóm</th>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá bán</th>
                                    <th>Số lượng bán</th>
                                    <th>Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list'>
                                    <td>
                                        <img ng-if="item.noImage == 0" class="img-thumb-product" class="img-responsive" ng-src="<% env('URL_IMAGE', 'http://phankhangco.com/img/product/')%>{{item.product_code}}.png" />
                                        <img ng-if="item.noImage == 1" class="img-thumb-product" class="img-responsive" ng-src="<% env('URL_IMAGE', 'http://phankhangco.com/img/product/')%>WT0000.png" />
                                    </td>
                                    <td>
                                        {{$index + 1}}
                                    </td>
                                    <td>
                                        {{item.product_cat_name}}
                                    </td>
                                    <!-- <td>
                                        {{item.product_id}}
                                    </td> -->
                                    <td>
                                        {{item.product_code}} <br/>
                                        <i>{{item.stock_code}}</i>
                                    </td>
                                    <td>
                                        {{item.name}} <br/>
                                        <i>{{item.name_origin}}</i>
                                    </td>
                                    <td class="text-right">
                                        {{item.selling_price | currency: '' : 0}}
                                    </td>
                                    <td class="text-right">
                                        {{item.amount | currency: '' : 0}}
                                    </td>
                                    <td class="text-right">
                                        {{item.money | currency: '' : 0}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>