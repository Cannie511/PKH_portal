<section class="content-header">
    <h1>Lịch nhập hàng<small></small></h1>
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
                    <h3 class="box-title"></h3>
                    
                </div>
                <div class="box-body form" >
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                           

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
                                                        
                                    <th class="text-right" >
                                        <span >PI no</span>
                                    </th>
                                    <th class="text-right" >
                                        <span >NCU</span>
                                    </th>
                                    <th class="col-action"></th>
                                    <th >
                                        <span >Đặt hàng</span>
                               
                                    </th>
                                  
                                    <th >
                                        <span >Thanh toán 1</span>
                                       
                                    </th>
                                  
                                    <th >
                                        <span >Sản xuất xong</span>
    
                                    </th>
                                    <th >
                                        <span >Vận chuyển</span>
                                       
                                    </th>

                                    <th >
                                        <span >Đến cảng</span>                                     
                                    </th>

                                    <th  >
                                        <span >Nhập kho</span>
                                    </th>

                                    <th  >
                                        <span >Thanh toán 2</span>
                                    </th>

                                      <th  >
                                        <span >Trạng thái</span>
                                    </th>

                                  
                                
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list.data'>
                                    <td class="col-action">
                                        <div class="btn-group" uib-dropdown dropdown-append-to-body>
                                          <button type="button" class="btn btn-default btn-sm" uib-dropdown-toggle>
                                            <i class="fa fa-ellipsis-v"></i>
                                          </button>
                                          <ul class="dropdown-menu" uib-dropdown-menu role="menu" aria-labelledby="btn-append-to-body">
                                            <li ng-if="vm.can('screen.crm1610')" role="menuitem"><a ui-sref='app.crm1610({supplier_delivery_id: item.supplier_delivery_id, supplier_order_id: item.supplier_order_id})'>Chi tiết PI</a></li>
                                          </ul>
                                        </div>
                                    </td>

                                    <td>{{$index + vm.m.list.from}}</td>
                                    <td>{{item.pi_no}}</td>
                                    <td>{{item.supplier_code}}</td>
                                    <td> Ngày thực tế <br> Ngày dự kiến</td>
                                    <td>{{item.send_po_date | date:'yyyy-MM-dd'}} </td>
                                    <td>{{item.payment_1_date | date:'yyyy-MM-dd'}}  </td>
                                    <td>{{item.finish_cont_date | date:'yyyy-MM-dd'}}  <br>{{item.finish_cont_expected_date | date:'yyyy-MM-dd'}} </td>
                                    <td>{{item.deliver_cont_date | date:'yyyy-MM-dd'}} <br>{{item.deliver_cont_expected_date | date:'yyyy-MM-dd'}} </td>
                                    <td>{{item.arrive_port_date | date:'yyyy-MM-dd'}} <br>{{item.arrive_port_expected_date | date:'yyyy-MM-dd'}} </td>
                                    <td>{{item.comming_pkh_date | date:'yyyy-MM-dd'}} <br> {{item.comming_pkh_expected_date | date:'yyyy-MM-dd'}}</td>
                                    <td>{{item.payment_2_date | date:'yyyy-MM-dd'}} <br>{{item.payment_2_expected_date | date:'yyyy-MM-dd'}} </td>

                                    <td class="text-center">
                                        <span ng-if="item.delivery_sts == 0" class="label bg-purple btn-flat margin">Mới</span> 
                                        <span ng-if="item.delivery_sts == 1" class="label label-warning">TT1</span> 
                                        <span ng-if="item.delivery_sts == 2" class="label label-info">SXX</span> 
                                        <span ng-if="item.delivery_sts == 3" class="label label-primary">VC</span>
                                        <span ng-if="item.delivery_sts == 4" class="label label-danger">DC</span>
                                        <span ng-if="item.delivery_sts == 5" class="label label-default">NK</span>
                                        <span ng-if="item.delivery_sts == 6" class="label label-success">TT2</span>
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
