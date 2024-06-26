<div class="box-body form">
    <form class="form" ng-submit="vm.loadData(vm.m.activeFlag)">
        <div class="row">
         
          
            <div ng-if="vm.m.init.isSale==0" class="col-md-3 col-sm-6 m-b-xs">
                <div class="form-group">
                    <label>Nhân viên bán hàng</label>
                    <select class="form-control"     
                        chosen                               
                        placeholder-text-single="'Chọn chương trình'"
                        ng-model="vm.m[vm.m.activeFlag].filter.salesman_id"
                        ng-options="item.id as item.name for item in vm.m.init.salesmanList "
                        >
                        <option value="">Không có</option>
                        </select>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Cửa hàng</label>
                    <input type="text" class="form-control" ng-model="vm.m[vm.m.activeFlag].filter.store_name"/>
                </div>
            </div>
            

            <div class="col-md-3 col-sm-6 m-b-xs">
                <div class="form-group">
                    <label>Độ trễ</label>
                    <select class="form-control"
                        placeholder-text-single="'Chọn Loại'"
                        ng-model="vm.m[vm.m.activeFlag].filter.delay"
                        >
                        <option value="">Tất cả</option>
                        <option value='1'>1 - 7 (ngày) Tuan 1</option>
                        <option value='2'>8 - 15 (ngày) Tuan 2</option>
                        <option value='3'>16 - 23 (ngày) Tuan 3</option>
                        <option value='4'>24 - 30 (ngày) Tuan 4</option>
                        <option value='5'>Hơn 30 ngày - Hon 1 thang </option>
                    </select>
                </div>
            </div>

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
                <th>NO</th>
                
                <th>Thông tin cửa hàng</th>
                <th>Cấp</th>
                <th>Phụ trách hiện tại</th>
                <th class="text-right">Trung bình trễ</th>
                <th class="text-right">Số đơn nợ</th>
                <th class="text-right">Cần thu</th>
                
                
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data'>
                <td>{{vm.m[vm.m.activeFlag].data.from +$index }}</td>
                <td>

                    {{item.store_id}} - {{item.store_name}}
                    <br/>
                    <small>{{item.store_address}}</small>
                </td>
                <td>
                    {{item.level}}
                </td>
                <td> 
                    {{item.salesman_name}}
                </td>
                <td class="text-right">{{item.avg_delay| currency: '' : 0}}  (ngày)</td>
                <td class="text-right">{{item.number_order| currency: '' : 0}}  (đơn)</td>
                <td class="text-right"><span>{{item.remain_amount | currency: '' : 0}}</span></td>
                <td class="text-right">
                        <span  class="label label-primary" ng-if="item.avg_delay<=7"> 
                            Tuần 1
                        </span>
                        <span  class="label label-success" ng-if="item.avg_delay>7 && item.avg_delay<=15"> 
                            Tuần 2
                        </span>
                        <span  class="label label-warning" ng-if="item.avg_delay>15 && item.avg_delay<= 23"> 
                            Tuần 3
                        </span>
                        <span  class="label label-default" ng-if="item.avg_delay>23 && item.avg_delay<= 30"> 
                            Tuần 4
                        </span>
                        <small  class="label label-danger" ng-if="item.avg_delay>30 "> 
                            Hơn 1 tháng
                            </small>
                    </td>
                
            </tr>
        </tbody>
    </table>
</div>

</div>
