<section class="content-header">
    <h1>ScoreCard For Merchant<small></small></h1>
</section>
<section class="content">
<div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách đại lý</h3>
                </div>
                <div class="box-body form">
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="title">Tên đại lý</label>
                                    <input type="text" class="form-control" id="title" ng-model="vm.m.filter.name" />
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
                                    <th></th>
                                    <th>STT.</th>
                                    <th ng-click="vm.sort('name');" class="sortable">
                                        <span translate="COM_LABEL_STORE"></span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th style="width: 500px">Tiêu chí</th>
                                    <th style="width: 500px">Tổng điểm dự kiến quý {{vm.m.quarter}}/{{vm.m.year}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data.data'
                                >
                                    <td class="col-action">
                                        <div class="btn-group" uib-dropdown dropdown-append-to-body>
                                          <button type="button" class="btn btn-default btn-sm" uib-dropdown-toggle>
                                            <i class="fa fa-ellipsis-v"></i>
                                          </button>
                                          <ul class="dropdown-menu" uib-dropdown-menu role="menu" aria-labelledby="btn-append-to-body">
                                            <li role="menuitem"><a ui-sref='app.crm3021({store_id: item.store_id})'>Lịch sử điểm</a></li>
                                          </ul>
                                        </div>
                                    </td>
                                    <td>{{$index+ vm.m.data.data.from}}</td>
                                    <td>
                                        <a ui-sref='app.crm2600({store_id: item.store_id})'> #{{item.store_id}}</a> {{item.name}}<br>
                                        <small><i ng-class="{'text-danger': item.gps_lat == 0 || item.gps_long == 0, 'text-success': item.gps_lat != 0 &amp;&amp; item.gps_long != 0}" class="fa fa-map-marker  text-danger"></i> <i>{{item.address}}</i></small>
                                    </td>
                                    <td>
                                        <small><i>1. Doanh số 2024: <b>{{item.total_sale|currency:'':0}} (+{{+item.total_sale < +vm.m.data.avg_sale ? 10:25}})</b></i></small>
                                        <br>
                                        <small><i>2. Thâm niên: <b>{{item.retention}} năm (+{{+item.retention >=3 ? 25:10}})</b></i></small>
                                        <br>
                                        <small><i>3. Tần suất đặt hàng: <b>{{+item.order_frequency}} đơn (+{{+item.order_frequency >= vm.m.data.avg_OD ? 25:10}})</b></i></small>
                                        <br>
                                        <small><i>4. Thời gian công nợ: <b>{{item.payment ? "Không có công nợ":"Có công nợ"}} (+{{item.payment ? 25:15}})</b></i></small>
                                    </td>
                                    <td>{{ vm.getTotalScore(item.total_sale, item.retention, item.order_frequency, item.payment) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 text-left">
                            <p class="form-control-static">{{vm.m.data.data.from}} - {{vm.m.data.data.to}} / {{vm.m.data.data.total}}</p>                            
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
