<section class="content-header">
    <h1>Thanh toán trước<small></small></h1>
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
                    <h3 class="box-title">Danh sách thanh toán trước</h3>
                    <div class="box-tools pull-right">
                        <div uib-dropdown class="btn-group">
                            <a ui-sref="app.crm0200" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a>
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
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="payment_type">Loại</label>
                                    <select class="form-control" ng-model="vm.m[vm.m.activeFlag].filter.payment_type" ng-init="vm.m[vm.m.activeFlag].filter.payment_type = ''">
                                        <option value="">Tất cả</option>
                                        <option value="0">Tiền mặt</option>
                                        <option value="1">Chuyển khoản</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="bank_account_no">Số tài khoản</label>
                                    <input type="text" class="form-control" id="bank_account_no" ng-model="vm.m[vm.m.activeFlag].filter.bank_account_no" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="store_id">Mã cửa hàng</label>
                                    <input type="text" class="form-control" id="store_id" ng-model="vm.m[vm.m.activeFlag].filter.store_id" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="store_name">Tên cửa hàng</label>
                                    <input type="text" class="form-control" id="store_name" ng-model="vm.m[vm.m.activeFlag].filter.store_name" />
                                </div>
                            </div>
                        
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Nhân viên bán hàng</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn chương trình'"
                                        ng-model="vm.m[vm.m.activeFlag].filter.salesman_id"
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
                                    
                                    <th ng-click="vm.sort('store_id');" >
                                        <span>Mã kế toán</span>
                                    
                                    </th>
                                    <th ng-click="vm.sort('store_name');">
                                        <span>Tên cửa hàng</span>
                                        
                                    </th>
                                    <th ng-click="vm.sort('bank_account_no');" >
                                        <span>Mã đơn hàng</span>
                                    
                                    </th>
                                    <th ng-click="vm.sort('salesman_name');" class="sortable">
                                        <span>Tên nhân viên</span>
                                        
                                    </th>
                                    <th >
                                        <span>Thưởng TT</span>
                                    </th>
                                    <th >
                                        <span>Tiền phải TT</span>
                                    </th>
                                    <th >
                                        <span>Trạng thái</span>
                                    </th>
                                    <th>
                                        <span>Ghi chú</span>
                                    </th>
                                    <th>
                                        <span>Cập nhật</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data'>
                                    <td class="col-action">
                                        <a class="btn btn-xs btn-warning" ui-sref='app.crm0752({ store_order_id: item.store_order_id, payment_id: item.payment_id})'>
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>{{$index + vm.m[vm.m.activeFlag].data.from}}</td>
                                    <!--<td>
                                        {{item.supplier_name}}
                                    </td>-->
                                    <td>{{item.payment_date}}</td>
                                    
                                    <td>
                                        <span ng-if="item.accountant!=null">
                                            {{item.accountant}}
                                        </span>
                                        <span ng-if="item.accountant==null">
                                            <button type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.update_accountant(item.store_id, item.store_name)">
                                            Update
                                            </button>
                                        </span>
                                    </td>
                                    <td>
                                        {{item.store_name}}<br/><small><i>{{item.address}}</i></small>
                                                <br/> 
                                        Contact mobile 1: {{item.contact_mobile1}}
                                    </td>
                                    <td>
                                        <a ui-sref='app.crm0211({store_id: item.store_id, store_order_id: item.store_order_id})'>#{{item.store_order_code}}</a>
                                        <br/><small>Giá trị sau CK: <i>{{item.total_with_discount | currency :'': 0}}</i> </small>
                                        <br/>
                                        <span ng-repeat='state in vm.m.statusList' ng-if="state.status_id == item.order_sts" > 
                                            <span class="{{state.label}}">{{state.descript}}</span>
                                        </span>
                                    </td>
                                    <td>{{item.salesman_name }}</td>
                                    <td class="text-right">{{item.payment_money | currency :'': 0}} </td>
                                    <td class="text-right">{{item.total_with_discount - item.payment_money | currency :'': 0}}</td>
                                    <td>
                                        <span class="label label-success" ng-if="item.payment_sts == 0" >Mới</span> 
                                        <span class="label label-primary" ng-if="item.payment_sts == 1" >Chờ duyệt</span> 
                                        <span class="label label-primary" ng-if="item.payment_sts == 2" >Đã duyệt</span> 
                                        <span class="label label-danger" ng-if="item.payment_sts == 3" >Từ chối</span>         
                                        <span class="label label-info" ng-if="item.payment_sts == 4" >Chi thưởng</span>   
                                        <span class="label label-default" ng-if="item.payment_sts == 5" >Huỷ</span>         

                                    </td>
                                    <td>{{item.notes}}</td>
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
</section>
