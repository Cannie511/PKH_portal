<section class="content-header">
    <h1>Bảng báo giá <small>Dành cho nhân viên bán hàng</small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Bảng báo giá</li>
    </ol>
</section>
<section class="content crm0130">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Bảng báo giá</h3>
                    <div class="box-tools pull-right">
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <div class="box-body">
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                            <!-- <div class="col-md-12">
                                <button type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.download()">
                                    <i class="fa fa-download fa-fw"></i>
                                    Xuất PDF
                                </button>
                            </div> -->
                            <div class="col-md-4 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label for="product_code">Nhà sản xuất</label>
                                    <select class="form-control"     
                                        placeholder-text-single="'Chọn nhà sản xuất'"
                                        ng-model="vm.m.filter.supplier_id"
                                        ng-options="item.supplier_id as item.name for item in vm.m.listSupplier"
                                        >
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                                    <i class="fa fa-search fa-fw"></i>
                                    <span translate="COM_BTN_SEARCH"></span>
                                </button>
                                <button type="button" class="btn btn-info" ng-if="vm.m.form.crm_price_list" ng-click="vm.clickPrint('landscape')">
                                    <i class="fa fa-print fa-fw"></i> Xuất PDF (Landscape)
                                </button> 
                                <button type="button" class="btn btn-info" ng-if="vm.m.form.crm_price_list" ng-click="vm.clickPrint('portrait')">
                                    <i class="fa fa-print fa-fw"></i> Xuất PDF (Portrait)
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped product-list">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th ng-click="vm.sort('product_code');" class="sortable">
                                        <span>Mã SP</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="product_code"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>                                    
                                    <th>Hình</th>
                                    <th>Diễn giải</th>
                                    <th ng-click="vm.sort('product_color');" class="sortable">
                                        <span>Màu</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="product_color"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th>Năm BH</th>
                                    <th>Đóng gói</th>
                                    <th>Giá</th>
                                    <th>Đặt hàng</th>
                                    <th>Ghi chú</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list.value'>
                                    <td ng-if="vm.m.list.level[$index]==3">{{vm.m.list.stt[$index]}}</td>
                                    <td ng-if="vm.m.list.level[$index]==3">{{vm.m.list.product[$index].product_code}}</td>
                                    <td ng-if="vm.m.list.level[$index]==3" class="text-center"><img class="img-thumb img-responsive" ng-src="{{vm.m.list.product[$index].imgUrl}}"/></td>
                                    <td ng-if="vm.m.list.level[$index]==3">{{vm.m.list.product[$index].name}}</td>
                                    <td ng-if="vm.m.list.level[$index]==3">{{vm.m.list.product[$index].color}}</td>
                                    <td ng-if="vm.m.list.level[$index]==3">{{vm.m.list.product[$index].warranty_year}}</td>
                                    <td ng-if="vm.m.list.level[$index]==3">{{vm.m.list.product[$index].standard_packing}}</td>
                                    <td ng-if="vm.m.list.level[$index]==3">{{vm.m.list.product[$index].selling_price | currency : '' : 0}}</td>
                                    <td ng-if="vm.m.list.level[$index]==3"></td>
                                    <td ng-if="vm.m.list.level[$index]==3">{{vm.m.list.note[$index]}}</td> 
                                    <td class="bg-primary" colspan="10" ng-if="vm.m.list.level[$index]==1">{{item}}</td>
                                    <td class="bg-info" colspan="10" ng-if="vm.m.list.level[$index]==2">{{item}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div ng-if="vm.can('screen.crm0140.save')">
                        <form role="form" ng-submit="vm.save()">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Soạn bảng báo giá</label>
                                        <textarea class="form-control" ng-model="vm.m.form.crm_price_list" rows="10" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-sm btn-width-default pull-right">
                                        <i class="fa fa-save fa-fw"></i>
                                        <span>Lưu</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
