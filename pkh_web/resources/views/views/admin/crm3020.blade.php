<section class="content-header">
    <h1>Lịch sử điểm<small></small></h1>
</section>
<section class="content">
<div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{vm . m . data . name}}</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.crm2910" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <span>Địa chỉ: {{vm . m . data . address}}</span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <span>Phụ trách hiện tại: {{vm . m . data . salesman_name}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <span>Khu vực: {{vm . m . data . area1_name}} - <i>{{vm . m . data . area2_name}}</i></span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <span>Liên hệ: {{vm . m . data . contact_tel}} - {{vm . m . data . contact_mobile1}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <span>Ngày sinh: 01 - 01 - 1999</i></span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <span>Điểm tích lũy: {{vm . m . data . scorecard}}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-2">
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="title">Tháng</label>
                                    <select class="form-control" ng-model="vm.m.filter.month">
                                        <option value="">- Tất cả -</option>
                                        <option value="1">01</option>
                                        <option value="2">02</option>
                                        <option value="3">03</option>
                                        <option value="4">04</option>
                                        <option value="5">05</option>
                                        <option value="6">06</option>
                                        <option value="7">07</option>
                                        <option value="8">08</option>
                                        <option value="9">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="title">Năm</label>
                                    <select class="form-control" ng-model="vm.m.filter.year">
                                        <option value="">- Tất cả -</option>
                                        <option value="1">2021</option>
                                        <option value="2">2020</option>
                                        <option value="3">2019</option>
                                        <option value="4">2018</option>
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
                </div>
                
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tháng</th>
                                    <th>Doanh số</th>
                                    <th>Thâm niên</th>
                                    <th>Tần suất đặt hàng</th>
                                    <th>Công nợ</th>
                                    <th>Tổng điểm</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               <tr>
                                    <td>12/2021</td>
                                    <td>
                                    {{vm . m . data1}}
                                        <br>
                                        <b><small>+10 điểm</small></b>
                                    </td>
                                    <td>
                                        4 năm
                                        <br>
                                        <b><small>+25 điểm</small></b>
                                    </td>
                                    <td>
                                        0.57 đơn / năm
                                        <br>
                                        <b><small>+10 điểm</small></b>
                                    </td>
                                    <td>
                                        Còn công nợ
                                        <br>
                                        <b><small>+15 điểm</small></b>
                                    </td>
                                    <td>
                                        <b>60 điểm</b>
                                    </td>
                                    <td>
                                        <h5 class="fw-bold"><i class="fa fa-arrow-down" style="color: red;"></i> (-10)</h5>
                                    </td>
                               </tr>
                            <tr>
                                <td>11/2021</td>
                                <td>
                                    102,220,102
                                    <br>
                                    <b><small>+10 điểm</small></b>
                                </td>
                                <td>
                                    4 năm
                                    <br>
                                    <b><small>+25 điểm</small></b>
                                </td>
                                <td>
                                    0.54 đơn / năm
                                    <br>
                                    <b><small>+10 điểm</small></b>
                                </td>
                                <td>
                                    Không còn công nợ
                                    <br>
                                    <b><small>+15 điểm</small></b>
                                </td>
                                <td>
                                    <b>70 điểm</b>
                                </td>
                                <td>
                                    <h5 class="fw-bold"><i class="fa fa-arrow-up" style="color: green;"></i> (+10)</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>10/2021</td>
                                <td>
                                    88,181,210
                                    <br>
                                    <b><small>+10 điểm</small></b>
                                </td>
                                <td>
                                    4 năm
                                    <br>
                                    <b><small>+25 điểm</small></b>
                                </td>
                                <td>
                                    0.5 đơn / năm
                                    <br>
                                    <b><small>+10 điểm</small></b>
                                </td>
                                <td>
                                    Còn công nợ
                                    <br>
                                    <b><small>+15 điểm</small></b>
                                </td>
                                <td>
                                    <b>60 điểm</b>
                                </td>
                                <td>
                                    __
                                </td>
                            </tr>
                            <tr>
                                <td>09/2021</td>
                                <td>
                                    68,842,100
                                    <br>
                                    <b><small>+10 điểm</small></b>
                                </td>
                                <td>
                                    4 năm
                                    <br>
                                    <b><small>+25 điểm</small></b>
                                </td>
                                <td>
                                    0.48 đơn / năm
                                    <br>
                                    <b><small>+10 điểm</small></b>
                                </td>
                                <td>
                                    Còn công nợ
                                    <br>
                                    <b><small>+15 điểm</small></b>
                                </td>
                                <td>
                                    <b>60 điểm</b>
                                </td>
                                <td>
                                    __
                                </td>
                                </tr>
                            <tr>
                                <td>08/2021</td>
                                <td>
                                    42,116,200
                                    <br>
                                    <b><small>+10 điểm</small></b>
                                </td>
                                <td>
                                    4 năm
                                    <br>
                                    <b><small>+25 điểm</small></b>
                                </td>
                                <td>
                                    0.43 đơn / năm
                                    <br>
                                    <b><small>+10 điểm</small></b>
                                </td>
                                <td>
                                    Còn công nợ
                                    <br>
                                    <b><small>+15 điểm</small></b>
                                </td>
                                <td>
                                    <b>60 điểm</b>
                                </td>
                                <td>
                                    <h5 class="fw-bold"><i class="fa fa-arrow-down" style="color: red;"></i> (-10)</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>07/2021</td>
                                <td>
                                    32,213,803
                                    <br>
                                    <b><small>+10 điểm</small></b>
                                </td>
                                <td>
                                    4 năm
                                    <br>
                                    <b><small>+25 điểm</small></b>
                                </td>
                                <td>
                                    0.4 đơn / năm
                                    <br>
                                    <b><small>+10 điểm</small></b>
                                </td>
                                <td>
                                    Không còn công nợ
                                    <br>
                                    <b><small>+25 điểm</small></b>
                                </td>
                                <td>
                                    <b>70 điểm</b>
                                </td>
                                <td>
                                    __
                                </td>
                            </tr>
                            <tr>
                                <td>06/2021</td>
                                <td>
                                    32,213,803
                                    <br>
                                    <b><small>+10 điểm</small></b>
                                </td>
                                <td>
                                    4 năm
                                    <br>
                                    <b><small>+25 điểm</small></b>
                                </td>
                                <td>
                                    0.4 đơn / năm
                                    <br>
                                    <b><small>+10 điểm</small></b>
                                </td>
                                <td>
                                    Không còn công nợ
                                    <br>
                                    <b><small>+25 điểm</small></b>
                                </td>
                                <td>
                                    <b>70 điểm</b>
                                </td>
                                <td>
                                    __
                                </td>
                            </tr>
                            <tr>
                                <td>05/2021</td>
                                <td>
                                    32,213,803
                                    <br>
                                    <b><small>+10 điểm</small></b>
                                </td>
                                <td>
                                    4 năm
                                    <br>
                                    <b><small>+25 điểm</small></b>
                                </td>
                                <td>
                                    0.4 đơn / năm
                                    <br>
                                    <b><small>+10 điểm</small></b>
                                </td>
                                <td>
                                    Không còn công nợ
                                    <br>
                                    <b><small>+25 điểm</small></b>
                                </td>
                                <td>
                                    <b>70 điểm</b>
                                </td>
                                <td>
                                    <h5 class="fw-bold"><i class="fa fa-arrow-up" style="color: green;"></i> (+10)</h5>
                                </td>
                            </tr>

                            <tr>
                                <td>04/2021</td>
                                <td>
                                    24,192,073
                                    <br>
                                    <b><small>+10 điểm</small></b>
                                </td>
                                <td>
                                    4 năm
                                    <br>
                                    <b><small>+25 điểm</small></b>
                                </td>
                                <td>
                                    0.38 đơn / năm
                                    <br>
                                    <b><small>+10 điểm</small></b>
                                </td>
                                <td>
                                    Còn công nợ
                                    <br>
                                    <b><small>+15 điểm</small></b>
                                </td>
                                <td>
                                    <b>60 điểm</b>
                                </td>
                                <td>
                                    __
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 text-left">
                            <p class="form-control-static">{{vm . m . data . from}} - {{vm . m . data . to}} / {{vm . m . data . total}}</p>                            
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <uib-pagination 
                                total-items="vm.m.data.total"
                                ng-model="vm.m.data.current_page"
                                items-per-page="vm.m.data.per_page"
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
