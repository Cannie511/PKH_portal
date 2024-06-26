
<section class="content-header">
    <h1>Thông tin trong ngày<small></small></h1>
    <!-- <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Lịch nghỉ nghep</li>
    </ol> -->
</section>

<section class="content das0100">
    <div class="row" ng-if="vm.m.news.data">
        <div class="col-md-12">
            <marquee>
                <span ng-repeat="item in vm.m.news.data">
                    <a ui-sref="app.hrm1021({id: item.id})" clsas="btn btn-xs" ng-class="{'not-read': item.viewed == '0'}">
                        {{item.title}} ({{item.created_at | date: 'yyyy-MM-dd'}})
                    </a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </span>
            </marquee>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" ng-if="vm.chartStatisticOrder">
            <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Đặt hàng</h3>
                  <div class="box-tools pull-right">
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                  </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                          <!-- <p class="text-center">
                            <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                          </p> -->
                            <div class="chart">
                                <canvas id="chartOrder" class="chart chart-bar" 
                                    chart-data="vm.chartStatisticOrder.data" 
                                    chart-labels="vm.chartStatisticOrder.labels" 
                                    chart-legend="false" 
                                    chart-series="vm.chartStatisticOrder.series" 
                                    chart-options="vm.chartStatisticOrder.options" 
                                    chart-colours="vm.chartStatisticOrder.colours" 
                                    style="height: 250px;">
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
            
                <ul class="nav nav-tabs">
                    <li ng-class="{'active': vm.m.activeFlag == 10}"><a href="javascript:void(0)" ng-click="vm.chooseTab(10)"><h4>Tổng quan &nbsp;</h4></a></li>


                </ul>

                <div class="tab-content">
                    <div class="tab-pane" ng-class="{'active': vm.m.activeFlag == 10}">
                        @include('views.admin.dashboard.report')  
                    </div>

                   

    </div>
</section>
