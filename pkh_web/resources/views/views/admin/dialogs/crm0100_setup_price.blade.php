<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="vm.cancel()"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Thiết lập giá</h4>
</div>
<div class="modal-body">
    <form role="form">
        <div class="form-group">
            <label for="month">Mã SP</label>
            <p class="form-control-static">{{vm.m.product.product_code}}</p>
        </div>
        <div class="form-group">
            <label for="month">Tên</label>
            <p class="form-control-static">{{vm.m.product.product_name}}</p>
        </div>
        <div class="form-group">
            <label for="month">Mã nhà máy</label>
            <p class="form-control-static">{{vm.m.product.supplier_code}} - {{vm.m.product.supplier_name}}</p>
        </div>
        
        <div class="form-group" ng-class="{'has-error': vm.m.errors['selling_price'].length > 0}">
            <label>Giá bán ({{vm.m.form.selling_price | currency : '' : 0 }})</label>
            <input type="text" ng-model="vm.m.form.selling_price" class="form-control"/>
            <span class="help-block" ng-repeat="(i, err) in vm.m.errors['selling_price']">{{err}}</span>
        </div>

      
        <div class="form-group" ng-class="{'has-error': vm.m.errors['import_price'].length > 0}">
            <label>Giá nhập ({{vm.m.form.import_price | currency : '' : 0 }})</label>
            <input type="text" ng-model="vm.m.form.import_price" class="form-control"/>
            <span class="help-block" ng-repeat="(i, err) in vm.m.errors['import_price']">{{err}}</span>
        </div>

    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" ng-click="vm.cancel()">Close</button>
    <button type="button" class="btn btn-warning" ng-click="vm.save()"><i class="fa fa-save fa-fw"></i>Lưu</button>
</div>