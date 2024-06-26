<section class="content-header">
    <h1>Danh sách bài kiểm tra<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Bài kiểm tra</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách bài kiểm tra</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body form" style="display:none">
                    <form role="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Mã đơn hàng</label>
                                    <input type="text" ng-model="vm.m.filter.store_order_code" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Tên cửa hàng</label>
                                    <input type="text" ng-model="vm.m.filter.store_name" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select class="form-control" ng-model="vm.m.filter.order_sts" ng-init="vm.m.filter.order_sts = ''">
                                        <option value="">Tất cả</option>
                                        <option value="0">Mới</option>
                                        <option value="1">Đang xuất</option>
                                        <option value="2">Đang giao</option>
                                        <option value="4">Hoàn tất</option>
                                        <option value="5">Hủy</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Tháng</label>
                                    <p class="input-group">
                                        <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM" ng-model="vm.m.filter.order_date" is-open="vm.dp1Opened" datepicker-options="vm.m.dateOptions" close-text="Close"
                                        ng-model-options="{timezone: 'utc'}" />
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" ng-click="vm.dp1Opened = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </p>
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
                                <button type="button" class="btn btn-sm btn-info" ng-click="vm.clickPrintCheck()"><i class="fa fa-print fa-fw"></i>Phiếu kiểm hàng</button> 
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="col-no">NO</th>
                                    <th class="col-action">
                                    </th>
                                    <th>
                                        <span>Tiêu đề</span>
                                    </th>
                                    <th>
                                        <span>Số người</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data'>
                                    <td class="col-no">{{$index + 1}}</td>
                                    <td>
                                        <!--<a ui-sref="app.hrm0210({id: item.id})" class="btn btn-xs btn-info">
                                            <i class="fa fa-play fa-fw"></i>
                                        </a>-->
                                    </td>
                                    <td>{{item.title}}</td>
                                    <td>{{item.count_result}}/{{item.count_assign}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row text-right">
                        <div class="col-md-12">
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
