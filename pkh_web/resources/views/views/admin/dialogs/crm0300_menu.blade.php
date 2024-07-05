<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="vm.cancel()"><span aria-hidden="true">&times;</span></button>
    <div class="modal-title">
        <h4>{{vm . m . item . name}}</h4>
    </div> 
</div>
<div class="modal-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <small>{{vm . m . item . address}}</small>
        </div>
        <div class="col-md-6 col-sm-12">
            <small>Phụ trách hiện tại: {{vm . m . item . salesman_name}}</small>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <small>Khu vực: {{vm . m . item . area1_name}} - <i>{{vm . m . item . area2_name}}</i></small>
        </div>
        <div class="col-md-6 col-sm-12">
            <small>Liên hệ: {{vm . m . item . contact_tel}} -  {{vm . m . item . contact_mobile1}}</small>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <small>Ngày sinh: 01 - 01 - 1999</i></small>
        </div>
        <div class="col-md-6 col-sm-12">
            <small>Điểm tích lũy: {{vm . m . item . scorecard}}</small>
        </div>
    </div>
</div>
<div class="modal-body crm0300-menu">
    <div><h4>Bán hàng</h4></div>
    <a class="btn btn-app" ui-sref='app.crm3021({store_id: vm.m.item.store_id}) ' ng-click="vm.cancel()" placement="top"
        uib-tooltip="Lịch sử cập nhật điểm">
        <i class="fa fa-clock"></i> Lịch sử điểm
    </a>
    <a class="btn btn-app" ui-sref='app.crm0210({store_id: vm.m.item.store_id}) ' ng-click="vm.cancel()" placement="top" uib-tooltip="Nhập đơn hàng (xuất cho khách)">
        <i class="fa fa-shopping-cart"></i> Đơn hàng
    </a>
    <a class="btn btn-app" ui-sref='app.crm0210({store_id: vm.m.item.store_id, order_type: 2})' ng-click="vm.cancel()" placement="top" uib-tooltip="Nhập đơn hàng bảo hành (xuất cho khách)">
        <i class="fa fa-caret-square-left"></i> Đơn bảo hành
    </a>
    <a class="btn btn-app" ui-sref='app.crm0210({store_id: vm.m.item.store_id, order_type: 3})' ng-click="vm.cancel()" placement="top" uib-tooltip="Nhập đơn hàng mẫu (xuất cho khách)">
        <i class="fa fa-vial"></i> Đơn hàng mẫu
    </a>
    <!-- <a class="btn btn-app" ui-sref='app.crm0710({store_id: vm.m.item.store_id})' ng-click="vm.cancel()"  placement="top" uib-tooltip="Nhập thanh toán">
        <i class="fa fa-money-bill-alt"></i> Thanh toán
    </a>
    <a class="btn btn-app" ui-sref='app.crm0751({store_id: vm.m.item.store_id})' ng-click="vm.cancel()"  placement="top" uib-tooltip="Nhập thanh toán trước">
        <i class="fa fa-money-bill-alt"></i> Thanh toán trước
    </a> -->

    <!-- <a class="btn btn-app" ui-sref='app.crm0510({store_id: vm.m.item.store_id}) ' ng-click="vm.cancel()" placement="top" uib-tooltip="Nhập phản hồi cửa hàng">
        <i class="fa fa-comments"></i> Phản hồi (CS)
    </a>
    <a class="btn btn-app" ui-sref='app.crm0332({store_id: vm.m.item.store_id, store_working_id: 0})' ng-click="vm.cancel()" placement="top" uib-tooltip="Nhập ghi chú cửa hàng">
        <i class="fa fa-sticky-note"></i> Ghi chú
    </a> -->
    <!-- <a class="btn btn-app" ui-sref='app.crm1210({store_id: vm.m.item.store_id})' ng-click="vm.cancel()" placement="top" uib-tooltip="Nhập tài khoản ngân hàng">
        <i class="fa fa-university"></i> Tài khoản
    </a> -->

    <!-- <a class="btn btn-app" ui-sref='app.crm1630({store_id: vm.m.item.store_id, import_type:2})' ng-click="vm.cancel()" placement="top" uib-tooltip="Nhập hàng trả lại (Nhập kho ảo riêng)">
        <i class="fa fa-angle-double-left"></i> Nhập trả lại
    </a>
    <a class="btn btn-app" ui-sref='app.crm1630({store_id: vm.m.item.store_id, import_type:1})' ng-click="vm.cancel()" placement="top" uib-tooltip="Nhập hàng bảo hành (Nhập kho ảo riêng)">
        <i class="fa fa-angle-left"></i> Nhập bảo hành
    </a> -->


    <!-- <a class="btn btn-app" ui-sref='app.crm0310({store_id: vm.m.item.store_id})' ng-click="vm.cancel()" placement="top" uib-tooltip="Chỉnh sửa thông tin cửa hàng">
        <i class="fa fa-edit"></i> Chỉnh sửa
    </a>
    <a class="btn btn-app"  ui-sref='app.crm2600({store_id: vm.m.item.store_id})' ng-click="vm.cancel()" placement="top" uib-tooltip="Hồ sơ cửa hàng">
        <i class="fa fa-eye"></i> Chi tiết
    </a>
    <a class="btn btn-app" ui-sref='app.rpt0514({store_id: vm.m.item.store_id})' ng-click="vm.cancel()" placement="top" uib-tooltip="Hồ sơ cửa hàng">
        <i class="fa fa-address-card"></i> Hồ sơ
    </a> -->
</div>




<div class="modal-body crm0300-menu">

    <div><h4>Khác</h4></div>

    <a class="btn btn-app" ui-sref='app.crm0310({store_id: vm.m.item.store_id})' ng-click="vm.cancel()" placement="top" uib-tooltip="Chỉnh sửa thông tin cửa hàng">
        <i class="fa fa-edit"></i> Chỉnh sửa
    </a>
    <a class="btn btn-app"  ui-sref='app.crm2600({store_id: vm.m.item.store_id})' ng-click="vm.cancel()" placement="top" uib-tooltip="Hồ sơ cửa hàng">
        <i class="fa fa-eye"></i> Chi tiết
    </a>
    <a class="btn btn-app" ui-sref='app.rpt0514({store_id: vm.m.item.store_id})' ng-click="vm.cancel()" placement="top" uib-tooltip="Hồ sơ cửa hàng">
        <i class="fa fa-address-card"></i> Hồ sơ
    </a>
</div>