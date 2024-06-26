<section class="content-header">
    <h1>Danh sách xuất nhập giữa các kho<small></small></h1>
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
                    <li ng-class="{'active': vm.m.activeFlag == 1}"><a href="javascript:void(0)" ng-click="vm.chooseTab(1)"><h4>Xuất&nbsp;<small class="label label-success pull-right" ng-if="vm.m[1].data.total > 0">{{vm.m[1].data.total}}</small></h4></a></li>
                    <!-- <li ng-class="{'active': vm.m.activeFlag == 2}"><a href="javascript:void(0)" ng-click="vm.chooseTab(2)"><h4>Nhập&nbsp;<small class="label label-success pull-right" ng-if="vm.m[2].data.total> 0">{{vm.m[2].data.total}}</small></h4></a></li>    -->
                </ul>
                <div class="tab-content">
                    @include('views.admin.crm2300.crm2300_tab')
                  
                
                </div>
            </div>
            
        </div>
    </div>
</section>
