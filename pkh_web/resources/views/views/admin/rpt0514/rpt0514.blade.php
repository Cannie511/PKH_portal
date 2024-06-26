<section class="content-header">
    <h2>
        PROFILE  {{vm.m.init.store.name}} - {{vm.m.init.store.area1_name}} {{vm.m.init.store.area2_name}}
    </h2>
   
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li ng-class="{'active': vm.m.activeFlag == 1}"><a href="javascript:void(0)" ng-click="vm.chooseTab(1)"><h4>Overview</h4></a></li>   
                    <li ng-class="{'active': vm.m.activeFlag == 2}"><a href="javascript:void(0)" ng-click="vm.chooseTab(2)"><h4>Sản phẩm</h4></a></li>
                    <li ng-class="{'active': vm.m.activeFlag == 3}"><a href="javascript:void(0)" ng-click="vm.chooseTab(3)"><h4>CS</h4></a></li>
                    <li ng-class="{'active': vm.m.activeFlag == 5}"><a href="javascript:void(0)" ng-click="vm.chooseTab(5)"><h4>Check-in</h4></a></li>                      
                    <li ng-class="{'active': vm.m.activeFlag == 4}"><a href="javascript:void(0)" ng-click="vm.chooseTab(4)"><h4>Thanh toán</h4></a></li>                      
                </ul>
                <div class="tab-content">
                    
        
                    <div ng-if=" vm.m.activeFlag == 2"> 
                        @include('views.admin.rpt0514.rpt0514_tab2')
                    </div>

                    <div ng-if=" vm.m.activeFlag == 3"> 
                        @include('views.admin.rpt0514.rpt0514_tab3')
                    </div>
                    <div ng-if=" vm.m.activeFlag == 5"> 
                        @include('views.admin.rpt0514.rpt0514_tab5')
                    </div>

                    <div ng-if=" vm.m.activeFlag == 4"> 
                        @include('views.admin.rpt0514.rpt0514_tab4')
                    </div>

                
                </div>
            </div>
            <div ng-if=" vm.m.activeFlag == 1"> 
                @include('views.admin.rpt0514.rpt0514_tab1')
            </div>
        </div>
    </div>
</section>