<section class="content-header">
    <h1>Thống kê nghỉ phép<small></small></h1>
    <!-- <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Lịch nghỉ nghep</li>
    </ol> -->
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thống kê nghỉ phép</h3>
                    <div class="box-tools pull-right">
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
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên nhân viên</th>
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
                                    <th class="text-right">Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data'>
                                    <td>{{$index + 1}}</td>
                                    <td>{{item.user_name}}</td>
                                    <td class="text-right" ng-if="item.t1>0">{{item.t1}}</td>
                                    <td class="text-right" ng-if="item.t1==0">-</td>
                                    <td class="text-right" ng-if="item.t2>0">{{item.t2}}</td>
                                    <td class="text-right" ng-if="item.t2==0">-</td>
                                    <td class="text-right" ng-if="item.t3>0">{{item.t3}}</td>
                                    <td class="text-right" ng-if="item.t3==0">-</td>
                                    <td class="text-right" ng-if="item.t4>0">{{item.t4}}</td>
                                    <td class="text-right" ng-if="item.t4==0">-</td>
                                    <td class="text-right" ng-if="item.t5>0">{{item.t5}}</td>
                                    <td class="text-right" ng-if="item.t5==0">-</td>
                                    <td class="text-right" ng-if="item.t6>0">{{item.t6}}</td>
                                    <td class="text-right" ng-if="item.t6==0">-</td>
                                    <td class="text-right" ng-if="item.t7>0">{{item.t7}}</td>
                                    <td class="text-right" ng-if="item.t7==0">-</td>
                                    <td class="text-right" ng-if="item.t8>0">{{item.t8}}</td>
                                    <td class="text-right" ng-if="item.t8==0">-</td>
                                    <td class="text-right" ng-if="item.t9>0">{{item.t9}}</td>
                                    <td class="text-right" ng-if="item.t9==0">-</td>
                                    <td class="text-right" ng-if="item.t10>0">{{item.t10}}</td>
                                    <td class="text-right" ng-if="item.t10==0">-</td>
                                    <td class="text-right" ng-if="item.t11>0">{{item.t11}}</td>
                                    <td class="text-right" ng-if="item.t11==0">-</td>
                                    <td class="text-right" ng-if="item.t12>0">{{item.t12}}</td>
                                    <td class="text-right" ng-if="item.t12==0">-</td>  
                                    <td class="text-right">{{item.total}}</td>  
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thống kê đăng nhập mobile app (ngày)</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên nhân viên</th>
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
                                    <th class="text-right">Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data_2'>
                                    <td>{{$index + 1}}</td>
                                    <td>{{item.user_name}}</td>
                                    <td class="text-right" ng-if="item.t1>0">{{item.t1}}</td>
                                    <td class="text-right" ng-if="item.t1==0">-</td>
                                    <td class="text-right" ng-if="item.t2>0">{{item.t2}}</td>
                                    <td class="text-right" ng-if="item.t2==0">-</td>
                                    <td class="text-right" ng-if="item.t3>0">{{item.t3}}</td>
                                    <td class="text-right" ng-if="item.t3==0">-</td>
                                    <td class="text-right" ng-if="item.t4>0">{{item.t4}}</td>
                                    <td class="text-right" ng-if="item.t4==0">-</td>
                                    <td class="text-right" ng-if="item.t5>0">{{item.t5}}</td>
                                    <td class="text-right" ng-if="item.t5==0">-</td>
                                    <td class="text-right" ng-if="item.t6>0">{{item.t6}}</td>
                                    <td class="text-right" ng-if="item.t6==0">-</td>
                                    <td class="text-right" ng-if="item.t7>0">{{item.t7}}</td>
                                    <td class="text-right" ng-if="item.t7==0">-</td>
                                    <td class="text-right" ng-if="item.t8>0">{{item.t8}}</td>
                                    <td class="text-right" ng-if="item.t8==0">-</td>
                                    <td class="text-right" ng-if="item.t9>0">{{item.t9}}</td>
                                    <td class="text-right" ng-if="item.t9==0">-</td>
                                    <td class="text-right" ng-if="item.t10>0">{{item.t10}}</td>
                                    <td class="text-right" ng-if="item.t10==0">-</td>
                                    <td class="text-right" ng-if="item.t11>0">{{item.t11}}</td>
                                    <td class="text-right" ng-if="item.t11==0">-</td>
                                    <td class="text-right" ng-if="item.t12>0">{{item.t12}}</td>
                                    <td class="text-right" ng-if="item.t12==0">-</td>  
                                    <td class="text-right">{{item.total}}</td>  
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thống kê check-in mobile app (ngày)</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên nhân viên</th>
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
                                    <th class="text-right">Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data_3'>
                                    <td>{{$index + 1}}</td>
                                    <td>{{item.user_name}}</td>
                                    <td class="text-right" ng-if="item.t1>0">{{item.t1}}</td>
                                    <td class="text-right" ng-if="item.t1==0">-</td>
                                    <td class="text-right" ng-if="item.t2>0">{{item.t2}}</td>
                                    <td class="text-right" ng-if="item.t2==0">-</td>
                                    <td class="text-right" ng-if="item.t3>0">{{item.t3}}</td>
                                    <td class="text-right" ng-if="item.t3==0">-</td>
                                    <td class="text-right" ng-if="item.t4>0">{{item.t4}}</td>
                                    <td class="text-right" ng-if="item.t4==0">-</td>
                                    <td class="text-right" ng-if="item.t5>0">{{item.t5}}</td>
                                    <td class="text-right" ng-if="item.t5==0">-</td>
                                    <td class="text-right" ng-if="item.t6>0">{{item.t6}}</td>
                                    <td class="text-right" ng-if="item.t6==0">-</td>
                                    <td class="text-right" ng-if="item.t7>0">{{item.t7}}</td>
                                    <td class="text-right" ng-if="item.t7==0">-</td>
                                    <td class="text-right" ng-if="item.t8>0">{{item.t8}}</td>
                                    <td class="text-right" ng-if="item.t8==0">-</td>
                                    <td class="text-right" ng-if="item.t9>0">{{item.t9}}</td>
                                    <td class="text-right" ng-if="item.t9==0">-</td>
                                    <td class="text-right" ng-if="item.t10>0">{{item.t10}}</td>
                                    <td class="text-right" ng-if="item.t10==0">-</td>
                                    <td class="text-right" ng-if="item.t11>0">{{item.t11}}</td>
                                    <td class="text-right" ng-if="item.t11==0">-</td>
                                    <td class="text-right" ng-if="item.t12>0">{{item.t12}}</td>
                                    <td class="text-right" ng-if="item.t12==0">-</td>  
                                    <td class="text-right">{{item.total}}</td>  
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
