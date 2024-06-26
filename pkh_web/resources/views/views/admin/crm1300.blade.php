<section class="content-header">
    <h1>Purchasing order<small></small></h1>
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
                    <h3 class="box-title">List PO</h3>
                    <div class="box-tools pull-right">
                        <a ui-sref="app.crm2520" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a>
                        
                    </div>
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
                                    <label for="supplier_name">Nhà cung ứng</label>
                                    <input type="text" class="form-control" id="supplier_name" ng-model="vm.m.filter.supplier_name" />
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
                                    <th>
                                        Mã NCC
                                    </th>
                                    <th>
                                        Ngày order
                                    </th>
                                    
                                    <th>
                                    <span>CK</span>
                                    <i class="fas fa-question-circle" placement="top" uib-tooltip="Chiết khấu"></i>
                                </th>
                                <th>
                                    <span>Tổng tiền/<br/> Sau CK</span>
                                </th>
                                    <th>
                                       Create
                                    </th>
                                    <th>
                                        Ghi chú
                                    </th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list.data'>
                                    <td class="col-action">
                                        <a class="btn btn-xs btn-warning" ui-sref='app.crm1311({supplier_order_id: item.supplier_order_id,supplier_id: item.supplier_id})'>
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>

                                    <td>{{$index + vm.m.list.from}}</td>
                                    <td>{{item.name}}</td>
                                    <td>{{item.order_date| date:'yyyy-MM-dd'}}</td>
                                    <td class="text-left">{{item.discount}}%</td>
                                
                                    <td class="text-left">{{item.total | currency: '' : 0}}<br/>{{item.total_with_discount | currency: '' : 0}}
                                     <td>
                                        {{item.updated_at}}<br/>
                                        <small><i>{{item.updated_by}}</i></small>
                                    </td>
                                    <td>{{item.notes}}</td>
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
