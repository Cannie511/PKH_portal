<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="vm.cancel()"><span aria-hidden="true">&times;</span></button>
    <div class="modal-title">
        {{vm.m.item.name}}<br>
        <small>{{vm.m.item.address}}</small>
    </div>
</div>
<div class="modal-body">
    <div class="form-group">
        <label class="col-sm-3 control-label">Chọn sale phụ trách</label>
        <div class="col-sm-9">
            <select class="form-control"     
                chosen                               
                placeholder-text-single="'Chọn saleman'"
                ng-model="vm.m.chosenSale"
                ng-options="item.id as item.name for item in vm.m.salesman "
                >
                <option value="">Không có sale</option>
            </select>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success" data-dismiss="modal" ng-click="vm.cancel()">Save</button>
</div>