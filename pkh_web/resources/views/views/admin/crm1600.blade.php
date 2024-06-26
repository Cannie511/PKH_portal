<section class="content-header">
    <h1>Packing List Invoice<small></small></h1>
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
                    <h3 class="box-title">List PI</h3>
                    
                </div>
                <div class="box-body form" >
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Từ ngày</label>
                                    <p class="input-group">
                                         <input class="form-control" datetimepicker ng-model="vm.m.filter.start_date" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
                                         <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </p>
                                </div> 
                            </div>

                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Đến ngày</label>
                                    <p class="input-group">
                                          <input class="form-control" datetimepicker ng-model="vm.m.filter.end_date" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </p>
                                </div> 
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="pi_no">PI no</label>
                                    <input type="text" class="form-control" id="pi_no" ng-model="vm.m.filter.pi_no" />
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
                                    <th class="col-action"></th>
                                    <th>NO</th>

                                    <th> Ngày đặt </th>
                                  
                                    <th >
                                        <span >Tên nhà cung ứng</span>
                                       
                                    </th>
                                  
                                   
                                   
                                    <th> Đơn giá </th>
                                    <th> Số lượng </th>
                                    <th class="text-right">
                                        <span >Số tiền (USD)</span>
    
                                    </th>
                                    <th>
                                        Cập nhật
                                    </th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list.data'>
                                    <td class="col-action">
                                         <a class="btn btn-xs btn-warning" ui-sref='app.crm1610({supplier_delivery_id: item.supplier_delivery_id, supplier_order_id: item.supplier_order_id})'>
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>

                                    <td>{{$index + vm.m.list.from}}</td>
                                    
                                    <td>{{item.delivery_date| date:'yyyy-MM-dd'}}</td>
                                   
                                    <td>{{item.name}}</td>
                                    <td class="text-right">{{item.unit_price}}</td>
                                    <td class="text-right">{{item.amount}}</td>
                                    <td class="text-right">{{item.total | currency : '' : 2}}</td>

                                    <td class="text-right">{{item.volume | number : 2}}</td>
                                  
                                   
                                    <td>
                                        {{item.updated_at}}<br/>
                                        <small><i>{{item.updated_by}}</i></small>
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
                                ng-model="vm.m.data.current_page"
                                items-per-page="vm.m.list.per_page"
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
