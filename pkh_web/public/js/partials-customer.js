(function(module) {
try {
  module = angular.module('app.partials');
} catch (e) {
  module = angular.module('app.partials', []);
}
module.run(['$templateCache', function($templateCache) {
  $templateCache.put('./views/directives/fk-col-sortable/fk-col-sortable.component.html',
    '<i ng-init="orderBy = columnName" ng-if="orderBy == null || (orderBy != null && orderBy != columnName)" class="fa fa-sort"></i>\n' +
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
  $templateCache.put('./views/app/components/cus0110/cus0110.component.html',
    '<section class="content-header">\n' +
    '    <h1>Tạo đơn đặt hàng<small></small></h1>\n' +
    '    <ol class="breadcrumb">\n' +
    '        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>\n' +
    '        <li class="active">Tạo đơn đặt hàng</li>\n' +
    '    </ol>\n' +
    '</section>\n' +
    '<section class="content cus0110">\n' +
    '    <div class="row">\n' +
    '        <div class="col-md-12">\n' +
    '            <div class="box box-info">\n' +
    '                <div class="box-header with-border">\n' +
    '                    <h3 class="box-title">Thông tin đơn đặt hàng</h3>\n' +
    '                    <div class="box-tools pull-right">\n' +
    '                        <div uib-dropdown class="btn-group">\n' +
    '                            <!-- <a ui-sref="app.crm0210" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;{{\'COM_BTN_NEW\' | translate}}</a> -->\n' +
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
    '                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->\n' +
    '                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->\n' +
    '                    </div>\n' +
    '                </div>\n' +
    '                <!-- <div class="box-body form">\n' +
    '                    <form role="form" ng-submit="vm.search()">\n' +
    '                        <div class="row">\n' +
    '                            <div class="col-md-3 col-sm-6 m-b-xs">\n' +
    '                                <div class="form-group">\n' +
    '                                    <label>Mã đơn hàng</label>\n' +
    '                                    <input type="text" ng-model="vm.m.filter.store_order_code" class="form-control"/>\n' +
    '                                </div>\n' +
    '                            </div>\n' +
    '                        </div>\n' +
    '                        <div class="row">\n' +
    '                            <div class="col-md-12">\n' +
    '                                <button type="submit" class="btn btn-primary btn-sm btn-width-default">\n' +
    '                                    <i class="fa fa-search fa-fw"></i>\n' +
    '                                    <span translate="COM_BTN_SEARCH"></span>\n' +
    '                                </button>\n' +
    '                                <button type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.resetFilter()">\n' +
    '                                    <i class="fa fa-eraser fa-fw"></i>\n' +
    '                                    <span translate="COM_BTN_RESET"></span>\n' +
    '                                </button>\n' +
    '                            </div>\n' +
    '                        </div>\n' +
    '                    </form>\n' +
    '                </div> -->\n' +
    '                <div class="box-body">\n' +
    '                    <div class="table-responsive" ng-if="vm.m.mode == \'EDIT\'">\n' +
    '                        <table class="table table-striped">\n' +
    '                            <thead>\n' +
    '                                <tr>\n' +
    '                                    <td>Hình ảnh</td>\n' +
    '                                    <td>Mã SP</td>\n' +
    '                                    <td>Tên SP</td>\n' +
    '                                    <td>Đóng thùng (cái)</td>\n' +
    '                                    <td>Đơn giá</td>\n' +
    '                                    <td>Số lượng (thùng)</td>\n' +
    '                                </tr>\n' +
    '                            </thead>\n' +
    '                            <tbody ng-repeat="proCat in vm.m.data">\n' +
    '                                <tr class="header">\n' +
    '                                    <td colspan="6">{{proCat.code}} {{proCat.name}}</td>\n' +
    '                                </tr>\n' +
    '                                <tr ng-repeat="pro in proCat.items" ng-if="pro.selling_price > 0">\n' +
    '                                    <td>\n' +
    '                                        <img ng-if="pro.noImage == 0" class="img-thumb" class="img-responsive" ng-src="/img/product/{{pro.product_code}}.png" />\n' +
    '                                        <img ng-if="pro.noImage == 1" class="img-thumb" class="img-responsive" ng-src="/img/product/WT0000.png" />\n' +
    '                                    </td>\n' +
    '                                    <td>{{pro.product_code}}</td>\n' +
    '                                    <td>{{pro.name}}</td>\n' +
    '                                    <td>{{pro.standard_packing}}</td>\n' +
    '                                    <td>{{pro.selling_price | currency: \'\': 0}}</td>\n' +
    '                                    <td>\n' +
    '                                        <input type="text" ng-model="pro.qty" class="form-control" style="width: 100px"/>\n' +
    '                                    </td>\n' +
    '                                </tr>\n' +
    '                            </tbody>\n' +
    '                        </table>\n' +
    '                    </div>\n' +
    '\n' +
    '                    <div class="table-responsive" ng-if="vm.m.mode == \'CONFIRM\'">\n' +
    '                        <table class="table table-striped">\n' +
    '                            <thead>\n' +
    '                                <tr>\n' +
    '                                    <td>Hình ảnh</td>\n' +
    '                                    <td>Mã SP</td>\n' +
    '                                    <td>Tên SP</td>\n' +
    '                                    <td>Đóng thùng (cái)</td>\n' +
    '                                    <td>Đơn giá</td>\n' +
    '                                    <td>Số lượng (thùng)</td>\n' +
    '                                    <td>Thành tiền</td>\n' +
    '                                </tr>\n' +
    '                            </thead>\n' +
    '                            <tbody ng-repeat="proCat in vm.m.data">\n' +
    '                                <!-- <tr class="header">\n' +
    '                                    <td colspan="7">{{proCat.code}} {{proCat.name}}</td>\n' +
    '                                </tr> -->\n' +
    '                                <tr ng-repeat="pro in proCat.items" ng-if="pro.qty > 0">\n' +
    '                                    <td>\n' +
    '                                        <img ng-if="pro.noImage == 0" class="img-thumb" class="img-responsive" ng-src="/img/product/{{pro.product_code}}.png" />\n' +
    '                                        <img ng-if="pro.noImage == 1" class="img-thumb" class="img-responsive" ng-src="/img/product/WT0000.png" />\n' +
    '                                    </td>\n' +
    '                                    <td>{{pro.product_code}}</td>\n' +
    '                                    <td>{{pro.name}}</td>\n' +
    '                                    <td>{{pro.standard_packing}}</td>\n' +
    '                                    <td>{{pro.selling_price | currency: \'\': 0}}</td>\n' +
    '                                    <td>{{pro.qty}}</td>\n' +
    '                                    <td>{{pro.standard_packing * pro.qty * pro.selling_price  | currency: \'\': 0 }}</td>\n' +
    '                                </tr>\n' +
    '                            </tbody>\n' +
    '                        </table>\n' +
    '                    </div>\n' +
    '                </div>\n' +
    '                <div class="box-footer text-right">\n' +
    '                    <!-- <a ui-sref="app.crm0300" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a> -->\n' +
    '                    <button ng-if="vm.m.mode == \'EDIT\'" type="button" class="btn btn-primary" ng-click="vm.confirm()">Xác nhận</button>\n' +
    '                    <button ng-if="vm.m.mode == \'CONFIRM\'" type="button" class="btn btn-default" ng-click="vm.back()">Trở về</button>&nbsp;\n' +
    '                    <button ng-if="vm.m.mode == \'CONFIRM\'" type="button" class="btn btn-primary" ng-click="vm.order()">Đặt hàng</button>\n' +
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
  $templateCache.put('./views/app/components/dashboard/dashboard.component.html',
    '<section class="content" style="display: none">\n' +
    '  <div class="row">\n' +
    '    <div class="col-md-3 col-sm-6 col-xs-12">\n' +
    '      <div class="info-box">\n' +
    '        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>\n' +
    '        <div class="info-box-content">\n' +
    '          <span class="info-box-text">CPU Traffic</span>\n' +
    '          <span class="info-box-number">90<small>%</small></span>\n' +
    '        </div>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '    <div class="col-md-3 col-sm-6 col-xs-12">\n' +
    '      <div class="info-box">\n' +
    '        <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>\n' +
    '        <div class="info-box-content">\n' +
    '          <span class="info-box-text">Likes</span>\n' +
    '          <span class="info-box-number">41,410</span>\n' +
    '        </div>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '    <div class="clearfix visible-sm-block"></div>\n' +
    '    <div class="col-md-3 col-sm-6 col-xs-12">\n' +
    '      <div class="info-box">\n' +
    '        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>\n' +
    '        <div class="info-box-content">\n' +
    '          <span class="info-box-text">Sales</span>\n' +
    '          <span class="info-box-number">760</span>\n' +
    '        </div>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '    <div class="col-md-3 col-sm-6 col-xs-12">\n' +
    '      <div class="info-box">\n' +
    '        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>\n' +
    '        <div class="info-box-content">\n' +
    '          <span class="info-box-text">New Members</span>\n' +
    '          <span class="info-box-number">2,000</span>\n' +
    '        </div>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '  </div>\n' +
    '  <div class="row">\n' +
    '    <div class="col-md-12">\n' +
    '      <div class="box">\n' +
    '        <div class="box-header with-border">\n' +
    '          <h3 class="box-title">Monthly Recap Report</h3>\n' +
    '          <div class="box-tools pull-right">\n' +
    '            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>\n' +
    '            </button>\n' +
    '            <div class="btn-group">\n' +
    '              <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">\n' +
    '                <i class="fa fa-wrench"></i></button>\n' +
    '              <ul class="dropdown-menu" role="menu">\n' +
    '                <li><a href="#">Action</a></li>\n' +
    '                <li><a href="#">Another action</a></li>\n' +
    '                <li><a href="#">Something else here</a></li>\n' +
    '                <li class="divider"></li>\n' +
    '                <li><a href="#">Separated link</a></li>\n' +
    '              </ul>\n' +
    '            </div>\n' +
    '            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>\n' +
    '          </div>\n' +
    '        </div>\n' +
    '        <div class="box-body">\n' +
    '          <div class="row">\n' +
    '            <div class="col-md-8">\n' +
    '              <p class="text-center">\n' +
    '                <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>\n' +
    '              </p>\n' +
    '              <div class="chart">\n' +
    '                <canvas id="line" class="chart chart-line" chart-data="data" chart-labels="labels" chart-legend="false" chart-series="series" chart-click="onClick" style="height: 180px;">\n' +
    '                </canvas>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="col-md-4">\n' +
    '              <p class="text-center">\n' +
    '                <strong>Goal Completion</strong>\n' +
    '              </p>\n' +
    '              <div class="progress-group">\n' +
    '                <span class="progress-text">Add Products to Cart</span>\n' +
    '                <span class="progress-number"><b>160</b>/200</span>\n' +
    '                <div class="progress sm">\n' +
    '                  <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>\n' +
    '                </div>\n' +
    '              </div>\n' +
    '              <div class="progress-group">\n' +
    '                <span class="progress-text">Complete Purchase</span>\n' +
    '                <span class="progress-number"><b>310</b>/400</span>\n' +
    '                <div class="progress sm">\n' +
    '                  <div class="progress-bar progress-bar-red" style="width: 80%"></div>\n' +
    '                </div>\n' +
    '              </div>\n' +
    '              <div class="progress-group">\n' +
    '                <span class="progress-text">Visit Premium Page</span>\n' +
    '                <span class="progress-number"><b>480</b>/800</span>\n' +
    '                <div class="progress sm">\n' +
    '                  <div class="progress-bar progress-bar-green" style="width: 80%"></div>\n' +
    '                </div>\n' +
    '              </div>\n' +
    '              <div class="progress-group">\n' +
    '                <span class="progress-text">Send Inquiries</span>\n' +
    '                <span class="progress-number"><b>250</b>/500</span>\n' +
    '                <div class="progress sm">\n' +
    '                  <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>\n' +
    '                </div>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '          </div>\n' +
    '        </div>\n' +
    '        <div class="box-footer">\n' +
    '          <div class="row">\n' +
    '            <div class="col-sm-3 col-xs-6">\n' +
    '              <div class="description-block border-right">\n' +
    '                <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>\n' +
    '                <h5 class="description-header">$35,210.43</h5>\n' +
    '                <span class="description-text">TOTAL REVENUE</span>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="col-sm-3 col-xs-6">\n' +
    '              <div class="description-block border-right">\n' +
    '                <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>\n' +
    '                <h5 class="description-header">$10,390.90</h5>\n' +
    '                <span class="description-text">TOTAL COST</span>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="col-sm-3 col-xs-6">\n' +
    '              <div class="description-block border-right">\n' +
    '                <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>\n' +
    '                <h5 class="description-header">$24,813.53</h5>\n' +
    '                <span class="description-text">TOTAL PROFIT</span>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="col-sm-3 col-xs-6">\n' +
    '              <div class="description-block">\n' +
    '                <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>\n' +
    '                <h5 class="description-header">1200</h5>\n' +
    '                <span class="description-text">GOAL COMPLETIONS</span>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '          </div>\n' +
    '        </div>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '  </div>\n' +
    '  <div class="row">\n' +
    '    <div class="col-md-8">\n' +
    '      <div class="row">\n' +
    '        <div class="col-md-6">\n' +
    '          <div class="box box-warning direct-chat direct-chat-warning">\n' +
    '            <div class="box-header with-border">\n' +
    '              <h3 class="box-title">Direct Chat</h3>\n' +
    '              <div class="box-tools pull-right">\n' +
    '                <span data-toggle="tooltip" title="3 New Messages" class="badge bg-yellow">3</span>\n' +
    '                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>\n' +
    '                </button>\n' +
    '                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">\n' +
    '                  <i class="fa fa-comments"></i></button>\n' +
    '                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>\n' +
    '                </button>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="box-body">\n' +
    '              <!-- <div class="direct-chat-messages">\n' +
    '                <div class="direct-chat-msg">\n' +
    '                  <div class="direct-chat-info clearfix">\n' +
    '                    <span class="direct-chat-name pull-left">Alexander Pierce</span>\n' +
    '                    <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>\n' +
    '                  </div>\n' +
    '                  <img class="direct-chat-img" src="/img/user1-128x128.jpg" alt="message user image">\n' +
    '                  <div class="direct-chat-text">\n' +
    '                    Is this template really for free? That\'s unbelievable!\n' +
    '                  </div>\n' +
    '                </div>\n' +
    '                <div class="direct-chat-msg right">\n' +
    '                  <div class="direct-chat-info clearfix">\n' +
    '                    <span class="direct-chat-name pull-right">Sarah Bullock</span>\n' +
    '                    <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>\n' +
    '                  </div>\n' +
    '                  <img class="direct-chat-img" src="/img/user3-128x128.jpg" alt="message user image">\n' +
    '                  <div class="direct-chat-text">\n' +
    '                    You better believe it!\n' +
    '                  </div>\n' +
    '                </div>\n' +
    '                <div class="direct-chat-msg">\n' +
    '                  <div class="direct-chat-info clearfix">\n' +
    '                    <span class="direct-chat-name pull-left">Alexander Pierce</span>\n' +
    '                    <span class="direct-chat-timestamp pull-right">23 Jan 5:37 pm</span>\n' +
    '                  </div>\n' +
    '                  <img class="direct-chat-img" src="/img/user1-128x128.jpg" alt="message user image">\n' +
    '                  <div class="direct-chat-text">\n' +
    '                    Working with AdminLTE on a great new app! Wanna join?\n' +
    '                  </div>\n' +
    '                </div>\n' +
    '                <div class="direct-chat-msg right">\n' +
    '                  <div class="direct-chat-info clearfix">\n' +
    '                    <span class="direct-chat-name pull-right">Sarah Bullock</span>\n' +
    '                    <span class="direct-chat-timestamp pull-left">23 Jan 6:10 pm</span>\n' +
    '                  </div>\n' +
    '                  <img class="direct-chat-img" src="/img/user3-128x128.jpg" alt="message user image">\n' +
    '                  <div class="direct-chat-text">\n' +
    '                    I would love to.\n' +
    '                  </div>\n' +
    '                </div>\n' +
    '              </div> -->\n' +
    '              <!-- <div class="direct-chat-contacts">\n' +
    '                <ul class="contacts-list">\n' +
    '                  <li>\n' +
    '                    <a href="#">\n' +
    '                      <img class="contacts-list-img" src="/img/user1-128x128.jpg" alt="User Image">\n' +
    '                      <div class="contacts-list-info">\n' +
    '                        <span class="contacts-list-name">\n' +
    '                              Count Dracula\n' +
    '                              <small class="contacts-list-date pull-right">2/28/2015</small>\n' +
    '                            </span>\n' +
    '                        <span class="contacts-list-msg">How have you been? I was...</span>\n' +
    '                      </div>\n' +
    '                    </a>\n' +
    '                  </li>\n' +
    '                  <li>\n' +
    '                    <a href="#">\n' +
    '                      <img class="contacts-list-img" src="/img/user7-128x128.jpg" alt="User Image">\n' +
    '                      <div class="contacts-list-info">\n' +
    '                        <span class="contacts-list-name">\n' +
    '                              Sarah Doe\n' +
    '                              <small class="contacts-list-date pull-right">2/23/2015</small>\n' +
    '                            </span>\n' +
    '                        <span class="contacts-list-msg">I will be waiting for...</span>\n' +
    '                      </div>\n' +
    '                    </a>\n' +
    '                  </li>\n' +
    '                  <li>\n' +
    '                    <a href="#">\n' +
    '                      <img class="contacts-list-img" src="/img/user3-128x128.jpg" alt="User Image">\n' +
    '                      <div class="contacts-list-info">\n' +
    '                        <span class="contacts-list-name">\n' +
    '                              Nadia Jolie\n' +
    '                              <small class="contacts-list-date pull-right">2/20/2015</small>\n' +
    '                            </span>\n' +
    '                        <span class="contacts-list-msg">I\'ll call you back at...</span>\n' +
    '                      </div>\n' +
    '                    </a>\n' +
    '                  </li>\n' +
    '                  <li>\n' +
    '                    <a href="#">\n' +
    '                      <img class="contacts-list-img" src="/img/user5-128x128.jpg" alt="User Image">\n' +
    '                      <div class="contacts-list-info">\n' +
    '                        <span class="contacts-list-name">\n' +
    '                              Nora S. Vans\n' +
    '                              <small class="contacts-list-date pull-right">2/10/2015</small>\n' +
    '                            </span>\n' +
    '                        <span class="contacts-list-msg">Where is your new...</span>\n' +
    '                      </div>\n' +
    '                    </a>\n' +
    '                  </li>\n' +
    '                  <li>\n' +
    '                    <a href="#">\n' +
    '                      <img class="contacts-list-img" src="/img/user6-128x128.jpg" alt="User Image">\n' +
    '                      <div class="contacts-list-info">\n' +
    '                        <span class="contacts-list-name">\n' +
    '                              John K.\n' +
    '                              <small class="contacts-list-date pull-right">1/27/2015</small>\n' +
    '                            </span>\n' +
    '                        <span class="contacts-list-msg">Can I take a look at...</span>\n' +
    '                      </div>\n' +
    '                    </a>\n' +
    '                  </li>\n' +
    '                  <li>\n' +
    '                    <a href="#">\n' +
    '                      <img class="contacts-list-img" src="/img/user8-128x128.jpg" alt="User Image">\n' +
    '                      <div class="contacts-list-info">\n' +
    '                        <span class="contacts-list-name">\n' +
    '                              Kenneth M.\n' +
    '                              <small class="contacts-list-date pull-right">1/4/2015</small>\n' +
    '                            </span>\n' +
    '                        <span class="contacts-list-msg">Never mind I found...</span>\n' +
    '                      </div>\n' +
    '                    </a>\n' +
    '                  </li>\n' +
    '                </ul>\n' +
    '              </div> -->\n' +
    '            </div>\n' +
    '            <div class="box-footer">\n' +
    '              <form action="#" method="post">\n' +
    '                <div class="input-group">\n' +
    '                  <input type="text" name="message" placeholder="Type Message ..." class="form-control">\n' +
    '                  <span class="input-group-btn">\n' +
    '                        <button type="button" class="btn btn-warning btn-flat">Send</button>\n' +
    '                      </span>\n' +
    '                </div>\n' +
    '              </form>\n' +
    '            </div>\n' +
    '          </div>\n' +
    '        </div>\n' +
    '        <div class="col-md-6">\n' +
    '          <div class="box box-danger">\n' +
    '            <div class="box-header with-border">\n' +
    '              <h3 class="box-title">Latest Members</h3>\n' +
    '              <div class="box-tools pull-right">\n' +
    '                <span class="label label-danger">8 New Members</span>\n' +
    '                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>\n' +
    '                </button>\n' +
    '                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>\n' +
    '                </button>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="box-body no-padding">\n' +
    '              <ul class="users-list clearfix">\n' +
    '                <li>\n' +
    '                  <img src="/img/user1-128x128.jpg" alt="User Image">\n' +
    '                  <a class="users-list-name" href="#">Alexander Pierce</a>\n' +
    '                  <span class="users-list-date">Today</span>\n' +
    '                </li>\n' +
    '                <li>\n' +
    '                  <img src="/img/user8-128x128.jpg" alt="User Image">\n' +
    '                  <a class="users-list-name" href="#">Norman</a>\n' +
    '                  <span class="users-list-date">Yesterday</span>\n' +
    '                </li>\n' +
    '                <li>\n' +
    '                  <img src="/img/user7-128x128.jpg" alt="User Image">\n' +
    '                  <a class="users-list-name" href="#">Jane</a>\n' +
    '                  <span class="users-list-date">12 Jan</span>\n' +
    '                </li>\n' +
    '                <li>\n' +
    '                  <img src="/img/user6-128x128.jpg" alt="User Image">\n' +
    '                  <a class="users-list-name" href="#">John</a>\n' +
    '                  <span class="users-list-date">12 Jan</span>\n' +
    '                </li>\n' +
    '                <li>\n' +
    '                  <img src="/img/user2-160x160.jpg" alt="User Image">\n' +
    '                  <a class="users-list-name" href="#">Alexander</a>\n' +
    '                  <span class="users-list-date">13 Jan</span>\n' +
    '                </li>\n' +
    '                <li>\n' +
    '                  <img src="/img/user5-128x128.jpg" alt="User Image">\n' +
    '                  <a class="users-list-name" href="#">Sarah</a>\n' +
    '                  <span class="users-list-date">14 Jan</span>\n' +
    '                </li>\n' +
    '                <li>\n' +
    '                  <img src="/img/user4-128x128.jpg" alt="User Image">\n' +
    '                  <a class="users-list-name" href="#">Nora</a>\n' +
    '                  <span class="users-list-date">15 Jan</span>\n' +
    '                </li>\n' +
    '                <li>\n' +
    '                  <img src="/img/user3-128x128.jpg" alt="User Image">\n' +
    '                  <a class="users-list-name" href="#">Nadia</a>\n' +
    '                  <span class="users-list-date">15 Jan</span>\n' +
    '                </li>\n' +
    '              </ul>\n' +
    '            </div>\n' +
    '            <div class="box-footer text-center">\n' +
    '              <a href="javascript:void(0)" class="uppercase">View All Users</a>\n' +
    '            </div>\n' +
    '          </div>\n' +
    '        </div>\n' +
    '      </div>\n' +
    '      <div class="box box-primary">\n' +
    '        <div class="box-header with-border">\n' +
    '          <h3 class="box-title">Recently Added Products</h3>\n' +
    '          <div class="box-tools pull-right">\n' +
    '            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>\n' +
    '            </button>\n' +
    '            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>\n' +
    '          </div>\n' +
    '        </div>\n' +
    '        <div class="box-body">\n' +
    '          <ul class="products-list product-list-in-box">\n' +
    '            <li class="item">\n' +
    '              <div class="product-img">\n' +
    '                <img src="/img/default-50x50.gif" alt="Product Image">\n' +
    '              </div>\n' +
    '              <div class="product-info">\n' +
    '                <a href="javascript:void(0)" class="product-title">Samsung TV\n' +
    '                  <span class="label label-warning pull-right">$1800</span></a>\n' +
    '                <span class="product-description">\n' +
    '                      Samsung 32" 1080p 60Hz LED Smart HDTV.\n' +
    '                    </span>\n' +
    '              </div>\n' +
    '            </li>\n' +
    '            <li class="item">\n' +
    '              <div class="product-img">\n' +
    '                <img src="/img/default-50x50.gif" alt="Product Image">\n' +
    '              </div>\n' +
    '              <div class="product-info">\n' +
    '                <a href="javascript:void(0)" class="product-title">Bicycle\n' +
    '                  <span class="label label-info pull-right">$700</span></a>\n' +
    '                <span class="product-description">\n' +
    '                      26" Mongoose Dolomite Men\'s 7-speed, Navy Blue.\n' +
    '                    </span>\n' +
    '              </div>\n' +
    '            </li>\n' +
    '            <li class="item">\n' +
    '              <div class="product-img">\n' +
    '                <img src="/img/default-50x50.gif" alt="Product Image">\n' +
    '              </div>\n' +
    '              <div class="product-info">\n' +
    '                <a href="javascript:void(0)" class="product-title">Xbox One <span class="label label-danger pull-right">$350</span></a>\n' +
    '                <span class="product-description">\n' +
    '                      Xbox One Console Bundle with Halo Master Chief Collection.\n' +
    '                    </span>\n' +
    '              </div>\n' +
    '            </li>\n' +
    '            <li class="item">\n' +
    '              <div class="product-img">\n' +
    '                <img src="/img/default-50x50.gif" alt="Product Image">\n' +
    '              </div>\n' +
    '              <div class="product-info">\n' +
    '                <a href="javascript:void(0)" class="product-title">PlayStation 4\n' +
    '                  <span class="label label-success pull-right">$399</span></a>\n' +
    '                <span class="product-description">\n' +
    '                      PlayStation 4 500GB Console (PS4)\n' +
    '                    </span>\n' +
    '              </div>\n' +
    '            </li>\n' +
    '          </ul>\n' +
    '        </div>\n' +
    '        <div class="box-footer text-center">\n' +
    '          <a href="javascript:void(0)" class="uppercase">View All Products</a>\n' +
    '        </div>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '    <div class="col-md-4">\n' +
    '      <div class="info-box bg-yellow">\n' +
    '        <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>\n' +
    '        <div class="info-box-content">\n' +
    '          <span class="info-box-text">Inventory</span>\n' +
    '          <span class="info-box-number">5,200</span>\n' +
    '          <div class="progress">\n' +
    '            <div class="progress-bar" style="width: 50%"></div>\n' +
    '          </div>\n' +
    '          <span class="progress-description">\n' +
    '                50% Increase in 30 Days\n' +
    '              </span>\n' +
    '        </div>\n' +
    '      </div>\n' +
    '      <div class="info-box bg-green">\n' +
    '        <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>\n' +
    '        <div class="info-box-content">\n' +
    '          <span class="info-box-text">Mentions</span>\n' +
    '          <span class="info-box-number">92,050</span>\n' +
    '          <div class="progress">\n' +
    '            <div class="progress-bar" style="width: 20%"></div>\n' +
    '          </div>\n' +
    '          <span class="progress-description">\n' +
    '                20% Increase in 30 Days\n' +
    '              </span>\n' +
    '        </div>\n' +
    '      </div>\n' +
    '      <div class="info-box bg-red">\n' +
    '        <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>\n' +
    '        <div class="info-box-content">\n' +
    '          <span class="info-box-text">Downloads</span>\n' +
    '          <span class="info-box-number">114,381</span>\n' +
    '          <div class="progress">\n' +
    '            <div class="progress-bar" style="width: 70%"></div>\n' +
    '          </div>\n' +
    '          <span class="progress-description">\n' +
    '                70% Increase in 30 Days\n' +
    '              </span>\n' +
    '        </div>\n' +
    '      </div>\n' +
    '      <div class="info-box bg-aqua">\n' +
    '        <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>\n' +
    '        <div class="info-box-content">\n' +
    '          <span class="info-box-text">Direct Messages</span>\n' +
    '          <span class="info-box-number">163,921</span>\n' +
    '          <div class="progress">\n' +
    '            <div class="progress-bar" style="width: 40%"></div>\n' +
    '          </div>\n' +
    '          <span class="progress-description">\n' +
    '                40% Increase in 30 Days\n' +
    '              </span>\n' +
    '        </div>\n' +
    '      </div>\n' +
    '      <div class="box box-default">\n' +
    '        <div class="box-header with-border">\n' +
    '          <h3 class="box-title">Browser Usage</h3>\n' +
    '          <div class="box-tools pull-right">\n' +
    '            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>\n' +
    '            </button>\n' +
    '            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>\n' +
    '          </div>\n' +
    '        </div>\n' +
    '        <div class="box-body">\n' +
    '          <div class="row">\n' +
    '            <div class="col-md-8">\n' +
    '              <div class="chart-responsive">\n' +
    '                <canvas id="doughnut" height="200" class="chart chart-doughnut" chart-data="pieData" chart-labels="pieLabels">\n' +
    '                </canvas>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="col-md-4">\n' +
    '              <ul class="chart-legend clearfix">\n' +
    '                <li><i class="fa fa-circle-o text-red"></i> Chrome</li>\n' +
    '                <li><i class="fa fa-circle-o text-green"></i> IE</li>\n' +
    '                <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>\n' +
    '                <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>\n' +
    '                <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>\n' +
    '                <li><i class="fa fa-circle-o text-gray"></i> Navigator</li>\n' +
    '              </ul>\n' +
    '            </div>\n' +
    '          </div>\n' +
    '        </div>\n' +
    '        <div class="box-footer no-padding">\n' +
    '          <ul class="nav nav-pills nav-stacked">\n' +
    '            <li><a href="#">United States of America\n' +
    '              <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>\n' +
    '            <li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a>\n' +
    '            </li>\n' +
    '            <li><a href="#">China\n' +
    '              <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>\n' +
    '          </ul>\n' +
    '        </div>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '    <div class="col-md-12">\n' +
    '      <div class="box box-info">\n' +
    '        <div class="box-header with-border">\n' +
    '          <h3 class="box-title">Latest Orders</h3>\n' +
    '          <div class="box-tools pull-right">\n' +
    '            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>\n' +
    '            </button>\n' +
    '            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>\n' +
    '          </div>\n' +
    '        </div>\n' +
    '        <div class="box-body">\n' +
    '          <div class="table-responsive">\n' +
    '            <table class="table no-margin">\n' +
    '              <thead>\n' +
    '                <tr>\n' +
    '                  <th>Order ID</th>\n' +
    '                  <th>Item</th>\n' +
    '                  <th>Status</th>\n' +
    '                  <th>Popularity</th>\n' +
    '                </tr>\n' +
    '              </thead>\n' +
    '              <tbody>\n' +
    '                <tr>\n' +
    '                  <td><a href="pages/examples/invoice.html">OR9842</a></td>\n' +
    '                  <td>Call of Duty IV</td>\n' +
    '                  <td><span class="label label-success">Shipped</span></td>\n' +
    '                  <td>\n' +
    '                    <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>\n' +
    '                  </td>\n' +
    '                </tr>\n' +
    '                <tr>\n' +
    '                  <td><a href="pages/examples/invoice.html">OR1848</a></td>\n' +
    '                  <td>Samsung Smart TV</td>\n' +
    '                  <td><span class="label label-warning">Pending</span></td>\n' +
    '                  <td>\n' +
    '                    <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>\n' +
    '                  </td>\n' +
    '                </tr>\n' +
    '                <tr>\n' +
    '                  <td><a href="pages/examples/invoice.html">OR7429</a></td>\n' +
    '                  <td>iPhone 6 Plus</td>\n' +
    '                  <td><span class="label label-danger">Delivered</span></td>\n' +
    '                  <td>\n' +
    '                    <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>\n' +
    '                  </td>\n' +
    '                </tr>\n' +
    '                <tr>\n' +
    '                  <td><a href="pages/examples/invoice.html">OR7429</a></td>\n' +
    '                  <td>Samsung Smart TV</td>\n' +
    '                  <td><span class="label label-info">Processing</span></td>\n' +
    '                  <td>\n' +
    '                    <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>\n' +
    '                  </td>\n' +
    '                </tr>\n' +
    '                <tr>\n' +
    '                  <td><a href="pages/examples/invoice.html">OR1848</a></td>\n' +
    '                  <td>Samsung Smart TV</td>\n' +
    '                  <td><span class="label label-warning">Pending</span></td>\n' +
    '                  <td>\n' +
    '                    <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>\n' +
    '                  </td>\n' +
    '                </tr>\n' +
    '                <tr>\n' +
    '                  <td><a href="pages/examples/invoice.html">OR7429</a></td>\n' +
    '                  <td>iPhone 6 Plus</td>\n' +
    '                  <td><span class="label label-danger">Delivered</span></td>\n' +
    '                  <td>\n' +
    '                    <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>\n' +
    '                  </td>\n' +
    '                </tr>\n' +
    '                <tr>\n' +
    '                  <td><a href="pages/examples/invoice.html">OR9842</a></td>\n' +
    '                  <td>Call of Duty IV</td>\n' +
    '                  <td><span class="label label-success">Shipped</span></td>\n' +
    '                  <td>\n' +
    '                    <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>\n' +
    '                  </td>\n' +
    '                </tr>\n' +
    '              </tbody>\n' +
    '            </table>\n' +
    '          </div>\n' +
    '        </div>\n' +
    '        <div class="box-footer clearfix">\n' +
    '          <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>\n' +
    '          <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>\n' +
    '        </div>\n' +
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
  $templateCache.put('./views/app/components/forms-general/forms-general.component.html',
    '<section class="content-header">\n' +
    '  <h1>\n' +
    '    General Form Elements\n' +
    '    <small>Preview</small>\n' +
    '  </h1>\n' +
    '  <ol class="breadcrumb">\n' +
    '    <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i> Home</a></li>\n' +
    '    <li><a href="#">Forms</a></li>\n' +
    '    <li class="active">General Elements</li>\n' +
    '  </ol>\n' +
    '</section>\n' +
    '<section class="content">\n' +
    '  <div class="row">\n' +
    '    <div class="col-md-6">\n' +
    '      <div class="box box-primary">\n' +
    '        <div class="box-header with-border">\n' +
    '          <h3 class="box-title">Quick Example</h3>\n' +
    '        </div>\n' +
    '        <form role="form">\n' +
    '          <div class="box-body">\n' +
    '            <div class="form-group">\n' +
    '              <label for="exampleInputEmail1">Email address</label>\n' +
    '              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">\n' +
    '            </div>\n' +
    '            <div class="form-group">\n' +
    '              <label for="exampleInputPassword1">Password</label>\n' +
    '              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">\n' +
    '            </div>\n' +
    '            <div class="form-group">\n' +
    '              <label for="exampleInputFile">File input</label>\n' +
    '              <input type="file" id="exampleInputFile">\n' +
    '              <p class="help-block">Example block-level help text here.</p>\n' +
    '            </div>\n' +
    '            <div class="checkbox">\n' +
    '              <label>\n' +
    '                <input type="checkbox"> Check me out\n' +
    '              </label>\n' +
    '            </div>\n' +
    '          </div>\n' +
    '          <div class="box-footer">\n' +
    '            <button type="submit" class="btn btn-primary">Submit</button>\n' +
    '          </div>\n' +
    '        </form>\n' +
    '      </div>\n' +
    '      <div class="box box-success">\n' +
    '        <div class="box-header with-border">\n' +
    '          <h3 class="box-title">Different Height</h3>\n' +
    '        </div>\n' +
    '        <div class="box-body">\n' +
    '          <input class="form-control input-lg" type="text" placeholder=".input-lg">\n' +
    '          <br>\n' +
    '          <input class="form-control" type="text" placeholder="Default input">\n' +
    '          <br>\n' +
    '          <input class="form-control input-sm" type="text" placeholder=".input-sm">\n' +
    '        </div>\n' +
    '      </div>\n' +
    '      <div class="box box-danger">\n' +
    '        <div class="box-header with-border">\n' +
    '          <h3 class="box-title">Different Width</h3>\n' +
    '        </div>\n' +
    '        <div class="box-body">\n' +
    '          <div class="row">\n' +
    '            <div class="col-xs-3">\n' +
    '              <input type="text" class="form-control" placeholder=".col-xs-3">\n' +
    '            </div>\n' +
    '            <div class="col-xs-4">\n' +
    '              <input type="text" class="form-control" placeholder=".col-xs-4">\n' +
    '            </div>\n' +
    '            <div class="col-xs-5">\n' +
    '              <input type="text" class="form-control" placeholder=".col-xs-5">\n' +
    '            </div>\n' +
    '          </div>\n' +
    '        </div>\n' +
    '      </div>\n' +
    '      <div class="box box-info">\n' +
    '        <div class="box-header with-border">\n' +
    '          <h3 class="box-title">Input Addon</h3>\n' +
    '        </div>\n' +
    '        <div class="box-body">\n' +
    '          <div class="input-group">\n' +
    '            <span class="input-group-addon">@</span>\n' +
    '            <input type="text" class="form-control" placeholder="Username">\n' +
    '          </div>\n' +
    '          <br>\n' +
    '          <div class="input-group">\n' +
    '            <input type="text" class="form-control">\n' +
    '            <span class="input-group-addon">.00</span>\n' +
    '          </div>\n' +
    '          <br>\n' +
    '          <div class="input-group">\n' +
    '            <span class="input-group-addon">$</span>\n' +
    '            <input type="text" class="form-control">\n' +
    '            <span class="input-group-addon">.00</span>\n' +
    '          </div>\n' +
    '          <h4>With icons</h4>\n' +
    '          <div class="input-group">\n' +
    '            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>\n' +
    '            <input type="email" class="form-control" placeholder="Email">\n' +
    '          </div>\n' +
    '          <br>\n' +
    '          <div class="input-group">\n' +
    '            <input type="text" class="form-control">\n' +
    '            <span class="input-group-addon"><i class="fa fa-check"></i></span>\n' +
    '          </div>\n' +
    '          <br>\n' +
    '          <div class="input-group">\n' +
    '            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>\n' +
    '            <input type="text" class="form-control">\n' +
    '            <span class="input-group-addon"><i class="fa fa-ambulance"></i></span>\n' +
    '          </div>\n' +
    '          <h4>With checkbox and radio inputs</h4>\n' +
    '          <div class="row">\n' +
    '            <div class="col-lg-6">\n' +
    '              <div class="input-group">\n' +
    '                <span class="input-group-addon">\n' +
    '                          <input type="checkbox">\n' +
    '                        </span>\n' +
    '                <input type="text" class="form-control">\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="col-lg-6">\n' +
    '              <div class="input-group">\n' +
    '                <span class="input-group-addon">\n' +
    '                          <input type="radio">\n' +
    '                        </span>\n' +
    '                <input type="text" class="form-control">\n' +
    '              </div>\n' +
    '            </div>\n' +
    '          </div>\n' +
    '          <h4>With buttons</h4>\n' +
    '          <p class="margin">Large: <code>.input-group.input-group-lg</code></p>\n' +
    '          <div class="input-group input-group-lg">\n' +
    '            <div class="input-group-btn">\n' +
    '              <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Action\n' +
    '                <span class="fa fa-caret-down"></span></button>\n' +
    '              <ul class="dropdown-menu">\n' +
    '                <li><a href="#">Action</a></li>\n' +
    '                <li><a href="#">Another action</a></li>\n' +
    '                <li><a href="#">Something else here</a></li>\n' +
    '                <li class="divider"></li>\n' +
    '                <li><a href="#">Separated link</a></li>\n' +
    '              </ul>\n' +
    '            </div>\n' +
    '            <input type="text" class="form-control">\n' +
    '          </div>\n' +
    '          <p class="margin">Normal</p>\n' +
    '          <div class="input-group">\n' +
    '            <div class="input-group-btn">\n' +
    '              <button type="button" class="btn btn-danger">Action</button>\n' +
    '            </div>\n' +
    '            <input type="text" class="form-control">\n' +
    '          </div>\n' +
    '          <p class="margin">Small <code>.input-group.input-group-sm</code></p>\n' +
    '          <div class="input-group input-group-sm">\n' +
    '            <input type="text" class="form-control">\n' +
    '            <span class="input-group-btn"><button type="button" class="btn btn-info btn-flat">Go!</button></span>\n' +
    '          </div>\n' +
    '        </div>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '    <div class="col-md-6">\n' +
    '      <div class="box box-info">\n' +
    '        <div class="box-header with-border">\n' +
    '          <h3 class="box-title">Horizontal Form</h3>\n' +
    '        </div>\n' +
    '        <form class="form-horizontal">\n' +
    '          <div class="box-body">\n' +
    '            <div class="form-group">\n' +
    '              <label for="inputEmail3" class="col-sm-2 control-label">Email</label>\n' +
    '              <div class="col-sm-10">\n' +
    '                <input type="email" class="form-control" id="inputEmail3" placeholder="Email">\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="form-group">\n' +
    '              <label for="inputPassword3" class="col-sm-2 control-label">Password</label>\n' +
    '              <div class="col-sm-10">\n' +
    '                <input type="password" class="form-control" id="inputPassword3" placeholder="Password">\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="form-group">\n' +
    '              <div class="col-sm-offset-2 col-sm-10">\n' +
    '                <div class="checkbox">\n' +
    '                  <label>\n' +
    '                    <input type="checkbox"> Remember me\n' +
    '                  </label>\n' +
    '                </div>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '          </div>\n' +
    '          <div class="box-footer">\n' +
    '            <button type="submit" class="btn btn-default">Cancel</button>\n' +
    '            <button type="submit" class="btn btn-info pull-right">Sign in</button>\n' +
    '          </div>\n' +
    '        </form>\n' +
    '      </div>\n' +
    '      <div class="box box-warning">\n' +
    '        <div class="box-header with-border">\n' +
    '          <h3 class="box-title">General Elements</h3>\n' +
    '        </div>\n' +
    '        <div class="box-body">\n' +
    '          <form role="form">\n' +
    '            <div class="form-group">\n' +
    '              <label>Text</label>\n' +
    '              <input type="text" class="form-control" placeholder="Enter ...">\n' +
    '            </div>\n' +
    '            <div class="form-group">\n' +
    '              <label>Text Disabled</label>\n' +
    '              <input type="text" class="form-control" placeholder="Enter ..." disabled>\n' +
    '            </div>\n' +
    '            <div class="form-group">\n' +
    '              <label>Textarea</label>\n' +
    '              <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>\n' +
    '            </div>\n' +
    '            <div class="form-group">\n' +
    '              <label>Textarea Disabled</label>\n' +
    '              <textarea class="form-control" rows="3" placeholder="Enter ..." disabled></textarea>\n' +
    '            </div>\n' +
    '            <div class="form-group has-success">\n' +
    '              <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Input with success</label>\n' +
    '              <input type="text" class="form-control" id="inputSuccess" placeholder="Enter ...">\n' +
    '              <span class="help-block">Help block with success</span>\n' +
    '            </div>\n' +
    '            <div class="form-group has-warning">\n' +
    '              <label class="control-label" for="inputWarning"><i class="fa fa-bell-o"></i> Input with warning\n' +
    '              </label>\n' +
    '              <input type="text" class="form-control" id="inputWarning" placeholder="Enter ...">\n' +
    '              <span class="help-block">Help block with warning</span>\n' +
    '            </div>\n' +
    '            <div class="form-group has-error">\n' +
    '              <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Input with error\n' +
    '              </label>\n' +
    '              <input type="text" class="form-control" id="inputError" placeholder="Enter ...">\n' +
    '              <span class="help-block">Help block with error</span>\n' +
    '            </div>\n' +
    '            <div class="form-group">\n' +
    '              <div class="checkbox">\n' +
    '                <label>\n' +
    '                  <input type="checkbox"> Checkbox 1\n' +
    '                </label>\n' +
    '              </div>\n' +
    '              <div class="checkbox">\n' +
    '                <label>\n' +
    '                  <input type="checkbox"> Checkbox 2\n' +
    '                </label>\n' +
    '              </div>\n' +
    '              <div class="checkbox">\n' +
    '                <label>\n' +
    '                  <input type="checkbox" disabled> Checkbox disabled\n' +
    '                </label>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="form-group">\n' +
    '              <div class="radio">\n' +
    '                <label>\n' +
    '                  <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked> Option one is this and that&mdash;be sure to include why it\'s great\n' +
    '                </label>\n' +
    '              </div>\n' +
    '              <div class="radio">\n' +
    '                <label>\n' +
    '                  <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2"> Option two can be something else and selecting it will deselect option one\n' +
    '                </label>\n' +
    '              </div>\n' +
    '              <div class="radio">\n' +
    '                <label>\n' +
    '                  <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" disabled> Option three is disabled\n' +
    '                </label>\n' +
    '              </div>\n' +
    '            </div>\n' +
    '            <div class="form-group">\n' +
    '              <label>Select</label>\n' +
    '              <select class="form-control">\n' +
    '                <option>option 1</option>\n' +
    '                <option>option 2</option>\n' +
    '                <option>option 3</option>\n' +
    '                <option>option 4</option>\n' +
    '                <option>option 5</option>\n' +
    '              </select>\n' +
    '            </div>\n' +
    '            <div class="form-group">\n' +
    '              <label>Select Disabled</label>\n' +
    '              <select class="form-control" disabled>\n' +
    '                <option>option 1</option>\n' +
    '                <option>option 2</option>\n' +
    '                <option>option 3</option>\n' +
    '                <option>option 4</option>\n' +
    '                <option>option 5</option>\n' +
    '              </select>\n' +
    '            </div>\n' +
    '            <div class="form-group">\n' +
    '              <label>Select Multiple</label>\n' +
    '              <select multiple class="form-control">\n' +
    '                <option>option 1</option>\n' +
    '                <option>option 2</option>\n' +
    '                <option>option 3</option>\n' +
    '                <option>option 4</option>\n' +
    '                <option>option 5</option>\n' +
    '              </select>\n' +
    '            </div>\n' +
    '            <div class="form-group">\n' +
    '              <label>Select Multiple Disabled</label>\n' +
    '              <select multiple class="form-control" disabled>\n' +
    '                <option>option 1</option>\n' +
    '                <option>option 2</option>\n' +
    '                <option>option 3</option>\n' +
    '                <option>option 4</option>\n' +
    '                <option>option 5</option>\n' +
    '              </select>\n' +
    '            </div>\n' +
    '          </form>\n' +
    '        </div>\n' +
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
    '              <li><a ui-sref=\'app.cus0110\'><i class="fa fa-cart-plus fa-fw"></i>Tạo đơn hàng</a></li>\n' +
    '            </ul>\n' +
    '          </li>\n' +
    '        \n' +
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
    '            <!-- <li class="user-body">\n' +
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
    '            </li> -->\n' +
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
    '<aside class="main-sidebar">\n' +
    '  <section class="sidebar">\n' +
    '    <form action="#" method="get" class="sidebar-form">\n' +
    '      <div class="input-group">\n' +
    '        <input type="text" name="q" class="form-control" placeholder="Search...">\n' +
    '        <span class="input-group-btn">\n' +
    '          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>\n' +
    '          </button>\n' +
    '        </span>\n' +
    '      </div>\n' +
    '    </form>\n' +
    '\n' +
    '    <ul class="sidebar-menu"> \n' +
    '      <li>\n' +
    '        <a ui-sref=\'app.landing\'>\n' +
    '          <i class="fa fa-dashboard"></i> <span>Dashboard</span>\n' +
    '        </a>\n' +
    '      </li>\n' +
    '      <li class="header">Quản lý đặt hàng</li>\n' +
    '      <li>\n' +
    '        <a ui-sref=\'app.cus0110\'>\n' +
    '          <i class="fa fa-shopping-cart fa-fw"></i> <span>Đặt hàng</span>\n' +
    '        </a>\n' +
    '        <!-- <a ui-sref=\'app.cus0100\'>\n' +
    '          <i class="fa fa-book fa-fw"></i> <span>Lịch sử dặt hàng</span>\n' +
    '        </a> -->\n' +
    '      </li>\n' +
    '    </ul>\n' +
    '\n' +
    '  </section>\n' +
    '</aside>\n' +
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
  $templateCache.put('./views/app/pages/footer/footer.page.html',
    '<footer class="main-footer">\n' +
    '  <div class="pull-right hidden-xs">\n' +
    '    <b>Version</b> 0.1\n' +
    '  </div>\n' +
    '  <strong>Copyright &copy; {{\'\' | currentdate | date: \'yyyy\' }} <a href="http://www.phankhangco.com">Phan Khang Home</a>.</strong> All rights reserved.\n' +
    '</footer>\n' +
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
  $templateCache.put('./views/app/pages/header/header.page.html',
    '<nav-header></nav-header>\n' +
    '<nav-sidebar></nav-sidebar>');
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
    '<section class="content-header">\n' +
    '  <h1>\n' +
    '    Dashboard\n' +
    '    <small>Version 2.0</small>\n' +
    '  </h1>\n' +
    '  <ol class="breadcrumb">\n' +
    '    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>\n' +
    '    <li class="active">Dashboard</li>\n' +
    '  </ol>\n' +
    '</section>\n' +
    '<dashboard></dashboard>\n' +
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
    '  <div class="login-logo">\n' +
    '    <a ui-sref="login"><b>Phan Khang Home</b> Portal</a>\n' +
    '  </div>\n' +
    '  <div class="login-box-body">\n' +
    '    <div class="row">\n' +
    '      <div class="col-xs-12">\n' +
    '        <div class="text-center">\n' +
    '          <h3>Sign in</h3>\n' +
    '        </div>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '    <div class="row">\n' +
    '      <div class="col-xs-12">\n' +
    '        <login-form></login-form>\n' +
    '      </div>\n' +
    '    </div>\n' +
    '  </div>\n' +
    '  <div class="row">\n' +
    '      <div class="col-xs-12">\n' +
    '        <div class="text-center">\n' +
    '          Copyright &copy; 2016 <strong><a href="http://www.phankhangco.com">Phan Khang Home</a>.</strong> All rights reserved.\n' +
    '        </div>\n' +
    '      </div>\n' +
    '    </div>\n' +
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
