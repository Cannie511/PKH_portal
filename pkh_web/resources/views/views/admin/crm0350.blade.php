<section class="content-header">
    <h1>Danh sách chành <small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Danh sách chành</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách cửa hàng</h3>
                    <div class="box-tools pull-right">
                        <a ui-sref="app.crm0351" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a>
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <div class="box-body form">
                    <form role="form" ng-submit="vm.search()">
                        <div class="row">
                        
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Tỉnh/Thành</label>
                                    {{vm.m.filter.area1}}
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn tỉnh'"
                                        ng-model="vm.m.filter.area1"
                                        ng-options="item.area_id as item.name for item in vm.m.init.listArea1  | filter : {'area_group_id': vm.m.filter.areaGroup}"
                                        >
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group" ng-if="vm.m.filter.area1">
                                    <label>Quận/Huyện</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn tỉnh'"
                                        ng-model="vm.m.filter.area2"
                                        ng-options="item.area_id as item.name for item in vm.m.init.listArea2 | filter : {'parent_area_id': vm.m.filter.area1}"
                                        >
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Tên chành</label>
                                    <input type="text" ng-model="vm.m.filter.name" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Fax/Điện thoại</label>
                                    <input type="text" ng-model="vm.m.filter.contact" class="form-control"/>
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
                                    <th class="col-action"></th>
                                    <th>NO</th>                       
                                    <th>Tên chành</th>
                                   
                                    <th>Khu vực</th>
                                    <th>Liên hệ</th>
                                    <th>Cập nhật</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data'>
                                    <td class="col-action">                       
                                        
                                          <a class="btn btn-xs btn-warning" ui-sref="app.crm0352({chanh_id: item.chanh_id})">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>{{$index + vm.m.data.from}}</td>
                                
                                    <td>
                                        {{item.name}} <br>
                                        <i>{{item.address}}</i>
                                    </td>
                                     <td>
                                        {{item.area1_name}}<br/>
                                        <i>{{item.area2_name}}</i>
                                    </td>
                                    <td>
                                        <span ng-if="item.contact_name">{{item.contact_name}} &nbsp;</span>
                                        <nobr ng-if="item.contact_tel"><i class="fa fa-phone fa-fw"></i>{{item.contact_tel}}</nobr>
                                        <nobr ng-if="item.contact_fax"><i class="fa fa-fax fa-fw"></i>{{item.contact_fax}}</nobr>
                                        <nobr ng-if="item.contact_mobile1"><i class="fa fa-mobile fa-fw"></i>{{item.contact_mobile1}}</nobr>
                                        <nobr ng-if="item.contact_mobile2"><i class="fa fa-mobile fa-fw"></i>{{item.contact_mobile2}}</nobr>
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