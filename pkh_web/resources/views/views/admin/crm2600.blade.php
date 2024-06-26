<section class="content-header">
    <h1>Chi tiết cửa hàng<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm0300"><span>Cửa hàng</span></a></li>
        <li class="active">#{{vm.m.store_id}}</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12 col-md-3 col-lg-2">
            <crm2601/>
            <crm2602/>
        </div>
        <div class="col-xs-12 col-md-9 col-lg-10">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin cửa hàng</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <label>Vùng</label>
                            <p class="form-control-static">{{vm.m.store.area_group_name}}</p>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <label>Tỉnh/TP</label>
                            <p class="form-control-static">{{vm.m.store.area1_name}}</p>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <label>Quận/Huyện</label>
                            <p class="form-control-static">{{vm.m.store.area2_name}}</p>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-4 col-xs-12">
                            <label>ID</label>
                            <p class="form-control-static">{{vm.m.store.store_id}}</p>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <label>Tên CH</label>
                            <p class="form-control-static">{{vm.m.store.name}}</p>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <label>Tax code</label>
                            <p class="form-control-static">{{vm.m.store.tax_code}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <label>Liên hệ</label>
                            <p class="form-control-static">{{vm.m.store.contact_name}}</p>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <label>Email</label>
                            <p class="form-control-static">{{vm.m.store.contact_email}}</p>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <label>Fax</label>
                            <p class="form-control-static">{{vm.m.store.contact_fax}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <label>Điện thoại</label>
                            <p class="form-control-static">{{vm.m.store.contact_tel}}</p>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <label>Mobile 1</label>
                            <p class="form-control-static">{{vm.m.store.contact_mobile1}}</p>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <label>Mobile 2</label>
                            <p class="form-control-static">{{vm.m.store.contact_mobile2}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-xs-12">
                            <label>Địa chỉ</label>
                            <p class="form-control-static">{{vm.m.store.address}}</p>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <label>Phụ trách</label>
                            <p class="form-control-static">{{vm.m.store.salesman_name}}</p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Chành</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body" ng-if="vm.m.store.chanh_id">
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <label>Tỉnh/TP</label>
                            <p class="form-control-static">{{vm.m.store.chanh_area1_name}}</p>
                        </div>
                        <div class="col-md-8 col-xs-12">
                            <label>Quận/Huyện</label>
                            <p class="form-control-static">{{vm.m.store.chanh_area2_name}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <label>Tên</label>
                            <p class="form-control-static">{{vm.m.store.chanh_name}}</p>
                        </div>
                        <div class="col-md-8 col-xs-12">
                            <label>Địa chỉ</label>
                            <p class="form-control-static">{{vm.m.store.chanh_address}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <label>Liên hệ</label>
                            <p class="form-control-static">{{vm.m.store.chanh_contact_name}}</p>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <label>Email</label>
                            <p class="form-control-static">{{vm.m.store.chanh_contact_email}}</p>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <label>Fax</label>
                            <p class="form-control-static">{{vm.m.store.chanh_contact_fax}}</p>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-4 col-xs-12">
                            <label>Điện thoại</label>
                            <p class="form-control-static">{{vm.m.store.chanh_contact_tel}}</p>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <label>Mobile 1</label>
                            <p class="form-control-static">{{vm.m.store.chanh_contact_mobile1}}</p>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <label>Mobile 2</label>
                            <p class="form-control-static">{{vm.m.store.chanh_contact_mobile2}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Chữ ký</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body" ng-if="vm.m.signatures.length > 0">
                   <div class="col-md-12">
                        <label>Chữ ký phiếu giao hàng</label>
                        <p class="form-control-static">
                        <ul class="list-inline">
                            <li ng-repeat="img in vm.m.signatures">
                                <a target="__blank" ng-href="/images/{{img.img_path}}">
                                    <img ng-src="/images{{img.img_path | imgThumb}}" class="img-rounded img-thumb-product-2x"/>
                                    <small class="img-thumb-description-2x">{{img.description}}</small>
                                </a>
                            </li>
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Duyệt cửa hàng</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body" ng-if="vm.can('screen.crm2600.review')">
                    <form class="form">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Ngày hết hạn</label>
                                    <div class="input-group">
                                        <input class="form-control" datetimepicker ng-model="vm.m.review.review_expired_date" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Ghi chú</label>
                                    <textarea class="form-control" ng-model="vm.m.review.comment" rows=5></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-success btn-sm btn-width-default" ng-click="vm.commitReview(1)">
                                    <i class="fa fa-check fa-fw"></i>
                                    <span>Duyệt</span>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm btn-width-default" ng-click="vm.commitReview(2)">
                                    <i class="fa fa-ban fa-fw"></i>
                                    <span>Từ chối</span>
                                </button>
                                <button type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.commitReview(0)">
                                    <i class="fa fa-edit fa-fw"></i>
                                    <span>Ghi chú</span>
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
                                    <th>Time</th>
                                    <th>Name</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.reviewComments.data'>
                                    <td>{{$index + vm.m.reviewComments.from}}</td>
                                    <td>{{item.updated_at| date:'yyyy-MM-dd HH:mm:ss'}}</td>
                                    <td>{{item.name}}</td>
                                    <td>{{item.content}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row" ng-if="vm.m.reviewComments.from > 0">
                        <div class="col-md-6 col-sm-12 text-left">
                            <p class="form-control-static">{{vm.m.reviewComments.from}} - {{vm.m.reviewComments.to}} / {{vm.m.reviewComments.total}}</p>                            
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <uib-pagination ng-show="vm.m.reviewComments.from > 0"
                                total-items="vm.m.reviewComments.total"
                                ng-model="vm.m.reviewComments.current_page"
                                items-per-page="vm.m.reviewComments.per_page"
                                ng-change="vm.doSearchComment(vm.m.reviewComments.current_page)"
                                class="pagination pagination-sm m-t-none m-b-none">
                            </uib-pagination>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>