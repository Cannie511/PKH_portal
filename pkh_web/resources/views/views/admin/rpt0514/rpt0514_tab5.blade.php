<div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Lịch sử</h3>
                    <div class="box-tools pull-right">
                        <a ng-click="vm.toogleList()" class="btn btn-info btn-xs"><i class="fa fa-list"></i></a>
                        <!-- <a ui-sref="app.crm0310" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <div class="box-body form">
                    <form role="form" ng-submit="vm.doSearch(vm.m.activeFlag,1)">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="month">Từ ngày</label>
                                    <div class="input-group">
                                        <input id="monthPicker" class="form-control" 
                                            datetimepicker ng-model="vm.m[index].filter.from_date" placeholder="YYYY-MM-DD HH:mm" options="vm.m.optionsFrom"
                                            on-change="vm.update(vm.m[index].filter.from_date, vm.m[index].filter.to_date)"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="month">Đến ngày</label>
                                    <div class="input-group">
                                        <input id="monthPicker" class="form-control" datetimepicker ng-model="vm.m[index].filter.to_date" placeholder="YYYY-MM-DD HH:mm" 
                                            options="vm.m.optionsTo"
                                            on-change="vm.update(vm.m[index].filter.from_date, vm.m[index].filter.to_date)"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                    
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                                    <i class="fa fa-search fa-fw"></i>
                                    <span translate="COM_BTN_SEARCH"></span>
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
                                    <th>Tên</th>
                                    <th>Thời gian</th>
                                    <th>Cửa hàng</th>
                                    <th>Độ lệch</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data.data'>
                                    <td ng-click="vm.focusItem(item, $index)">{{$index + vm.m[vm.m.activeFlag].data.data.from}}</td>
                                    <td ng-click="vm.focusItem(item, $index)"><a href="javascript:void(0);">{{item.working_time}}</a></td>
                                    <td ng-click="vm.focusItem(item, $index)">{{item.salesman_name}}</td>
                                    <td>
                                        {{item.store_name}}
                                        <br/>
                                        <small>{{item.store_address}} {{item.store_area2_name}} {{item.store_area1_name}}</small>
                                        <br/>
                                        {{item.gps_lat}},{{item.gps_long}}
                                        <br/>
                                        {{item.notes}}
                                        <br/>
                                        <ul ng-if="item.images" class="list-inline">
                                            <li ng-repeat="img in item.images">
                                                <a target="__blank" ng-href="/images{{img.img_path}}">
                                                    <img ng-src="/images{{img.img_path | imgThumb}}" class="img-rounded img-thumb-product-2x"/>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        {{item.dist | currency: '' : 0}} Km
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row" ng-if=" vm.m[vm.m.activeFlag].data.data.from > 0">
                        <div class="col-md-12 col-sm-12 text-left">
                            <p class="form-control-static">{{ vm.m[vm.m.activeFlag].data.data.from}} - {{ vm.m[vm.m.activeFlag].data.data.to}} / {{ vm.m[vm.m.activeFlag].data.data.total}}</p>                            
                        </div>
                        <div class="col-md-12 col-sm-12 text-right">
                            <uib-pagination ng-show=" vm.m[vm.m.activeFlag].data.data.from > 0"
                                total-items=" vm.m[vm.m.activeFlag].data.data.total"
                                ng-model=" vm.m[vm.m.activeFlag].data.data.current_page"
                                items-per-page=" vm.m[vm.m.activeFlag].data.data.per_page"
                                ng-change="vm.doSearch(vm.m.activeFlag,vm.m[vm.m.activeFlag].data.data.current_page)"
                                class="pagination pagination-sm m-t-none m-b-none">
                            </uib-pagination>    
                        </div>
                    </div>
                </div>
</div>