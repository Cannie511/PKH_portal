<section class="content-header">
    <h1>Thiết lập <small>Trang chủ</small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Thiết lập trang chủ</li>
    </ol>
</section>
<section class="content cms0100">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thiết lập</h3>
                    <div class="box-tools pull-right">
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <div class="box-body">
                    <form class="form" ng-submit="vm.save()">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Thông báo 1</label>
                                    <textarea class="form-control" ng-model="vm.m.form.cms_home_marquee" rows="5" ></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Thông báo 2</label>
                                    <textarea class="form-control" ng-model="vm.m.form.cms_home_marquee_2" rows="5" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                                    <i class="fa fa-search fa-fw"></i>
                                    <span translate="COM_BTN_UPDATE"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li ng-class="{'active': vm.m.activeFlag == 1}"><a href="javascript:void(0)" ng-click="vm.chooseTab(1)"><h5>Sản phẩm bán chạy &nbsp;</h5></a></li>
                    <li ng-class="{'active': vm.m.activeFlag == 2}"><a href="javascript:void(0)" ng-click="vm.chooseTab(2)"><h5>Sản phẩm mới &nbsp;</h5></a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane" ng-class="{'active': vm.m.activeFlag == 1}">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Thêm sản phẩm</label>
                                    <select class="form-control" name="top_product_id"
                                        placeholder-text-single="'Sản phẩm'"
                                        ng-model="vm.m.form.selectProduct"
                                        ng-options="item as item.displayName for item in vm.m.init.listProductFilter"
                                        name="top_product_id"
                                        chosen
                                        ng-change="vm.addProduct(item)"
                                        >
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <!-- <div class="form-group">
                                    <label class="control-label required">Sản phẩm top</label>
                                    <input type="text" class="form-control" ng-model="vm.m.form.cms_home_top_product"/>
                                </div> -->
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Loại</th>
                                            <th>Mã sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat='item in vm.m.form.listProduct'>
                                            <td>{{item.product_cat_name}}</td>
                                            <td>{{item.product_code}}</td>
                                            <td>{{item.name}}</td>
                                            <td>
                                                <button class="btn btn-xs btn-danger" ng-click="vm.removeProduct(item)">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" ng-class="{'active': vm.m.activeFlag == 2}">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Thêm sản phẩm</label>
                                    <select class="form-control" name="top_product_id_new"
                                        placeholder-text-single="'Sản phẩm'"
                                        ng-model="vm.m.form.selectProductNew"
                                        ng-options="item as item.displayName for item in vm.m.init.listProductFilterNew"
                                        name="top_product_id_new"
                                        chosen
                                        ng-change="vm.addProductNew(item)"
                                        >
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <!-- <div class="form-group">
                                    <label class="control-label required">Sản phẩm top</label>
                                    <input type="text" class="form-control" ng-model="vm.m.form.cms_home_top_product"/>
                                </div> -->
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Loại</th>
                                            <th>Mã sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat='item in vm.m.form.listProductNew'>
                                            <td>{{item.product_cat_name}}</td>
                                            <td>{{item.product_code}}</td>
                                            <td>{{item.name}}</td>
                                            <td>
                                                <button class="btn btn-xs btn-danger" ng-click="vm.removeProductNew(item)">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Tin nhắn ZALO</h3>
                    <div class="box-tools pull-right">
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <div class="box-body">
                    <form class="form" ng-submit="vm.broadcast()">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Thông báo ZALO bằng Official Account cho tất cả followers</label>
                                    <textarea class="form-control" ng-model="vm.m.form.cms_zalo_notify" rows="20" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                                    <i class="fa fa-search fa-fw"></i>
                                    <span >Gửi Thông Báo</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
