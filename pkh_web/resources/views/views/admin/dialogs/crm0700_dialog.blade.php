<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="vm.cancel()"><span aria-hidden="true">&times;</span></button>
    <div class="modal-title">
        Cập nhật mã kế toán cho cửa hàng - {{vm.m.store_name}}
    </div> 
</div>
<div class="modal-body">
        <label class="col-sm-2 control-label">Mã kế toán</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" ng-model="vm.m.accountant_store_id" name="tax_code" placeholder="" maxlen="32"/>
        </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success" data-dismiss="modal" ng-click="vm.update()">Save</button>
</div>

