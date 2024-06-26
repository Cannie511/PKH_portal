<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Thông tin nhân viên</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-xs btn-info" ng-click="vm.sendCode()"><i class="fa fa-fw fa-send"/>Send Code</button>
            <a ui-sref="app.hrm0714({id: vm.m.employee_id})" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i>&nbsp;{{'COM_BTN_UPDATE' | translate}}</a>
        </div>
    </div>
    <div class="box-body">

        <div class="row">
            <div class="col-md-4 col-xs-12">
                <label>Mã Nhân Viên</label>
                <p class="form-control-static">{{vm.m.employee.employee_code}}</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <label>Email</label>
                <p class="form-control-static">{{vm.m.employee.email}}</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <label>Giới tính</label>
                <p class="form-control-static" ng-if="vm.m.employee.gender == 'MALE'">Nam</p>
                <p class="form-control-static" ng-if="vm.m.employee.gender == 'FEMALE'">Nữ</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-xs-12">
                <label>Họ và tên</label>
                <p class="form-control-static">{{vm.m.employee.fullname}}</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <label>Ngày Sinh</label>
                <p class="form-control-static">{{vm.m.employee.dob}}</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <label>TT Hôn nhân</label>
                <p class="form-control-static" ng-if="vm.m.employee.marital_sts == 'SINGLE'">Độc thân</p>
                <p class="form-control-static" ng-if="vm.m.employee.marital_sts == 'MARRIED'">Kết hôn</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-xs-12">
                <label>Phòng ban</label>
                <p class="form-control-static">{{vm.m.employee.devision}}</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <label>Chức vụ</label>
                <p class="form-control-static">{{vm.m.employee.title}}</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <label>Quốc tịch</label>
                <p class="form-control-static">{{vm.m.employee.nationality}}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-xs-12">
                <label>CMND</label>
                <p class="form-control-static">{{vm.m.employee.card_id}}</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <label>Ngày cấp</label>
                <p class="form-control-static">{{vm.m.employee.card_id_issue_on}}</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <label>Nơi cấp</label>
                <p class="form-control-static">{{vm.m.employee.card_id_issue_at}}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-xs-12">
                <label>Số ĐT bàn</label>
                <p class="form-control-static">{{vm.m.employee.home_phone}}</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <label>Số di động 1</label>
                <p class="form-control-static">{{vm.m.employee.tel1}}</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <label>Số di động 2</label>
                <p class="form-control-static">{{vm.m.employee.tel2}}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-xs-12">
                <label>Mã TNCH</label>
                <p class="form-control-static">{{vm.m.employee.tax_number}}</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <label>Số BHXH</label>
                <p class="form-control-static">{{vm.m.employee.social_number}}</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <label>Người phụ thuộc</label>
                <p class="form-control-static">{{vm.m.employee.count_dependent_person}}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-xs-12">
                <label>Bắt đầu thử việc</label>
                <p class="form-control-static">{{vm.m.employee.probation_start_date}}</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <label>Kết thúc thử việc</label>
                <p class="form-control-static">{{vm.m.employee.probation_end_date}}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-xs-12">
                <label>Bắt đầu làm việc</label>
                <p class="form-control-static">{{vm.m.employee.start_date}}</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <label>Kết thúc làm việc</label>
                <p class="form-control-static">{{vm.m.employee.end_date}}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xs-12">
                <label>Địa chỉ thường trú</label>
                <p class="form-control-static">{{vm.m.employee.address_permernance}}</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <label>Địa chỉ liên lạc</label>
                <p class="form-control-static">{{vm.m.employee.address_contact}}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xs-12">
                <label>Ghi chú</label>
                <p class="form-control-static">{{vm.m.employee.notes}}</p>
            </div>
        </div>

    </div>
</div>