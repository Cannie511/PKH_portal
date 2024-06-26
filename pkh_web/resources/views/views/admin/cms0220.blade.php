<section class="content-header">
    <h1>Hình ảnh tin tức<small></small></h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách hình ảnh tin tức</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body form">
                <form class="form-horizontal" name="form" ng-submit="vm.upload(form.$valid, form)" novalidate>
                    <div class="box-body">        
                        <div class="form-group"> 
                            <div class="col-md-4"> 
                                <input id="file" type="file" enctype="mutipart/form-data"> 
                                <div id="imgPreview" class="text-center"> 
                                    <img ng-if="vm.m.form.file" ng-attr-src="{{vm.m.form.file}}" heigh="200px" weight="200px"/>
                                </div> 
                            </div>
                        </div>        
                        <div class="form-group" ng-class="{ 'has-error': form.title.$invalid && ( vm.formSubmitted || form.title.$touched) }">
                            <label class="col-md-1 control-label required">Tên file</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" ng-model="vm.m.form.title" name="title" required>
                                <p ng-show="form.title.$error.required && ( vm.formSubmitted || form.title.$touched)" class="help-block">Vui lòng nhập tiêu đề</p>
                            </div>
                        </div>
                        <div class="form-group"> 
                            <div class="col-md-4"> 
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
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.data.data'>
                                    <td>{{$index + vm.m.data.from}}</td>
                                    <td>
                                        <img src="<?php echo env('NEW_IMAGE_WEB_PATH','http://www.phankhangco.com'); ?>/frontend/img/news/thumb/{{item}}" height="100px" weight="100px"/>
                                    </td>
                                    <td>{{item}}</td>
                                    <td>
                                        <!-- <button type="button" class="btn btn-danger btn-sm btn-width-default" ng-click="vm.remove(item)">
                                            <i class="fa fa-remove fa-fw"></i>
                                            <span> Xóa </span>
                                        </button>  -->
                                        <button class="btn btn-xs btn-danger" ng-click="vm.remove(item)">
                                            <i class="fa fa-trash-o"></i>
                                        </button>&nbsp;
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
                                ng-change="vm.loadData(vm.m.data.current_page)"
                                class="pagination pagination-sm m-t-none m-b-none">
                            </uib-pagination>    
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>
