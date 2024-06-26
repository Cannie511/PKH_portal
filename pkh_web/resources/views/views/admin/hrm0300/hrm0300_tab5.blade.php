<div class="tab-pane" ng-class="{'active': vm.m.activeFlag == 4}">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Task Schedule</h3>
            
        </div>
    </div>
    <div class="box-body form">
        <div class="box-body">
            <div ui-calendar="vm.uiConfig.calendar" ng-model="vm.eventSources"></div>
        </div>
       
    </div>
</div>
                