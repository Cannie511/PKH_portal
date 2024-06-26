<section class="content-header">
    <h1>Doanh số bán hàng<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Doanh số bán hàng</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Doanh số bán hàng</h3>
                    <div class="box-tools pull-right">
                        <div uib-dropdown class="btn-group">
                        </div>
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <div class="box-body form">
                    <form role="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Năm</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn năm'"
                                        ng-model="vm.m.filter.year"
                                        ng-options="item.year as item.year for item in vm.m.init.listYear"
                                        >
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Nhà cung ứng</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn nhà cung ứng'"
                                        ng-model="vm.m.filter.supplier_id"
                                        ng-options="item.supplier_id as item.name for item in vm.m.init.supplierList"
                                        >
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                                    <i class="fa fa-search fa-fw"></i>
                                    <span translate="COM_BTN_SEARCH"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-body" ng-if="vm.m.data.length > 0">
                    <h4>Từng tháng<small>&nbsp;<i>(ĐVT: nghìn đồng)</i></small></h4>
                    <div class="table-responsive">
                        <!--<h4>Doanh số trước chiết khấu</h4>-->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width:150px">&nbsp;</th>
                                    <th class="text-right">Tháng 1</th>
                                    <th class="text-right">Tháng 2</th>
                                    <th class="text-right">Tháng 3</th>
                                    <th class="text-right">Tháng 4</th>
                                    <th class="text-right">Tháng 5</th>
                                    <th class="text-right">Tháng 6</th>
                                    <th class="text-right">Tháng 7</th>
                                    <th class="text-right">Tháng 8</th>
                                    <th class="text-right">Tháng 9</th>
                                    <th class="text-right">Tháng 10</th>
                                    <th class="text-right">Tháng 11</th>
                                    <th class="text-right">Tháng 12</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data'>
                                    <td>{{item.name}}</td>
                                    <td class="text-right"><span title="{{item.t1 | currency: '' : 0}}">{{item.t1 / 1000 | currency: '' : 0}}</span></td>
                                    <td class="text-right"><span title="{{item.t2 | currency: '' : 0}}">{{item.t2 / 1000 | currency: '' : 0}}</span></td>
                                    <td class="text-right"><span title="{{item.t3 | currency: '' : 0}}">{{item.t3 / 1000 | currency: '' : 0}}</span></td>
                                    <td class="text-right"><span title="{{item.t4 | currency: '' : 0}}">{{item.t4 / 1000 | currency: '' : 0}}</span></td>
                                    <td class="text-right"><span title="{{item.t5 | currency: '' : 0}}">{{item.t5 / 1000 | currency: '' : 0}}</span></td>
                                    <td class="text-right"><span title="{{item.t6 | currency: '' : 0}}">{{item.t6 / 1000 | currency: '' : 0}}</span></td>
                                    <td class="text-right"><span title="{{item.t7 | currency: '' : 0}}">{{item.t7 / 1000 | currency: '' : 0}}</span></td>
                                    <td class="text-right"><span title="{{item.t8 | currency: '' : 0}}">{{item.t8 / 1000 | currency: '' : 0}}</span></td>
                                    <td class="text-right"><span title="{{item.t9 | currency: '' : 0}}">{{item.t9 / 1000 | currency: '' : 0}}</span></td>
                                    <td class="text-right"><span title="{{item.t10 | currency: '' : 0}}">{{item.t10 / 1000 | currency: '' : 0}}</span></td>
                                    <td class="text-right"><span title="{{item.t11 | currency: '' : 0}}">{{item.t11 / 1000 | currency: '' : 0}}</span></td>
                                    <td class="text-right"><span title="{{item.t12 | currency: '' : 0}}">{{item.t12 / 1000 | currency: '' : 0}}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-body" ng-if="vm.m.dataSum.length > 0">
                    <h4>Cộng dồn<small>&nbsp;<i>(ĐVT: nghìn đồng)</i></small></h4>
                    <div class="table-responsive">
                        <!--<h4>Doanh số trước chiết khấu</h4>-->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width:150px">&nbsp;</th>
                                    <th class="text-right">Tháng 1</th>
                                    <th class="text-right">Tháng 2</th>
                                    <th class="text-right">Tháng 3</th>
                                    <th class="text-right">Tháng 4</th>
                                    <th class="text-right">Tháng 5</th>
                                    <th class="text-right">Tháng 6</th>
                                    <th class="text-right">Tháng 7</th>
                                    <th class="text-right">Tháng 8</th>
                                    <th class="text-right">Tháng 9</th>
                                    <th class="text-right">Tháng 10</th>
                                    <th class="text-right">Tháng 11</th>
                                    <th class="text-right">Tháng 12</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.dataSum'>
                                    <td>{{item.name}}</td>
                                    <td class="text-right"><span title="{{item.t1 | currency: '' : 0}}">{{item.t1 / 1000 | currency: '' : 0}}</span></td>
                                    <td class="text-right"><span title="{{item.t2 | currency: '' : 0}}">{{item.t2 / 1000 | currency: '' : 0}}</span></td>
                                    <td class="text-right"><span title="{{item.t3 | currency: '' : 0}}">{{item.t3 / 1000 | currency: '' : 0}}</span></td>
                                    <td class="text-right"><span title="{{item.t4 | currency: '' : 0}}">{{item.t4 / 1000 | currency: '' : 0}}</span></td>
                                    <td class="text-right"><span title="{{item.t5 | currency: '' : 0}}">{{item.t5 / 1000 | currency: '' : 0}}</span></td>
                                    <td class="text-right"><span title="{{item.t6 | currency: '' : 0}}">{{item.t6 / 1000 | currency: '' : 0}}</span></td>
                                    <td class="text-right"><span title="{{item.t7 | currency: '' : 0}}">{{item.t7 / 1000 | currency: '' : 0}}</span></td>
                                    <td class="text-right"><span title="{{item.t8 | currency: '' : 0}}">{{item.t8 / 1000 | currency: '' : 0}}</span></td>
                                    <td class="text-right"><span title="{{item.t9 | currency: '' : 0}}">{{item.t9 / 1000 | currency: '' : 0}}</span></td>
                                    <td class="text-right"><span title="{{item.t10 | currency: '' : 0}}">{{item.t10 / 1000 | currency: '' : 0}}</span></td>
                                    <td class="text-right"><span title="{{item.t11 | currency: '' : 0}}">{{item.t11 / 1000 | currency: '' : 0}}</span></td>
                                    <td class="text-right"><span title="{{item.t12 | currency: '' : 0}}">{{item.t12 / 1000 | currency: '' : 0}}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
