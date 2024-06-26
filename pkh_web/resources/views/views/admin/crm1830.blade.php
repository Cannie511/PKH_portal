<section class="content-header">
    <h1>Chi phí công ty<small></small></h1>
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
                    <h3 class="box-title">Danh sách chi phí</h3>
                    <div class="box-tools pull-right">
                        <div uib-dropdown class="btn-group">
                            <a ui-sref="app.crm1831" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a>
                        </div>
                    </div>
                </div>
                <div class="box-body form">
                    <form class="form" ng-submit="vm.search()">                   
                        <div class="row">
                             <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="day">Từ ngày</label>
                                    <div class="input-group">
                                        <input class="form-control" datetimepicker ng-model="vm.m.filter.from_date" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div> 
                             <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="day">Đến ngày</label>
                                    <div class="input-group">
                                        <input class="form-control" datetimepicker ng-model="vm.m.filter.to_date" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>  
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Phòng ban</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn phòng ban'"
                                        ng-model="vm.m.filter.department_id"
                                        ng-options="item.department_id as item.name for item in vm.m.init.departments "
                                        >
                                        <option value="">Không có</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Loại chi phí</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn loại chi phí'"
                                        ng-model="vm.m.filter.cost_cat_id"
                                        ng-options="item.cost_cat_id as item.name for item in vm.m.init.costcats "
                                        >
                                        <option value="">Không có</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Trạng thái chi phí</label>
                                    <select class="form-control"
                                                    placeholder-text-single="'Chọn cấp'"
                                                    ng-model="vm.m.filter.cost_sts"
                                                    >
                                        <option value="">Tất cả</option>
                                        <option value='0'>Mới</option>
                                        <option value='1'>Chờ xác nhận</option>
                                        <option value='2'>Xác nhận</option>
                                        <option value='3'>Không Xác nhận</option>
                                        <option value='4'>Huỷ</option>
                                        <option value='5'>Kế toán chi trả</option>
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
                                <button type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.download()">
                                    <i class="fa fa-download fa-fw"></i>
                                    Tải về
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
                                    <th>
                                        <span>Số chứng từ</span>
                                    </th>
                                    <th>
                                        <span>Ngày nhập</span>
                                    </th>
                                    <th>
                                        <span>Người đề xuất</span>
                                    </th>
                                    <th>
                                        <span>Diễn giải</span>
                                    </th>
                                     <th>
                                        <span>TK đối ứng</span>
                                    </th>
                                     <th>
                                        <span>Loại chi phí</span>
                                    </th>
                                    <th>
                                        <span>Phòng/ban</span>
                                    </th>
                                     <th  class="text-right">
                                        <span>Phát sinh nợ</span>
                                    </th>
                                    <th>
                                        <span>Trạng thái</span>
                                    </th>
                                      <th>
                                        <span>Cập nhật cuối</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data'>
                                    <td class="col-action">
                                        <div class="btn-group" uib-dropdown dropdown-append-to-body>
                                          <button type="button" class="btn btn-default btn-sm" uib-dropdown-toggle>
                                            <i class="fa fa-ellipsis-v"></i>
                                          </button>
                                          <ul class="dropdown-menu" uib-dropdown-menu role="menu" aria-labelledby="btn-append-to-body">
                                            <li  role="menuitem"><a ui-sref='app.crm1832({cost_id: item.cost_id})'>Chỉnh sửa</a></li>
                                          </ul>
                                        </div>
                                    </td>
                                    <td>{{$index + vm.m.data.from}}</td>
                                    <td>{{item.voucher}}</td>
                                    <td>{{item.cost_date}}</td>
                                    <td>{{item.created_by}}</td>
                                    <td>{{item.description}}</td>
                                    <td>{{item.contra_account}}</td>
                                    <td>{{item.cate_name}}</td>
                                    <td>{{item.department_name}}</td>
                                    <td  class="text-right">{{item.amount | currency :'': 0}}</td>
                                    <td> 
                                    <span ng-if="item.cost_sts == 0" class="label bg-purple btn-flat margin">Mới</span> 
                                    <span ng-if="item.cost_sts == 1" class="label label-warning">Chờ xác nhận</span> 
                                    <span ng-if="item.cost_sts == 2" class="label label-info">Xác nhận</span> 
                                    <span ng-if="item.cost_sts == 3" class="label label-primary">không xác nhận</span>
                                    <span ng-if="item.cost_sts == 4" class="label label-primary">Huỷ</span>
                                    <span ng-if="item.cost_sts == 5" class="label label-primary">Kế toán chi trả</span>
                                    </td>
                                    <td>
                                        {{item.updated_at}}<br/>
                                        <small><i>{{item.updated_by}}</i></small>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row" ng-if="vm.m.data.from > 0">
                        <div class="col-md-6 col-sm-12 text-left">
                            <p class="form-control-static">{{vm.m.data.from}} - {{vm.m.data.to}} / {{vm.m.data.total}}</p>                            
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <uib-pagination ng-show="vm.m.data.from > 0"
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
