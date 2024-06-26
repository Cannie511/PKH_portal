<div class="box-header with-border">
    <h4 class="box-title">Thống kê xuất hàng</h4>
   
</div>
<div class="box-body form">
    <form role="form" ng-submit="vm.doSearch(vm.m.activeFlag, 1)">
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
            
            <!-- <div class="col-md-3 col-sm-6 m-b-xs">
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
            </div> -->
            
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
           
            </div>
        </div>
    </form>
</div>
<div class="box-body">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>
                        Date
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Ngày ra phiếu xuất"></i>
                    </th>
                    <th>
                        Day
                    </th>
                    <th class="text-right">
                        Amount
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Tổng tiền sau CK, 1000VND"></i>
                    </th>
                    <th class="text-right">
                        Volume
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Tổng thể tích m3"></i>
                    </th>
                    <th class="text-right">
                        Carton
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Tổng số thùng"></i>
                    </th>
                    <th class="text-right">
                        Product
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Tổng sản phẩm"></i>
                    </th>
                    <th class="text-right">
                        Store
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Tổng số cửa hàng"></i>
                    </th>
                    <th class="text-right">
                        Del numb
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Tổng số đơn "></i>
                    </th>
                    <th class="text-right">
                        Wh numb
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Tổng số kho"></i>
                    </th>
                    <th class="text-right">
                        Trans amount
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Tổng phí vận chuyển"></i>
                    </th>
                    <th class="text-right">
                        Trans numb
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Tổng số lượt vận chuyển"></i>
                    </th>
                    <th class="text-right">
                        Trans man
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Tổng số người vận chuyển"></i>
                    </th>
                    <th class="text-right">
                        Trans/Del
                        <i class="fas fa-question-circle" placement="top" uib-tooltip="Tỉ lệ phí/giá trị đơn hàng"></i>
                    </th>
                </tr>
                   
            </thead>
            <tbody>
                <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data'>
                   <td>
                   {{item.date_time}}
                   </td>
                   <td>
                   {{item.day_name}}
                   </td>
                   <td class="text-right">
                   {{item.selling_amount/1000| currency: '' : 0}}
                   </td>
                   <td class="text-right">
                   {{item.volume| currency: '' : 2}}
                   </td>
                   <td class="text-right">
                   {{item.carton| currency: '' : 0}}
                   </td>
                   <td class="text-right">
                   {{item.product_numb| currency: '' : 0}}
                   </td>
                   <td class="text-right">
                   {{item.store_numb| currency: '' : 0}}
                   </td>
                   <td class="text-right">
                   {{item.delivery_numb| currency: '' : 0}}
                   </td>
                   <td class="text-right">
                   {{item.wh_numb| currency: '' : 0}}
                   </td>
                   <td class="text-right">
                   {{item.trans_amount/1000| currency: '' : 0}}
                   </td>
                   <td class="text-right">
                   {{item.trans_numb| currency: '' : 0}}
                   </td>
                   <td class="text-right">
                   {{item.trans_man| currency: '' : 0}}
                   </td>
                   <td class="text-right">
                   {{item.trans_amount/item.selling_amount| currency: '' : 2}}
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
