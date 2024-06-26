<section class="content-header">
    <h1>Báo cáo chi phí<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">chi phí</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">chi phí công ty</h3>
                    <div class="box-tools pull-right">
                        <div uib-dropdown class="btn-group">
                        </div>
                    </div>
                </div>
                <div class="box-body form">
                    <form role="form" ng-submit="vm.search()">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 m-b-xs">
                                <div class="form-group">
                                    <label>Năm</label>
                                    <select class="form-control"     
                                        chosen                               
                                        placeholder-text-single="'Chọn năm'"
                                        ng-model="vm.m.filter.year"
                                        ng-options="item.year as item.year for item in vm.m.init.listYear">
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
                 <div class="box-header with-border">
                    <ul class="nav nav-tabs">
                        <li ng-class="{'active': vm.m.activeFlag == 1}"><a href="javascript:void(0)" ng-click="vm.choose(1)"><h4>Loại chi phí</h4></a></li>
                        <li ng-class="{'active': vm.m.activeFlag == 2 }"><a href="javascript:void(0)" ng-click="vm.choose(2)"><h4>Phòng ban</h4></a></li>
                    </ul>
                </div>
                 <div>
                    <div class="table-responsive"  >
                        <h4></h4>

                        <table class="table table-striped table-border">
                            <thead>      
                                <tr>        
                                    <th></th>
                                    <th>No</th>
                                    <th ng-repeat='header in vm.m.res[vm.m.activeFlag].header'>
                                        <span class="text-center">
                                            <button ng-if="$index!=0" ng-click="vm.draw(1,vm.m.res[vm.m.activeFlag].data,$index,3,1,2,'','')" class="btn btn-success btn-xs">
                                                <i  class="fa fa-pie-chart" ></i>
                                            </button> 
                                            <br>{{header}}
                                        </span>   
                                    </th>      
                                </tr>
                            </thead>
                            <tbody>       
                                <tr ng-repeat='data  in vm.m.res[vm.m.activeFlag].data'> 
                                    <td><button class="btn btn-success btn-xs" ng-click="vm.draw(1,data,'',2,0,2,'',vm.m.res[vm.m.activeFlag].header)"><i class="fa fa-line-chart"></i></button></td> 
                                    <td>{{$index+1}}</td>
                                    <td ng-repeat ='header in vm.m.res[vm.m.activeFlag].header' class="text-right">
                                        <span ng-if="$index>0 && data[$index]!=0" > {{data[$index] | currency: '' : 0 }} </span>
                                        <span ng-if="$index>0 &&data[$index]==0 " > - </span>
                                        <span ng-if="$index==0 " class="text-left">{{data[$index]}}   </span>
                                    </td>   
                                </tr>                                     
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
