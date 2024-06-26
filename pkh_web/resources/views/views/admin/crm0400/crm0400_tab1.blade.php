<div class="box-body">
        <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Trạng thái</th>
                    <th class="text-right">Số đơn</th>
                    <th class="text-right">Tổng tiền</th>
                    <th class="text-right">Tổng tiền sau chiết khấu</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat='item in vm.m.reportStatus'>
                    <td>{{ $index+1 }}</td>
                    <td> 
                            <span ng-repeat='state in vm.m.statusList' ng-if="state.status_id == item.delivery_sts" > 
                            <span class="{{state.label}}">{{state.descript}}</span>
                        </span>
                    </td>
                    <td class="text-right"> {{ item.count | currency: '' : 0}}</td>
                    <td class="text-right"> {{ item.total | currency: '' : 0}}</td>
                    <td class="text-right"> {{ item.total_with_discount | currency: '' : 0}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>