<section class="content-header">
    <h1>Danh sách yêu cầu xử lý<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Danh sách y/c xử lý</li>
    </ol>
</section>
<section class="content">
    <ul class="nav nav-tabs">
        <li ng-class="{'active': vm.m.activeFlag == 1}"><a href="javascript:void(0)" ng-click="vm.choose(1)"><h4>Xử lý đơn</h4></a></li>
        <li ng-class="{'active': vm.m.activeFlag == 2 }"><a href="javascript:void(0)" ng-click="vm.choose(2)"><h4>Nhập hàng bảo hành - trả lại</h4></a></li>
        <li ng-class="{'active': vm.m.activeFlag == 3 }"><a href="javascript:void(0)" ng-click="vm.choose(3)"><h4>Nhập hàng nhà máy</h4></a></li>
        <li ng-class="{'active': vm.m.activeFlag == 4 }"><a href="javascript:void(0)" ng-click="vm.choose(4)"><h4>Huỷ xuất nhập kho</h4></a></li>
    </ul>
    <div class="tab-content">
        <!-- request cancel order, delivery -->
        @include('views.admin.crm0240.crm0240_tab1')
         <!-- request cancel  import warranty, return products -->
        @include('views.admin.crm0240.crm0240_tab2')
         <!-- request cancel  import from factory-->
        @include('views.admin.crm0240.crm0240_tab3')
        <!-- request cancel export import betweeen warehouses -->
        @include('views.admin.crm0240.crm0240_tab4')

    </div>

</section>
