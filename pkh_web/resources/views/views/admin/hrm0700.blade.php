<section class="content-header">
    <h1>Danh sách nhân viên</h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Danh sách nhân viên</li>
    </ol>
</section>
<section class="content crm0130">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách nhân viên</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.hrm0710({})" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <div class="box-body">
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" ng-model="vm.m.filter.email" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="name">Tên</label>
                                    <input type="text" class="form-control" id="name" ng-model="vm.m.filter.name" />
                                </div>
                            </div>
                            <div  class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Tình trạng làm việc</label>
                                    <select class="form-control" ng-model="vm.m.filter.is_work"  >
                                        <!-- <option value="">Null</option> -->
                                        <option value="">Tất cả</option>
                                        <option value="1">Đang làm việc</option>
                                        <option value="2">Nghỉ việc</option>    
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-sm btn-width-default" ng-click="vm.search()">
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
                    <div class="table-responsive">
                        <table class="table table-striped product-list">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <!-- <th ng-click="vm.sort('supplier_name');" class="sortable">
                                        <span translate="CRM0130_LABEL_SUPPLIER_NAME"></span>
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="supplier_name"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th> -->
                                    <th>Mã</th>
                                    <th>Tên</th>
                                    <th ng-click="vm.sort('email');" class="sortable">
                                        Email
                                        <fk-col-sortable order-by="vm.m.filter.orderBy" column-name="email"
                                            order-direction="vm.m.filter.orderDirection"></fk-col-sortable>
                                    </th>
                                    <th>Ngày sinh</th>
                                    <th>Giới tính</th>
                                    <th>Phòng ban</th>
                                    <th>Chức danh</th>
                                    <th>Ngày kết thúc HĐ</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list.data'>
                                    <td>{{$index + 1}}</td>
                                    <td><a ui-sref="app.hrm0710({id: item.employee_id})">{{item.employee_code}}</a></td>
                                    <td>{{item.fullname}}</td>
                                    <td><a ui-sref="app.hrm0710({id: item.employee_id})">{{item.email}}</a></td>
                                    <td>{{item.dob | date: 'yyyy-MM-dd'}}</td>
                                    <td>
                                        <span ng-if="item.gender == 'MALE'">Nam</span>
                                        <span ng-if="item.gender == 'FEMALE'">Nữ</span>
                                    </td>
                                    <td>{{item.devision}}</td>
                                    <td>{{item.title}}</td>
                                    <td>{{item.max_end_date | date: 'yyyy-MM-dd'}}</td>
                                    <td>{{item.start_date | date: 'yyyy-MM-dd'}}</td>
                                    <td>{{item.end_date | date: 'yyyy-MM-dd'}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row text-right">
                        <div class="col-md-12">
                            <uib-pagination ng-show="vm.m.list.from > 0"
                                total-items="vm.m.list.total"
                                ng-model="vm.m.list.current_page"
                                items-per-page="vm.m.list.per_page"
                                ng-change="vm.doSearch(vm.m.list.current_page)"
                                class="pagination pagination-sm m-t-none m-b-none">
                            </uib-pagination>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
