<div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Số ngày thanh toán đơn hàng</h3>
                                <div class="box-tools pull-right">
                                </div>
                            </div>
                            <div class="box-body form">
                                <form class="form" ng-submit="vm.doSearch(vm.m.activeFlag,1)">
                                    <div class="row">
                                      
                                       
                                        <div class="col-md-3 col-sm-6 m-b-xs">
                                            <div class="form-group">
                                                <label>Loại</label>
                                                <select class="form-control"
                                                    placeholder-text-single="'Chọn Loại'"
                                                    ng-model="vm.m[vm.m.activeFlag].filter.sts"
                                                    >
                                                    <option value="">Tất cả</option>
                                                    <option value='0'>Chưa thanh toán</option>
                                                    <option value='1'>Đã thanh toán</option>
                                                </select>
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
                                                <th>Khu vực</th>
                                                <th>Tỉnh/Thành</th>
                                                <!-- <th>Quận/huyện</th> -->
                                                <th>Thông tin đơn hàng</th>
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
                                           
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data'>
                                                <td>{{vm.m[vm.m.activeFlag].data.from +$index }}</td>
                                                <td>{{item.group_area_name}}</td>
                                                <td>{{item.area1}}</td>
                                                <!-- <td>{{item.area2}}</td> -->
                                                <td>
                                                    <a ui-sref='app.crm0411({store_delivery_id: item.store_delivery_id, store_order_id: item.store_order_id})'>#{{item.store_delivery_code}}(#{{item.store_delivery_id}})</a>
                                                    <br/>
                                                    <small class="text-danger"> Phụ trách: {{item.salesman_name}} </small>
                                                    <br/>
                                                    {{item.store_id}} - {{item.store_name}}
                                                    <br/>
                                                    <small>{{item.store_address}}</small>
                                                    <br/>
                                                    <small>Phone: {{item.contact_tel}} - {{item.contact_mobile}}</small>
                                                    <br/>
                                                    <small>Cấp: {{item.level}}</small>
                                                </td>
                                               
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
                                <div class="row text-right">
                                    <div class="col-md-6 col-sm-12 text-left" ng-show="vm.m[vm.m.activeFlag].data.from > 0">
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
