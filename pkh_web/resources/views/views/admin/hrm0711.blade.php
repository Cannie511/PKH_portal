<div class="box box-info">
    <div class="box-header box-profile with-border">
        <img class="profile-user-img img-responsive img-circle" src="/img/store-avatar.jpg" alt="Store profile picture">

        <h5 class="text-center">{{vm.m.employee.fullname}}</h5>
        <p class="text-muted text-center">
            <b>{{vm.m.employee.devision}}</b>&nbsp;
            <span>{{vm.m.employee.title}}</span>
        </p>
        
        <!-- <p class="text-muted text-center">{{vm.m.employee.address}}</p> -->

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
            <li ng-class="{'active': vm.m.screen_name == 'hrm0710' || vm.m.screen_name == 'hrm0714'}"><a ui-sref='app.hrm0710({id: vm.m.employee_id})'>Thông tin nhân viên</a></li>
            <li ng-class="{'active': vm.m.screen_name == 'hrm0715'}"><a ui-sref='app.hrm0715({id: vm.m.employee_id})'>Hợp đồng</a></li>
            <!-- <li ng-class="{'active': vm.m.screen_name == 'crm2610'}"><a ui-sref='app.crm2610({store_id: vm.m.store_id})'>Sản phẩm</a></li> -->
        </ul>
    </div>
</div>