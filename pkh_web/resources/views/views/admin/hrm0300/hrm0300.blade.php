<section class="content-header">
    <h1>Task lists<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Task List</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li ng-class="{'active': vm.m.activeFlag == 1}"><a href="javascript:void(0)" ng-click="vm.chooseTab(1)"><h4>New&nbsp;<small class="label label-success pull-right" ng-if="vm.m.newTask.length > 0">{{vm.m.newTask.length}}</small></h4></a></li>
                    <li ng-class="{'active': vm.m.activeFlag == 2}"><a href="javascript:void(0)" ng-click="vm.chooseTab(2)"><h4>Doing&nbsp;<small class="label label-success pull-right" ng-if="vm.m.doingTask.length > 0">{{vm.m.doingTask.length}}</small></h4></a></li>   
                    <li ng-class="{'active': vm.m.activeFlag == 3}"><a href="javascript:void(0)" ng-click="vm.chooseTab(3)"><h4>Finish&nbsp;<small class="label label-success pull-right" ng-if="vm.m.finishTask.length > 0">{{vm.m.finishTask.length}}</small></h4></a></li>   
                    <li ng-class="{'active': vm.m.activeFlag == 4}"><a href="javascript:void(0)" ng-click="vm.chooseTab(4)"><h4>Scoring&nbsp;<small class="label label-success pull-right" ng-if="vm.m.doingTask.length > 0">{{vm.m.doingTask.length}}</small></h4></a></li>   
                    <li ng-class="{'active': vm.m.activeFlag == 5}"><a href="javascript:void(0)" ng-click="vm.chooseTab(5)"><h4>Report&nbsp;<small class="label label-success pull-right" ng-if="vm.m.doingTask.length > 0">{{vm.m.doingTask.length}}</small></h4></a></li>   
                </ul>
                <div class="tab-content">
                    <div ng-if=" vm.m.activeFlag == 1"> 
                        @include('views.admin.hrm0300.hrm0300_tab1')
                    </div>
                    <div ng-if=" vm.m.activeFlag == 2"> 
                        @include('views.admin.hrm0300.hrm0300_tab1')
                    </div>
                    <div ng-if=" vm.m.activeFlag == 3"> 
                        @include('views.admin.hrm0300.hrm0300_tab1')
                    </div>
                    <div ng-if=" vm.m.activeFlag == 4"> 
                         @include('views.admin.hrm0300.hrm0300_tab4')
                    </div>
                    <div ng-if=" vm.m.activeFlag == 5"> 
                        @include('views.admin.hrm0300.hrm0300_report')
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
