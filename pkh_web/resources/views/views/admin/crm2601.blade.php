<div class="box box-info">
    <div class="box-header box-profile with-border">
        <img class="profile-user-img img-responsive img-circle" src="/img/store-avatar.jpg" alt="Store profile picture">

        <h3 class="text-center">{{vm.m.store.name}}</h3>
        <p class="text-muted text-center">
            <b>{{vm.m.store.area_group_name}}</b>&nbsp;
            <span>{{vm.m.store.area1_name}}</span>
            <span ng-if="vm.m.store.area2_name"> - {{vm.m.store.area2_name}}</span>
        </p>
        
        <p class="text-muted text-center">{{vm.m.store.address}}</p>

            <span class="badge badge-success" ng-if="vm.m.store.is_review_valid == true && vm.m.store.review_sts == 'VERIFIED'">Verified</span>
            <span class="badge badge-warning" ng-if="vm.m.store.is_review_valid == false && vm.m.store.review_sts == 'VERIFIED'">Expired</span>
            <span class="badge badge-danger" ng-if="vm.m.store.review_sts == 'BLACKLIST'">Blacklist</span>
            <span ng-if="vm.m.store.review_expired_date" class="badge">{{vm.m.store.review_expired_date}}</span>
        </p>
        
        <!-- <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
                <b>Followers</b> <a class="pull-right">1,322</a>
            </li>
            <li class="list-group-item">
                <b>Following</b> <a class="pull-right">543</a>
            </li>
            <li class="list-group-item">
                <b>Friends</b> <a class="pull-right">13,287</a>
            </li>
        </ul> -->

        <!-- <a ui-sref='app.crm0310({store_id: vm.m.store_id})' class="btn btn-warning btn-block"><b>Chỉnh sửa</b></a> -->
    </div>
    <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">
            <li ng-class="{'active': vm.m.screen_name == 'crm2600'}"><a ui-sref='app.crm2600({store_id: vm.m.store_id})'>Thông tin cửa hàng</a></li>
            <li ng-class="{'active': vm.m.screen_name == 'crm2610'}"><a ui-sref='app.crm2610({store_id: vm.m.store_id})'>Sản phẩm</a></li>
            <li ng-class="{'active': vm.m.screen_name == 'crm2810'}"><a ui-sref='app.crm2810({store_id: vm.m.store_id})'>KPI</a></li>
        </ul>
    </div>
</div>