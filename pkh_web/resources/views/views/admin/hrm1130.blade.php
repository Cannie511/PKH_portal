<section class="content-header">
    <h1 ng-if="vm.m.init.id > 0">Cập nhật Hrm1130<small></small></h1>
    <h1 ng-if="vm.m.init.id == 0">Thêm Hrm1130<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.hrm1130">List</a></li>
        <li ng-if="vm.m.init.id > 0" class="active">Cập nhật Hrm1130</li>
        <li ng-if="vm.m.init.id == 0" class="active">Thêm Hrm1130</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin Hrm1130</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.hrm1130({ employee_id: vm.m.employee_id,contract_id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <form class="form" name="form" ng-submit="vm.save(form.$valid, form)" novalidate>
                    <div class="box-body">
                        <div class="row">
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="pull-right">
                            <button ng-if="vm.m.form.id > 0 && vm.can('screen.hrm1010.delete')" type="button" class="btn btn-danger btn-min-width" ng-click="vm.delete()"><i class="fa fa-trash-o fa-fw"></i>{{'COM_BTN_DELETE' | translate}}</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save fa-fw"></i>{{'COM_BTN_UPDATE' | translate}}</button>
                        </div>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>