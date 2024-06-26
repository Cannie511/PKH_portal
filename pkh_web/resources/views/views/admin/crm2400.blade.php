<section class="content-header">
    <h1>Quản lý thời gian đặt hàng<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Danh sách thời gian đặt</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách thời gian đặt</h3>
                    <div class="box-tools pull-right">
                      
                    </div>
                </div>
                    <div class="box-body">
                    
                </div>
                <div class="box-body form">
                    <form role="form" ng-submit="vm.search()">
                        <div class="row">
                             <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Tên cửa hàng</label>
                                    <input type="text" ng-model="vm.m.filter.store_name" class="form-control"/>
                                </div>
                            </div>
                              <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Nhân viên bán hàng</label>
                                      <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn salesman'"
                                        ng-model="vm.m.filter.salesman_id"
                                        ng-options="item.id as item.name for item in vm.m.listSalesman "
                                        >
                                        <option value="">Không có</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Tỉnh/Thành</label>
                                    {{vm.m.filter.area1}}
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn tỉnh'"
                                        ng-model="vm.m.filter.area1"
                                        ng-options="item.area_id as item.name for item in vm.m.listArea1 "
                                        >
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>  
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group" ng-if="vm.m.filter.area1">
                                    <label>Quận/Huyện</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn tỉnh'"
                                        ng-model="vm.m.filter.area2"
                                        ng-options="item.area_id as item.name for item in vm.m.listArea2 "
                                        >
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>               
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Cấp cửa hàng</label>
                                    <select class="form-control"
                                        placeholder-text-single="'Chọn cấp'"
                                        ng-model="vm.m.filter.level"
                                        >
                                        <option value="">Tất cả</option>
                                        <option value='1'>Cấp 1</option>
                                        <option value='2'>Cấp 2</option>
                                        <option value='3'>Cấp 3</option>
                                        <option value='4'>Cấp 4</option>
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
                                <button type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.resetFilter()">
                                    <i class="fa fa-eraser fa-fw"></i>
                                    <span translate="COM_BTN_RESET"></span>
                                </button>
                              
                             
                            </div>
                        </div>
                    </form>
                </div>
            
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                    <tr>
                                    <th></th>
                                    <th></th>
                                    <th>              
                                    </th>
                                   <th>              
                                    </th>
                                   <th colspan="2" class="text-center">Đặt hàng gần nhất</th>
                                    <th colspan="2" class="text-center">Giao hàng gần nhất</th>
                                </tr>
                                <tr>
                                   
                                    <th>NO</th>
                                    <th >
                                        <span>Tên cửa hàng</span>
                                      
                                    </th>
                                    <th >
                                        <span>Cấp</span>
                                      
                                    </th>
                                     <th >
                                        <span>Khu vực</span>
                                     </th>
                                    <th >
                                        <span>Phụ trách hiện tại</span>
                                    
                                    </th>
                                    <th>
                                        <span>Ngày</span>
                                    </th>
                                    <th>
                                        <span>Số ngày</span>
                                       
                                    </th>
                                     <th>
                                        <span>Ngày</span>
                                    </th>
                                    <th>
                                        <span>Số ngày</span>
                                       
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                    </th>
                                    <th>
                                    </th>
                                    <th>
                                    </th>
                                    <th>
                                    </th>
                                    <th>
                                    </th>
                                    <th  ng-click="vm.sort('order_day');" class="sortable">
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="order_day"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                     <th>
                                    </th>
                                     <th  ng-click="vm.sort('delivery_day');" class="sortable">
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="delivery_day"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data'>
                                   
                                    <td>{{$index + vm.m.data.from}}</td>
                                  
                                    <td>
                                        {{item.store_name}}<br/><small><i>{{item.address}}</i></small>
                                    </td>
                                    <td>
                                        {{item.level}}
                                    </td>
                                     <td>
                                        {{item.area1_name}}   
                                        <br/>{{item.area2_name}}   
                                    </td>     
                                    <td>
                                        {{item.salesman_name}}   
                                    </td>                             
                                    <td>
                                        {{item.order_date}}                                     
                                    </td>
                                     <td>
                                        {{item.order_day}}                                     
                                    </td>
                                     <td>
                                        {{item.delivery_date}}                                     
                                    </td>
                                     <td>
                                        {{item.delivery_day}}                                     
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row" ng-if="vm.m.data.from > 0">
                        <div class="col-md-6 col-sm-12 text-left">
                            <p class="form-control-static">{{vm.m.data.from}} - {{vm.m.data.to}} / {{vm.m.data.total}}</p>                            
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <uib-pagination ng-show="vm.m.data.from > 0"
                                total-items="vm.m.data.total"
                                ng-model="vm.m.data.current_page"
                                items-per-page="vm.m.data.per_page"
                                ng-change="vm.doSearch(vm.m.data.current_page)"
                                class="pagination pagination-sm m-t-none m-b-none">
                            </uib-pagination>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
