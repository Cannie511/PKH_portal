<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="vm.cancel()"><span aria-hidden="true">&times;</span></button>
    <div class="modal-title">
        Submit to finish your task - {{vm.m.task.task_name}}
    </div> 
</div>
<div class="modal-body">
        <div class="col-md-12">
            <label>Notes</label>
            <textarea class="form-control" row="5" ng-model="vm.m.form.submit_notes"></textarea>
        </div>
        
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success" data-dismiss="modal" ng-click="vm.finish()">Save</button>
</div>

