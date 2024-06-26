    <section class="content-header">
    <h1>Phân công cửa hàng<small></small></h1>
    <!-- <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Lịch nghỉ nghep</li>
    </ol> -->
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Phân công</h3>
                    
                </div>
                <div class="box-body form" >
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">

                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class=" required">Nhân viên sale</label>
                                    <div >
                                        <select class="form-control"     
                                            chosen                               
                                            placeholder-text-single="'Chọn saleman'"
                                            ng-model="vm.m.form.saleman_id"
                                            ng-options="item1.id as item1.name for item1 in vm.m.init.userList"
                                            >
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
        
                        </div>
                      
                    </form>
                </div>
                <div class="box-body">
                    
                    <div class="col-sm-12">
                        <div class="box-header with-border well" > 
                            <h4 class="box-title">Chọn theo tỉnh</h4>
                            <div class="box-tools pull-right">
                                <div ng-click="vm.choose(1)" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></div>                        
                            </div>
                        </div>
                        <div ng-hide="vm.m.openTable1 == 1">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tỉnh/TP</label>
                                <div class="col-sm-4">
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn tỉnh'"
                                        ng-model="vm.m.form.area1"
                                        ng-options="item.area_id as item.name for item in vm.m.init.areaList"
                                        >
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <button ng-click="vm.addProvince()" class="btn btn-primary pull-right">ADD</button>
                                </div>
                                <div class="col-sm-2">
                                    <button ng-click="vm.emptyProvince()" class="btn btn-danger pull-right">EMPTY</button>
                                </div>
                            </div>
                            
                            <div class="box-body">
                                <div class="col-sm-12">
                                    DANH SÁCH TỈNH CẦN ĐỔI NHÂN VIÊN KINH DOANH
                                    <div>
                                  
                                        <p ng-repeat="item in vm.m.cart">{{item.name}} </p>
                                    </div>
                                </div> 
                                <div class="col-sm-12">
                                    KẾT QUẢ THAY ĐỔI
                                    <div>
                                        <p ng-if="vm.m.result.count">{{vm.m.result.count}} thay đổi thành công</p>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-sm-12">
                                <button ng-click="vm.assignUser()" ng-disabled="vm.m.form.saleman_id==null " class="btn btn-primary pull-right">Phân công</button>
                            </div>
                        </div>
                    </div>
                  
                    <div class="col-sm-12">
                        <div class="box-header with-border well" > 
                            <h4 class="box-title">Chọn theo cửa hàng</h4>
                            <div class="box-tools pull-right">
                                <div ng-click="vm.choose(2)" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></div>                        
                            </div>
                        </div>
                        <div ng-hide="vm.m.openTable2 == 1">
                        
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Valid StoreID</label>
                                    <input type="number" ng-model="vm.m.form.store_id_valid" class="form-control"/>
                                </div>
                            </div>
                             <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Fake StoreID</label>
                                    <input type="number" ng-model="vm.m.form.store_id_fake" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button ng-click="vm.mergeStore()"  class="btn btn-primary pull-left">Merge</button>
                            </div>

                        </div>
                        
                    </div>  
                
                  

                    
                </div>


            </div>
        </div>
    </div>
</section>
