<section class="content-header">
    <h1>Danh sách mã hàng chưa mua<small></small></h1>
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
                                    <label for="title">Tên đại lý:</label>
                                    <input type="text" class="form-control" id="title" ng-model="vm.m.filter.name" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="title">Mã hàng:</label>
                                    <input type="text" class="form-control" id="title" ng-model="vm.m.filter.product_code" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- <div class="col-md-2 col-sm-6 col-xs-12">
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
                            </div> -->
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
                                    <th>Đại lý</th>
                                    <th>Mã hàng</th>
                                    <th>Tên hàng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data'>
                                    <td>{{$index + vm . m . data . from }}</td>
                                    <th class="sticky-top">
                                        {{item . store_name}}
                                        <br><small><i>{{item . address}}</i></small>
                                    </th>
                                    <td>
                                        {{item . product_code}}
                                    </td>
                                    <td>{{item . product_name}}</td>
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
