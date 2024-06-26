<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Tạo mới</h3>

        <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">
            <li><a ui-sref='app.crm0210({store_id: vm.m.store_id, order_type: 1}) '>Đơn hàng (khách)</a></li>
            <li><a ui-sref='app.crm0210({store_id: vm.m.store_id, order_type: 2}) '>Đơn hàng bảo hành (khách)</a></li>
            <li> <a ui-sref='app.crm0210({store_id: vm.m.store_id, order_type: 3}) '>Đơn hàng mẫu (khách)</a></li>
            <li ng-if="vm.can('screen.crm0710')"><a ui-sref='app.crm0710({store_id: vm.m.store_id})'>Nhập thanh toán</a></li>
            <li><a ui-sref='app.crm0332({store_id: vm.m.store_id, store_working_id: 0})'>Ghi chú cửa hàng</a></li>
            <li ng-if="vm.can('screen.crm1630')"><a ui-sref='app.crm1630({store_id: vm.m.store_id, import_type:2})'>Trả lại (Kho ảo)</a></li>
            <li ng-if="vm.can('screen.crm1630')"> <a ui-sref='app.crm1630({store_id: vm.m.store_id, import_type:1})'>Bảo hành (Kho ảo)</a></li>
            <li ng-if="vm.can('screen.crm1210')"><a ui-sref='app.crm1210({store_id: vm.m.store_id})'>Tài khoản ngân hàng</a></li>
        </ul>
    </div>
    <!-- /.box-body -->
</div>

<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Liên kết</h3>

        <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">
            <!-- <li class="active"><a href="#"><i class="fa fa-inbox"></i> Inbox
                    <span class="label label-primary pull-right">12</span></a></li> -->
            <!-- <li ng-class="{'active': vm.m.screen_name == 'crm2600'}"><a href="#">Thông tin cửa hàng</a></li> -->
            <li><a ui-sref='app.crm0200_params({store_id: vm.m.store_id})'>Đơn đặt hàng</a></li>
            <li><a ui-sref='app.crm0400_params({store_id: vm.m.store_id})'>Phiếu xuất</a></li>
            <li><a ui-sref='app.crm0330({store_id: vm.m.store_id})'>Ghi chú</a></li>
            <li><a ui-sref='app.rpt0514({store_id: vm.m.store_id})'>Report sản phẩm</a></li>
            <li ng-if="vm.can('screen.crm0230')"><a ui-sref='app.crm0230({store_id: vm.m.store_id})'>Sản phẩm đã mua</a></li>
            <li ng-if="vm.can('screen.crm0231')"><a ui-sref='app.crm0231({store_id: vm.m.store_id})'>Sản phẩm chưa mua</a></li>
            <li><a href="#">Chăm sóc khách hàng</a></li>
            <li><a href="#">Log check-in</a></li>
        </ul>
    </div>
    <!-- /.box-body -->
</div>