<div class="box-header with-border">
    <h4 class="box-title">Danh sách {{vm.m[vm.m.activeFlag].title}}</h4>
</div>
<div class="box-body form">
    <form role="form" ng-submit="vm.doSearch(vm.m.activeFlag, 1)">
        <div class="row">
            <div class="col-md-3 col-sm-6 m-b-xs">
                <div class="form-group">
                    <label>Mã đơn hàng</label>
                    <input type="text" ng-model="vm.m[vm.m.activeFlag].filter.store_order_code" class="form-control"/>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 m-b-xs">
                <div class="form-group">
                    <label>Tên cửa hàng</label>
                    <input type="text" ng-model="vm.m[vm.m.activeFlag].filter.store_name" class="form-control"/>
                </div>
            </div>
            
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
                <div class="col-md-3 col-sm-6 m-b-xs">
                <div class="form-group">
                    <label>Chương trình</label>
                        <select class="form-control"     
                        chosen                               
                        placeholder-text-single="'Chọn chương trình'"
                        ng-model="vm.m[vm.m.activeFlag].filter.promotion_id"
                        ng-options="item.promotion_id as item.promotion_name for item in vm.m.listPromotion "
                        >
                        <option value="">Không có</option>
                        </select>
                </div>
            </div>
                <div class="col-md-3 col-sm-6 m-b-xs">
                <div class="form-group">
                    <label>Nhân viên bán hàng</label>
                        <select class="form-control"     
                        chosen                               
                        placeholder-text-single="'Chọn salesman'"
                        ng-model="vm.m[vm.m.activeFlag].filter.salesman_id"
                        ng-options="item.id as item.name for item in vm.m.listSalesman "
                        >
                        <option value="">Không có</option>
                        </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 m-b-xs">
                <div class="form-group">
                    <label>Loại đơn</label>
                    <select class="form-control" ng-model="vm.m[vm.m.activeFlag].filter.order_type" ng-init="vm.m[vm.m.activeFlag].filter.order_sts = ''">
                        <option value="">Tất cả</option>
                        <option value="1">Đơn hàng thường</option>
                        <option value="2">Đơn hàng bảo hành</option>   
                        <option value="3">Đơn hàng mẫu</option>     
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 m-b-xs">
                <div class="form-group">
                    <label>Chi nhánh</label>
                        <select class="form-control"     
                        chosen                               
                        placeholder-text-single="'Chọn chi nhánh'"
                        ng-model="vm.m[vm.m.activeFlag].filter.branch_id"
                        ng-options="item.branch_id as item.branch_name for item in vm.m.branchList "
                        >
                        <option value="">Không có</option>
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
                        ng-model="vm.m[vm.m.activeFlag].filter.level"
                        >
                        <option value="">Tất cả</option>
                        <option value='1'>Cấp 1</option>
                        <option value='2'>Cấp 2</option>
                        <option value='3'>Cấp 3</option>
                        <option value='4'>Cấp 4</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 m-b-xs">
                <div class="form-group">
                    <label>Mã cửa hàng</label>
                    <input type="text" ng-model="vm.m[vm.m.activeFlag].filter.store_id" class="form-control"/>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 m-b-xs">
                <div class="form-group">
                    <label>Nhà cung ứng</label>
                    <select class="form-control"     
                        chosen                               
                        placeholder-text-single="'Chọn nhà cung ứng'"
                        ng-model="vm.m[vm.m.activeFlag].filter.supplier_id"
                        ng-options="item.supplier_id as item.name for item in vm.m.supplierList"
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
                <button type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.resetFilter(vm.m.activeFlag)">
                    <i class="fa fa-eraser fa-fw"></i>
                    <span translate="COM_BTN_RESET"></span>
                </button>
                <!-- <button ng-if="vm.can('screen.crm0200.print_check')" type="button" class="btn btn-sm btn-info" ng-click="vm.clickPrintCheck(vm.m.activeFlag)"><i class="fa fa-print fa-fw"></i>Phiếu kiểm hàng</button>  -->
                <button type="button" class="btn btn-info btn-sm btn-width-default" ng-if="vm.can('screen.crm0200.download')" ng-click="vm.download(vm.m.activeFlag)">
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
                    <th></th>
                    <th>NO</th>
                    <th >
                        <span>Mã đặt hàng</span>
                    </th>
                    <th >
                        <span>NCU</span>
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Nhà cung ứng"></i>
                    </th>
                    <th >
                        <span>TGD</span>
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Thời gian đặt"></i>
                    </th>
                    <th>
                        <span>Cửa hàng</span>
                    </th>
                    <th>
                        <span>CK</span>
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Chiết khấu"></i>
                    </th>
                    <th>
                        <span>Tổng tiền/<br/> Sau CK</span>
                    </th>
                    <th>
                        Carton
                    </th>
                    <th>
                        Volume
                    </th>
                    <th ng-if="vm.m.activeFlag == 2 || vm.m.activeFlag == 3">
                        Delay (h)
                    </th>
                    <th>
                        <span>TT</span>
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Tình Trạng"></i>
                    </th>
                    <td ng-if="vm.m.activeFlag!= 5 && vm.m.activeFlag!= 6 && vm.m.activeFlag!= 2 "> 
                      TT trước
                    </th>
                    <th>
                        Cập nhật cuối
                    </th>
                </tr>
                <tr>
                    <th>
                    </th>
                    <th>
                    </th>
                    <th>
                    </th>
                    <th ng-click="vm.sort(vm.m.activeFlag,'store_order_code');" class="sortable">
                            <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="store_order_code"
                            order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                    </th>
                    <th ng-click="vm.sort(vm.m.activeFlag,'order_date');" class="sortable"> 
                            <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="order_date"
                            order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                    </th>
                        <th>
                    </th>
                    <th  ng-click="vm.sort(vm.m.activeFlag,'store_name');" class="sortable">
                        <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="store_name"
                            order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                    </th>
                    <th>
                    </th>
                    <th  ng-click="vm.sort(vm.m.activeFlag,'total');" class="sortable">
                        <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="total"
                            order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                    </th>
                    <th>
                    </th>
                    <th ng-if="vm.m.activeFlag == 2 || vm.m.activeFlag == 3">
                    </th>
                    <th>
                    </th>
                    <th ng-if="vm.m.activeFlag != 5 && vm.m.activeFlag != 6">
                    </th>
                    <th  ng-click="vm.sort(vm.m.activeFlag,'updated_at');" class="sortable">
                        <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="updated_at"
                            order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data'>
                    <td><input type="checkbox" ng-model="item.check" /></td>
                    <td>{{$index + vm.m.data.from + 1}}</td>
                    <td>
                        <a ui-sref='app.crm0211({store_id: item.store_id, store_order_id: item.store_order_id})'>#{{item.store_order_code}}</a>
                        <br/>
                        <a ng-if="item.prev_store_order_code" ui-sref='app.crm0211({store_id: item.store_id, store_order_id: item.prev_store_order_id})'><i class="fa fa-cut fa-fw"></i><small>({{item.prev_store_order_code}})</small><br/></a>
                        <small>(#{{item.store_order_id}})</small>&nbsp;<br/>
                        <small ng-if="item.salesman_name"><i>PTD: ({{item.salesman_name}})</i></small> <br/>
                        <small ng-if="item.branch_name"><i>ND: ({{item.branch_name}})</i></small> <br/>
                    
                    </td>
                    <td>{{item.supplier_code}}</td>
                    <td>{{item.order_date}}</td>
                    
                    <td>
                        <a ui-sref='app.crm2600({store_id: item.store_id})'>#{{item.store_id}}</a>&nbsp;
                        <a ui-sref='app.rpt0514({store_id: item.store_id})'>{{item.store_name}}</a>
                        &nbsp;
                    <span class="badge badge-success" ng-if="item.is_review_valid && item.review_sts == 'VERIFIED'"><i class="fas fa-thumbs-up fa-fw"></i>&nbsp;{{item.review_expired_date}}</span>
                    <span class="badge badge-warning" ng-if="!item.is_review_valid && item.review_sts == 'VERIFIED'"><i class="fas fa-thumbs-up fa-fw"></i>&nbsp;{{item.review_expired_date}}</span>
                    <span class="badge badge-danger" ng-if="item.review_sts == 'BLACKLIST'"><i class="fas fa-thumbs-down"></i></span>
                    
                        <br/><small><i>{{item.address}}</i></small>
                        <br/>
                        <small >Cấp cửa hàng: {{item.level}}</small>
                        <br/><small><i>Phụ trách hiện tại: {{item.current_salesman_name}}</i></small>
                        <small ng-if="item.order_type==1" class="text-danger"><br/>Đơn thường</small>
                        <small ng-if="item.order_type==2" class="text-danger"><br/>Đơn bảo hành- Không tính doanh số</small>
                        <small ng-if="item.order_type==3" class="text-danger"><br/>Đơn mẫu- Không tính doanh số</small>
                        <small ng-if="item.promotion_name" class="text-primary"><br/><i class="fa fa-gift fa-fw"><i>{{item.promotion_name}}</i></small>
                    </td>
                    <td class="text-right">{{item.discount_1}}%<br/>{{item.discount_2}}%</td>
                    <td class="text-right">{{item.total | currency: '' : 0}}<br/>{{item.total_with_discount | currency: '' : 0}}
                    </td>   
                    <td>
                        {{item.carton | number: 2}}
                    </td>
                    <td>
                        {{item.volume | number : 2}}
                    </td>       
                    <td ng-if="vm.m.activeFlag == 2 || vm.m.activeFlag == 3">
                        {{item.pending_hour}}
                    </td>                        
                    <td>
                        <span ng-repeat='state in vm.m.statusList' ng-if="state.status_id == item.order_sts" > 
                            <span class="{{state.label}}">{{state.descript}}</span>
                        </span>
                        </br> 
                        <span>
                            {{item.completion_percent*100 | currency: '' : 0}}%
                        </span>
                    </td>
                    <td ng-if="item.order_sts!= 5 && item.order_sts!= 6 && item.order_sts!= 0" > 
                        <button ng-if="item.payment_advance_id == null" type="button" class="btn btn-info btn-sm btn-width-default">
                        <a ui-sref='app.crm0751({store_order_id: item.store_order_id})'>TTT</a>
                        </button>
                        <i ng-if="item.payment_advance_id!= null" >Paid</i>
                    </td> 
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