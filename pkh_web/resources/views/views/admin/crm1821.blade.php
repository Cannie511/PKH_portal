<section class="content-header">
    <h1>Thêm phòng ban<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm1820">phòng ban</a></li>
        <li class="active">Thêm phòng ban</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-7">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin phòng ban</h3>
                </div>
                <form class="form-horizontal" name="form" ng-submit="vm.save()" >
                    <div class="box-body">
                        <div class="form-group" >
                            <label class="col-sm-2 control-label ">Tên phòng ban</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.form.name" name="name" placeholder="" />
                            </div>
                        </div>

                        <div class="form-group" >
                            <label class="col-sm-2 control-label ">Mô tả</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" ng-model="vm.m.form.description" name="description" placeholder="" />
                            </div>
                        </div>
                                          
                    </div>
                    <div class="box-footer">
                        <a ui-sref="app.crm1820" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_NEW" ng-if="!vm.m.department_id" >Thêm mới</button>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_UPDATE" ng-if="vm.m.department_id">Cập nhật</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>
