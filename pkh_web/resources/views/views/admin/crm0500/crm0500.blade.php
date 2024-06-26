<section class="content-header">
    <h1>Customer Service<small></small></h1>
</section>
<section class="content">
<div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li ng-class="{'active': vm.m.activeFlag == 1}"><a href="javascript:void(0)" ng-click="vm.chooseTab(1)"><h4>Pending&nbsp;<small class="label label-success pull-right" ng-if="vm.m[1].data.total > 0">{{vm.m[1].data.total}}</small></h4></a></li>
                    <li ng-class="{'active': vm.m.activeFlag == 2}"><a href="javascript:void(0)" ng-click="vm.chooseTab(2)"><h4>Done&nbsp;<small class="label label-success pull-right" ng-if="vm.m[2].data.total> 0">{{vm.m[2].data.total}}</small></h4></a></li>   
               </ul>
                <div class="tab-content">
                    @include('views.admin.crm0500.crm0500_tab')
                </div>
            </div>
        </div>
    </div>
</section>
