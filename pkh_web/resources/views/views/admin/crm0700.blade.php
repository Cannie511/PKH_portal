<section class="content-header">
    <h1>Khách hàng thanh toán<small></small></h1>
    <!-- <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Lịch nghỉ nghep</li>
    </ol> -->
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
              
                <div class="tab-content">
                   
                    <div class="tab-pane" ng-class="{'active': vm.m.activeFlag == 1}">
                                            <div class="box box-info">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title"></h3>
                                                    <div class="box-tools pull-right">
                                                        <div uib-dropdown class="btn-group">
                                                            <!-- <a ui-sref="app.crm0710" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                                                            <!-- <button type="button" uib-dropdown-toggle class="btn btn-success btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul uib-dropdown-menu>
                                                                <li><a ui-sref="a">a</a></li>
                                                                <li><a ui-sref="b">b</a></li>
                                                                <li><a ui-sref="c">c</a></li>
                                                                <li><a ui-sref="d">d</a></li>
                                                            </ul> -->
                                                        </div>
                                                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                                                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                                                    </div>
                                                </div>
                                                <div class="box-body form">
                                                    <form class="form" ng-submit="vm.doSearch(vm.m.activeFlag,1)">
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="day">Từ ngày</label>
                                                                    <div class="input-group">
                                                                        <input class="form-control" datetimepicker ng-model="vm.m[vm.m.activeFlag].filter.from_date" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
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
                                                                        <input class="form-control" datetimepicker ng-model="vm.m[vm.m.activeFlag].filter.to_date" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
                                                                        <span class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            
                                                        </div>
                                                        <div class="row">
                                                            
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="store_name">Tên khách hàng</label>
                                                                    <input type="text" class="form-control" id="store_name" ng-model="vm.m[vm.m.activeFlag].filter.store_name" />
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                                                                    <i class="fa fa-search fa-fw"></i>
                                                                    <span translate="COM_BTN_SEARCH"></span>
                                                                </button>
                                                                <button type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.resetFilter(vm.m.activeFlag)">
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
                                                                    <th class="col-action"></th>
                                                                    <th>NO</th>
                                                                    <th ng-click="vm.sort('payment_date');" >
                                                                        <span>Ngày thu</span>
                                                                    
                                                                    </th>
                                                                   
                                                                    <th ng-click="vm.sort('store_name');">
                                                                        <span>Tên khách hàng</span>
                                                                        
                                                                    </th>
                                                                  
                                                                    <th >
                                                                        <span>Số tiền thanh toán</span>
                                                                    </th>
                                                                   
                                                                    <th>
                                                                        <span>Tổng giá trị đơn</span>
                                                                    </th>
                                                                    <th>
                                                                        <span>Tiền dư</span>
                                                                    </th>

                                                                   
                                                                    <th>
                                                                        <span>Cập nhật</span>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data'>
                                                                    <td class="col-action">
                                                                        <a class="btn btn-xs btn-warning" ui-sref='app.crm0711({cpayment_id: item.cpayment_id, store_id: item.customer_id})'>
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>
                                                                    </td>
                                                                    <td>{{$index + vm.m[vm.m.activeFlag].data.from}}</td>
                                                                    <!--<td>
                                                                        {{item.supplier_name}}
                                                                    </td>-->
                                                                    <td>{{item.cpayment_date}}</td>
                                                                   
                                                                   
                                                                    <td>
                                                                    #{{item.customer_id}}  {{item.store_name}}<br/><small><i>{{item.address}}</i></small>
                                                                                <br/> 
                                                                        Contact mobile 1: {{item.contact_mobile1}}/ {{item.contact_mobile2}}
                                                                    </td>
                                                                   
                                                                    <td>{{item.cpayment_money | currency :'': 0}}</td>
                                                                   
                                                                    <td>{{item.total | currency :'': 0}}</td>
                                                                    <td>{{item.cpayment_money - item.total | currency :'': 0}}</td>
                                                                   
                                                                    <td>
                                                                        {{item.updated_at}}<br/>
                                                                        <small><i>{{item.updated_by}}</i></small>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="row" ng-if="vm.m[vm.m.activeFlag].data.from > 0">
                                                        <div class="col-md-6 col-sm-12 text-left">
                                                            <p class="form-control-static">{{vm.m[vm.m.activeFlag].data.from}} - {{vm.m[vm.m.activeFlag].data.to}} / {{vm.m[vm.m.activeFlag].data.total}}</p>                            
                                                        </div>
                                                        <div class="col-md-6 col-sm-12 text-right">
                                                            <uib-pagination ng-show="vm.m[vm.m.activeFlag].data.from > 0"
                                                                total-items="vm.m[vm.m.activeFlag].data.total"
                                                                ng-model="vm.m[vm.m.activeFlag].data.current_page"
                                                                items-per-page="vm.m[vm.m.activeFlag].data.per_page"
                                                                ng-change="vm.doSearch(vm.m.activeFlag, vm.m[vm.m.activeFlag].data.current_page)"
                                                                class="pagination pagination-sm m-t-none m-b-none">
                                                            </uib-pagination>    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</section>
