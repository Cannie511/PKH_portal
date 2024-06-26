<section class="content-header">
    <h1>Thêm tin tức<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.cms0200"><span>Tin tức</span></a></li>
        <li class="active">Thêm tin tức</li>
    </ol>
</section>
<section class="content cms0210">
    <div class="row">
        <div class="col-sm-12 col-md-7">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin tin tức</h3>
                    <div class="box-tools pull-right">
                        <a class="btn btn-info btn-xs" ng-if="vm.m.form.id > 0" target="__blank" ng-href="http://<?php echo env('DOMAIN_MAIN','www.phankhangco.com');?>/tin-tuc/preview-id/{{vm.m.form.id}}">Xem trước</a>
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <form class="form-horizontal" name="form" ng-submit="vm.save(form.$valid, form)" novalidate>
                    <!-- <input id="fileUpload" type="file" enctype="mutipart/form-data"/>  -->
                    <div class="box-body">
                        <div ng-if="vm.alerts" class="alert alert-{{alert.type}}" ng-repeat="alert in vm.alerts">
                            <h4>{{alert.title}}</h4>
                            <p>{{alert.msg}}</p>
                        </div>
                        <div class="form-group" ng-class="{'has-error': vm.errors['publishDate'].length > 0}">
                            <label class="col-sm-2 control-label required">Ngày đăng</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input id="publishDate" class="form-control" datetimepicker ng-model="vm.m.form.publishDate" placeholder="YYYY-MM-DD" options="vm.m.datetimepicker_options"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <span class="help-block" ng-repeat="(i, err) in vm.errors['dayOffDate']">{{err}}</span>
                            </div>
                        </div>
                        
                        <div class="form-group" ng-class="{ 'has-error': form.title.$invalid && ( vm.formSubmitted || form.title.$touched) }">
                            <label class="col-sm-2 control-label required">Tiêu đề</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="vm.m.form.title" name="title" placeholder="" required>
                                <p ng-show="form.title.$error.required && ( vm.formSubmitted || form.title.$touched)" class="help-block">Vui lòng nhập tiêu đề</p>
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': form.short_content.$invalid && ( vm.formSubmitted || form.short_content.$touched) }">
                            <label class="col-sm-2 control-label required">Nội dung vắn tắt</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="6" ng-model="vm.m.form.short_content"></textarea>
                                <p ng-show="form.short_content.$error.required && ( vm.formSubmitted || form.short_content.$touched)" class="help-block">Vui lòng nhập nội dung vắn tắt (hiển thị trong danh sách tin tức)</p>
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': form.content.$invalid && ( vm.formSubmitted || form.content.$touched) }">
                            <label class="col-sm-2 control-label required">Nội dung chính</label>
                            <div class="col-sm-10">
                                <text-angular ng-model="vm.m.form.content"></text-angular>
                                <p ng-show="form.content.$error.required && ( vm.formSubmitted || form.content.$touched)" class="help-block">Vui lòng nhập nội dung</p>
                            </div>
                        </div>

                        <div class="form-group"> 
                            <label class="col-sm-2 control-label">Thêm ảnh</label> 
                            <div class="col-sm-10"> 
                                <input id="file" type="file" enctype="mutipart/form-data"/> 
                                <div id="imgPreview" class="text-center"> 
                                    <img ng-if="vm.m.form.file" ng-attr-src="{{vm.m.form.file}}" style="max-width: 240px" class="img-preview" />
                                    <img ng-if="(vm.m.form.pathFile) && !(vm.m.form.file)" ng-src="{{vm.m.form.pathFile}}" style="max-width: 240px" class="img-preview"/> 
                                </div> 
                            </div> 
                        </div> 

                        <hr/>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <h4 class="form-control-static">Thông tin SEO</h4>
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': form.slug.$invalid && ( vm.formSubmitted || form.slug.$touched) }">
                            <label class="col-sm-2 control-label">Slug</label>
                            <div class="col-sm-10">
                                <input name="slug" id="slug" cols="30" rows="2" class="form-control" ng-model="vm.m.form.slug"></input>
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': form.description.$invalid && ( vm.formSubmitted || form.description.$touched) }">
                            <label class="col-sm-2 control-label">Mô tả</label>
                            <div class="col-sm-10">
                                <textarea name="description" id="description" cols="30" rows="2" class="form-control" ng-model="vm.m.form.description" maxlength="1024"></textarea>
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': form.keywords.$invalid && ( vm.formSubmitted || form.keywords.$touched) }">
                            <label class="col-sm-2 control-label">Từ khóa</label>
                            <div class="col-sm-10">
                                <input name="keywords" id="keywords" cols="30" rows="2" class="form-control" ng-model="vm.m.form.keywords"></input>
                            </div>
                        </div>

                        <input id="urlImageFrontend" type="hidden" name="urlImageFrontend" value="<% env('URL_IMAGE_FRONTEND')%>"/>
                    </div>

                    <div class="box-footer">
                        <a ui-sref="app.crm0300" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>

                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_NEW" ng-if="!(vm.m.form.id > 0)">Add New</button>
                        <button type="submit" class="btn btn-warning pull-right" translate="COM_BTN_UPDATE" ng-if="vm.m.form.id > 0" >Update</button> 
                    </div> 
                </form>
            </div>
        </div>

        <div class="col-sm-12 col-md-5" ng-show="vm.m.form.id > 0">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Hình ảnh tin tức</h3>
                    <div class="box-tools pull-right">
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <div class="box-body">
                    <form class="form form-horizontal" name="form" ng-submit="vm.upload()" novalidate>
                        <div class="box-body">         
                            <div class="form-group"> 
                                <div class="col-sm-12"> 
                                    <input id="fileUpload" type="file" enctype="mutipart/form-data"/> 
                                    <div id="imgPreviewUpload" class="text-center"> 
                                        <img ng-if="vm.m.formUpload.file" ng-attr-src="{{vm.m.formUpload.file}}" class="img-preview"/>
                                    </div> 
                                </div>
                            </div>        
                            <div class="form-group"> 
                                <div class="col-sm-12"> 
                                    <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                                        <i class="fa fa-upload fa-fw"></i>
                                        <span>Upload</span>
                                    </button>
                                </div> 
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="box-body">
                    <div class="table-responsive" ng-if="vm.m.formUpload.images.length > 0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Hình ảnh</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.formUpload.images'>
                                    <td class="text-center">{{$index + 1}}</td>
                                    <td>
                                        <a target="__blank" ng-href="<?php echo env('URL_IMAGE_FRONTEND','//www.phankhangco.com/images'); ?>{{item}}">
                                            <img class="image-preview-list-small" src="<?php echo env('URL_IMAGE_FRONTEND','//www.phankhangco.com/images'); ?>{{item}}"/>
                                        </a>
                                        <br>
                                        <?php echo env('URL_IMAGE_FRONTEND','//www.phankhangco.com/images'); ?>{{item}}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-xs" ng-click="vm.insertImage(item)">
                                            <i class="fa fa-plus fa-fw"></i>
                                        </button> 
                                        <button class="btn btn-xs btn-danger" ng-click="vm.removeImage(item)">
                                            <i class="fa fa-trash-o"></i>
                                        </button>&nbsp;
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
