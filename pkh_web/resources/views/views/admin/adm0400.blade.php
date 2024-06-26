<section class="content-header">
    <h1>Điều khiển batch<small></small></h1>
    <!-- <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Lịch nghỉ nghep</li>
    </ol> -->
</section>
<section class="content">
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Điều khiển batch</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body form">
                    <form class="form" ng-submit="vm.run()">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="month">Lệnh</label>
                                    <textarea class="form-control" ng-model="vm.m.form.cmd" rows="10">
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                                    <i class="fa fa-play"></i>
                                    <span>Thực thi</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Clear cache</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body form">
                    
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-warning btn-sm btn-width-default" ng-click="vm.clear('route')">
                            Route
                        </button>
                        <button type="button" class="btn btn-warning btn-sm btn-width-default" ng-click="vm.clear('config')">
                            Config
                        </button>
                        <button type="button" class="btn btn-warning btn-sm btn-width-default" ng-click="vm.clear('cache')">
                            Cache
                        </button>
                        <button type="button" class="btn btn-warning btn-sm btn-width-default" ng-click="vm.clear('clear')">
                            View
                        </button>
                        <button type="button" class="btn btn-warning btn-sm btn-width-default" ng-click="vm.clear('All')">
                            All
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Hướng dẫn sử dụng</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body">
                    <ol>
                        <li>
                            <code>BAT0100 {--month=}</code>
                            <p class="help-block">
                                Xếp hạng cửa hàng theo doanh thu
                                month: yyyy-MM
                                Ex: BAT0100 --month=2017-04
                            </p>
                        </li>
                        <li>
                            <code>BAT0110 {--fromDate=}</code>
                            <p class="help-block">
                                Tính lại số ngày tồn kho của sản phẩm
                                fromDate: yyyyMMdd
                                Ex: BAT0110 --fromDate=2017-04-01
                            </p>
                        </li>
                        <li>
                            <code>BAT0131 {--num=}</code>
                            <p class="help-block">
                                Lấy thông tin vị trí ip đăng nhập
                                Ex: BAT0131 --num=5
                            </p>
                        </li>BAT0132 {--store_ids=} {--limit=}
                        <li>
                            <code>BAT0132 {--store_ids=} {--limit=}</code>
                            <p class="help-block">
                                Lấy thông tin vị trí ip đăng nhập
                                Ex: BAT0132 --store_ids=1,2,3 --limit=100
                            </p>
                        </li>
                        <li>
                            <code>BAT0210 {storeDeliveryId} {productId} {--price=}  {--amount=}</code>
                            <p class="help-block">
                                Sửa thông tin phiếu xuất
                                Ex: BAT0210 storeDeliveryId=0 productId=0 --price=-1 --amount=-1
                            </p>
                        </li>
                        <li>
                            <code>BAT0220 {storeOrderId} {productId} {price=}</code>
                            <p class="help-block">
                                Sửa thông tin giá đơn đặt hàng + phiếu xuất
                                Ex: BAT0220 storeOrderId=0 productId=0 price=-1
                            </p>
                        </li>
                        <li>
                            <code>BAT0310</code>
                            <p class="help-block">
                                Cập nhật tình trạng thanh toán đơn hàng
                                Ex: BAT0310
                            </p>
                        </li>
                
                        <li>
                            <code>BAT0230</code>
                            <p class="help-block">
                                Hủy hàng còn của đơn đặt hàng từ tháng được nhập trở về trước
                                Ex: BAT0230 --month=2017-04
                            </p>
                        </li>
                        <li>
                            <code>BAT0240 {storeOrderId} {newId}</code>
                            <p class="help-block">
                               Chỉnh sửa thông tin salesman của đơn đặt hàng và đơn xuất hàng 
                               Ex: BAT0240 storeOrderId=0 newId=12
                            </p>
                        </li>
                      
                        <li>
                            <code>BAT0913 {warehouse_id=} {date=}</code>
                            <p class="help-block">
                               Hủy số liệu cân bằng kho (tăng-giảm) trong wh_change với ngày và kho cho trước 
                               Ex: BAT0913 warehouse_id=1 date=2017-04-22
                            </p>
                        </li>

                        <li>
                            <code>BAT0200</code>
                            <p class="help-block">
                               Cập nhật mức độ hoàn thành đơn khách đặt.
                            </p>
                        </li>

                        <li>
                            <code>BAT0410 {fromDate=} {toDate=}</code>
                            <p class="help-block">
                               Cập nhật thời gian làm việc (Login/Logout)
                               Ex: BAT0410 --fromDate=2018-10-01 --toDate=2020-08-31
                            </p>
                        </li>
                        <li>
                            <code>BAT0420 {fromDate=} {toDate=}</code>
                            <p class="help-block">
                               Cập nhật thời gian làm việc (Checkin/Checkout)
                               Ex: BAT0420 --fromDate=2020-09-01 --toDate=2020-10-30
                            </p>
                        </li>
                        <li>
                            <code>BAT2100 {mode=} {id=} {saleman_id=}</code>
                            <p class="help-block">
                               Cập nhật khu vực cho saleman. mode = 1 theo khu vuc, mode = 2 theo cua hang.
                               Ex: BAT2100 mode=1 id=1 saleman_id=1
                            </p>
                        </li>

                        <li>
                            <code>BAT0912 {mode=} </code>
                            <p class="help-block">
                               Check duplicated record in trn_warehouse_change and fix it. mode = 0: report through google chat. mode = 1: fix 
                               Ex: BAT0912 mode=0
                            </p>
                        </li>
                      
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
