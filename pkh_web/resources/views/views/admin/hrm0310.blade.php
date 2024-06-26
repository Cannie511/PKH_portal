<section class="content-header">
    <h1>Thêm task<small></small></h1>
   
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-7">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin task</h3>
                    <div class="box-tools pull-right">
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <form class="form-horizontal" name="form" ng-submit="vm.save()" >
                    <div class="box-body">
                       

                        <div class="form-group" >
                            <label class="col-sm-2 control-label ">Task name</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" ng-model="vm.m.filter.task_name" name="name" placeholder="" />
                            </div>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error': form.type.$invalid && ( vm.formSubmitted || form.type.$touched) }">
                            <label class="col-sm-2 control-label required">Task group</label>
                            <div class="col-sm-10">
                                <select class="form-control" ng-model="vm.m.filter.task_group_id"  name="type" ng-init="vm.m.filter.task_group_id= '1'" >
                                        <option value="1">Daily job</option>
                                        <option value="2">Development</option>
                                        <option value="3">Improvement</option>
                                
                                    </select>
                            </div>              
                        </div>
                        
                        <div class="form-group" ng-class="{ 'has-error': form.assign.$invalid && ( vm.formSubmitted || form.name.$touched) }">
                            <label class="col-sm-2 control-label">Assign to</label>
                            <div class="col-sm-10">
                                <select class="form-control"     
                                    chosen  
                                    name ="assign"                             
                                    placeholder-text-single="'choose person to assign'"
                                    ng-model="vm.m.filter.user_id"
                                    ng-options="item.employee_id as item.display for item in vm.m.init.users "
                                    >
                                    <option value="">No one</option>
                                </select>
                                <p ng-show="form.assign.$error.required && ( vm.formSubmitted || form.assign.$touched)" class="help-block">Please enter deadline</p>

                            </div>
                        </div>
                       

                        <div class="form-group" ng-class="{ 'has-error': form.date.$invalid && ( vm.formSubmitted || form.name.$touched) }">
                               <label class="col-sm-2 control-label required">Deadline</label>
                               <div class="col-sm-10">
                                    <p class="input-group">
                                        <input type="text" class="form-control" name="date" uib-datepicker-popup="yyyy-MM-dd" ng-model="vm.m.filter.deadline" is-open="vm.dp2Opened" datepicker-options="vm.m.dateOptions" close-text="Close"
                                        ng-model-options="{timezone: 'utc'}" required/>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" ng-click="vm.dp2Opened = true"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </p>
                                     <p ng-show="form.date.$error.required && ( vm.formSubmitted || form.date.$touched)" class="help-block">Please enter deadline</p>
                                </div>
                                
                        </div>
                 
                          <div class="form-group" >
                                <label class="col-sm-2 control-label ">Ghi chú</label>
                                <div class="col-sm-10">
                                        <textarea class="form-control" row="10" ng-model="vm.m.filter.task_content"></textarea>
                                    <!-- <input type="text"  class="form-control" ng-model="" name="notes" placeholder="" /> -->
                                </div>
                        </div>
                                          
                    </div>
                    <div class="box-footer">
                        <a ui-sref="app.hrm0300" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_NEW" ng-if="!vm.m.task_id" >Thêm mới</button>
                        <button type="submit" class="btn btn-primary pull-right" translate="COM_BTN_UPDATE" ng-if="vm.m.task_id">Cập nhật</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>
