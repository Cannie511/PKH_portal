<section class="content-header">
  <h1>Users <small>Module description here</small></h1>
  <ol class="breadcrumb">
    <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a ui-sref="app.userlist">Danh sách người dùng</a></li>
    <li class="active">Thêm mới người dùng</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-sm-12 col-md-7">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Thêm mới người dùng</h3>
        </div>
        <form class="form-horizontal" name="form" ng-submit="vm.save(form.$valid)" novalidate>
          <div class="box-body">
            <div ng-if="vm.alerts" class="alert alert-{{alert.type}}" ng-repeat="alert in vm.alerts">
              <h4>{{alert.title}}</h4>
              <p>{{alert.msg}}</p>
            </div>
            <div class="form-group" ng-class="{ 'has-error': form.name.$invalid && ( vm.formSubmitted || form.name.$touched) }">
              <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" ng-model="vm.m.form.name" name="name" placeholder="Name" required>
                <p ng-show="form.name.$error.required && ( vm.formSubmitted || form.name.$touched)" class="help-block">Name is required.</p>
              </div>
            </div>
            <div class="form-group" ng-class="{ 'has-error': form.email.$invalid && ( vm.formSubmitted || form.email.$touched) }">
              <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" ng-model="vm.m.form.email" name="email" placeholder="Email" required>
                <p ng-show="form.email.$error.required && ( vm.formSubmitted || form.email.$touched)" class="help-block">Email is required.</p>
                <p ng-show="form.email.$error.email  && ( vm.formSubmitted || form.email.$touched)" class="help-block">This is not a valid email.</p>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <a ui-sref="app.userlist" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
            <button type="submit" class="btn btn-primary pull-right">Thêm mới</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
