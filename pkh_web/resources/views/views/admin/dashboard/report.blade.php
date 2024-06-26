<div class="box-body form">
    <form role="form" ng-submit="vm.doSearchReport()">
        <div class="row">    
            <div class="col-md-3 col-sm-6 m-b-xs">
                <div class="form-group">
                    <label>Nhà cung ứng</label>
                    <select class="form-control"     
                        chosen                               
                        placeholder-text-single="'Chọn nhà cung ứng'"
                        ng-model="vm.m.filter.supplier_id"
                        ng-options="item.supplier_id as item.name for item in vm.m.supplierList"
                        >
                        <option value="">Tất cả</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                    <i class="fa fa-search fa-fw"></i>
                    <span translate="COM_BTN_SEARCH"></span>
                </button>
              
            </div>
        </div>
    </form>
</div>
<div class="row">
        <div class="col-md-6" ng-if="vm.chartStatisticDelivery">
            <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title"> Target vs Sales in months  </h3>
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
                                <canvas id="chartDelivery" class="chart chart-bar" 
                                    chart-data="vm.chartStatisticDelivery.data" 
                                    chart-labels="vm.chartStatisticDelivery.labels" 
                                    chart-legend="false" 
                                    chart-series="vm.chartStatisticDelivery.series" 
                                    chart-options="vm.chartStatisticDelivery.options" 
                                    chart-colors ="vm.chartStatisticDelivery.colors"
                                   >
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6" ng-if="vm.chartStatisticDeliveryQuarter">
            <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title"> Target vs Sales in quarters  </h3>
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
                                <canvas id="chartDelivery" class="chart chart-bar" 
                                    chart-data="vm.chartStatisticDeliveryQuarter.data" 
                                    chart-labels="vm.chartStatisticDeliveryQuarter.labels" 
                                    chart-legend="false" 
                                    chart-series="vm.chartStatisticDeliveryQuarter.series" 
                                    chart-options="vm.chartStatisticDeliveryQuarter.options" 
                                    chart-colors ="vm.chartStatisticDeliveryQuarter.colors"
                                   >
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6" ng-if="vm.chartStatisticSO2">
            <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">SM1 -  Target vs Sales in quarters  </h3>
                  <div class="box-tools pull-right">
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                  </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                        
                            <div class="chart">
                                <canvas id="chartDelivery" class="chart chart-bar" 
                                    chart-data="vm.chartStatisticSO1.data" 
                                    chart-labels="vm.chartStatisticSO1.labels" 
                                    chart-legend="false" 
                                    chart-series="vm.chartStatisticSO1.series" 
                                    chart-options="vm.chartStatisticSO1.options" 
                                    chart-colors ="vm.chartStatisticSO1.colors"
                                   >
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6" ng-if="vm.chartStatisticSO2">
            <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">SM2 -  Target vs Sales in quarters  </h3>
                  <div class="box-tools pull-right">
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                  </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                        
                            <div class="chart">
                                <canvas id="chartDelivery" class="chart chart-bar" 
                                    chart-data="vm.chartStatisticSO2.data" 
                                    chart-labels="vm.chartStatisticSO2.labels" 
                                    chart-legend="false" 
                                    chart-series="vm.chartStatisticSO2.series" 
                                    chart-options="vm.chartStatisticSO2.options" 
                                    chart-colors ="vm.chartStatisticSO2.colors"
                                   >
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6" ng-if="vm.chartStatisticSO3">
            <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">SM3 -  Target vs Sales in quarters  </h3>
                  <div class="box-tools pull-right">
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                  </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                        
                            <div class="chart">
                                <canvas id="chartDelivery" class="chart chart-bar" 
                                    chart-data="vm.chartStatisticSO3.data" 
                                    chart-labels="vm.chartStatisticSO3.labels" 
                                    chart-legend="false" 
                                    chart-series="vm.chartStatisticSO3.series" 
                                    chart-options="vm.chartStatisticSO3.options" 
                                    chart-colors ="vm.chartStatisticSO3.colors"
                                   >
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6" ng-if="vm.chartStatisticSO4">
            <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">SM4 -  Target vs Sales in quarters  </h3>
                  <div class="box-tools pull-right">
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                  </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                        
                            <div class="chart">
                                <canvas id="chartDelivery" class="chart chart-bar" 
                                    chart-data="vm.chartStatisticSO4.data" 
                                    chart-labels="vm.chartStatisticSO4.labels" 
                                    chart-legend="false" 
                                    chart-series="vm.chartStatisticSO4.series" 
                                    chart-options="vm.chartStatisticSO4.options" 
                                    chart-colors ="vm.chartStatisticSO4.colors"
                                   >
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6" ng-if="vm.chartCompareSale">
            <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title"> Sales in quarters  </h3>
                  <div class="box-tools pull-right">
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                  </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                        
                            <div class="chart">
                                <canvas id="chartDelivery" class="chart chart-bar" 
                                    chart-data="vm.chartCompareSale.data" 
                                    chart-labels="vm.chartCompareSale.labels" 
                                    chart-legend="false" 
                                    chart-series="vm.chartCompareSale.series" 
                                    chart-options="vm.chartCompareSale.options" 
                                    chart-colors ="vm.chartCompareSale.colors"
                                   >
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>