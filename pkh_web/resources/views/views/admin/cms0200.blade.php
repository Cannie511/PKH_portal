<section class="content-header">
    <h1>Tin tức<small></small></h1>
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
                    <h3 class="box-title">Danh sách Tin tức</h3>
                    <div class="box-tools pull-right">
                        <a ui-sref="app.cms0210" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a>
                    </div>
                </div>
                <div class="box-body form">
                    <form class="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="title">Tiêu đề</label>
                                    <input type="text" class="form-control" id="title" ng-model="vm.m.filter.title" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="keyword">Từ khóa</label>
                                    <input type="text" class="form-control" id="keyword" ng-model="vm.m.filter.keyword" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                             <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="day">Từ ngày</label>
                                    <div class="input-group">
                                        <input class="form-control" datetimepicker ng-model="vm.m.filter.start_date" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
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
                                        <input class="form-control" datetimepicker ng-model="vm.m.filter.end_date" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
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
                                    <th>Hình ảnh</th>
                                    <!--<th ng-click="vm.sort('id');" class="sortable">
                                        <span>ID</span>
                                        <fk-col-sortable 
                                            column-name="product_cat_name"
                                            order-by="vm.m.filter.orderBy"
                                            order-direction="vm.m.filter.orderDirection">
                                        </fk-col-sortable>
                                    </th>-->
                                    <th ng-click="vm.sort('publish_date');" class="sortable">
                                        <span>Ngày đăng</span>
                                        <fk-col-sortable 
                                            column-name="publish_date"
                                            order-by="vm.m.filter.orderBy"
                                            order-direction="vm.m.filter.orderDirection">
                                        </fk-col-sortable>
                                    </th>
                                    <th ng-click="vm.sort('title');" class="sortable">
                                        <span>Tiêu đề</span>
                                        <fk-col-sortable 
                                            column-name="title"
                                            order-by="vm.m.filter.orderBy"
                                            order-direction="vm.m.filter.orderDirection">
                                        </fk-col-sortable>
                                    </th>
                                    <th ng-click="vm.sort('updated_at');" class="sortable">
                                        <span>Ngày cập nhật</span>
                                        <fk-col-sortable 
                                            column-name="updated_at"
                                            order-by="vm.m.filter.orderBy"
                                            order-direction="vm.m.filter.orderDirection">
                                        </fk-col-sortable>
                                    </th>
                                    <th ng-click="vm.sort('updated_by_name');" class="sortable">
                                        <span>Người cập nhật</span>
                                        <fk-col-sortable 
                                            column-name="updated_by_name"
                                            order-by="vm.m.filter.orderBy"
                                            order-direction="vm.m.filter.orderDirection">
                                        </fk-col-sortable>
                                    </th>
                                    <th ng-click="vm.sort('show_flg');" class="sortable">
                                        <span>Hiển thị</span>
                                        <fk-col-sortable 
                                            column-name="show_flg"
                                            order-by="vm.m.filter.orderBy"
                                            order-direction="vm.m.filter.orderDirection">
                                        </fk-col-sortable>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data'>
                                    <td>{{$index + vm.m.data.from}}</td>
                                    <!--<td>{{item.id}}</td>-->
                                    <td>                                
                                        <div id="imgPreview" class="text-center"> 
                                            <img class="img-preview" ng-if="item.feature_image_path" ng-attr-src='<?php echo env('URL_IMAGE_FRONTEND') ?>{{item.feature_image_path}}' />
                                        </div> 
                                    </td>
                                    <td>{{item.publish_date}}</td>
                                    <td>
                                        <a ui-sref="app.cms0211({ id : item.id})">{{item.title}}</a>                                        
                                        <br/>
                                        <i class="help-block">{{item.slug}}</i>
                                    </td>
                                    <td>{{item.updated_at | date : 'yyyy-MM-dd HH:mm'}}</td>
                                    <td>{{item.updated_by_name}}</td>
                                    <td>
                                        <!--{{item.show_flg}}-->
                                        <button type="button" class="btn btn-info btn-sm btn-width-default" ng-if="item.show_flg == 1" ng-click="vm.updateShow(item.id, 0)">
                                            <i class="fa fa-check fa-fw"></i>
                                            <span></span>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm btn-width-default" ng-if="item.show_flg == 0" ng-click="vm.updateShow(item.id, 1)">
                                            <i class="fa fa-times fa-fw"></i>
                                            <span></span>
                                        </button>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm btn-width-default" target="__blank" ng-href="http://<?php echo env('DOMAIN_MAIN','www.phankhangco.com');?>/tin-tuc/preview/{{item.slug}}">Xem trước</a>
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
