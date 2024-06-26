<section class="content-header">
    <h1>Report<small></small></h1>
    
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li ng-class="{'active': vm.m.activeFlag == 4}"><a href="javascript:void(0)" ng-click="vm.chooseTab(4)"><h4>Payment</h4></a></li>      
                    <li ng-class="{'active': vm.m.activeFlag == 1}"><a href="javascript:void(0)" ng-click="vm.chooseTab(1)"><h4>Store</h4></a></li>   
                    <li ng-class="{'active': vm.m.activeFlag == 2}"><a href="javascript:void(0)" ng-click="vm.chooseTab(2)"><h4>Area</h4></a></li>
                    <li ng-class="{'active': vm.m.activeFlag == 3}"><a href="javascript:void(0)" ng-click="vm.chooseTab(3)"><h4>Product</h4></a></li>      
                </ul>
                <div class="tab-content">

                    <div ng-if=" vm.m.activeFlag == 4"> 
                        @include('views.admin.rpt0511.rpt0511_payment')
                    </div>
        
                    <div ng-if=" vm.m.activeFlag == 1"> 
                        @include('views.admin.rpt0511.rpt0511_store')
                    </div>

                    <div ng-if=" vm.m.activeFlag == 2"> 
                        @include('views.admin.rpt0511.rpt0511_area')
                    </div>

                    <div ng-if=" vm.m.activeFlag == 3"> 
                        @include('views.admin.rpt0511.rpt0511_product')
                    </div>
        
                </div>
            </div>
        </div>
    </div>
</section>
