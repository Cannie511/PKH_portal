<section class="content-header">
    <h1>Thêm tài khoản ngân hàng<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm1200">Tài khoản ngân hàng</a></li>
        <li class="active">Thêm tài khoản ngân hàng</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-7">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Tài khoản ngân hàng</h3>
                    <div class="box-tools pull-right">
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <form class="form-horizontal" name="form" ng-submit="vm.save()" >
                    <div class="box-body">
                       
                        <div class="form-group" >
                            <label class="col-sm-2 control-label ">Tên cửa hàng</label>
                            <div class="col-sm-10">
                                <input type="text" ng-disabled="true" class="form-control" ng-model="vm.m.filter.name" name="name" placeholder="" />
                            </div>
                        </div>

                        <div class="form-group" >
                            <label class="col-sm-2 control-label ">Địa chỉ</label>
                            <div class="col-sm-10">
                                <input type="text" ng-disabled="true" class="form-control" ng-model="vm.m.filter.address" name="address" placeholder="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nhân viên sale phụ trách</label>
                            <div class="col-sm-10">
                                <input type="text" ng-disabled="true" class="form-control" ng-model="vm.m.filter.salesman_name" name="sale_name" placeholder="" />
                            </div>
                        </div>
                                               
                        <div class="form-group" >
                            <label class="col-sm-2 control-label ">Tên ngân hàng</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" ng-model="vm.m.filter.bank_name" name="bank_name" placeholder="" />
                            </div>
                        </div>

                        <div class="form-group" >
                            <label class="col-sm-2 control-label ">Tên chi nhánh ngân hàng</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" ng-model="vm.m.filter.bank_branch" name="bank_branch" placeholder="" />
                            </div>
                        </div>

                        <div class="form-group" >
                            <label class="col-sm-2 control-label ">Tài khoản ngân hàng</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" ng-model="vm.m.filter.bank_account_no" name="bank_account_no" placeholder="" />
                            </div>
                        </div>

                        <div class="form-group" >
                            <label class="col-sm-2 control-label ">Tên tài khoản ngân hàng</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" ng-model="vm.m.filter.bank_account_name" name="bank_account_name" placeholder="" />
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-sm-2 control-label ">Ghi chú</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" ng-model="vm.m.filter.notes" name="notes" placeholder="" />
                            </div>
                        </div>
                                          
                    </div>
                    <div class="box-footer">
                        <a ui-sref="app.crm1200" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_NEW" >Thêm mới</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>
