<section class="content-header">
    <h1>BÁO CÁO CỬA HÀNG <small></small></h1>
   
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li ng-class="{'active': vm.m.activeFlag == 1}"><a href="javascript:void(0)" ng-click="vm.chooseTab(1)"><h4>Overview</h4></a></li>
                    <li ng-class="{'active': vm.m.activeFlag == 2}"><a href="javascript:void(0)" ng-click="vm.chooseTab(2)"><h4>Giao hàng</h4></a></li>   
                    <li ng-class="{'active': vm.m.activeFlag == 3}"><a href="javascript:void(0)" ng-click="vm.chooseTab(3)"><h4>Đặt hàng</h4></a></li>   
                    <li ng-class="{'active': vm.m.activeFlag == 4}"><a href="javascript:void(0)" ng-click="vm.chooseTab(4)"><h4>Thanh toán</h4></a></li>   
                    <li ng-class="{'active': vm.m.activeFlag == 5}"><a href="javascript:void(0)" ng-click="vm.chooseTab(5)"><h4>Hàng nợ</h4></a></li> 
                    <li ng-class="{'active': vm.m.activeFlag == 6}"><a href="javascript:void(0)" ng-click="vm.chooseTab(6)"><h4>Warranty</h4></a></li>     
                    <li ng-class="{'active': vm.m.activeFlag == 7}"><a href="javascript:void(0)" ng-click="vm.chooseTab(7)"><h4>Profit</h4></a></li>   
                    <li ng-class="{'active': vm.m.activeFlag == 8}"><a href="javascript:void(0)" ng-click="vm.chooseTab(8)"><h4>Checkin</h4></a></li>     
                </ul>
                <div class="tab-content">
                    <div  ng-if=" vm.m.activeFlag == 1">
                        @include('views.admin.rpt0518.rpt0518_overview')
                    </div>
                    <div  ng-if=" vm.m.activeFlag == 2">
                        @include('views.admin.rpt0518.rpt0518_tab2')
                    </div>
                    <div  ng-if=" vm.m.activeFlag == 3">
                        @include('views.admin.rpt0518.rpt0518_tab3')
                    </div>
                    <div  ng-if=" vm.m.activeFlag == 4">
                        @include('views.admin.rpt0518.rpt0518_tab4')
                    </div>
                    <div  ng-if=" vm.m.activeFlag == 5">
                        @include('views.admin.rpt0518.rpt0518_tab5')
                    </div>
                    <div  ng-if=" vm.m.activeFlag == 6">
                        @include('views.admin.rpt0518.rpt0518_tab6')
                    </div>
                    <div  ng-if=" vm.m.activeFlag == 7">
                        @include('views.admin.rpt0518.rpt0518_tab7')
                    </div>
                    <div  ng-if=" vm.m.activeFlag == 8">
                        @include('views.admin.rpt0518.rpt0518_tab8')
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

