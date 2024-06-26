<section class="content-header">
    <h1>Cập nhật KPI cửa hàng<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm2600({store_id: vm.m.form.kpi.store_id})">{{vm.m.form.kpi.store_name}}</a></li>
        <li><a ui-sref="app.crm2810({store_id: vm.m.form.kpi.store_id})">KPI</a></li>
        <li class="active">Cập nhật KPI cửa hàng</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin KPI</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.crm2820({ employee_id: vm.m.employee_id,contract_id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <form class="form" name="form" ng-submit="vm.save(form.$valid, form)" novalidate>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th></th>
                                        <th>Mã SP</th>
                                        <th>Tên SP</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat='item in vm.m.form.listProduct'>
                                        <td>{{$index + 1}}</td>
                                        <td>
                                            <img class="img-thumb-product" class="img-responsive" ng-src="{{item.imgUrl}}" />
                                        </td>
                                        <td>{{item.product_code}}</td>
                                        <td>{{item.name}}</td>
                                        <td>
                                            <input type="number" ng-init="0" ng-model="item.amount" class="form-control"/>
                                        </td>
                                        <td class="text-right">{{item.selling_price | currency : '': 0}}</td>
                                        <td class="text-right">{{item.selling_price * item.amount | currency : '': 0}}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>Tổng Cộng</b></td>
                                        <td class="text-right"><b>{{vm.m.form.listProduct | crm2820Total | currency : '': 0}}</b></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>Chiết khấu</b></td>
                                        <td class="text-right"><b>{{vm.m.form.kpi.discount}}%</b></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>Sau chiết khấu</b></td>
                                        <td class="text-right"><b>{{(vm.m.form.listProduct | crm2820Total) * (100 - vm.m.form.kpi.discount) / 100  | currency : '': 0}}</b></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="pull-right">
                            <button ng-if="vm.m.form.id > 0 && vm.can('screen.hrm1010.delete')" type="button" class="btn btn-danger btn-min-width" ng-click="vm.delete()"><i class="fa fa-trash-o fa-fw"></i>{{'COM_BTN_DELETE' | translate}}</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save fa-fw"></i>{{'COM_BTN_UPDATE' | translate}}</button>
                        </div>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>