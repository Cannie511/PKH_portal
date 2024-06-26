<section class="content-header">
    <h1>Thêm Warehouse<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm2900">Warehouse</a></li>
        <li class="active">Thêm warehouse</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-7">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin warehouse</h3>
                   
                 
                </div>
                <form class="form-horizontal" name="form" ng-submit="vm.save()" >
                    <div class="box-body">
                       
                        
                       
                        <div class="form-group" >
                            <label class="col-sm-2 control-label required">Name</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" ng-model="vm.m.form.name" name="name" placeholder="" />
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-sm-2 control-label required">Address</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" ng-model="vm.m.form.address" name="address" placeholder="" />
                            </div>
                        </div>
                      
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Cho đặt</label>
                            <div class="col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" ng-model="vm.m.form.active_flg" name="active_flg" placeholder="" ng-true-value="1" ng-false-value="0">
                                    </label>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="box-footer">
                        <a ui-sref="app.crm2900" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_NEW" ng-if="!vm.m.warehouse_id" >Thêm mới</button>
                            <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_UPDATE" ng-if="vm.m.warehouse_id">Cập nhật</button>
                        </div>

                    </div> 
                </form>
            </div>
        </div>
       
    </div>
</section>
