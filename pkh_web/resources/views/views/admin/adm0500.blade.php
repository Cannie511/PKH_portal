<section class="content-header">
    <h1>Thiết lập thông số<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Thiết lập thông số</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Nhóm</h3>
                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding" style="">
                    <ul class="nav nav-pills nav-stacked">
                        <li ng-repeat="tab in vm.m.tabs" ng-click="vm.setTab(tab)" ng-class="{'active': vm.m.currentTab == tab.id}"><a href="javascript: void(0);"><i ng-class="tab.icon"></i> {{tab.name}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông số</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body" ng-if="vm.m.currentTab == 'PRINT_DELIVERY'">
                    <form class="form" ng-submit="vm.save('PRINT_DELIVERY')">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Khổ giấy</label>
                                    <select class="form-control" ng-model="vm.m.forms.PRINT_DELIVERY.print_delivery_page_size">
                                        <option value="A4">A4</option>
                                        <option value="A5">A5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="month">In liên 1 (Kho)</label>
                                    <div class="checkbox">
                                        <label><input ng-model="vm.m.forms.PRINT_DELIVERY.print_delivery_page_1" type="checkbox" ng-true-value="'1'" ng-false-value="'0'">In</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="month">In liên 2 (Kế toán)</label>
                                    <div class="checkbox">
                                        <label><input ng-model="vm.m.forms.PRINT_DELIVERY.print_delivery_page_2" type="checkbox" ng-true-value="'1'" ng-false-value="'0'">In</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="month">In liên 3 (Lưu tạm)</label>
                                    <div class="checkbox">
                                        <label><input ng-model="vm.m.forms.PRINT_DELIVERY.print_delivery_page_3" type="checkbox" ng-true-value="'1'" ng-false-value="'0'">In</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="month">In liên 4 (Khách giữ)</label>
                                    <div class="checkbox">
                                        <label><input ng-model="vm.m.forms.PRINT_DELIVERY.print_delivery_page_4" type="checkbox" ng-true-value="'1'" ng-false-value="'0'">In</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="month">In thư cảm ơn</label>
                                    <div class="checkbox">
                                        <label><input ng-model="vm.m.forms.PRINT_DELIVERY.print_delivery_page_5" type="checkbox" ng-true-value="'1'" ng-false-value="'0'">In</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-warning btn-width-default">
                                    <i class="fa fa-save"></i>
                                    <span>Lưu</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-body" ng-if="vm.m.currentTab == 'DELIVERY'">
                    <form class="form" ng-submit="vm.save('DELIVERY')">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="month">Cho xuất khi hết kho</label>
                                    <div class="checkbox">
                                        <label><input ng-model="vm.m.forms.DELIVERY.delivery_allow_empty" type="checkbox" ng-true-value="'1'" ng-false-value="'0'">Cho phép</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-warning btn-width-default">
                                    <i class="fa fa-save"></i>
                                    <span>Lưu</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="box-body" ng-if="vm.m.currentTab == 'ESMS'">
                    <form class="form" ng-submit="vm.save('ESMS')">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="month">API_KEY</label>
                                    <div class="form-group">
                                        <input ng-model="vm.m.forms.ESMS.esms_api_key" type="text" style="width:500px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="month">SECRET_KEY</label>
                                    <div class="form-group">
                                        <input ng-model="vm.m.forms.ESMS.esms_secret_key" type="text" style="width:500px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="month">OA_ID</label>
                                    <div class="form-group">
                                        <input ng-model="vm.m.forms.ESMS.oa_id" type="text" style="width:500px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-warning btn-width-default">
                                    <i class="fa fa-save"></i>
                                    <span>Lưu</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="box-body" ng-if="vm.m.currentTab == 'OA'">
                    <form class="form" ng-submit="vm.save('OA')">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="month">APP_ID</label>
                                    <div class="form-group">
                                        <input ng-model="vm.m.forms.OA.oa_api_id" type="text" style="width:500px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="month">APP_SECRET</label>
                                    <div class="form-group">
                                        <input ng-model="vm.m.forms.OA.oa_app_secret" type="text" style="width:500px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="month">ACCESS_TOKEN</label>
                                    <div class="form-group">
                                        <input ng-model="vm.m.forms.OA.oa_access_token" type="text" style="width:500px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-warning btn-width-default">
                                    <i class="fa fa-save"></i>
                                    <span>Lưu</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- <div class="box-body" ng-if="vm.m.currentTab == 'PRINT_DELIVERY2'">
                    <form class="form" ng-submit="vm.run()">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="month">Lệnh</label>
                                    <textarea class="form-control" ng-model="vm.m.form.cmd" rows="3">
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-warning btn-width-default">
                                    <i class="fa fa-save"></i>
                                    <span>Lưu</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div> -->
            </div>
        </div>
    </div>
</section>