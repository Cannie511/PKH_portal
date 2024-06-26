<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="vm.cancel()"><span aria-hidden="true">&times;</span></button>
    <div class="modal-title">
        Xác nhận vận chuyển
    </div> 
</div>
<div class="modal-body">
        <div class="col-md-12">
            <label>Mã phiếu xuất</label>
            <p class="form-control-static">#{{vm.m.delivery.store_delivery_code}}(#{{vm.m.delivery.store_delivery_id}})  </p>    
        </div>
        <div class="col-md-12">
            <label>Cửa hàng</label>
            <p class="form-control-static">{{vm.m.delivery.store_name}} - {{vm.m.delivery.address2}} - {{vm.m.delivery.address1}} </p>    
        </div>
        <div class="col-md-12">
            <label>SO</label>
            <p class="form-control-static">{{vm.m.delivery.salesman_name}}  </p>    
        </div>
        <div class="col-md-12">
            <label>Chiết khấu </label>
            <p class="form-control-static">{{vm.m.delivery.discount_1}}  %</p>    
        </div>
        <div class="col-md-12">
            <label>Giá tiền trước chiết khấu </label>
            <p class="form-control-static">{{vm.m.delivery.total | currency: '' : 0}}  </p>    
        </div>
        <div class="col-md-12">
            <label>Giá tiền sau chiết khấu </label>
            <p class="form-control-static">{{vm.m.delivery.total_with_discount | currency: '' : 0}}  </p>    
        </div>
        <div class="col-md-12">
                <label>Chọn lượt giao hàng</label>
                <div >
                    <select class="form-control"     
                        chosen  
                        name ="assign"                             
                        placeholder-text-single="'chọn giao hàng'"
                        ng-model="vm.m.form.shipping_id"
                        ng-options="item.id as item.name for item in vm.m.shippingList"
                        >
                        <option value="">Nothing</option>
                    </select>

                </div>
        </div>
        
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success" data-dismiss="modal" ng-click="vm.finish()">Save</button>
</div>

