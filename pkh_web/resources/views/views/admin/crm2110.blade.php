<section class="content-header">
    <h1>Thêm khu vực<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm2100">Khu vực</a></li>
        <li class="active">Thêm khu vực</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-7">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin khu vực</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <form class="form-horizontal" name="form" ng-submit="vm.save()" >
                    <div class="box-body">
                       
                        <div class="form-group" >
                            <label class="col-sm-2 control-label ">Tên khu vực</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" ng-model="vm.m.filter.area_name" name="name" placeholder="Tên khu vực" required/>
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': form.area_group.$invalid && ( vm.formSubmitted || form.area_group.$touched) }">
                            <label class="col-sm-2 control-label ">Tên vùng</label>
                            <div class="col-sm-10">
                                <select class="form-control"     
                                    chosen      
                                    name = "area_group"                         
                                    placeholder-text-single="'Chọn vùng'"
                                    ng-model="vm.m.filter.area_group_id"
                                    ng-options="item.area_group_id as item.name for item in vm.m.groupList "
                                    >
                                    <option value="">Không có</option>
                                </select>
                                 <p ng-show="form.area_group.$error.required && ( vm.formSubmitted || form.area_group.$touched)" class="help-block">Vui lòng chọn vùng</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Salesman phụ trách</label>
                            <div class="col-sm-10">
                                <select class="form-control"     
                                    chosen                               
                                    placeholder-text-single="'Chọn salesman'"
                                    ng-model="vm.m.filter.salesman_id"
                                    ng-options="item.id as item.name for item in vm.m.salesmanList "
                                    >
                                    <option value="">Không có</option>
                                </select>
                                <p ng-show="form.contact.$error.required && ( vm.formSubmitted || form.contact.$touched)" class="help-block">Vui lòng nhập liên hệ</p>
                            </div>
                        </div>                               
                    </div>
                    <div class="box-footer">
                        <a ui-sref="app.crm2100" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_NEW" ng-if="!vm.m.area_id" >Thêm mới</button>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_UPDATE" ng-if="vm.m.area_id">Cập nhật</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>
