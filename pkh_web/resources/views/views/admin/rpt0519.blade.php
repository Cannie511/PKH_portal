<section class="content-header">
    <h1>Báo cáo nhân viên<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Báo cáo nhân viên</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Báo cáo nhân viên - Thời gian: ngày - DVT: VND</h3>
                    <div class="box-tools pull-right">
                        <div uib-dropdown class="btn-group">
                        </div>
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <div class="box-body form">
                    <form role="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="day">Từ ngày</label>
                                    <div class="input-group">
                                        <input class="form-control" datetimepicker ng-model="vm.m.filter.from_date" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="day">Đến ngày</label>
                                    <div class="input-group">
                                        <input class="form-control" datetimepicker ng-model="vm.m.filter.to_date" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Nhà cung ứng</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn nhà cung ứng'"
                                        ng-model="vm.m.filter.supplier_id"
                                        ng-options="item.supplier_id as item.name for item in vm.m.init.supplierList"
                                        >
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                                    <i class="fa fa-search fa-fw"></i>
                                    <span translate="COM_BTN_SEARCH"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-body" >
                <div ng-if="vm.m.data2" class="table-responsive col-sm-6">
                        <h3>last period</h3> 
                        <table class="table table-striped">
                            <thead>
                                <tr >
                                    <th>No </th>
                                    <th>Hạng mục </th>
                                    <th ng-repeat='item in vm.m.init.salesmanList' class="text-right">{{item.name}}</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data2'>
                                  
                                    <td>{{$index+1}}</td>        
                                    <td>{{item["name"]}}</td>
                                    <td ng-repeat ='itemSales in vm.m.init.salesmanList' class="text-right">{{item[itemSales.id]| currency: '' : 1}}</td>
                                   
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div  ng-if="vm.m.data" class="table-responsive col-sm-6">
                        <h3>current period</h3> 
                        <table class="table table-striped">
                            <thead>
                                <tr >
                                    <th>No </th>
                                    <th>Hạng mục </th>
                                    <th ng-repeat='item in vm.m.init.salesmanList' class="text-right">{{item.name}}</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data'>
                                  
                                    <td>{{$index+1}}</td>        
                                    <td>{{item["name"]}}</td>
                                    <td ng-repeat ='itemSales in vm.m.init.salesmanList' class="text-right">
                                        {{item[itemSales.id]| currency: '' : 1}}
                                    </td>
                                   
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div  ng-if="vm.m.data4" class="table-responsive col-sm-6">
                        <h3>Last period</h3> 
                        <table class="table table-striped">
                            <thead>
                                <tr >
                                    <th>No </th>
                                    <th>Hạng mục </th>
                                    <th ng-repeat='item in vm.m.init.salesmanList' class="text-right">{{item.name}}</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.init.productList'>
                                  
                                    <td>{{$index+1}}</td>        
                                    <td>{{item["name"]}}</td>
                                    <td ng-repeat ='itemSales in vm.m.init.salesmanList' class="text-right">
                                        {{vm.m.data4[itemSales['id']][item["product_id"]]| currency: '' : 0}}
                                    </td>
                                   
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div  ng-if="vm.m.data3" class="table-responsive col-sm-6">
                        <h3>current period</h3> 
                        <table class="table table-striped">
                            <thead>
                                <tr >
                                    <th>No </th>
                                    <th>Hạng mục </th>
                                    <th ng-repeat='item in vm.m.init.salesmanList' class="text-right">{{item.name}}</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.init.productList'>
                                  
                                    <td>{{$index+1}}</td>        
                                    <td>{{item["name"]}}</td>
                                    <td ng-repeat ='itemSales in vm.m.init.salesmanList' class="text-right">
                                        {{vm.m.data3[itemSales['id']][item["product_id"]]| currency: '' : 0}}
                                    </td>
                                   
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
