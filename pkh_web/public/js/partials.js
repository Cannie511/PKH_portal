(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/directives/fk-col-sortable/fk-col-sortable.component.html',
    '<i ng-if="orderBy == null || (orderBy != null && orderBy != columnName)" class="fa fa-sort"></i>\n' +
    '<i ng-if="orderBy == columnName && orderDirection == \'asc\' " class="fa fa-sort-asc"></i>\n' +
    '<i ng-if="orderBy == columnName && orderDirection == \'desc\' " class="fa fa-sort-desc"></i> ');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/dialogs/store_dialog/store_dialog.dialog.html',
    '<md-dialog>\n' +
    '    <form ng-submit="vm.save()">\n' +
    '\n' +
    '        <md-toolbar>\n' +
    '          <div class="md-toolbar-tools">\n' +
    '            <h2>Store dialog</h2>\n' +
    '          </div>\n' +
    '        </md-toolbar>\n' +
    '\n' +
    '        <md-dialog-content>\n' +
    '            <div class="md-dialog-content">\n' +
    '                <md-input-container flex>\n' +
    '                    <label>Data</label>\n' +
    '                    <input type="text">\n' +
    '                </md-input-container>\n' +
    '             </div>\n' +
    '        </md-dialog-content>\n' +
    '\n' +
    '        <md-dialog-actions>\n' +
    '            <md-button type="button" ng-click="vm.cancel()">Cancel</md-button>\n' +
    '            <md-button class="md-primary md-raised" type="submit">Save</md-button>\n' +
    '        </md-dialog-actions>\n' +
    '    </form>\n' +
    '</md-dialog>\n' +
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/components/crm0751/crm0751.component.html',
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/components/forgot-password/forgot-password.component.html',
    '<form ng-submit="vm.submit()" class="ForgotPassword-form" name="vm.forgotPasswordForm" novalidate>\n' +
    '  <div class="callout callout-danger" ng-if="vm.errorTrigger">\n' +
    '    <h4>Error:</h4>\n' +
    '    <p>Please check your email and try again.</p>\n' +
    '  </div>\n' +
    '  <div class="form-group has-feedback" ng-class="{ \'has-error\': (vm.forgotPasswordForm.email.$invalid || vm.serverError) && ( vm.formSubmitted || vm.forgotPasswordForm.email.$touched) }">\n' +
    '    <input type="email" class="form-control" placeholder="Please enter your email address" name="email" ng-model="vm.email" ng-required="true" ng-pattern="/^[^\\s@]+@[^\\s@]+\\.[^\\s@]{2,}$/">\n' +
    '    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>\n' +
    '    <p ng-show="vm.forgotPasswordForm.email.$error.email  && ( vm.formSubmitted || vm.forgotPasswordForm.email.$touched)" class="help-block">This is not a valid email</p>\n' +
    '    <p ng-show="vm.forgotPasswordForm.email.$error.required && ( vm.formSubmitted || vm.forgotPasswordForm.email.$touched)" class="help-block">Email is required.</p>\n' +
    '    <p ng-show=\'vm.serverError\' class="help-block">{{ vm.serverError }}</p>\n' +
    '  </div>\n' +
    '  <div class="row">\n' +
    '    <div class="col-xs-12">\n' +
    '      <button type="submit" class="btn btn-primary btn-block btn-flat">\n' +
    '        Submit\n' +
    '      </button>\n' +
    '    </div>\n' +
    '  </div>\n' +
    '</form>\n' +
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/components/login-form/login-form.component.html',
    '<form ng-submit="vm.login()" method="post" name="vm.loginForm">\n' +
    '  <div class="callout callout-danger" ng-if="vm.loginfailederror">\n' +
    '    <h4>Login Failed</h4>\n' +
    '    <p>{{ vm.loginfailederror }}</p>\n' +
    '  </div>\n' +
    '  <div class="callout callout-danger" ng-if="vm.loginfailed">\n' +
    '    <h4>Login Failed</h4>\n' +
    '    <p>Incorrect Email/Username or Password.</p>\n' +
    '  </div>\n' +
    '  <div class="callout callout-danger" ng-if="vm.unverified">\n' +
    '    <h4>Email Unverified</h4>\n' +
    '    <p>Please check your email and click the verification link.</p>\n' +
    '  </div>\n' +
    '  <div class="callout callout-success" ng-if="vm.registerSuccess">\n' +
    '    <h4>Registration Success!</h4>\n' +
    '    <p>A verification link has been sent to your Email Account. Thank You!</p>\n' +
    '  </div>\n' +
    '  <div class="callout callout-success" ng-if="vm.successMsg">\n' +
    '    <h4>Success!</h4>\n' +
    '    <p>{{ vm.successMsg }}</p>\n' +
    '  </div>\n' +
    '  <div class="form-group has-feedback">\n' +
    '    <input type="email" class="form-control" placeholder="Email" name="email" ng-model="vm.email" ng-required="true" ng-pattern="/^[^\\s@]+@[^\\s@]+\\.[^\\s@]{2,}$/">\n' +
    '    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>\n' +
    '  </div>\n' +
    '  <div class="form-group has-feedback">\n' +
    '    <input type="password" class="form-control" placeholder="Password" name="password" ng-model="vm.password" ng-required="true">\n' +
    '    <span class="glyphicon glyphicon-lock form-control-feedback"></span>\n' +
    '  </div>\n' +
    '  <div class="row">\n' +
    '    <div class="col-xs-12">\n' +
    '      <button type="submit" class="btn btn-primary btn-block btn-flat">\n' +
    '        Sign In\n' +
    '      </button>\n' +
    '    </div>\n' +
    '  </div>\n' +
    '</form>\n' +
    '<!-- <div class="social-auth-links text-center">\n' +
    '  <p>- OR -</p>\n' +
    '  <a href="/auth/github" class="btn btn-block btn-social btn-github btn-flat">\n' +
    '    <i class="fa fa-github"></i> Sign in using Github\n' +
    '  </a>\n' +
    '  <a href="/auth/google" class="btn btn-block btn-social btn-google btn-flat">\n' +
    '    <i class="fa fa-google"></i> Sign in using Google+\n' +
    '  </a>\n' +
    '  <a href="/auth/facebook" class="btn btn-block btn-social btn-facebook btn-flat">\n' +
    '    <i class="fa fa-facebook"></i> Sign in using Facebook\n' +
    '  </a>\n' +
    '</div>\n' +
    '<div class="row">\n' +
    '  <div class="col-xs-6">\n' +
    '    <div class="pull-left">\n' +
    '      <a ui-sref="forgot_password">Forgot your password?</a>\n' +
    '    </div>\n' +
    '  </div>\n' +
    '  <div class="col-xs-6">\n' +
    '    <div class="pull-right">\n' +
    '      <a ui-sref="register" class="text-center">Create an account</a>\n' +
    '    </div>\n' +
    '  </div> -->\n' +
    '</div>\n' +
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/components/login-loader/login-loader.component.html',
    'Logging in...');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/components/nav-header/nav-header.component.html',
    '<header class="main-header">\n' +
    '  <a href="/" class="logo">\n' +
    '    <span class="logo-mini"><b>PK</b>H</span>\n' +
    '    <span class="logo-lg"><b>PKH</b>Portal</span>\n' +
    '  </a>\n' +
    '  <nav class="navbar navbar-static-top">\n' +
    '    <a href="javascript:void(0)" class="sidebar-toggle" data-toggle="offcanvas" role="button">\n' +
    '      <span class="sr-only">Toggle navigation</span>\n' +
    '    </a>\n' +
    '    <div class="navbar-custom-menu">\n' +
    '      <ul class="nav navbar-nav">\n' +
    '          <li class="dropdown" uib-dropdown>\n' +
    '            <a href="#" class="dropdown-toggle" data-toggle="dropdown" uib-dropdown-toggle>\n' +
    '                <i class="fa fa-link"></i>\n' +
    '            </a>\n' +
    '            <ul class="dropdown-menu" uib-dropdown-menu>\n' +
    '              <li><a ui-sref=\'app.crm0210\'><i class="fa fa-cart-plus fa-fw"></i>Tạo đơn hàng</a></li>\n' +
    '              <li><a ui-sref=\'app.hrm0153\'><i class="fa fa-sign-in fa-fw"></i>Attendance</a></li>\n' +
    '            </ul>\n' +
    '          </li>\n' +
    '        <!-- <li class="dropdown messages-menu" uib-dropdown>\n' +
    '          <a href="#" class="dropdown-toggle" data-toggle="dropdown" uib-dropdown-toggle>\n' +
    '            <i class="fa fa-envelope-o"></i>\n' +
    '            <span class="label label-success">4</span>\n' +
    '          </a>\n' +
    '          <ul class="dropdown-menu" uib-dropdown-menu>\n' +
    '            <li class="header">You have 4 messages</li>\n' +
    '            <li>\n' +
    '              <ul class="menu">\n' +
    '                <li>\n' +
    '                  <a href="#">\n' +
    '                    <div class="pull-left">\n' +
    '                      <img src="/img/user2-160x160.jpg" class="img-circle" alt="User Image">\n' +
    '                    </div>\n' +
    '                    <h4>\n' +
    '                      Support Team\n' +
    '                      <small><i class="fa fa-clock-o"></i> 5 mins</small>\n' +
    '                    </h4>\n' +
    '                    <p>Why not buy a new awesome theme?</p>\n' +
    '                  </a>\n' +
    '                </li>\n' +
    '                <li>\n' +
    '                  <a href="#">\n' +
    '                    <div class="pull-left">\n' +
    '                      <img src="/img/user3-128x128.jpg" class="img-circle" alt="User Image">\n' +
    '                    </div>\n' +
    '                    <h4>\n' +
    '                      AdminLTE Design Team\n' +
    '                      <small><i class="fa fa-clock-o"></i> 2 hours</small>\n' +
    '                    </h4>\n' +
    '                    <p>Why not buy a new awesome theme?</p>\n' +
    '                  </a>\n' +
    '                </li>\n' +
    '                <li>\n' +
    '                  <a href="#">\n' +
    '                    <div class="pull-left">\n' +
    '                      <img src="/img/user4-128x128.jpg" class="img-circle" alt="User Image">\n' +
    '                    </div>\n' +
    '                    <h4>\n' +
    '                      Developers\n' +
    '                      <small><i class="fa fa-clock-o"></i> Today</small>\n' +
    '                    </h4>\n' +
    '                    <p>Why not buy a new awesome theme?</p>\n' +
    '                  </a>\n' +
    '                </li>\n' +
    '                <li>\n' +
    '                  <a href="#">\n' +
    '                    <div class="pull-left">\n' +
    '                      <img src="/img/user3-128x128.jpg" class="img-circle" alt="User Image">\n' +
    '                    </div>\n' +
    '                    <h4>\n' +
    '                      Sales Department\n' +
    '                      <small><i class="fa fa-clock-o"></i> Yesterday</small>\n' +
    '                    </h4>\n' +
    '                    <p>Why not buy a new awesome theme?</p>\n' +
    '                  </a>\n' +
    '                </li>\n' +
    '                <li>\n' +
    '                  <a href="#">\n' +
    '                    <div class="pull-left">\n' +
    '                      <img src="/img/user4-128x128.jpg" class="img-circle" alt="User Image">\n' +
    '                    </div>\n' +
    '                    <h4>\n' +
    '                      Reviewers\n' +
    '                      <small><i class="fa fa-clock-o"></i> 2 days</small>\n' +
    '                    </h4>\n' +
    '                    <p>Why not buy a new awesome theme?</p>\n' +
    '                  </a>\n' +
    '                </li>\n' +
    '              </ul>\n' +
    '            </li>\n' +
    '            <li class="footer"><a href="#">See All Messages</a></li>\n' +
    '          </ul>\n' +
    '        </li>\n' +
    '        <li class="dropdown notifications-menu" uib-dropdown>\n' +
    '          <a href="#" class="dropdown-toggle" data-toggle="dropdown" uib-dropdown-toggle>\n' +
    '            <i class="fa fa-bell-o"></i>\n' +
    '            <span class="label label-warning">10</span>\n' +
    '          </a>\n' +
    '          <ul class="dropdown-menu" uib-dropdown-menu>\n' +
    '            <li class="header">You have 10 notifications</li>\n' +
    '            <li>\n' +
    '              <ul class="menu">\n' +
    '                <li>\n' +
    '                  <a href="#">\n' +
    '                    <i class="fa fa-users text-aqua"></i> 5 new members joined today\n' +
    '                  </a>\n' +
    '                </li>\n' +
    '                <li>\n' +
    '                  <a href="#">\n' +
    '                    <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems\n' +
    '                  </a>\n' +
    '                </li>\n' +
    '                <li>\n' +
    '                  <a href="#">\n' +
    '                    <i class="fa fa-users text-red"></i> 5 new members joined\n' +
    '                  </a>\n' +
    '                </li>\n' +
    '                <li>\n' +
    '                  <a href="#">\n' +
    '                    <i class="fa fa-shopping-cart text-green"></i> 25 sales made\n' +
    '                  </a>\n' +
    '                </li>\n' +
    '                <li>\n' +
    '                  <a href="#">\n' +
    '                    <i class="fa fa-user text-red"></i> You changed your username\n' +
    '                  </a>\n' +
    '                </li>\n' +
    '              </ul>\n' +
    '            </li>\n' +
    '            <li class="footer"><a href="#">View all</a></li>\n' +
    '          </ul>\n' +
    '        </li>\n' +
    '        <li class="dropdown tasks-menu" uib-dropdown>\n' +
    '          <a href="#" class="dropdown-toggle" uib-dropdown-toggle>\n' +
    '            <i class="fa fa-flag-o"></i>\n' +
    '            <span class="label label-danger">9</span>\n' +
    '          </a>\n' +
    '          <ul class="dropdown-menu" uib-dropdown-menu>\n' +
    '            <li class="header">You have 9 tasks</li>\n' +
    '            <li>\n' +
    '              <ul class="menu">\n' +
    '                <li>\n' +
    '                  <a href="#">\n' +
    '                    <h3>\n' +
    '                      Design some buttons\n' +
    '                      <small class="pull-right">20%</small>\n' +
    '                    </h3>\n' +
    '                    <div class="progress xs">\n' +
    '                      <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">\n' +
    '                        <span class="sr-only">20% Complete</span>\n' +
    '                      </div>\n' +
    '                    </div>\n' +
    '                  </a>\n' +
    '                </li>\n' +
    '                <li>\n' +
    '                  <a href="#">\n' +
    '                    <h3>\n' +
    '                      Create a nice theme\n' +
    '                      <small class="pull-right">40%</small>\n' +
    '                    </h3>\n' +
    '                    <div class="progress xs">\n' +
    '                      <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">\n' +
    '                        <span class="sr-only">40% Complete</span>\n' +
    '                      </div>\n' +
    '                    </div>\n' +
    '                  </a>\n' +
    '                </li>\n' +
    '                <li>\n' +
    '                  <a href="#">\n' +
    '                    <h3>\n' +
    '                      Some task I need to do\n' +
    '                      <small class="pull-right">60%</small>\n' +
    '                    </h3>\n' +
    '                    <div class="progress xs">\n' +
    '                      <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">\n' +
    '                        <span class="sr-only">60% Complete</span>\n' +
    '                      </div>\n' +
    '                    </div>\n' +
    '                  </a>\n' +
    '                </li>\n' +
    '                <li>\n' +
    '                  <a href="#">\n' +
    '                    <h3>\n' +
    '                      Make beautiful transitions\n' +
    '                      <small class="pull-right">80%</small>\n' +
    '                    </h3>\n' +
    '                    <div class="progress xs">\n' +
    '                      <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">\n' +
    '                        <span class="sr-only">80% Complete</span>\n' +
    '                      </div>\n' +
    '                    </div>\n' +
    '                  </a>\n' +
    '                </li>\n' +
    '              </ul>\n' +
    '            </li>\n' +
    '            <li class="footer">\n' +
    '              <a href="#">View all tasks</a>\n' +
    '            </li>\n' +
    '          </ul>\n' +
    '        </li> -->\n' +
    '        <li class="dropdown user user-menu" uib-dropdown>\n' +
    '          <a href="" class="dropdown-toggle" data-toggle="dropdown" uib-dropdown-toggle>\n' +
    '            <img src="{{vm.userData.avatar}}" class="user-image" alt="User Image" onError="this.src=\'/img/avatar.png\'">\n' +
    '            <span class="hidden-xs">{{vm.userData.name | capitalize}}</span>\n' +
    '          </a>\n' +
    '          <ul class="dropdown-menu" uib-dropdown-menu>\n' +
    '            <li class="user-header">\n' +
    '              <img src="{{vm.userData.avatar}}" class="img-circle" alt="User Image" onError="this.src=\'/img/avatar.png\'">\n' +
    '              <p>\n' +
    '                {{vm.userData.name | capitalize}}\n' +
    '                <small>Member since {{vm.userData.created_at | datemillis |date:\'MMMM yyyy\' }}</small>\n' +
    '              </p>\n' +
    '            </li>\n' +
    '            <li class="user-body">\n' +
    '              <div class="row">\n' +
    '                <div class="col-xs-4 text-center">\n' +
    '                  <a href="#">Followers</a>\n' +
    '                </div>\n' +
    '                <div class="col-xs-4 text-center">\n' +
    '                  <a href="#">Sales</a>\n' +
    '                </div>\n' +
    '                <div class="col-xs-4 text-center">\n' +
    '                  <a href="#">Friends</a>\n' +
    '                </div>\n' +
    '              </div>\n' +
    '            </li>\n' +
    '            <li class="user-footer">\n' +
    '              <div class="pull-left">\n' +
    '                <a ui-sref="app.profile" class="btn btn-default btn-flat">Profile</a>\n' +
    '              </div>\n' +
    '              <div class="pull-right">\n' +
    '                <a ui-sref="app.logout" class="btn btn-default btn-flat">Sign out</a>\n' +
    '              </div>\n' +
    '            </li>\n' +
    '          </ul>\n' +
    '        </li>\n' +
    '      </ul>\n' +
    '    </div>\n' +
    '  </nav>\n' +
    '</header>\n' +
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/components/nav-sidebar/nav-sidebar.component.html',
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/components/reset-password/reset-password.component.html',
    '<form ng-submit="vm.submit(vm.resetPasswordForm.$valid)" name="vm.resetPasswordForm" novalidate>\n' +
    '  <div ng-if="!vm.isValidToken" layout="row" layout-align="center center">\n' +
    '    <md-progress-circular md-mode="indeterminate"></md-progress-circular>\n' +
    '  </div>\n' +
    '  <div ng-if="vm.alerts" class="alert alert-{{alert.type}}" ng-repeat="alert in vm.alerts">\n' +
    '    <h4>{{alert.title}}</h4>\n' +
    '    <p>{{alert.msg}}</p>\n' +
    '  </div>\n' +
    '  <div ng-show="vm.isValidToken">\n' +
    '    <div class="form-group has-feedback" ng-class="{ \'has-error\': vm.resetPasswordForm.password.$invalid && ( vm.formSubmitted || vm.resetPasswordForm.password.$touched) }">\n' +
    '      <input type="password" class="form-control" placeholder="Please enter your new password" ng-model="vm.password" name="password" ng-minlength="8" ng-maxlength="50" required>\n' +
    '      <span class="glyphicon glyphicon-lock form-control-feedback"></span>\n' +
    '      <p ng-show="vm.resetPasswordForm.password.$error.required && ( vm.formSubmitted || vm.resetPasswordForm.password.$touched)" class="help-block">Password is required.</p>\n' +
    '      <p ng-show="vm.resetPasswordForm.password.$error.maxlength" class="help-block">Password is too long.</p>\n' +
    '      <p ng-show="vm.resetPasswordForm.password.$invalid && vm.resetPasswordForm.password.$error.minlength && vm.resetPasswordForm.password.$touched" class="help-block">Password is too short, Please enter more than 8 characters.</p>\n' +
    '      <p ng-show="vm.resetPasswordForm.password.$invalid && (vm.formSubmitted || vm.errors.password)" class="help-block">{{vm.errors.password}}</p>\n' +
    '    </div>\n' +
    '    <div class="form-group has-feedback" ng-class="{ \'has-error\': vm.resetPasswordForm.password_confirmation.$invalid && ( vm.formSubmitted || vm.resetPasswordForm.password_confirmation.$touched ) }">\n' +
    '      <input type="password" class="form-control" placeholder="Please confirm your new password" ng-model="vm.password_confirmation" password-verify="vm.password" name="password_confirmation" ng-minlength="8" ng-maxlength="50" required>\n' +
    '      <span class="glyphicon glyphicon-lock form-control-feedback"></span>\n' +
    '      <p ng-show="vm.resetPasswordForm.password_confirmation.$error.required && ( vm.formSubmitted || vm.resetPasswordForm.password_confirmation.$touched)" class="help-block">Password confirmation is required.</p>\n' +
    '      <p ng-show="vm.resetPasswordForm.password_confirmation.$error.passwordVerify && (vm.formSubmitted || vm.resetPasswordForm.password_confirmation.$touched)" class="help-block">Password confirmation does not match.</p>\n' +
    '      <p ng-show="vm.resetPasswordForm.password_confirmation.$error.maxlength" class="help-block">Password confirmation is too long.</p>\n' +
    '      <p ng-show="vm.resetPasswordForm.password_confirmation.$invalid && vm.resetPasswordForm.password_confirmation.$error.minlength && vm.resetPasswordForm.password_confirmation.$touched" class="help-block">Password confirmation is too short, Please enter more than 8 characters.</p>\n' +
    '      <p ng-show="vm.resetPasswordForm.password_confirmation.$invalid && (vm.formSubmitted || vm.errors.password_confirmation)" class="help-block">{{vm.errors.password_confirmation}}</p>\n' +
    '    </div>\n' +
    '    <div class="row">\n' +
    '      <div class="col-xs-12">\n' +
    '        <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '  </div>\n' +
    '</form>\n' +
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/components/supplier_add/supplier_add.component.html',
    '<section class="content-header">\n' +
    '  <h1>Suppliers <small>Supplier Management</small></h1>\n' +
    '  <ol class="breadcrumb">\n' +
    '    <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i> Home</a></li>\n' +
    '    <li><a ui-sref="app.supplierlist">Supplier Lists</a></li>\n' +
    '    <li class="active">Add New Supplier</li>\n' +
    '  </ol>\n' +
    '</section>\n' +
    '<section class="content">\n' +
    '  <div class="row">\n' +
    '    <div class="col-sm-12 col-md-7">\n' +
    '      <div class="box box-primary">\n' +
    '        <div class="box-header with-border">\n' +
    '          <h3 class="box-title">Add New Supplier</h3>\n' +
    '        </div>\n' +
    '        <form class="form-horizontal" name="form" ng-submit="vm.save(form.$valid, form)" novalidate>\n' +
    '          <div class="box-body">\n' +
    '            <div ng-if="vm.alerts" class="alert alert-{{alert.type}}" ng-repeat="alert in vm.alerts">\n' +
    '              <h4>{{alert.title}}</h4>\n' +
    '              <p>{{alert.msg}}</p>\n' +
    '            </div>\n' +
    '            <div class="form-group" ng-class="{ \'has-error\': form.name.$invalid && ( vm.formSubmitted || form.name.$touched) }">\n' +
    '              <label for="inputEmail3" class="col-sm-2 control-label">Name</label>\n' +
    '              <div class="col-sm-10">\n' +
    '                <input type="text" class="form-control" ng-model="vm.name" name="name" placeholder="Name" required>\n' +
    '                <p ng-show="form.name.$error.required && ( vm.formSubmitted || form.name.$touched)" class="help-block">Name is required.</p>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="form-group" ng-class="{ \'has-error\': form.short_name.$invalid && ( vm.formSubmitted || form.short_name.$touched) }">\n' +
    '              <label for="inputPassword3" class="col-sm-2 control-label">Short name</label>\n' +
    '              <div class="col-sm-10">\n' +
    '                <input type="text" class="form-control" ng-model="vm.short_name" name="short_name" placeholder="Slug" required>\n' +
    '                <p ng-show="form.short_name.$error.required && ( vm.formSubmitted || form.short_name.$touched)" class="help-block">Short name is required.</p>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '          </div>\n' +
    '          <div class="box-footer">\n' +
    '            <a ui-sref="app.supplierlist" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>\n' +
    '            <button type="submit" class="btn btn-primary pull-right">Add New</button>\n' +
    '          </div>\n' +
    '        </form>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '  </div>\n' +
    '</section>\n' +
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/components/supplier_edit/supplier_edit.component.html',
    '<section class="content-header">\n' +
    '    <h1>Suppliers <small>Supplier Management</small></h1>\n' +
    '    <ol class="breadcrumb">\n' +
    '        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i> Home</a></li>\n' +
    '        <li><a ui-sref="app.supplierlist">Supplier Lists</a></li>\n' +
    '        <li class="active">Edit Supplier</li>\n' +
    '    </ol>\n' +
    '</section>\n' +
    '<section class="content">\n' +
    '    <div class="row">\n' +
    '        <div class="col-sm-12 col-md-7">\n' +
    '            <div class="box box-primary">\n' +
    '                <div class="box-header with-border">\n' +
    '                    <h3 class="box-title">Edit Supplier</h3>\n' +
    '                </div>\n' +
    '                <form class="form-horizontal" name="form" ng-submit="vm.save(form.$valid)" novalidate>\n' +
    '                    <div class="box-body">\n' +
    '                        <div ng-if="vm.alerts" class="alert alert-{{alert.type}}" ng-repeat="alert in vm.alerts">\n' +
    '                            <h4>{{alert.title}}</h4>\n' +
    '                            <p>{{alert.msg}}</p>\n' +
    '                        </div>\n' +
    '                        <div class="form-group" ng-class="{ \'has-error\': (form.name.$invalid && ( vm.formSubmitted || form.name.$touched)) || vm.errors[\'data.entity.name\'] != null }">\n' +
    '                            <label for="inputEmail3" class="col-sm-2 control-label">Name</label>\n' +
    '                            <div class="col-sm-10">\n' +
    '                                <input type="text" class="form-control" ng-model="vm.model.data.entity.name" name="name" placeholder="Name" required>\n' +
    '                                <p ng-if="vm.errors[\'data.entity.name\']" class="help-block">{{vm.errors[\'data.entity.name\'][0]}}</p>\n' +
    '                            </div>\n' +
    '                        </div>\n' +
    '                        <div class="form-group" ng-class="{ \'has-error\': form.short_name.$invalid && ( vm.formSubmitted || form.short_name.$touched)  || vm.errors[\'data.entity.short_name\'] != null }">\n' +
    '                            <label for="inputPassword3" class="col-sm-2 control-label">Short name</label>\n' +
    '                            <div class="col-sm-10">\n' +
    '                                <input type="text" class="form-control" ng-model="vm.model.data.entity.short_name" name="short_name" placeholder="Short name" required>\n' +
    '                                <p ng-if="vm.errors[\'data.entity.short_name\']" class="help-block">{{vm.errors[\'data.entity.short_name\'][0]}}</p>\n' +
    '                            </div>\n' +
    '                        </div>\n' +
    '                    </div>\n' +
    '                    <div class="box-footer">\n' +
    '                        <a ui-sref="app.supplierlist" class="btn btn-default"><i class="fa fa-angle-double-left"></i> {{\'COM_BTN_BACK\' | translate}}</a>\n' +
    '                        <button type="submit" class="btn btn-primary pull-right">{{\'COM_BTN_UPDATE\' | translate}}</button>\n' +
    '                    </div>\n' +
    '                </form>\n' +
    '            </div>\n' +
    '        </div>\n' +
    '    </div>\n' +
    '</section>\n' +
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/components/supplier_lists/supplier_lists.component.html',
    '<section class="content-header">\n' +
    '    <h1>Supplier <small>Module description here</small></h1>\n' +
    '    <ol class="breadcrumb">\n' +
    '        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i> Home</a></li>\n' +
    '        <li class="active">Supplier Lists</li>\n' +
    '    </ol>\n' +
    '</section>\n' +
    '<section class="content">\n' +
    '    <div class="row">\n' +
    '        <div class="col-md-12">\n' +
    '            <div class="box box-info">\n' +
    '                <div class="box-header with-border">\n' +
    '                    <h3 class="box-title">Supplier List</h3>\n' +
    '                    <div class="box-tools pull-right">\n' +
    '                        <div uib-dropdown class="btn-group">\n' +
    '                            <a ui-sref="app.supplieradd" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{\'COM_BTN_NEW\' | translate}}</a>\n' +
    '                            <!-- <button type="button" uib-dropdown-toggle class="btn btn-success btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\n' +
    '                                <span class="caret"></span>\n' +
    '                            </button>\n' +
    '                            <ul uib-dropdown-menu>\n' +
    '                                <li><a ui-sref="a">a</a></li>\n' +
    '                                <li><a ui-sref="b">b</a></li>\n' +
    '                                <li><a ui-sref="c">c</a></li>\n' +
    '                                <li><a ui-sref="d">d</a></li>\n' +
    '                            </ul> -->\n' +
    '                        </div>\n' +
    '                    </div>\n' +
    '                </div>\n' +
    '                <div class="box-body">\n' +
    '                    <div ng-if="vm.alerts" class="alert alert-{{alert.type}}" ng-repeat="alert in vm.alerts">\n' +
    '                        <h4>{{alert.title}}</h4>\n' +
    '                        <p>{{alert.msg}}</p>\n' +
    '                    </div>\n' +
    '                    <table datatable="" width="100%" class="table table-striped table-bordered" ng-if="vm.displayTable" dt-options="vm.dtOptions" dt-columns="vm.dtColumns"></table>\n' +
    '                </div>\n' +
    '            </div>\n' +
    '        </div>\n' +
    '    </div>\n' +
    '</section>\n' +
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/components/user-lists/user-lists.component.html',
    '<section class="content-header">\n' +
    '    <h1>Users <small>Users management</small></h1>\n' +
    '    <ol class="breadcrumb">\n' +
    '        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i> Home</a></li>\n' +
    '        <li class="active">User Lists</li>\n' +
    '    </ol>\n' +
    '</section>\n' +
    '<section class="content">\n' +
    '    <div class="row">\n' +
    '        <div class="col-md-12">\n' +
    '            <div class="box box-info">\n' +
    '                <div class="box-header with-border">\n' +
    '                    <h3 class="box-title">User List</h3>\n' +
    '                    <div class="box-tools pull-right">\n' +
    '                        <a ui-sref="app.adm0110" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{\'COM_BTN_NEW\' | translate}}</a>\n' +
    '                        <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>\n' +
    '                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->\n' +
    '                    </div>\n' +
    '                </div>\n' +
    '                <div class="box-body">\n' +
    '                    <table datatable="" width="100%" class="table table-striped table-bordered" ng-if="vm.displayTable" dt-options="vm.dtOptions" dt-columns="vm.dtColumns"></table>\n' +
    '                </div>\n' +
    '            </div>\n' +
    '        </div>\n' +
    '    </div>\n' +
    '</section>');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/components/user-edit/user-edit.component.html',
    '<section class="content-header">\n' +
    '    <h1>Users <small>Module description here</small></h1>\n' +
    '    <ol class="breadcrumb">\n' +
    '        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i> Home</a></li>\n' +
    '        <li><a ui-sref="app.userlist">User Lists</a></li>\n' +
    '        <li class="active">Edit User</li>\n' +
    '    </ol>\n' +
    '</section>\n' +
    '<section class="content">\n' +
    '    <div class="row">\n' +
    '        <div class="col-sm-12 col-md-7">\n' +
    '            <div class="box box-primary">\n' +
    '                <div class="box-header with-border">\n' +
    '                    <h3 class="box-title">Edit User</h3>\n' +
    '                </div>\n' +
    '                <form class="form-horizontal" name="userForm" ng-submit="vm.save(userForm.$valid)" novalidate>\n' +
    '                    <div class="box-body">\n' +
    '                        <div ng-if="vm.alerts" class="alert alert-{{alert.type}}" ng-repeat="alert in vm.alerts">\n' +
    '                            <h4>{{alert.title}}</h4>\n' +
    '                            <p>{{alert.msg}}</p>\n' +
    '                        </div>\n' +
    '                        <div class="form-group" ng-class="{ \'has-error\': userForm.name.$invalid && ( vm.formSubmitted || userForm.name.$touched) }">\n' +
    '                            <label for="inputEmail3" class="col-sm-2 control-label">Name</label>\n' +
    '                            <div class="col-sm-10">\n' +
    '                                <input type="text" class="form-control" ng-model="vm.usereditdata.data.name" name="name" placeholder="Name" required>\n' +
    '                                <p ng-show="userForm.name.$error.required && ( vm.formSubmitted || userForm.name.$touched)" class="help-block">Name is required.</p>\n' +
    '                            </div>\n' +
    '                        </div>\n' +
    '                        <div class="form-group" ng-class="{ \'has-error\': userForm.email.$invalid && ( vm.formSubmitted || userForm.email.$touched) }">\n' +
    '                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>\n' +
    '                            <div class="col-sm-10">\n' +
    '                                <input type="email" class="form-control" ng-model="vm.usereditdata.data.email" name="email" placeholder="Email" required>\n' +
    '                                <p ng-show="userForm.email.$error.required && ( vm.formSubmitted || userForm.email.$touched)" class="help-block">Email is required.</p>\n' +
    '                                <p ng-show="userForm.email.$error.email  && ( vm.formSubmitted || userForm.email.$touched)" class="help-block">This is not a valid email.</p>\n' +
    '                            </div>\n' +
    '                        </div>\n' +
    '                        <div class="form-group">\n' +
    '                            <label for="inputEmail3" class="col-sm-2 control-label">Roles</label>\n' +
    '                            <div class="col-sm-10">\n' +
    '                                <div class="checkbox" ng-repeat="role in vm.systemRoles">\n' +
    '                                    <label>\n' +
    '                                <input type="checkbox" checklist-model="vm.usereditdata.data.role" checklist-value="role.id"> {{role.name}}\n' +
    '                                </label>\n' +
    '                                </div>\n' +
    '                            </div>\n' +
    '                        </div>\n' +
    '                        <div class="form-group">\n' +
    '                            <label class="col-sm-2 control-label">Chọn chi nhánh</label>\n' +
    '                            <div class="col-sm-10">\n' +
    '                                <select class="form-control" chosen placeholder-text-single="\'Chọn chi nhánh\'" ng-model="vm.usereditdata.data.branch" ng-options="branch.id as branch.name for branch in vm.systemBranches">\n' +
    '                                    <option value="0">Không có chi nhánh</option>   \n' +
    '                                </select>\n' +
    '                            </div>\n' +
    '                        </div>\n' +
    '                        <div class="form-group">\n' +
    '                            <label class="col-sm-2 control-label">Active</label>\n' +
    '                            <div class="col-sm-10">\n' +
    '                                <input type="checkbox" ng-model="vm.usereditdata.data.email_verified" ng-true-value="1" ng-false-value="0" />\n' +
    '                            </div>\n' +
    '                        </div>\n' +
    '                    </div>\n' +
    '                    <div class="box-footer">\n' +
    '                        <a ui-sref="app.userlist" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>\n' +
    '                        <button type="submit" class="btn btn-primary pull-right">Update</button>\n' +
    '                    </div>\n' +
    '                </form>\n' +
    '            </div>\n' +
    '        </div>\n' +
    '    </div>\n' +
    '</section>');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/components/user-permissions/user-permissions.component.html',
    '<section class="content-header">\n' +
    '  <h1>User Permissions <small>Module description here</small></h1>\n' +
    '  <ol class="breadcrumb">\n' +
    '    <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i> Home</a></li>\n' +
    '    <li class="active">Permission Lists</li>\n' +
    '  </ol>\n' +
    '</section>\n' +
    '<section class="content">\n' +
    '  <div class="box">\n' +
    '    <div class="box-header with-border">\n' +
    '      <h3 class="box-title">Permission Lists</h3>\n' +
    '      <div class="box-tools pull-right">\n' +
    '        <a ui-sref="app.userpermissionsadd" class="btn btn-block btn-success btn-xs"><i class="fa fa-plus"></i> Add New</a>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '    <div class="box-body">\n' +
    '      <table datatable="" width="100%" class="table table-striped table-bordered" ng-if="vm.displayTable" dt-options="vm.dtOptions" dt-columns="vm.dtColumns"></table>\n' +
    '    </div>\n' +
    '    <div class="box-footer">\n' +
    '      Footer\n' +
    '    </div>\n' +
    '  </div>\n' +
    '</section>\n' +
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/components/user-permissions-add/user-permissions-add.component.html',
    '<section class="content-header">\n' +
    '  <h1>Users <small>Module description here</small></h1>\n' +
    '  <ol class="breadcrumb">\n' +
    '    <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i> Home</a></li>\n' +
    '    <li><a ui-sref="app.userpermissions">Permission Lists</a></li>\n' +
    '    <li class="active">Add New User Permission</li>\n' +
    '  </ol>\n' +
    '</section>\n' +
    '<section class="content">\n' +
    '  <div class="row">\n' +
    '    <div class="col-sm-12 col-md-7">\n' +
    '      <div class="box box-primary">\n' +
    '        <div class="box-header with-border">\n' +
    '          <h3 class="box-title">Add New User Permission</h3>\n' +
    '        </div>\n' +
    '        <form class="form-horizontal" name="permissionForm" ng-submit="vm.save(permissionForm.$valid, permissionForm)" novalidate>\n' +
    '          <div class="box-body">\n' +
    '            <div ng-if="vm.alerts" class="alert alert-{{alert.type}}" ng-repeat="alert in vm.alerts">\n' +
    '              <h4>{{alert.title}}</h4>\n' +
    '              <p>{{alert.msg}}</p>\n' +
    '            </div>\n' +
    '            <div class="form-group" ng-class="{ \'has-error\': permissionForm.name.$invalid && ( vm.formSubmitted || permissionForm.name.$touched) }">\n' +
    '              <label for="inputEmail3" class="col-sm-2 control-label">Name</label>\n' +
    '              <div class="col-sm-10">\n' +
    '                <input type="text" class="form-control" ng-model="vm.name" name="name" placeholder="Name" required>\n' +
    '                <p ng-show="permissionForm.name.$error.required && ( vm.formSubmitted || permissionForm.name.$touched)" class="help-block">Name is required.</p>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="form-group" ng-class="{ \'has-error\': permissionForm.slug.$invalid && ( vm.formSubmitted || permissionForm.slug.$touched) }">\n' +
    '              <label for="inputPassword3" class="col-sm-2 control-label">Slug</label>\n' +
    '              <div class="col-sm-10">\n' +
    '                <input type="text" class="form-control" ng-model="vm.slug" name="slug" placeholder="Slug" required>\n' +
    '                <p ng-show="permissionForm.slug.$error.required && ( vm.formSubmitted || permissionForm.slug.$touched)" class="help-block">Slug is required.</p>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="form-group">\n' +
    '              <label for="inputPassword3" class="col-sm-2 control-label">Description</label>\n' +
    '              <div class="col-sm-10">\n' +
    '                <textarea class="form-control" rows="3" ng-model="vm.description" name="description" placeholder="Description"></textarea>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '          </div>\n' +
    '          <div class="box-footer">\n' +
    '            <a ui-sref="app.userpermissions" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>\n' +
    '            <button type="submit" class="btn btn-primary pull-right">Add New</button>\n' +
    '          </div>\n' +
    '        </form>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '  </div>\n' +
    '</section>\n' +
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/components/user-permissions-edit/user-permissions-edit.component.html',
    '<section class="content-header">\n' +
    '  <h1>Users <small>Module description here</small></h1>\n' +
    '  <ol class="breadcrumb">\n' +
    '    <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i> Home</a></li>\n' +
    '    <li><a ui-sref="app.userpermissions">Permission Lists</a></li>\n' +
    '    <li class="active">Edit User Permission</li>\n' +
    '  </ol>\n' +
    '</section>\n' +
    '<section class="content">\n' +
    '  <div class="row">\n' +
    '    <div class="col-sm-12 col-md-7">\n' +
    '      <div class="box box-primary">\n' +
    '        <div class="box-header with-border">\n' +
    '          <h3 class="box-title">Edit User Permission</h3>\n' +
    '        </div>\n' +
    '        <form class="form-horizontal" name="permissionForm" ng-submit="vm.save(permissionForm.$valid)" novalidate>\n' +
    '          <div class="box-body">\n' +
    '            <div ng-if="vm.alerts" class="alert alert-{{alert.type}}" ng-repeat="alert in vm.alerts">\n' +
    '              <h4>{{alert.title}}</h4>\n' +
    '              <p>{{alert.msg}}</p>\n' +
    '            </div>\n' +
    '            <div class="form-group" ng-class="{ \'has-error\': permissionForm.permission.$invalid && ( vm.formSubmitted || permissionForm.permission.$touched) }">\n' +
    '              <label for="inputEmail3" class="col-sm-2 control-label">Name</label>\n' +
    '              <div class="col-sm-10">\n' +
    '                <input type="text" class="form-control" ng-model="vm.permission.data.name" name="permission" placeholder="Name" required>\n' +
    '                <p ng-show="permissionForm.permission.$error.required && ( vm.formSubmitted || permissionForm.permission.$touched)" class="help-block">Name is required.</p>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="form-group" ng-class="{ \'has-error\': permissionForm.slug.$invalid && ( vm.formSubmitted || permissionForm.slug.$touched) }">\n' +
    '              <label for="inputPassword3" class="col-sm-2 control-label">Slug</label>\n' +
    '              <div class="col-sm-10">\n' +
    '                <input type="text" class="form-control" ng-model="vm.permission.data.slug" name="slug" placeholder="Slug" required>\n' +
    '                <p ng-show="permissionForm.slug.$error.required && ( vm.formSubmitted || permissionForm.slug.$touched)" class="help-block">Slug is required.</p>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="form-group">\n' +
    '              <label for="inputPassword3" class="col-sm-2 control-label">Description</label>\n' +
    '              <div class="col-sm-10">\n' +
    '                <textarea class="form-control" rows="3" ng-model="vm.permission.data.description" name="description" placeholder="Description"></textarea>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '          </div>\n' +
    '          <div class="box-footer">\n' +
    '            <a ui-sref="app.userpermissions" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>\n' +
    '            <button type="submit" class="btn btn-primary pull-right">Update</button>\n' +
    '          </div>\n' +
    '        </form>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '  </div>\n' +
    '</section>\n' +
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/components/user-profile/user-profile.component.html',
    '<section class="content-header">\n' +
    '  <h1>Users <small>Module description here</small></h1>\n' +
    '  <ol class="breadcrumb">\n' +
    '    <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i> Home</a></li>\n' +
    '    <li><a ui-sref="app.userlist">User Lists</a></li>\n' +
    '    <li class="active">Edit User</li>\n' +
    '  </ol>\n' +
    '</section>\n' +
    '<section class="content">\n' +
    '  <div class="row">\n' +
    '    <div class="col-sm-12 col-md-7">\n' +
    '      <div class="box box-primary">\n' +
    '        <div class="box-header with-border">\n' +
    '          <h3 class="box-title">Profile</h3>\n' +
    '        </div>\n' +
    '        <form class="form-horizontal" name="userForm" ng-submit="vm.save(userForm.$valid, userForm)" novalidate>\n' +
    '          <div class="box-body">\n' +
    '            <div ng-if="vm.alerts" class="alert alert-{{alert.type}}" ng-repeat="alert in vm.alerts">\n' +
    '              <h4>{{alert.title}}</h4>\n' +
    '              <p>{{alert.msg}}</p>\n' +
    '            </div>\n' +
    '            <div class="form-group" ng-class="{ \'has-error\': userForm.name.$invalid && ( vm.formSubmitted || userForm.name.$touched) }">\n' +
    '              <label for="inputEmail3" class="col-sm-3 control-label">Name</label>\n' +
    '              <div class="col-sm-9">\n' +
    '                <input type="text" class="form-control" ng-model="vm.userdata.data.name" name="name" placeholder="Name" required>\n' +
    '                <p ng-show="userForm.name.$error.required && ( vm.formSubmitted || userForm.name.$touched)" class="help-block">Name is required.</p>\n' +
    '                <p ng-show="userForm.name.customError" class="help-block">{{userForm.name.customError}}</p>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="form-group" ng-class="{ \'has-error\': userForm.email.$invalid && ( vm.formSubmitted || userForm.email.$touched) }">\n' +
    '              <label for="inputEmail3" class="col-sm-3 control-label">Email</label>\n' +
    '              <div class="col-sm-9">\n' +
    '                <input type="email" class="form-control" ng-model="vm.userdata.data.email" name="email" placeholder="Email" required>\n' +
    '                <p ng-show="userForm.email.$error.required && ( vm.formSubmitted || userForm.email.$touched)" class="help-block">Email is required.</p>\n' +
    '                <p ng-show="userForm.email.$error.email  && ( vm.formSubmitted || userForm.email.$touched)" class="help-block">This is not a valid email.</p>\n' +
    '                <p ng-show="userForm.email.customError" class="help-block">{{userForm.email.customError}}</p>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="page-header">\n' +
    '              <h4>Update Password <small>( Optional )</small></h4>\n' +
    '            </div>\n' +
    '            <div class="form-group" ng-class="{ \'has-error\': userForm.current_password.$invalid && ( vm.formSubmitted || userForm.current_password.$touched) }">\n' +
    '              <label for="inputEmail3" class="col-sm-3 control-label">Current Password</label>\n' +
    '              <div class="col-sm-9">\n' +
    '                <input type="password" class="form-control" placeholder="Password" name="current_password" ng-model="vm.userdata.data.current_password" ng-minlength="8" ng-maxlength="50" ng-required="vm.userdata.data.new_password">\n' +
    '                <p ng-show="userForm.current_password.$error.required && ( vm.formSubmitted || userForm.current_password.$touched)" class="help-block">Password is required.</p>\n' +
    '                <p ng-show="userForm.current_password.$error.maxlength" class="help-block">Password is too long.</p>\n' +
    '                <p ng-show="userForm.current_password.$invalid &&\n' +
    '                            userForm.current_password.$error.minlength &&\n' +
    '                            userForm.current_password.$touched" class="help-block">Password is too short, Please enter more than 8 characters.</p>\n' +
    '                <p ng-show="userForm.current_password.$invalid && (vm.formSubmitted || vm.errors.current_password)" class="help-block">{{vm.errors.current_password}}</p>\n' +
    '                <p ng-show="userForm.current_password.customError" class="help-block">{{userForm.current_password.customError}}</p>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="form-group" ng-class="{ \'has-error\': userForm.new_password.$invalid && ( vm.formSubmitted || userForm.new_password.$touched) }">\n' +
    '              <label for="inputEmail3" class="col-sm-3 control-label">New Password</label>\n' +
    '              <div class="col-sm-9">\n' +
    '                <input type="password" class="form-control" placeholder="Password" name="new_password" ng-model="vm.userdata.data.new_password" ng-minlength="8" ng-maxlength="50" ng-required="vm.userdata.data.current_password">\n' +
    '                <p ng-show="userForm.new_password.$error.required && ( vm.formSubmitted || userForm.new_password.$touched)" class="help-block">New Password is required.</p>\n' +
    '                <p ng-show="userForm.new_password.$error.maxlength" class="help-block">Password is too long.</p>\n' +
    '                <p ng-show="userForm.new_password.$invalid &&\n' +
    '                            userForm.new_password.$error.minlength &&\n' +
    '                            userForm.new_password.$touched" class="help-block">Password is too short, Please enter more than 8 characters.</p>\n' +
    '                <p ng-show="userForm.new_password.$invalid && (vm.formSubmitted || vm.errors.new_password)" class="help-block">{{vm.errors.new_password}}</p>\n' +
    '                <p ng-show="userForm.new_password.customError" class="help-block">{{userForm.new_password.customError}}</p>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="form-group" ng-class="{ \'has-error\': userForm.new_password_confirmation.$invalid && ( vm.formSubmitted || userForm.new_password_confirmation.$touched) }">\n' +
    '              <label for="inputEmail3" class="col-sm-3 control-label">Confirm Password</label>\n' +
    '              <div class="col-sm-9">\n' +
    '                <input type="password" class="form-control" placeholder="Password" name="new_password_confirmation" ng-model="vm.userdata.data.new_password_confirmation" ng-minlength="8" ng-maxlength="50" ng-required="vm.userdata.data.current_password" password-verify="vm.userdata.data.new_password">\n' +
    '                <p ng-show="userForm.new_password_confirmation.$error.required &&\n' +
    '                            ( vm.formSubmitted || userForm.new_password_confirmation.$touched)" class="help-block">Confirm Password is required.</p>\n' +
    '                <p ng-show="userForm.new_password_confirmation.$error.maxlength" class="help-block">Password is too long.</p>\n' +
    '                <p ng-show="userForm.new_password_confirmation.$invalid &&\n' +
    '                            userForm.new_password_confirmation.$error.minlength &&\n' +
    '                            userForm.new_password_confirmation.$touched" class="help-block">Password is too short, Please enter more than 8 characters.</p>\n' +
    '                <p ng-show="userForm.new_password_confirmation.$invalid && (vm.formSubmitted || vm.errors.new_password_confirmation)" class="help-block">{{vm.errors.new_password_confirmation}}</p>\n' +
    '                <p ng-show="userForm.new_password_confirmation.$error.passwordVerify && (vm.formSubmitted || userForm.new_password_confirmation.$touched)" class="help-block">Password Mismatch</p>\n' +
    '                <p ng-show="userForm.new_password_confirmation.customError" class="help-block">{{userForm.new_password.customError}}</p>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '          </div>\n' +
    '          <div class="box-footer">\n' +
    '            <a ui-sref="app.userlist" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>\n' +
    '            <button type="submit" class="btn btn-primary pull-right">Update</button>\n' +
    '          </div>\n' +
    '        </form>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '  </div>\n' +
    '</section>\n' +
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/components/user-roles/user-roles.component.html',
    '<section class="content-header">\n' +
    '  <h1>User Roles <small>Module description here</small></h1>\n' +
    '  <ol class="breadcrumb">\n' +
    '    <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i> Home</a></li>\n' +
    '    <li class="active">Role List</li>\n' +
    '  </ol>\n' +
    '</section>\n' +
    '<section class="content">\n' +
    '  <div class="box">\n' +
    '    <div class="box-header with-border">\n' +
    '      <h3 class="box-title">Role List</h3>\n' +
    '      <div class="box-tools pull-right">\n' +
    '        <a ui-sref="app.userrolesadd" class="btn btn-block btn-success btn-xs"><i class="fa fa-plus"></i> Add New</a>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '    <div class="box-body">\n' +
    '      <table datatable="" width="100%" class="table table-striped table-bordered" ng-if="vm.displayTable" dt-options="vm.dtOptions" dt-columns="vm.dtColumns"></table>\n' +
    '    </div>\n' +
    '    <div class="box-footer">\n' +
    '      Footer\n' +
    '    </div>\n' +
    '  </div>\n' +
    '</section>\n' +
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/components/user-roles-add/user-roles-add.component.html',
    '<section class="content-header">\n' +
    '  <h1>Users Roles<small>Module description here</small></h1>\n' +
    '  <ol class="breadcrumb">\n' +
    '    <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i> Home</a></li>\n' +
    '    <li><a ui-sref="app.userroles">Role Lists</a></li>\n' +
    '    <li class="active">Add User Role</li>\n' +
    '  </ol>\n' +
    '</section>\n' +
    '<section class="content">\n' +
    '  <div class="row">\n' +
    '    <div class="col-sm-12 col-md-7">\n' +
    '      <div class="box box-primary">\n' +
    '        <div class="box-header with-border">\n' +
    '          <h3 class="box-title">Add User Role</h3>\n' +
    '        </div>\n' +
    '        <form class="form-horizontal" name="roleForm" ng-submit="vm.save(roleForm.$valid, roleForm)" novalidate>\n' +
    '          <div class="box-body">\n' +
    '            <div ng-if="vm.alerts" class="alert alert-{{alert.type}}" ng-repeat="alert in vm.alerts">\n' +
    '              <h4>{{alert.title}}</h4>\n' +
    '              <p>{{alert.msg}}</p>\n' +
    '            </div>\n' +
    '            <div class="form-group" ng-class="{ \'has-error\': roleForm.role.$invalid && ( vm.formSubmitted || roleForm.role.$touched) }">\n' +
    '              <label for="inputEmail3" class="col-sm-2 control-label">Role</label>\n' +
    '              <div class="col-sm-10">\n' +
    '                <input type="text" class="form-control" ng-model="vm.role" name="role" placeholder="Role" required>\n' +
    '                <p ng-show="roleForm.role.$error.required && ( vm.formSubmitted || roleForm.role.$touched)" class="help-block">Role is required.</p>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="form-group" ng-class="{ \'has-error\': roleForm.slug.$invalid && ( vm.formSubmitted || roleForm.slug.$touched) }">\n' +
    '              <label for="inputPassword3" class="col-sm-2 control-label">Slug</label>\n' +
    '              <div class="col-sm-10">\n' +
    '                <input type="text" class="form-control" ng-model="vm.slug" name="slug" placeholder="Slug" required>\n' +
    '                <p ng-show="roleForm.slug.$error.required && ( vm.formSubmitted || roleForm.slug.$touched)" class="help-block">Slug is required.</p>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="form-group">\n' +
    '              <label for="inputPassword3" class="col-sm-2 control-label">Description</label>\n' +
    '              <div class="col-sm-10">\n' +
    '                <textarea class="form-control" rows="3" ng-model="vm.description" name="description" placeholder="Description"></textarea>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '          </div>\n' +
    '          <div class="box-footer">\n' +
    '            <a ui-sref="app.userroles" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>\n' +
    '            <button type="submit" class="btn btn-primary pull-right">Add New</button>\n' +
    '          </div>\n' +
    '        </form>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '  </div>\n' +
    '</section>\n' +
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/components/user-roles-edit/user-roles-edit.component.html',
    '<section class="content-header">\n' +
    '    <h1>Users Roles<small>Module description here</small></h1>\n' +
    '    <ol class="breadcrumb">\n' +
    '        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i> Home</a></li>\n' +
    '        <li><a ui-sref="app.userroles">Role Lists</a></li>\n' +
    '        <li class="active">Edit User Role</li>\n' +
    '    </ol>\n' +
    '</section>\n' +
    '<section class="content">\n' +
    '    <div class="row">\n' +
    '        <div class="col-sm-12 col-md-7">\n' +
    '            <div class="box box-primary">\n' +
    '                <div class="box-header with-border">\n' +
    '                    <h3 class="box-title">Edit User Role</h3>\n' +
    '                </div>\n' +
    '                <form class="form-horizontal" name="roleForm" ng-submit="vm.save(roleForm.$valid)" novalidate>\n' +
    '                    <div class="box-body">\n' +
    '                        <div ng-if="vm.alerts" class="alert alert-{{alert.type}}" ng-repeat="alert in vm.alerts">\n' +
    '                            <h4>{{alert.title}}</h4>\n' +
    '                            <p>{{alert.msg}}</p>\n' +
    '                        </div>\n' +
    '                        <div class="form-group" ng-class="{ \'has-error\': roleForm.role.$invalid && ( vm.formSubmitted || roleForm.role.$touched) }">\n' +
    '                            <label for="inputEmail3" class="col-sm-2 control-label">Role</label>\n' +
    '                            <div class="col-sm-10">\n' +
    '                                <input type="text" class="form-control" ng-model="vm.role.data.name" name="role" placeholder="Role" required>\n' +
    '                                <p ng-show="roleForm.role.$error.required && ( vm.formSubmitted || roleForm.role.$touched)" class="help-block">Role is required.</p>\n' +
    '                            </div>\n' +
    '                        </div>\n' +
    '                        <div class="form-group" ng-class="{ \'has-error\': roleForm.slug.$invalid && ( vm.formSubmitted || roleForm.slug.$touched) }">\n' +
    '                            <label for="inputPassword3" class="col-sm-2 control-label">Slug</label>\n' +
    '                            <div class="col-sm-10">\n' +
    '                                <input type="text" class="form-control" ng-model="vm.role.data.slug" name="slug" placeholder="Slug" required>\n' +
    '                                <p ng-show="roleForm.slug.$error.required && ( vm.formSubmitted || roleForm.slug.$touched)" class="help-block">Slug is required.</p>\n' +
    '                            </div>\n' +
    '                        </div>\n' +
    '                        <div class="form-group">\n' +
    '                            <label for="inputPassword3" class="col-sm-2 control-label">Description</label>\n' +
    '                            <div class="col-sm-10">\n' +
    '                                <textarea class="form-control" rows="3" ng-model="vm.role.data.description" name="description" placeholder="Description"></textarea>\n' +
    '                            </div>\n' +
    '                        </div>\n' +
    '                        <div class="form-group">\n' +
    '                            <label for="inputEmail3" class="col-sm-2 control-label">Permission</label>\n' +
    '                            <div class="col-sm-10">\n' +
    '                                <div class="checkbox" ng-repeat="permission in vm.systemPermissions">\n' +
    '                                    <label>\n' +
    '                    <input type="checkbox" checklist-model="vm.role.data.permissions" checklist-value="permission.id"> {{permission.name}} ({{permission.description}})\n' +
    '                  </label>\n' +
    '                                </div>\n' +
    '                            </div>\n' +
    '                        </div>\n' +
    '                    </div>\n' +
    '                    <div class="box-footer">\n' +
    '                        <a ui-sref="app.userroles" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>\n' +
    '                        <button type="submit" class="btn btn-primary pull-right">Update</button>\n' +
    '                    </div>\n' +
    '                </form>\n' +
    '            </div>\n' +
    '        </div>\n' +
    '    </div>\n' +
    '</section>');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/components/user-verification/user-verification.component.html',
    '<div ng-if="vm.alerts" class="alert alert-{{alert.type}}" ng-repeat="alert in vm.alerts">\n' +
    '  <h4>{{alert.title}}</h4>\n' +
    '  <p>{{alert.msg}}</p>\n' +
    '</div>\n' +
    '<a ui-sref="login" class="btn btn-default">Login Page</a>\n' +
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/pages/forgot-password/forgot-password.page.html',
    '<div class="login-box">\n' +
    '  <div class="login-logo">\n' +
    '    <a ui-sref="login"><b>Admin</b>LTE</a>\n' +
    '  </div>\n' +
    '  <div class="login-box-body">\n' +
    '    <div class="row">\n' +
    '      <div class="col-xs-12">\n' +
    '        <div class="text-center">\n' +
    '          <h3>Forgot your password?</h3>\n' +
    '        </div>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '    <div class="row">\n' +
    '      <div class="col-xs-12">\n' +
    '        <forgot-password></forgot-password>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '    <br>\n' +
    '    <div class="row">\n' +
    '      <div class="col-xs-12">\n' +
    '        <a ui-sref="login">Back to Login Page</a>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '  </div>\n' +
    '</div>\n' +
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/pages/footer/footer.page.html',
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/pages/header/header.page.html',
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/pages/landing/landing.page.html',
    '<dashboard></dashboard>');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/pages/layout/layout.page.html',
    '<toaster-container toaster-options="{\'time-out\': 5000, \'close-button\':true, \'animation-class\': \'toast-top-right\'}"></toaster-container>\n' +
    '<div ui-view="header"></div>\n' +
    '<div id="main-content" class="content-wrapper">\n' +
    '    <div ui-view="main"></div>\n' +
    '</div>\n' +
    '<div ui-view="footer"></div>');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/pages/login/login.page.html',
    '<div class="login-box">\n' +
    '    <div class="login-logo">\n' +
    '        <a ui-sref="login"><b>Phan Khang Home</b> Portal</a>\n' +
    '    </div>\n' +
    '    <div class="login-box-body">\n' +
    '        <div class="row">\n' +
    '            <div class="col-xs-12">\n' +
    '                <div class="text-center">\n' +
    '                    <h3>Sign in</h3>\n' +
    '                </div>\n' +
    '            </div>\n' +
    '        </div>\n' +
    '        <div class="row">\n' +
    '            <div class="col-xs-12">\n' +
    '                <login-form></login-form>\n' +
    '            </div>\n' +
    '        </div>\n' +
    '    </div>\n' +
    '    <div class="row">\n' +
    '        <div class="col-xs-12">\n' +
    '            <div class="text-center">\n' +
    '                Copyright &copy; 2016 <strong><a href="http://www.phankhangco.com">Phan Khang Home</a>.</strong> All rights reserved.\n' +
    '            </div>\n' +
    '        </div>\n' +
    '    </div>\n' +
    '</div>');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/pages/login-loader/login-loader.page.html',
    '<div class="login-box">\n' +
    '  <div class="login-logo">\n' +
    '    <a ui-sref="login"><b>Admin</b>LTE</a>\n' +
    '  </div>\n' +
    '  <div class="login-box-body">\n' +
    '    <login-loader></login-loader>\n' +
    '  </div>\n' +
    '</div>\n' +
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/pages/register/register.page.html',
    '<div class="register-box">\n' +
    '  <div class="register-logo">\n' +
    '    <a ui-sref="login"><b>Admin</b>LTE</a>\n' +
    '  </div>\n' +
    '  <div class="register-box-body">\n' +
    '    <div class="row">\n' +
    '      <div class="col-xs-12">\n' +
    '        <div class="text-center">\n' +
    '          <h3>Create a new account</h3>\n' +
    '        </div>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '    <div class="row">\n' +
    '      <div class="col-xs-12">\n' +
    '        <register-form></register-form>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '    <br>\n' +
    '    <div class="row">\n' +
    '      <div class="col-xs-12">\n' +
    '        <div class="text-center">\n' +
    '          <a ui-sref="login">I already have an account</a>\n' +
    '        </div>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '    <br>\n' +
    '    <div class="row">\n' +
    '      <div class="col-xs-12">\n' +
    '        By signing up, you agree to our <a href="#">Terms</a> and that you have read our <a href="#">Privacy Policy</a>.\n' +
    '      </div>\n' +
    '    </div>\n' +
    '  </div>\n' +
    '</div>\n' +
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/pages/reset-password/reset-password.page.html',
    '<div class="login-box">\n' +
    '  <div class="login-logo">\n' +
    '    <a ui-sref="login"><b>Admin</b>LTE</a>\n' +
    '  </div>\n' +
    '  <div class="login-box-body">\n' +
    '    <div class="row-">\n' +
    '      <div class="col-xs-12">\n' +
    '        <div class="text-center">\n' +
    '          <h3>Reset Password</h3>\n' +
    '        </div>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '    <div class="row">\n' +
    '      <div class="col-xs-12">\n' +
    '        <reset-password></reset-password>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '  </div>\n' +
    '</div>\n' +
    '');
}]);
})();

(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/app/pages/user-verification/user-verification.page.html',
    '<div class="login-box">\n' +
    '  <div class="login-logo">\n' +
    '    <a ui-sref="login"><b>Admin</b>LTE</a>\n' +
    '  </div>\n' +
    '  <div class="login-box-body">\n' +
    '    <user-verification></user-verification>\n' +
    '  </div>\n' +
    '</div>\n' +
    '');
}]);
})();
