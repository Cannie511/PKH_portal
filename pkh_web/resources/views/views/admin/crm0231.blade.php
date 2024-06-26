<section class="content-header">
    <h1>Sản phẩm cửa hàng chưa mua <small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Sản phẩm cửa hàng chưa mua</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Sản phẩm cửa hàng chưa mua</h3>
                    <div class="box-tools pull-right">
                        <!--<a ui-sref="app.crm0310" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a>-->
                    </div>
                </div>
                <div class="box-body form">
                    <form role="form" ng-submit="vm.search()">
                        <div class="row">
                        <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Mã cửa hàng</label>
                                    <input type="text" ng-model="vm.m.filter.storeId" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Tên cửa hàng</label>
                                    <input type="text" ng-model="vm.m.filter.storeName" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Tỉnh/Thành</label>
                                    {{vm.m.filter.area1}}
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn tỉnh'"
                                        ng-model="vm.m.filter.area1"
                                        ng-options="item.area_id as item.name for item in vm.m.init.listArea1  | filter : {'area_group_id': vm.m.filter.areaGroup}">
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group" ng-if="vm.m.filter.area1">
                                    <label>Quận/Huyện</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn tỉnh'"
                                        ng-model="vm.m.filter.area2"
                                        ng-options="item.area_id as item.name for item in vm.m.init.listArea2 | filter : {'parent_area_id': vm.m.filter.area1}">
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Mã sản phẩm</label>
                                    <input type="text" ng-model="vm.m.filter.productCode" class="form-control"/>
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
                                    <th>NO</th>
                                    <th ng-click="vm.sort('area1');" class="sortable">
                                        <span translate="COM_LABEL_AREA1"></span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="area1"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th ng-click="vm.sort('name');" class="sortable">
                                        <span translate="COM_LABEL_STORE"></span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th>
                                        <span>Mã sản phẩm</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th>
                                        <span>Tên sản phẩm</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data'>
                                    <td>{{$index + vm.m.data.from}}</td>
                                    <td>
                                        {{item.area1}}<br/>
                                        <i>{{item.area2}}</i>
                                    </td>
                                    <td>
                                    <a ui-sref='app.crm2600({store_id: item.store_id})'>#{{item.store_id}}</a> - {{item.store_name}}<br/>
                                        <i>{{item.address}}</i>
                                    </td>
                                    <td>{{item.product_code}}</td>
                                    <td>{{item.product_name}}</td>
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