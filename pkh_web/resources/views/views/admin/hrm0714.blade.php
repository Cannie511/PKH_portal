<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Cập nhật thông tin nhân viên</h3>
        <div class="box-tools pull-right">
            <div class="box-tools pull-right">
                <!-- <a ui-sref="app.hrm0710({id: vm.m.employee_id})" class="btn btn-warning btn-xs"><i class="fa fa-remove"></i>&nbsp;{{'COM_BTN_CANCEL' | translate}}</a> -->
            </div>
        </div>
    </div>
    <div class="box-body">

        <form name="form" ng-submit="vm.save(form.$valid, form)">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label required">Mã nhân viên</label>
                            <input type="text" class="form-control" ng-model="vm.m.form.employee_code" name="employee_code" placeholder="" maxlength="16" required>
                            <p ng-show="form.employee_code.$error.required && ( vm.formSubmitted || form.employee_code.$touched)" class="help-block">Vui lòng nhập Mã</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label required">Email</label>
                            <p class="form-control-static">{{vm.m.form.email}}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label required">Giới tính</label>
                            <select class="form-control"     
                                placeholder-text-single="'Giới tính'"
                                ng-model="vm.m.form.gender"
                                >
                                <option value="MALE">Nam</option>
                                <option value="FEMALE">Nữ</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label required">Họ và tên</label>
                            <input type="text" class="form-control" ng-model="vm.m.form.fullname" name="fullname" placeholder="" maxlength="128" required>
                            <p ng-show="form.fullname.$error.required && ( vm.formSubmitted || form.fullname.$touched)" class="help-block">Vui lòng nhập Tên</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label required">Ngày sinh</label>
                            <div class="input-group">
                                <input class="form-control" datetimepicker ng-model="vm.m.form.dob" placeholder="YYYY-MM-DD" options="vm.m.dateOptions"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label required">TT Hôn nhân</label>
                            <select class="form-control"     
                                placeholder-text-single="'TT Hôn nhân'"
                                ng-model="vm.m.form.marital_sts"
                                >
                                <option value="SINGLE">Độc thân</option>
                                <option value="MARRIED">Kết hôn</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Phòng ban</label>
                            <input type="text" class="form-control" ng-model="vm.m.form.devision"  maxlength="128" name="devision" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Chức vụ</label>
                            <input type="text" class="form-control" ng-model="vm.m.form.title" maxlength="128" name="title" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Quốc tịch</label>
                            <input type="text" class="form-control" ng-model="vm.m.form.nationality" maxlength="32" name="nationality" placeholder="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">CMND</label>
                            <input type="text" class="form-control" ng-model="vm.m.form.card_id" name="card_id" maxlength="32" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Ngày cấp</label>
                            <div class="input-group">
                                <input class="form-control" datetimepicker ng-model="vm.m.form.card_id_issue_on" placeholder="YYYY-MM-DD" options="vm.m.dateOptions"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Nơi cấp</label>
                            <input type="text" class="form-control" ng-model="vm.m.form.card_id_issue_at" maxlength="64" name="card_id_issue_at" placeholder="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Số ĐT bàn</label>
                            <input type="text" class="form-control" ng-model="vm.m.form.home_phone" maxlength="32" name="home_phone" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Số di động 1</label>
                            <input type="text" class="form-control" ng-model="vm.m.form.tel1" maxlength="32" name="tel1" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Số di động 2</label>
                            <input type="text" class="form-control" ng-model="vm.m.form.tel2" maxlength="32" name="tel2" placeholder="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Mã TNCH</label>
                            <input type="text" class="form-control" ng-model="vm.m.form.tax_number" maxlength="32" name="tax_number" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Số BHXH</label>
                            <input type="text" class="form-control" ng-model="vm.m.form.social_number" maxlength="32" name="social_number" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Số người phụ thuộc</label>
                            <input type="number" class="form-control" ng-model="vm.m.form.count_dependent_person" min="0" max="10" name="count_dependent_person" placeholder="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Bắt đầu thử việc</label>
                            <div class="input-group">
                                <input class="form-control" datetimepicker ng-model="vm.m.form.probation_start_date" placeholder="YYYY-MM-DD" options="vm.m.dateOptions"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Kết thúc thử việc</label>
                            <div class="input-group">
                                <input class="form-control" datetimepicker ng-model="vm.m.form.probation_end_date" placeholder="YYYY-MM-DD" options="vm.m.dateOptions"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Bắt đầu làm việc</label>
                            <div class="input-group">
                                <input class="form-control" datetimepicker ng-model="vm.m.form.start_date" placeholder="YYYY-MM-DD" options="vm.m.dateOptions"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Kết thúc làm việc</label>
                            <div class="input-group">
                                <input class="form-control" datetimepicker ng-model="vm.m.form.end_date" placeholder="YYYY-MM-DD" options="vm.m.dateOptions"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Địa chỉ thường trú</label>
                            <input type="text" class="form-control" ng-model="vm.m.form.address_permernance" maxlength="512" name="address_permernance" placeholder="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Địa chỉ liên lạc</label>
                            <input type="text" class="form-control" ng-model="vm.m.form.address_contact" name="address_contact"  maxlength="512" placeholder="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Ghi chú</label>
                            <textarea rows="5" type="text" class="form-control" ng-model="vm.m.form.notes" name="notes" placeholder=""/>
                        </div>
                    </div>
                </div>

            </div>
            <div class="box-footer">
                <a ui-sref="app.hrm0710({id: vm.m.employee_id})" class="btn btn-default"><i class="fa fa-angle-double-left"></i>{{'COM_BTN_CANCEL' | translate}}</a>
                <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_UPDATE">{{'COM_BTN_UPDATE' | translate}}</button>
            </div> 
        </form>

    </div>
</div>