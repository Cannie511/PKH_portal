<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="vm.cancel()"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">
        Task Detail
    </h4>
</div>
<div class="modal-body">
    <form>
        <div class="row form-row">
            <div class="form-group col-md-4">
                <label class="control-label">Task group</label>
                <p class="form-control-static">
                    <span  ng-if="vm.m.task.task_group_id == '1'">Daily job</span> 
                    <span  ng-if="vm.m.task.task_group_id == 2">Improvement</span> 
                    <span  ng-if="vm.m.task.task_group_id == 3">Development</span> 
                </p>
            </div>
            <div class="form-group col-md-4">
                <label class="control-label">Task creator</label>
                <p class="form-control-static">{{vm.m.task.task_creator}}</p>
            </div>
            <div class="form-group col-md-4">
                <label class="control-label">Task assigned to</label>
                <p class="form-control-static">{{vm.m.task.user_name}}</p>
            </div>
        </div>
        <div class="row form-row">
            <div class="form-group col-md-4">
                <label class="control-label">Task status</label>
                <p class="form-control-static">
                    <span class="label label-success" ng-if="vm.m.task.task_sts == '1'">New</span> 
                    <span class="label label-warning" ng-if="vm.m.task.task_sts == 2">Doing</span> 
                    <span class="label label-default" ng-if="vm.m.task.task_sts == 3">Finish</span> 
                    <span class="label label-danger" ng-if="vm.m.task.task_sts == 4">Scoring</span> 
                </p>
            </div>
            <div class="form-group col-md-4">
                <label class="control-label">Task score</label>
                <p class="form-control-static">{{vm.m.task.task_score}}</p>
            </div>
        </div>
        <div class="row form-row">
            <div class="form-group col-md-12">
                <label class="control-label">Task name</label>
                <p class="form-control-static">{{vm.m.task.task_name}}</p>
            </div>
        </div>
        <div class="row form-row">
            <div class="form-group col-md-12">
                <label class="control-label">Task content</label>
                <pre class="form-control-static">{{vm.m.task.task_content}}</pre>
            </div>
        </div>
        <div class="row form-row">
            <div class="form-group col-md-12">
                <label class="control-label">Submit notes</label>
                <pre class="form-control-static">{{vm.m.task.submit_notes}}</pre>
            </div>
        </div>
        <div class="row form-row">
            <div class="form-group col-md-12">
                <label class="control-label">Response notes</label>
                <pre class="form-control-static">{{vm.m.task.response_notes}}</pre>
            </div>
        </div>
        <div class="row row form-row">
            <div class="form-group col-md-4">
                <label class="control-label">Start date</label>
                <p class="form-control-static">{{vm.m.task.start_date}}</p>
            </div>
            <div class="form-group col-md-4">
                <label class="control-label">Deadline</label>
                <p class="form-control-static">{{vm.m.task.deadline}}</p>
            </div>
            <div class="form-group col-md-4">
                <label class="control-label">End date</label>
                <p class="form-control-static">{{vm.m.task.end_date}}</p>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" ng-click="vm.cancel()">Close</button>
</div>
