
<div class="box-body form">
    
        <div class="row">    
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Loại đơn hàng </label>
                    <select class="form-control"
                        placeholder-text-single="'Chọn loại đơn'"
                        ng-model="vm.m.filter.order_type_pay"
                        ng-change="vm.selectPayment()"
                        >
                        <option value='0'>Tất cả</option>
                        <option value='1'>Đơn Ecommerce</option>
                        <option value='2'>Đơn sỉ</option>
                    </select>
                </div>
            </div>
        </div>
       
  
</div>
<div class="table-responsive">
<table class="table table-striped">
        <thead>
            <tr>
                <th>NO</th>
                <th>Khu vực</th>
                <!-- <th>Tỉnh/Thành</th> -->
                <!-- <th>Quận/huyện</th> -->
                <th style="width:120px">Thông tin đơn hàng</th>
                <!-- <th>Đơn hàng</th> -->
                <!-- <th>Ngày đặt</th> -->
                <th class="text-right">Ngày giao</th>
                <th class="text-right" >Ngày Thanh Toán</th>
                <th class="text-right">Số ngày TT</th>
                <th class="text-right">Hạn mức</th>
                <th class="text-right">Độ trễ</th>
                <th class="text-right">Giá trị</th>
                <th class="text-right">Cần thu</th>
                
                <th></th>
            </tr>
            <!-- <tr>
                <th colspan="8"></th>
                <th>Hạn</th>
                <th>Bắt đầu</th>
                <th>Kết thúc</th>
            </tr> -->
        </thead>
        <tbody>
            <tr ng-repeat='item in vm.m.needToPay' ng-if="item.hide != true">
                <td>{{1+$index }}</td>
                <td>
                    {{item.group_area_name}}
                    <br/>
                    {{item.area1}}
                </td>
                
                <!-- <td>{{item.area2}}</td> -->
                <td style="width:120px">
                    <a ui-sref='app.crm0411({store_delivery_id: item.store_delivery_id, store_order_id: item.store_order_id})'>#{{item.store_delivery_code}}(#{{item.store_delivery_id}})</a>
                    <br/>
                    <small class="text-danger"> Phụ trách: {{item.salesman_name}} </small>
                    <br/>
                    {{item.store_id}} - 
                    <a ui-sref='app.rpt0514({store_id: item.store_id})'>{{item.store_name}}</a>
                    <br/>
                    <small>Cấp: {{item.level}} </small>

                    <!-- <br/>
                    <small>{{item.store_address}}</small> -->
                </td>
                <!-- <td></td> -->
                <!-- <td>{{item.order_date | date: 'yyyy-MM-dd'}}</td> -->
                <td class="text-right">{{item.delivery_date | date: 'yyyy-MM-dd'}}</td>
                <td class="text-right">
                    {{item.payment_date | date: 'yyyy-MM-dd'}}
                    <br/>
                    <span ng-if="item.sts=='1'" class="label label-success">Đã thanh toán</span>
                    <span ng-if="item.sts=='0'" class="label label-danger">Chưa thanh toán</span>
                </td>

                <td class="text-right">{{item.days}} </td>
                <td class="text-right">{{item.payment_day}} </td>
                <td class="text-right">{{item.days - item.payment_day}} </td>
                <!-- <td>{{item.delivery_date_deadline | date: 'yyyy-MM-dd'}}</td>
                <td>{{item.payment_start | date: 'yyyy-MM-dd'}}</td>
                <td>{{item.payment_end | date: 'yyyy-MM-dd'}}</td> -->
                <td class="text-right">{{item.total_with_discount | currency: '' : 0}}</td>
                <td class="text-right"><span>{{item.remain_amount | currency: '' : 0}}</span></td>
                
                <td class="text-right">
                    <span  class="label label-primary" ng-if="item.days - item.payment_day<=7"> 
                        Tuần 1
                    </span>
                    <span  class="label label-success" ng-if="item.days - item.payment_day>7 && item.days - item.payment_day<=15"> 
                        Tuần 2
                    </span>
                    <span  class="label label-warning" ng-if="item.days - item.payment_day>15 && item.days - item.payment_day<= 23"> 
                        Tuần 3
                    </span>
                    <span  class="label label-default" ng-if="item.days - item.payment_day>23 && item.days - item.payment_day<= 30"> 
                        Tuần 4
                    </span>
                    <small  class="label label-danger" ng-if="item.days - item.payment_day>30 "> 
                        Hơn 1 tháng
                        </small>
                </td>
            </tr>
        </tbody>
    </table>
</div>



