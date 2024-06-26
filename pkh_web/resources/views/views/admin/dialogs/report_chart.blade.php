<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="vm.cancel()"><span aria-hidden="true">&times;</span></button>
    <div class="modal-title">
        <!--div ng-repeat='item in vm.m.descript'> 
            <p>{{item.name }}: {{item.quantity}}</p>
        </div-->
    </div>
</div>
<div class="modal-body">
    <!-- <div ng-repeat ='item in vm.m.id_charts' >
        <amchart id="vm.m.id_charts[$index]" options="vm.m.amChartOptions[$index]" height="400" width="100%"></amchart>
    </div> -->
    <amchart id="Chart0" options="vm.m.amChartOptions[0]" height="500" width="100%"></amchart>
    <amchart id="Chart1" options="vm.m.amChartOptions[1]" height="500" width="100%"></amchart>
    <amchart id="Chart2" options="vm.m.amChartOptions[2]" height="500" width="100%"></amchart>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" ng-click="vm.cancel()">Close</button>
</div>