<section class="content-header">
    <h1>ScoreCard For Merchant<small></small></h1>
</section>
<section class="content">
<div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách đại lý</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.crm2910" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <div class="box-body form">
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="title">Name</label>
                                    <input type="text" class="form-control" id="title" ng-model="vm.m.filter.name" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Level of Sales</label>
                                    <select class="form-control"
                                        placeholder-text-single="'Chọn level'"
                                        ng-model="vm.m.filter.level_sales"
                                        >
                                        <option value="">All</option>
                                        <option value='1'>level 1</option>
                                        <option value='2'>level 2</option>
                                        <option value='3'>level 3</option>
                                        <option value='4'>level 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Level of Retention</label>
                                    <select class="form-control"
                                        placeholder-text-single="'Chọn level'"
                                        ng-model="vm.m.filter.level_retention"
                                        >
                                        <option value="">All</option>
                                        <option value='1'>level 1</option>
                                        <option value='2'>level 2</option>
                                        <option value='3'>level 3</option>
                                        <option value='4'>level 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Level of Dept</label>
                                    <select class="form-control"
                                        placeholder-text-single="'Chọn level'"
                                        ng-model="vm.m.filter.level_dept"
                                        >
                                        <option value="">All</option>
                                        <option value='0'>level 0</option>
                                        <option value='2'>level 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Level of Payment History</label>
                                    <select class="form-control"
                                        placeholder-text-single="'Chọn level'"
                                        ng-model="vm.m.filter.level_payment_history"
                                        >
                                        <option value="">All</option>
                                        <option value='1'>level 1</option>
                                        <option value='2'>level 2</option>
                                        <option value='3'>level 3</option>
                                        <option value='4'>level 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Level of Order Frequency</label>
                                    <select class="form-control"
                                        placeholder-text-single="'Chọn level'"
                                        ng-model="vm.m.filter.level_order_frequency"
                                        >
                                        <option value="">All</option>
                                        <option value='1'>level 1</option>
                                        <option value='2'>level 2</option>
                                        <option value='3'>level 3</option>
                                        <option value='4'>level 4</option>
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
                                    <th>NO</th>
                                    <th>Name</th>
                                    <th>Doanh số</th>
                                    <th>Điểm doanh số</th>
                                    <th>Retention</th>
                                    <th>Retention's level</th>
                                    <th>Outstanding Debt</th>
                                    <th>Debt's level</th>
                                    <th>Payment History</th>
                                    <th>PH's level</th>
                                    <th>OF's Quarter {{vm.m.quarter}}/{{vm.m.year}}</th>
                                    <th>OF's level</th>
                                    <th>OverAll</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data.data'>
                                    <td>{{$index+ vm.m.data.data.from}}</td>
                                    <td>{{item.name}}<br><small><i>{{item.address}}</i></small></td>
                                    <td >{{ item.total_sale | currency:'':0 }}</td>
                                    <td ng-style="{'color': item.total < 50000000 ? 'red' : 'black'}">
                                        <b>
                                            {{+item.total_sale < +vm.m.data.avg_sale ? 10:25}}
                                        </b> 
                                    </td>
                                    <td >{{ item.retention}} years</td>
                                    <td  ng-style="{'color': item.retention < 1 ? 'red' : 'black'}">
                                        <b>
                                            {{item.level_retention}}
                                        </b>
                                    </td>
                                    <td>{{item.remain_amount}}</td>
                                    <td ng-style="{'color': item.remain_amount == 0 ? 'red' : 'black'}">
                                        <b>
                                            {{item.level_dept}}
                                        </b>
                                    </td>
                                    <td>{{item.history | number: 1}} days</td>
                                    <td ng-style="{'color': item.history > 28 ? 'red' : 'black'}">
                                        <b>
                                            {{item.level_payment_history}}
                                        </b>
                                    </td>
                                    <td>{{item.count_order|number:1}}</td>
                                    <td ng-style="{'color': item.count_order <= 1 ? 'red' : 'black'}">
                                        <b>
                                            {{item.level_order_frequency}}
                                        </b>
                                    </td>
                                    <td>{{
                                        +item.total_sale < +vm.m.data.avg_sale ? 10:25
                                    }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 col-sm-12 text-left">
                            <p class="form-control-static">{{vm.m.data.from}} - {{vm.m.data.to}} / {{vm.m.data.total}}</p>                            
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <uib-pagination 
                                total-items="vm.m.data.data.total"
                                ng-model="vm.m.data.data.current_page"
                                items-per-page="vm.m.data.data.per_page"
                                ng-change="vm.doSearch(vm.m.data.data.current_page)"
                                class="pagination pagination-sm m-t-none m-b-none">
                            </uib-pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
