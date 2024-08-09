<section class="content-header">
    <h1>CRM4000<small></small></h1>
</section>
<section class="content">
<div class="row">

        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Test thanh toán</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.crm2910" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <div class="box-body form">
                    <form role="form" >
                        <div class="row">
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Năm</label>
                                    <select ng-model="vm.m.filter.year" ng-options="year for year in vm.years" ng-change="vm.search()">
                                        <option value="">Chọn năm</option>
                                    </select>
                                </div>
                            </div>     
                        </div>
                    </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead style="background-color: #46b6f7;">
                                <tr>
                                    <th>STT.</th>
                                    <th>Tên đại lý</th>
                                    <th>Thanh toán(đặt payment_id là 1)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data.data'
                                >
                                    <td>{{$index+ vm.m.data.data.from}}</td>
                                    <td>
                                        {{item.name}}<br>
                                        <small><i>{{item.address}}</i></small>
                                    </td>
                                    <td>
                                        <!-- Nút thanh toán -->
                                        <button class="btn btn-primary btn-sm" ng-click="vm.pay(3)">
                                            Thanh toán
                                        </button>
                                    </td>
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
