<section class="content-header">
    <h1>Theo dõi công nợ<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Theo dõi công nợ</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Theo dõi công nợ</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body form">
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="month">Tháng</label>
                                    <div class="input-group">
                                        <input id="monthPicker" class="form-control" datetimepicker ng-model="vm.m.filter.month" placeholder="YYYY-MM" options="vm.m.datetimepicker_options"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Tên cửa hàng</label>
                                    <input type="text" ng-model="vm.m.filter.name" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Mã kế toán</label>
                                    <input type="text" ng-model="vm.m.filter.accountant_store_id" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Loại</label>
                                    <select class="form-control"
                                        placeholder-text-single="'Chọn Loại'"
                                        ng-model="vm.m.filter.filter_type"
                                        >
                                        <option value="">Tất cả</option>
                                        <option value='1'>Cửa hàng còn nợ</option>
                                        <option value='2'>Nợ cửa hàng</option>
                                    </select>
                                </div>
                            </div>
                               <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Nhân viên bán hàng</label>
                                      <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn chương trình'"
                                        ng-model="vm.m.filter.salesman_id"
                                        ng-options="item.id as item.name for item in vm.m.listSalesman "
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
                                <button type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.download()">
                                    <i class="fa fa-download fa-fw"></i>
                                    Tải về
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
                                    <td></td>   
                                    <th>NO</th>
                                    <th ng-click="vm.sort('product_name');" class="sortable">
                                        <span>Mã KT</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="product_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th ng-click="vm.sort('product_cat_name');" class="sortable">
                                        <span>Cửa hàng</span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="product_cat_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th>Nợ tháng trước</th>
                                    <th>Giao hàng (Chưa CK)</th>
                                    <th>Giao hàng (Đã CK)</th>
                                    <th>Đã thanh toán</th>
                                    <th>Điều chỉnh</th>
                                    <th>Còn lại</th>
                                </tr>
                                <tr>
                                    <td>Tổng cộng</td>   
                                    <th></th>
                                    <th> </th>
                                    <th > </th>
                                    <th  class="text-right" style="color:green;">{{vm.m.summary.remain_lastmonth| currency : '' : 0}}</th>
                                    <th  class="text-right" style="color:green;">{{vm.m.summary.total_thismonth| currency : '' : 0}}</th>
                                    <th  class="text-right" style="color:green;">{{vm.m.summary.total_with_discount_thismonth| currency : '' : 0}}</th>
                                    <th  class="text-right" style="color:green;">{{vm.m.summary.payment_thismonth| currency : '' : 0}}</th>
                                    <th></th>
                                    <th  class="text-right" style="color:green;">{{vm.m.summary.remain| currency : '' : 0}}</th>
                                </tr>
                                <!-- <tr>
                                    <td>Tổng trang</td>   
                                    <th></th>
                                    <th> </th>
                                    <th > </th>
                                    <th  class="text-right" style="color:green;">{{vm.m.total.lastmonth| currency : '' : 0}}</th>
                                    <th  class="text-right" style="color:green;">{{vm.m.total.thismonth| currency : '' : 0}}</th>
                                    <th  class="text-right" style="color:green;">{{vm.m.total.discountThismonth| currency : '' : 0}}</th>
                                    <th  class="text-right" style="color:green;">{{vm.m.total.payment| currency : '' : 0}}</th>
                                    <th></th>
                                    <th  class="text-right" style="color:green;">{{vm.m.total.remain| currency : '' : 0}}</th>
                                </tr> -->
                            </thead>
                            <!--  ng-if="(item.old_total >0) || (item.new_total >0)"-->
                            <tbody>
                                <tr ng-repeat='item in vm.m.list.data'>
                                    <td><button class="btn btn-success btn-xs" ng-click="vm.detailInfor(item)"><i class="fa fa-check"></i></button></td>
                                    <td>{{$index + vm.m.list.from}}</td>
                                    <td>{{item.accountant_store_id}}</td>
                                    <td>
                                        #{{item.store_id}} - {{item.name}}<br/>
                                        <small>{{item.address}}</small><br/>
                                        <small>Phụ trách hiện tại: {{item.salesman_name}}</small>
                                    </td>
                                    <td class="text-right" ng-class="{'text-danger': item.remain_lastmonth > 0 , 'text-primary': item.remain_lastmonth < 0 }">{{item.remain_lastmonth | currency : '' : 0}}</td>  
                                    <td class="text-right">{{item.total_thismonth | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.total_with_discount_thismonth | currency : '' : 0}}</td>
                                    <td class="text-right">{{item.payment_thismonth | currency : '' : 0}}</td>
                                    <td class="text-right" ng-class="{'text-danger': item.edit_thismonth > 0, 'text-primary': item.edit_thismonth < 0 }">
                                        <span ng-if="item.edit_thismonth != 0">{{item.edit_thismonth | currency : '' : 0}}</span> 
                                    </td>
                                    <td class="text-right" ng-class="{'text-danger': item.remain > 0 , 'text-primary': item.remain < 0 }">
                                        {{item.remain | currency : '' : 0}}
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
