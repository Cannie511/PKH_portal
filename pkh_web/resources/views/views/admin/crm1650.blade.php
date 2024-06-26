<section class="content-header">
    <h1>Chi tiết nhập hàng<small></small></h1>
    <!-- <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Lịch nghỉ nghep</li>
    </ol> -->
</section>
<section class="content das0100">
    <div class="row">
    

        <div class="col-md-12" >
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Chi tiết nhập hàng nhà máy</h3>
                  
                </div>
                <div class="box-body">
                    <div class="text-right">
                        <button class="btn btn-sm btn-info" ng-click="vm.download()"><i class="fa fa-download fa-fw"></i>&nbsp;Download</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                     <td ng-repeat ='itemArea in vm.m.list.header' ng-class="{'text-right': $index > 1}"><b>{{itemArea}}</b></td>                                                                           
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='item in vm.m.list.data'>
                                    <td>{{$index + 1}}</td>
                                    <td ng-repeat ='itemArea in vm.m.list.header' ng-class="{'text-right': $index > 1}">
                                        <span ng-if="itemArea=='PKH code' || itemArea=='Stock code'">  {{item[itemArea]}}</span>
                                        <span ng-if="itemArea!='PKH code' && itemArea!='Stock code'">  {{item[itemArea]| currency : '' : 0}}</span>
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
