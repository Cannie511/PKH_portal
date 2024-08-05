
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
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <span>Ngày bắt đầu: {{vm.m.data.start_date}}</i></span>
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
                                        <option value="2021">2021</option>
                                        <option value="2020">2020</option>
                                        <option value="2019">2019</option>
                                        <option value="2018">2018</option>
                                        <option value="2017">2017</option>
                                        <option value="2016">2016</option>
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
                <div ng-repeat="item in vm.m.data.years" class="box-body">
                    <div class="table-responsive">
                        <div class="box box-info collapsed-box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Năm {{item}}</h3>
                                <div class="box-tools pull-right">
                                    <button ng-click="vm.m.filter.month" type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="box-body" style="display: none">
                                <div class="table-responsive" ng-if="vm.m.init">
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
                                            <tr ng-repeat="data in vm.m.data.sale" ng-value="{{$index}}" ng-if="data.year === item ">
                                                <td>{{data.month}}/{{data.year}}</td>
                                                <td>
                                                    {{data . gap_sale | currency:'':0}}<br>
                                                    <b><small>+{{+data.gap_sale >= +vm.m.data.avg_sale ? 25:10}} điểm</small></b>
                                                </td>
                                                <td>
                                                    {{data.retention}} năm
                                                    <br>
                                                    <b><small>+{{vm.m.data.retention >= 3 ? 25 : 10}} điểm</small></b>
                                                </td>
                                                <td>
                                                    <h5 class="fw-bold"><i class="fa fa-arrow-up" style="color: green;"></i> {{data.gap_order|currency:'':0}} đơn</h5>
                                                    <b><small>+{{data.order >= vm.m.data.avg_order ? 25:10}} điểm</small></b>
                                                </td>
                                                <td>
                                                    {{data.payment ? "Không có công nợ": "Còn công nợ"}}
                                                    <br>
                                                    <b><small> <i ng-if="data.payment" class="fa fa-arrow-up" style="color: green;"></i> <span ng-if="!data.payment">( - )</span> +{{data.payment ? 25:15}} điểm</small></b>
                                                </td>
                                                <td>
                                                    <b>60 điểm</b>
                                                </td>
                                                <td>
                                                    <h5 class="fw-bold"><i class="fa fa-arrow-down" style="color: red;"></i> (-10)</h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
