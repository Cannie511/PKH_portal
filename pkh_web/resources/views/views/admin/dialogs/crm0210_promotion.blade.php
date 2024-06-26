<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="vm.cancel()"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">
        Danh sách chương trình
    </h4>
</div>
<div class="modal-body">
    <div class="form-group">
        <label class="col-sm-3 control-label">Chương trình</label>
        <div class="col-sm-9">
            <select class="form-control"     
                chosen                               
                placeholder-text-single="'Chọn saleman'"
                ng-model="vm.m.promotion"
                ng-options="item as item.promotion_name for item in vm.m.list "
                >
                <option value="">Không có</option>
            </select>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" ng-click="vm.cancel()">Close</button>
    <button type="button" class="btn btn-primary" ng-click="vm.clickApply()">Áp dụng</button>
</div>