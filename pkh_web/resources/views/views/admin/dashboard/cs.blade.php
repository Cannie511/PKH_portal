

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th> </th>
                <th>NO</th>
                <th>Area</th>    
                <th>Store</th>
                
                <th>Status</th>
                <th>Rating</th>
                <th>Review</th>
                <th>Resolve</th>
                <th>Created_by</th>
            </tr>
        </thead>
        <tbody>
             <tr ng-repeat='item in vm.m.csToday'>
                <td class="col-action">
                    <a class="btn btn-xs btn-warning" ui-sref='app.rpt0514({store_id: item.store_id})'>
                        <i class="fa fa-edit"></i>
                    </a>
                </td>
                <td>{{$index + vm.m.data.from}}</td>
                <td>
                    {{item.area1 }} <br> 
                    {{item.area2 }}
                </td>
                
                <td style="width:200px">
                    {{item.store_name}}
                    <br>
                    PIC: {{item.salesman_name}}
                </td>
                
                <!-- """
                0: pending 
                1: done
                2: black list
                """ -->
                    <td>
                    <span ng-if="item.status==0">Pending</span>
                    <span ng-if="item.status==1">Done</span>
                    <span ng-if="item.status==2">Blacklist</span>
                </td>
                    <td>
                    {{item.cus_rating}}/5
                    
                </td>
                    <td style="width:300px">{{item.cus_review}}</td>
                    <td style="width:300px">{{item.com_resolve}}</td>
                    <td>
                    {{item.created_by}}
                    <br>
                    {{item.created_at}}
                </td>
            </tr>
        </tbody>
    </table>
</div>