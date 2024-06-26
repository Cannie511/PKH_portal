<div class="tab-pane" ng-class="{'active': vm.m.activeFlag == 5}">
    <div class="box-body form">
        <form class="form" ng-submit="vm.doSearch(vm.m.activeFlag,1)">
            <div class="row">
               
                <div class="col-md-3 col-sm-6 m-b-xs">
                    <div class="form-group">
                        <label>Deadline Year</label>
                        <p class="input-group">
                            <input class="form-control" datetimepicker ng-model="vm.m[vm.m.activeFlag].filter.year" placeholder="Year" options="vm.m.datetimepicker_options"/>
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </p>
                    </div> 
                </div>

                <div class="col-md-3 col-sm-6 m-b-xs">
                    <div class="form-group">
                        <label>Assign to</label>
                        <select class="form-control"     
                            chosen                               
                            placeholder-text-single="'Chọn nhân viên'"
                            ng-model="vm.m[vm.m.activeFlag].filter.assign_id"
                            ng-options="item.employee_id as item.display for item in vm.m.init.users "
                            >
                            <option value="">Không có</option>
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
                    <button type="button" class="btn btn-default btn-sm btn-width-default" ng-click="vm.resetFilter(vm.m.activeFlag)">
                        <i class="fa fa-eraser fa-fw"></i>
                        <span translate="COM_BTN_RESET"></span>
                    </button>
                    
                </div>
            </div>
        </form>
    </div>
</div>

<div ng-if="vm.m.activeFlag == 5">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">New task</h3>
                </div>
            </div>
            <div  class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Staff</th>
                            <th class="text-right">Count</th>
                            <th class="text-right">Min day delay</th>
                            <th class="text-right">Max day delay</th>
                            <th class="text-right">AVG day delay</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data1'>
                            <td> {{$index + 1}}</td>
                            <td> {{item.name}} </td>
                            <td class="text-right"> {{item.count}} </td>
                            <td class="text-right"> {{item.min}}</td>
                            <td class="text-right"> {{item.max}}</td>
                            <td class="text-right"> {{item.avg  | currency: '' : 0}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Doing task</h3>
                  
                </div>
               
            </div>
            <div  class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Staff</th>
                            <th class="text-right">Count</th>
                            <th class="text-right">Min day delay</th>
                            <th class="text-right">Max day delay</th>
                            <th class="text-right">AVG day delay</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data2'>
                            <td> {{$index + 1}}</td>
                            <td> {{item.name}} </td>
                            <td class="text-right"> {{item.count}} </td>
                            <td class="text-right"> {{item.min}}</td>
                            <td class="text-right"> {{item.max}}</td>
                            <td class="text-right"> {{item.avg  | currency: '' : 0}}</td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Finish task</h3>
                  
                </div>
               
            </div>
            <div  class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Staff</th>
                            <th class="text-right">Count</th>
                            <th class="text-right">Min day delay</th>
                            <th class="text-right">Max day delay</th>
                            <th class="text-right">AVG day delay</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data3'>
                            <td> {{$index + 1}}</td>
                            <td> {{item.name}} </td>
                            <td class="text-right"> {{item.count}} </td>
                            <td class="text-right"> {{item.min_1}}</td>
                            <td class="text-right"> {{item.max_1}}</td>
                            <td class="text-right"> {{item.avg_1  | currency: '' : 0}}</td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Score</h3>
                  
                </div>
               
            </div>
            <div  class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Staff</th>
                            <th class="text-right">Count</th>
                            <th class="text-right">Min day delay</th>
                            <th class="text-right">Max day delay</th>
                            <th class="text-right">AVG day delay</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data4'>
                            <td> {{$index + 1}}</td>
                            <td> {{item.name}} </td>
                            <td class="text-right"> {{item.count}} </td>
                            <td class="text-right"> {{item.min_1}}</td>
                            <td class="text-right"> {{item.max_1}}</td>
                            <td class="text-right"> {{item.avg_1  | currency: '' : 0}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-12 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">KPI table scoring</h3>
                  
                </div>
               
            </div>
            <div  class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Staff</th>
                            <th class="text-right">1</th>
                            <th class="text-right">2</th>
                            <th class="text-right">3</th>
                            <th class="text-right">4</th>
                            <th class="text-right">5</th>
                            <th class="text-right">6</th>
                            <th class="text-right">7</th>
                            <th class="text-right">8</th>
                            <th class="text-right">9</th>
                            <th class="text-right">10</th>
                            <th class="text-right">11</th>
                            <th class="text-right">12</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data5'>
                            <td> {{$index + 1}}</td>
                            <td> {{item.name}} </td>
                            <td class="text-right"> {{item.T1s/item.T1c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T2s/item.T2c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T3s/item.T3c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T4s/item.T4c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T5s/item.T5c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T6s/item.T6c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T7s/item.T7c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T8s/item.T8c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T9s/item.T9c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T10s/item.T10c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T11s/item.T11c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T12s/item.T12c | currency: '' : 0}} </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-12 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Number of task assigned</h3>
                </div>
               
            </div>
            <div  class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Staff</th>
                            <th class="text-right">1</th>
                            <th class="text-right">2</th>
                            <th class="text-right">3</th>
                            <th class="text-right">4</th>
                            <th class="text-right">5</th>
                            <th class="text-right">6</th>
                            <th class="text-right">7</th>
                            <th class="text-right">8</th>
                            <th class="text-right">9</th>
                            <th class="text-right">10</th>
                            <th class="text-right">11</th>
                            <th class="text-right">12</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data5'>
                            <td> {{$index + 1}}</td>
                            <td> {{item.name}} </td>
                            <td class="text-right"> {{item.T1c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T2c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T3c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T4c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T5c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T6c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T7c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T8c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T9c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T10c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T11c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T12c | currency: '' : 0}} </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-12 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">KPI table creator evaluate</h3>
                  
                </div>
               
            </div>
            <div  class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Staff</th>
                            <th class="text-right">1</th>
                            <th class="text-right">2</th>
                            <th class="text-right">3</th>
                            <th class="text-right">4</th>
                            <th class="text-right">5</th>
                            <th class="text-right">6</th>
                            <th class="text-right">7</th>
                            <th class="text-right">8</th>
                            <th class="text-right">9</th>
                            <th class="text-right">10</th>
                            <th class="text-right">11</th>
                            <th class="text-right">12</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data6'>
                            <td> {{$index + 1}}</td>
                            <td> {{item.name}} </td>
                            <td class="text-right"> {{item.T1s/item.T1c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T2s/item.T2c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T3s/item.T3c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T4s/item.T4c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T5s/item.T5c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T6s/item.T6c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T7s/item.T7c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T8s/item.T8c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T9s/item.T9c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T10s/item.T10c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T11s/item.T11c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T12s/item.T12c | currency: '' : 0}} </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-12 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Number of task created by</h3>
                </div>
               
            </div>
            <div  class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Staff</th>
                            <th class="text-right">1</th>
                            <th class="text-right">2</th>
                            <th class="text-right">3</th>
                            <th class="text-right">4</th>
                            <th class="text-right">5</th>
                            <th class="text-right">6</th>
                            <th class="text-right">7</th>
                            <th class="text-right">8</th>
                            <th class="text-right">9</th>
                            <th class="text-right">10</th>
                            <th class="text-right">11</th>
                            <th class="text-right">12</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data6'>
                            <td> {{$index + 1}}</td>
                            <td> {{item.name}} </td>
                            <td class="text-right"> {{item.T1c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T2c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T3c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T4c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T5c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T6c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T7c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T8c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T9c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T10c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T11c | currency: '' : 0}} </td>
                            <td class="text-right"> {{item.T12c | currency: '' : 0}} </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>