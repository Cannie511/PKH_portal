<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="vm.cancel()"><span aria-hidden="true">&times;</span></button>
    <div class="modal-title">
        Finish your task 
    </div> 
</div>
<div class="modal-body">
        <div class="col-md-12">
            <label>Cửa hàng</label>
            <p class="form-control-static">{{vm.m.cs.store_name}} - {{vm.m.cs.area1 }} {{vm.m.cs.area2 }}  </p>    
        </div>
        <div class="col-md-12">
            <label>PIC</label>
            <p class="form-control-static">{{vm.m.cs.salesman_name}} </p>    
        </div>
        <div class="col-md-4">
            <label>Rating</label>
            <p class="form-control-static">{{vm.m.cs.cus_rating}}/5  </p>    
        </div>
        <div class="col-md-4">
            <label>Complete hour</label>
            <p class="form-control-static">{{vm.m.cs.complete_hour}} (h)  </p>    
        </div>
        <div class="col-md-4">
            <label>Delay hour</label>
            <p class="form-control-static">{{vm.m.cs.delay_hour}}  (h)</p>    
        </div>
        <div class="col-md-6">
            <label>Deadline</label>
            <p class="form-control-static">{{vm.m.cs.deadline}}  </p>    
        </div>
        <div class="col-md-6">
            <label>Complete time</label>
            <p class="form-control-static">{{vm.m.cs.completed_time}}  </p>    
        </div>
        
     
    
        <div class="col-md-6">
            <label>Created </label>
            <p class="form-control-static">  {{vm.m.cs.created_by}} - {{vm.m.cs.created_at}} </p>    
        </div>
        <div class="col-md-6">
            <label>Updated </label>
            <p class="form-control-static">  {{vm.m.cs.updated_by}} - {{vm.m.cs.updated_at}} </p>    
        </div>
        <div class="col-md-12">
            <label>Review</label>
            <p class="form-control-static">{{vm.m.cs.cus_review}}  </p>    
        </div>
    
        <div class="col-md-12" ng-if="vm.m.edit == false">
            <label>Solution </label>
            <p class="form-control-static">  {{vm.m.cs.com_resolve}}  </p>    
        </div>
        <div class="col-md-12" ng-if="vm.m.edit == true">
            <label>Solution</label>
            <textarea class="form-control" row="10" ng-model="vm.m.form.com_resolve" required></textarea>
        </div>
        
</div>
<div class="modal-footer">
    <button type="button"   ng-if="vm.m.edit == true" class="btn btn-success" data-dismiss="modal" ng-click="vm.finish()">Save</button>
</div>

