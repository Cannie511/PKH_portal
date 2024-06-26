<div class="tab-pane" ng-class="{'active': vm.m.activeFlag == 2}">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Doing task list</h3>
        
        </div>
    </div>
    <div class="box-body form">
        <form class="form" ng-submit="vm.doSearch(vm.m.activeFlag,1)">
            <div class="row">
                <div class="col-md-3 col-sm-6 m-b-xs">
                    <div class="form-group">
                        <label>Deadline year</label>
                        <p class="input-group">
                            <input class="form-control" datetimepicker ng-model="vm.m[vm.m.activeFlag].filter.year" placeholder="Year" options="vm.m.datetimepicker_options"/>
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </p>
                    </div> 
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="task_name">Task name</label>
                        <input type="text" class="form-control"  ng-model="vm.m[vm.m.activeFlag].filter.task_name" />
                    </div>
                </div>

               
                <div class="col-md-3 col-sm-6 m-b-xs">
                    <div class="form-group">
                        <label>Task group</label>
                        <select class="form-control" ng-model="vm.m[vm.m.activeFlag].filter.task_group_id"  name="type" ng-init="vm.m[vm.m.activeFlag].filter.task_group_id= '1'" >
                            <option value="1">Daily job</option>
                            <option value="2">Development</option>
                            <option value="2">Improvement</option>
                    
                        </select>
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
    
    <div class="box-body">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Detail</th>
                        <th>NO</th>
                        <th>Task name</th>
                        <th>Task group</th>
                        <th>Task creator</th>
                        <th>Assign to</th>
                        <th>Task status</th>
                        <th>Deadline</th>
                        <th>Day delay</th>
                        <th>Finish</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat='item in vm.m[vm.m.activeFlag].data.data'>
                        <td class="col-action">
                            <button class="btn btn-xs btn-warning" ng-click="vm.get_detail(item)">
                                <i class="fa fa-edit"></i>
                            </button>
                        </td>
                        <td>{{vm.m[vm.m.activeFlag].data.from +$index }}</td>
                        
                        <td> 
                            {{item.task_name}}
                        </td>
                        
                        <td>
                            <span  ng-if="item.task_group_id == '1'">Daily job</span> 
                            <span  ng-if="item.task_group_id == 2">Improvement</span> 
                            <span  ng-if="item.task_group_id == 3">Development</span> 
                        </td>
                        <td> 
                            {{item.task_creator}}
                        </td>
                        <td> 
                            {{item.user_name}}
                        </td>
                        <td>
                            <span class="label label-success" ng-if="item.task_sts == '1'">New</span> 
                            <span class="label label-warning" ng-if="item.task_sts == 2">Doing</span> 
                            <span class="label label-default" ng-if="item.task_sts == 3">Finish</span> 
                        </td>
                        <td> 
                            {{item.deadline}}
                        </td>
                     
                        <td> 
                            {{item.delay}}
                        </td>
                        <td>
                            
                            <span >
                                <button type="button" class="btn btn-info btn-sm btn-width-default" ng-click="vm.submit(item)">
                                Finish
                                </button>
                            </span>
                        </td>
                     
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row text-right">
            <div class="col-md-6 col-sm-12 text-left" ng-show="vm.m[vm.m.activeFlag].data.from > 0">
                <p class="form-control-static">{{vm.m[vm.m.activeFlag].data.from}} - {{vm.m[vm.m.activeFlag].data.to}} / {{vm.m[vm.m.activeFlag].data.total}}</p>                            
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <uib-pagination ng-show="vm.m[vm.m.activeFlag].data.from > 0"
                    total-items="vm.m[vm.m.activeFlag].data.total"
                    ng-model="vm.m[vm.m.activeFlag].data.current_page"
                    items-per-page="vm.m[vm.m.activeFlag].data.per_page"
                    ng-change="vm.doSearch(vm.m.activeFlag, vm.m[vm.m.activeFlag].data.current_page)"
                    class="pagination pagination-sm m-t-none m-b-none">
                </uib-pagination>    
            </div>
        </div>
    </div>   
</div>


