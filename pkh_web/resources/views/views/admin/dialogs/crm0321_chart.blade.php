<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="vm.cancel()"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">
        {{vm.m.item.store_name}} <small>{{vm.m.item.salesman_name}}</small><br/>
        <small>{{vm.m.item.area_group_name}} - {{vm.m.item.area1_name}} {{vm.m.item.area2_name}} - {{vm.m.item.address}}</small>
    </h4>
</div>
<div class="modal-body">
    <amchart id="myFirstChart" options="vm.m.amChartOptions" height="400" width="100%"></amchart>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" ng-click="vm.cancel()">Close</button>
</div>