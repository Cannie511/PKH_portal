<section class="content-header">
    <h1>Danh sách phiếu xuất<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Danh sách {{vm.m[vm.m.activeFlag].title}}</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li ng-class="{'active': vm.m.activeFlag == 2}"><a href="javascript:void(0)" ng-click="vm.chooseTab(2)"><h4>Mới&nbsp;<small class="label label-success pull-right" ng-if="vm.m[2].data.total > 0">{{vm.m[2].data.total}}</small></h4></a></li>
                    <li ng-class="{'active': vm.m.activeFlag == 3}"><a href="javascript:void(0)" ng-click="vm.chooseTab(3)"><h4>Đóng gói&nbsp;<small class="label label-success pull-right" ng-if="vm.m[3].data.total> 0">{{vm.m[3].data.total}}</small></h4></a></li>   
                    <li ng-class="{'active': vm.m.activeFlag == 4}"><a href="javascript:void(0)" ng-click="vm.chooseTab(4)"><h4>Xác nhận&nbsp;<small class="label label-success pull-right" ng-if="vm.m[4].data.total > 0">{{vm.m[4].data.total}}</small></h4></a></li>   
                    <li ng-class="{'active': vm.m.activeFlag == 5}"><a href="javascript:void(0)" ng-click="vm.chooseTab(5)"><h4>Xuất kho&nbsp;<small class="label label-success pull-right" ng-if="vm.m[5].data.total > 0">{{vm.m[5].data.total}}</small></h4></a></li>   
                    <li ng-class="{'active': vm.m.activeFlag == 6}"><a href="javascript:void(0)" ng-click="vm.chooseTab(6)"><h4>Vận chuyển&nbsp;<small class="label label-success pull-right" ng-if="vm.m[6].data.total > 0">{{vm.m[6].data.total}}</small></h4></a></li>   
                    <li ng-class="{'active': vm.m.activeFlag == 7}"><a href="javascript:void(0)" ng-click="vm.chooseTab(7)"><h4>Khách nhận&nbsp;<small class="label label-success pull-right" ng-if="vm.m[7].data.total > 0">{{vm.m[7].data.total}}</small></h4></a></li>   
                    <li ng-class="{'active': vm.m.activeFlag == 8}"><a href="javascript:void(0)" ng-click="vm.chooseTab(8)"><h4>Hoàn tất&nbsp;<small class="label label-success pull-right" ng-if="vm.m[8].data.total > 0">{{vm.m[8].data.total}}</small></h4></a></li>   
                    <li ng-class="{'active': vm.m.activeFlag == 9}"><a href="javascript:void(0)" ng-click="vm.chooseTab(9)"><h4>Huỷ&nbsp;<small class="label label-success pull-right" ng-if="vm.m[9].data.total> 0">{{vm.m[9].data.total}}</small></h4></a></li>   
                    <li ng-class="{'active': vm.m.activeFlag == 10}"><a href="javascript:void(0)" ng-click="vm.chooseTab(10)"><h4>Stats&nbsp;</h4></a></li>   
                    <li ng-class="{'active': vm.m.activeFlag == 11}"><a href="javascript:void(0)" ng-click="vm.chooseTab(11)"><h4>Map&nbsp;</h4></a></li>   
                </ul>
                <div class="tab-content">
                    <div  ng-if="vm.m.activeFlag<10">
                        @include('views.admin.crm0400.crm0400_tab2')
                    </div>
                    <div  ng-if="vm.m.activeFlag==10">
                        @include('views.admin.crm0400.crm0400_tab_stats')
                    </div>
                    <div  ng-if="vm.m.activeFlag==11">
                        @include('views.admin.crm0400.crm0400_tab_map')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
