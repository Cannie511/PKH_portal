<div class="box-header with-border">
    <h4 class="box-title">Danh sách {{vm.m[vm.m.activeFlag].title}}</h4>
    <div class="box-tools pull-right">
        <div uib-dropdown class="btn-group">
            <a ui-sref="app.crm1010" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>Thêm mới vận chuyển</a>
        </div>
    </div>
</div>
<div class="box-body form">
    <form role="form" ng-submit="vm.doSearch(vm.m.activeFlag, 1)">
        <div class="row">
            <div class="col-md-3 col-sm-6 m-b-xs">
                <div class="form-group">
                    <label>Mã phiếu xuất</label>
                    <input type="text" ng-model="vm.m[vm.m.activeFlag].filter.store_delivery_code" class="form-control"/>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 m-b-xs">
                <div class="form-group">
                    <label>Tên cửa hàng</label>
                    <input type="text" ng-model="vm.m[vm.m.activeFlag].filter.store_name" class="form-control"/>
                </div>
            </div>
            <!-- <div class="col-md-3 col-sm-6 m-b-xs">
                <div class="form-group">
                    <label>Tháng</label>
                    <p class="input-group">
                        <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM" ng-model="vm.m[vm.m.activeFlag].filter.delivery_date" is-open="vm.dp1Opened" datepicker-options="vm.m.dateOptions" close-text="Close"
                        ng-model-options="{timezone: 'utc'}" />
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" ng-click="vm.dp1Opened = true"><i class="glyphicon glyphicon-calendar"></i></button>
                        </span>
                    </p>
                </div> 
            </div> -->
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
                        placeholder-text-single="'Chọn chương trình'"
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
                        <option value="1">Xuất thường</option>
                        <option value="2">Xuất bảo hành</option>    
                        <option value="3">Xuất mẫu</option>    
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 m-b-xs">
                <div class="form-group">
                    <label>Kho</label>
                        <select class="form-control"     
                        chosen                               
                        placeholder-text-single="'Chọn chi nhánh'"
                        ng-model="vm.m[vm.m.activeFlag].filter.warehouse_id"
                        ng-options="item.warehouse_id as item.warehouse_name for item in vm.m.warehouseList "
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
                <button type="button" class="btn btn-sm btn-info" ng-click="vm.clickPrint()"><i class="fa fa-print fa-fw"></i>Phiếu xuất hàng</button> 
                <button type="button" class="btn btn-info btn-sm btn-width-default" ng-if="vm.m.activeFlag==3" ng-click="vm.downloadWH()">
                    <i class="fa fa-download fa-fw"></i>
                    Tải về WH
                </button>
                <button type="button" class="btn btn-info btn-sm btn-width-default" ng-if="vm.m.activeFlag==8" ng-click="vm.download()">
                    <i class="fa fa-download fa-fw"></i>
                    Tải về Acct
                </button>
                <button type="button" class="btn btn-info btn-sm btn-width-default" ng-if="vm.can('screen.crm0400.download')" ng-click="vm.downloadList(vm.m.activeFlag)">
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
                        <span>Thông tin xuất</span>                                     
                    </th>
                    <th >
                        <span>Kho</span>                                     
                    </th>
                    <th >
                        <span>NCU</span>   
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Nhà cung ứng"></i>                                  
                    </th>
                    <th>
                        <span ng-if="vm.m.activeFlag==2">TG tạo <i class="fas fa-question-circle" placement="top" uib-tooltip="Thời gian tạo"></i></span>
                        <span ng-if="vm.m.activeFlag==3">Bắt đầu soạn</span>
                        <span ng-if="vm.m.activeFlag==4">TG xác nhận <i class="fas fa-question-circle" placement="top" uib-tooltip="Thời gian xác nhận"></i></span>
                        <span ng-if="vm.m.activeFlag==5 || vm.m.activeFlag==6 || vm.m.activeFlag==7 || vm.m.activeFlag==8 || vm.m.activeFlag==9">TG xuất  <i class="fas fa-question-circle" placement="top" uib-tooltip="Thời gian xuất"></i></span>
                    </th>
                   
                    <th >
                        <span>Cửa hàng</span>
                    </th>
                    <th>
                        <span>CK</span>
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Chiết khấu"></i>
                    </th>
                    <th>
                        <span>Tổng tiền/<br/>Sau CK</span>
                    </th>
                    <th>
                        Volume
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Tổng thể tích đơn hàng (m3)"></i>
                    </th>
                    <th>
                        Carton
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Tổng só thùng đơn hàng"></i>
                    </th>
                    <th ng-if="vm.m.activeFlag == 2 || vm.m.activeFlag == 3|| vm.m.activeFlag == 4">
                        Delay
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Từ lúc đặt đến thời điểm hiện tại"></i>

                    </th>
                    <th ng-if="vm.m.activeFlag == 5">
                        Delay 1
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Từ lúc đặt đến ra phiếu xuất"></i>

                    </th>
                    <th>
                        <span>TT</span>
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Tình trạng"></i>
                    </th>
                    <th>
                        Cập nhật cuối
                    </th>
                    <th>
                    </th>
                </tr>
                    <tr>
                    <th></th>
                    <th></th>
                    
                    <th ng-click="vm.sort(vm.m.activeFlag,'store_delivery_code');" class="sortable">
                        
                        <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="store_delivery_code"
                            order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                    </th>
                    <th></th>
                    <th></th>
                    <th ng-if="vm.m.activeFlag == 2" ng-click="vm.sort(vm.m.activeFlag,'created_at');" class="sortable">
                        
                        <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="created_at"
                            order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                    </th>
                    <th ng-if="vm.m.activeFlag == 3" ng-click="vm.sort(vm.m.activeFlag,'packing_time');" class="sortable">
                        
                        <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="packing_time"
                            order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                    </th>
                    <th ng-if="vm.m.activeFlag == 4" ng-click="vm.sort(vm.m.activeFlag,'confirm_time');" class="sortable">
                        
                        <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="confirm_time"
                            order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                    </th>
                    <th ng-if="vm.m.activeFlag >=5 && vm.m.activeFlag<=9" ng-click="vm.sort(vm.m.activeFlag,'delivery_time');" class="sortable">
                        
                        <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="delivery_time"
                            order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                    </th>
                    
                    <th ng-click="vm.sort(vm.m.activeFlag,'store_name');" class="sortable">
                        
                        <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="store_name"
                            order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                    </th>
                    <th>
                        
                    </th>
                    <th ng-click="vm.sort(vm.m.activeFlag,'total');" class="sortable">
                            <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="store_name"
                            order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                    </th>
                    <th>   
                    </th>
                    <th>          
                    </th>
                    <th ng-if="vm.m.activeFlag == 2 || vm.m.activeFlag == 3|| vm.m.activeFlag == 4">
                    
                    </th>
                    <th ng-if="vm.m.activeFlag == 5">
                    
                    </th>
                    </th>
                        <th ng-click="vm.sort(vm.m.activeFlag,'updated_at');" class="sortable">
                        
                        <fk-col-sortable order-by="vm.m[vm.m.activeFlag].filter.orderBy" column-name="store_name"
                            order-direction="vm.m[vm.m.activeFlag].filter.orderDirection"></fk-col-sortable>
                    </th>
                    <th>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data'>
                    <td><input type="checkbox" ng-model="item.check" /></td>
                    <td>{{$index + vm.m[vm.m.activeFlag].data.from}}</td>
                    <td>
                        <a ui-sref='app.crm0411({store_delivery_id: item.store_delivery_id, store_order_id: item.store_order_id})'>#{{item.store_delivery_code}}(#{{item.store_delivery_id}})</a>
                       
                        <br/>
                        <small ng-if="item.salesman_id"><i>PTD: ({{item.salesman_name}})</i></small> 
                        <br/>
                        <small ng-if="item.branch_name"><i>NX: ({{item.branch_name}})</i></small> <br/>

                        <small ng-if="item.delivery_vendor_name">
                            <i>Người VC: ({{item.delivery_vendor_name}})</i>
                            <br/>
                            <i>Phí VC: ({{item.delivery_cost | currency: '' : 0}})</i>
                            <br/>
                            <i>Time VC: ({{item.transport_date}})</i>
                        </small> <br/>
                    </td>
                    <td>
                        {{item.warehouse_name}}
                    </td>
                    <td>
                        {{item.supplier_code}}
                    </td>
                    <td>
                        <span ng-if="vm.m.activeFlag==2">{{item.created_at}}</span>
                        <span ng-if="vm.m.activeFlag==3">{{item.packing_time}}</span>
                        <span ng-if="vm.m.activeFlag=='4'">{{item.confirm_time}}</span>

                        <span ng-if="vm.m.activeFlag==5 || vm.m.activeFlag==6 || vm.m.activeFlag==7 || vm.m.activeFlag==8 ||vm.m.activeFlag==9 ">{{item.delivery_time}}</span>
                        
                    </td>
                    <td>
                        <a ui-sref='app.crm2600({store_id: item.store_id})'>#{{item.store_id}}</a>&nbsp;
                        <a ui-sref='app.rpt0514({store_id: item.store_id})'>{{item.store_name}}</a>
                        &nbsp;
                    <span class="badge badge-success" ng-if="item.is_review_valid && item.review_sts == 'VERIFIED'"><i class="fas fa-thumbs-up fa-fw"></i>&nbsp;{{item.review_expired_date}}</span>
                    <span class="badge badge-warning" ng-if="!item.is_review_valid && item.review_sts == 'VERIFIED'"><i class="fas fa-thumbs-up fa-fw"></i>&nbsp;{{item.review_expired_date}}</span>
                    <span class="badge badge-danger" ng-if="item.review_sts == 'BLACKLIST'"><i class="fas fa-thumbs-down"></i></span>
                    
                        <br/><i>{{item.address2}} - {{item.address1}}</i>
                        <br/>
                        <small >Cấp : {{item.level}}</small>
                        <br/><small><i>Phụ trách hiện tại: {{item.current_salesman_name}}</i></small>
                        <small ng-if="item.promotion_name" class="text-primary"><br/><i class="fa fa-gift fa-fw"/><i>{{item.promotion_name}}</i></small>
                        <small ng-if="item.order_type==1" class="text-danger"><br/>Xuất thường</small>
                        <small ng-if="item.order_type==2" class="text-danger"><br/>Xuất bảo hành- Không tính doanh số</small>
                        <small ng-if="item.order_type==3" class="text-danger"><br/>Xuất hàng mẫu- Không tính doanh số</small>
                    </td>
                        <td class="text-right">{{item.discount_1}}%<br/>{{item.discount_2}}%</td>
                    <td class="text-right">{{item.total | currency: '' : 0}}<br/>{{item.total_with_discount | currency: '' : 0}}</td>
                    <td>
                        {{item.volume}}
                    </td>
                    <td>
                        {{item.carton}}
                    </td>
                    <td  ng-if="vm.m.activeFlag == 2 || vm.m.activeFlag == 3|| vm.m.activeFlag == 4"> 
                        {{item.pending_hour}}
                    </td>
                    <td  ng-if="vm.m.activeFlag ==5"> 
                        {{item.del_cre}}
                    </td>
                    <td>
                        <span ng-repeat='state in vm.m.statusList' ng-if="state.status_id == item.delivery_sts" > 
                            <span class="{{state.label}}">{{state.descript}}</span>
                        </span>
                    </td>
                    <td>
                            {{item.updated_at}}<br/>
                        <small><i>{{item.updated_by}}</i></small>
                    </td>
                    <td>
                        <span ng-if="item.delivery_sts=='1'" >
                            <button type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.Shipping(item)">
                            VC
                            </button>
                        </span>
                        <span ng-if="item.delivery_sts=='8'" >
                            <button type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.Receive(item)">
                            KN
                            </button>
                        </span>
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
