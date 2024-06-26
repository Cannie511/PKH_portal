<section class="content-header">
    <h1>Doanh số nhân viên bán hàng<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Doanh số NVBH</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Doanh số nhân viên bán hàng</h3>
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
                                        ng-options="item.year as item.year for item in vm.m.init.listYear">
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
                    <div class="table-responsive">
                        <h4>Doanh số đặt hàng (trước chiết khấu)</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NVBH</th>
                                    <th>Tháng 1</th>
                                    <th>Tháng 2</th>
                                    <th>Tháng 3</th>
                                    <th>Tháng 4</th>
                                    <th>Tháng 5</th>
                                    <th>Tháng 6</th>
                                    <th>Tháng 7</th>
                                    <th>Tháng 8</th>
                                    <th>Tháng 9</th>
                                    <th>Tháng 10</th>
                                    <th>Tháng 11</th>
                                    <th>Tháng 12</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data' ng-if='item.name!="Tổng Cộng G"'>
                                    <td>{{item.name}}</td>
                                    <td class="text-right">{{item.t1 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t2 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t3 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t4 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t5 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t6 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t7 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t8 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t9 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t10 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t11 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t12 | currency: '' : 0}}</td>
                                </tr>
                            </tbody>
                        </table>

                        <hr/>

                        <h4>Doanh số đặt hàng (sau chiết khấu)</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NVBH</th>
                                    <th>Tháng 1</th>
                                    <th>Tháng 2</th>
                                    <th>Tháng 3</th>
                                    <th>Tháng 4</th>
                                    <th>Tháng 5</th>
                                    <th>Tháng 6</th>
                                    <th>Tháng 7</th>
                                    <th>Tháng 8</th>
                                    <th>Tháng 9</th>
                                    <th>Tháng 10</th>
                                    <th>Tháng 11</th>
                                    <th>Tháng 12</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data' ng-if='item.name!="Tổng Cộng G"'>
                                    <td>{{item.name}}</td>
                                    <td class="text-right">{{item.t1_2 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t2_2 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t3_2 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t4_2 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t5_2 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t6_2 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t7_2 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t8_2 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t9_2 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t10_2 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t11_2 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t12_2 | currency: '' : 0}}</td>
                                </tr>
                            </tbody>
                        </table>

                        <hr/>

                        <h4>Doanh số giao hàng (trước chiết khấu)</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NVBH</th>
                                    <th>Tháng 1</th>
                                    <th>Tháng 2</th>
                                    <th>Tháng 3</th>
                                    <th>Tháng 4</th>
                                    <th>Tháng 5</th>
                                    <th>Tháng 6</th>
                                    <th>Tháng 7</th>
                                    <th>Tháng 8</th>
                                    <th>Tháng 9</th>
                                    <th>Tháng 10</th>
                                    <th>Tháng 11</th>
                                    <th>Tháng 12</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data' ng-if='item.name!="Tổng Cộng D"'>
                                    <td>{{item.name}}</td>
                                    <td class="text-right">{{item.t1_3 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t2_3 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t3_3 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t4_3 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t5_3 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t6_3 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t7_3 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t8_3 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t9_3 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t10_3 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t11_3 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t12_3 | currency: '' : 0}}</td>
                                </tr>
                            </tbody>
                        </table>

                        <hr/>

                        <h4>Doanh số giao hàng (sau chiết khấu)</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NVBH</th>
                                    <th>Tháng 1</th>
                                    <th>Tháng 2</th>
                                    <th>Tháng 3</th>
                                    <th>Tháng 4</th>
                                    <th>Tháng 5</th>
                                    <th>Tháng 6</th>
                                    <th>Tháng 7</th>
                                    <th>Tháng 8</th>
                                    <th>Tháng 9</th>
                                    <th>Tháng 10</th>
                                    <th>Tháng 11</th>
                                    <th>Tháng 12</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data' ng-if='item.name!="Tổng Cộng D"'>
                                    <td>{{item.name}}</td>
                                    <td class="text-right">{{item.t1_4 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t2_4 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t3_4 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t4_4 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t5_4 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t6_4 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t7_4 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t8_4 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t9_4 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t10_4 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t11_4 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t12_4 | currency: '' : 0}}</td>
                                </tr>
                            </tbody>
                        </table>

                        <h4>Thu hồi công nợ</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NVBH</th>
                                    <th>Tháng 1</th>
                                    <th>Tháng 2</th>
                                    <th>Tháng 3</th>
                                    <th>Tháng 4</th>
                                    <th>Tháng 5</th>
                                    <th>Tháng 6</th>
                                    <th>Tháng 7</th>
                                    <th>Tháng 8</th>
                                    <th>Tháng 9</th>
                                    <th>Tháng 10</th>
                                    <th>Tháng 11</th>
                                    <th>Tháng 12</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data' ng-if='item.name!="Tổng Cộng D"'>
                                    <td>{{item.name}}</td>
                                    <td class="text-right">{{item.t1_5 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t2_5 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t3_5 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t4_5 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t5_5 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t6_5 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t7_5 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t8_5 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t9_5 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t10_5 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t11_5 | currency: '' : 0}}</td>
                                    <td class="text-right">{{item.t12_5 | currency: '' : 0}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
