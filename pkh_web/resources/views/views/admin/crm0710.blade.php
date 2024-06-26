<section class="content-header">
    <h1>Tạo đơn đặt hàng <small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm1300">Danh sách đơn hàng </a></li>
        <li class="active">Tạo đơn hàng</li>
    </ol>
</section>

        

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Thông tin khách hàng</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
        </div>
    </div>
    <div class="box-body" ng-if="vm.m.store">
        <div class="row" >
            <div class="col-md-12">
                <label>Mã Khách hàng</label>
                <p class="form-control-static"><a ui-sref='app.crm2600({store_id: vm.m.store_id})'>#{{vm.m.store.store_id}}</a></p>
            </div>
            <div class="col-md-12" >
                <label>Tên Khách hàng</label>
                <p class="form-control-static">{{item.store_id}}</p>
            </div>
            
            <div class="col-md-12">
                <label>Địa chỉ</label>
                <p class="form-control-static">{{vm.m.store.address}}</p>
            </div>
         
            <div class="col-md-12">
                <label>Discount</label>
                <p class="form-control-static">{{vm.m.store.discount}}</p>
            </div>
            
            <div class="col-md-12">
                <label>Điện thoại</label>
                <p class="form-control-static">{{vm.m.store.contact_tel}}</p>
            </div>
            <div class="col-md-12">
                <label>Email</label>
                <p class="form-control-static">{{vm.m.store.contact_email}} </p>
            </div>
            

           
        </div>
    </div>
</div>




</div>

    </div>
</section>