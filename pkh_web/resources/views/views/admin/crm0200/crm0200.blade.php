<section class="content-header">
    <h1>Danh sách đơn đặt hàng<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Danh sách đơn hàng </li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li ng-class="{'active': vm.m.activeFlag == 2}"><a href="javascript:void(0)" ng-click="vm.chooseTab(2)"><h4>Mới&nbsp;<small class="label label-success pull-right" ng-if="vm.m[2].data.total > 0">{{vm.m[2].data.total}}</small></h4></a></li>
                    <li ng-class="{'active': vm.m.activeFlag == 8}"><a href="javascript:void(0)" ng-click="vm.chooseTab(8)"><h4>Sales confirm&nbsp;<small class="label label-success pull-right" ng-if="vm.m[8].data.total> 0">{{vm.m[8].data.total}}</small></h4></a></li>   
                    <li ng-class="{'active': vm.m.activeFlag == 3}"><a href="javascript:void(0)" ng-click="vm.chooseTab(3)"><h4>Đang xử lý&nbsp;<small class="label label-success pull-right" ng-if="vm.m[3].data.total> 0">{{vm.m[3].data.total}}</small></h4></a></li>   
                    <li ng-class="{'active': vm.m.activeFlag == 4}"><a href="javascript:void(0)" ng-click="vm.chooseTab(4)"><h4>Hoàn tất&nbsp;<small class="label label-success pull-right" ng-if="vm.m[4].data.total > 0">{{vm.m[4].data.total}}</small></h4></a></li>   
                    <li ng-class="{'active': vm.m.activeFlag == 5}"><a href="javascript:void(0)" ng-click="vm.chooseTab(5)"><h4>Huỷ&nbsp;<small class="label label-success pull-right" ng-if="vm.m[5].data.total > 0">{{vm.m[5].data.total}}</small></h4></a></li>   
                    <li ng-class="{'active': vm.m.activeFlag == 6}"><a href="javascript:void(0)" ng-click="vm.chooseTab(6)"><h4>Huỷ hàng còn&nbsp;<small class="label label-success pull-right" ng-if="vm.m[6].data.total > 0">{{vm.m[6].data.total}}</small></h4></a></li>   
                </ul>
                <div class="tab-content">
                    @include('views.admin.crm0200.crm0200_tab')
                </div>
            </div>
        </div>
    </div>
</section>
