<section class="content-header">
    <h1>Kiểm kho<small></small></h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách kiểm kho (Chỉ thay đổi được dữ liệu trong vòng 4 ngày kể từ ngày nhập)</h3>
                    <div class="box-tools pull-right">
                        <a ui-sref="app.crm0810" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a>
                   </div>
                </div>
                <div class="box-body form" >
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                             <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="day">Từ ngày</label>
                                    <div class="input-group">
                                        <input class="form-control" datetimepicker ng-model="vm.m.filter.delivery_start_date" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
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
                                        <input class="form-control" datetimepicker ng-model="vm.m.filter.delivery_end_date" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div> 
                             <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Kho</label>
                                      <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn kho'"
                                        ng-model="vm.m.filter.warehouse_id"
                                        ng-options="item.warehouse_id as item.warehouse_name for item in vm.m.warehouseList "
                                        >
                                        <option value="">Không có</option>
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
                                    <th> </th>
                                    <th>NO</th>
                                    <th ng-click="vm.sort('check_date');" class="sortable">
                                        <span >Ngày kiểm</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="check_date"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th>Kho</th>
                                    <th ng-click="vm.sort('check_name');" class="sortable">
                                        <span >Tên người kiểm</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="check_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                     <th >
                                        <span >Trạng thái</span>
                                    </th>
                                    <th style="width:300px;">
                                        <span>Ghi chú</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="notes"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                     <th>
                                        Cập nhật
                                    </th>
                                    <th>
                                       Xác nhận
                                    </th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list.data'>
                                    <td>
                                         <a class="btn btn-xs btn-warning" ui-sref="app.crm0811({checkWarehouseId: item.id})">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>{{$index + vm.m.list.from}}</td>
                                    <td>
                                       {{item.check_date| date:'yyyy-MM-dd'}}
                                    </td>
                                    <td>
                                        {{item.warehouse_name}}
                                    </td>
                                    <td>{{item.name}}</td>
                                    <td>
                                        <span ng-if="item.checking_sts == 0" class="label label-success">Mới</span> 
                                        <span ng-if="item.checking_sts == 1" class="label label-primary">Xác nhận</span> 
                                        <span ng-if="item.checking_sts == 5" class="label label-default">Hủy</span>
                                    </td>
                                    <td>{{item.notes}}</td>
                                     <td>
                                          {{item.updated_at}}<br/>
                                        <small><i>{{item.updated_by}}</i></small>
                                    </td>
                                    <td>

                                        <a ng-if="item.checking_sts == 0"  ng-if="item.checking_sts == 0"  class="btn btn-xs btn-primary" ui-sref="app.crm0913_2({check_warehouse_id : item.id})">
                                            Xác nhận
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row" ng-if="vm.m.list.from > 0">
                        <div class="col-md-6 col-sm-12 text-left">
                            <p class="form-control-static">{{vm.m.list.from}} - {{vm.m.list.to}} / {{vm.m.list.total}}</p>                            
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <uib-pagination ng-show="vm.m.list.from > 0"
                                total-items="vm.m.list.total"
                                ng-model="vm.m.list.current_page"
                                items-per-page="vm.m.list.per_page"
                                ng-change="vm.doSearch(vm.m.list.current_page)"
                                class="pagination pagination-sm m-t-none m-b-none">
                            </uib-pagination>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
