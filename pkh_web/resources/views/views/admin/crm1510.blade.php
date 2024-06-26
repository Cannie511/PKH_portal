<section class="content-header">
    <h1>Thêm packing<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm1100">Packing List</a></li>
        <li class="active">Thêm packing</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-7">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin packing</h3>
                    <div class="box-tools pull-right">
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <form class="form-horizontal" name="form" ng-submit="vm.save()" >
                    <div class="box-body">
                        <div ng-if="vm.alerts" class="alert alert-{{alert.type}}" ng-repeat="alert in vm.alerts">
                            <h4>{{alert.title}}</h4>
                            <p>{{alert.msg}}</p>
                        </div>
                        
                       
                        <div class="form-group" >
                            <label class="col-sm-2 control-label required">Chiều dài</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" ng-model="vm.m.filter.length" name="length" placeholder="" required>
                                
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-sm-2 control-label required">Chiều rộng</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" ng-model="vm.m.filter.width" name="width" placeholder="" required>
                                
                            </div>
                        </div>
                  
                         
                        <div class="form-group" >
                            <label class="col-sm-2 control-label required">Chiều cao</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" ng-model="vm.m.filter.height" name="height" placeholder="" required>
                                
                            </div>
                        </div>
                  

                    </div>
                    <div class="box-footer">
                        <a ui-sref="app.crm1500" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_NEW" ng-if="!vm.m.packing_id">Add new</button>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_UPDATE" ng-if="vm.m.packing_id">Update</button>                       
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>
