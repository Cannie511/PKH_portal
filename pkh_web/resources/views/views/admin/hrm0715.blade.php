@extends('views.admin.layouts.hrm0710-tpl')

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Danh sách hợp đồng</h3>
        <div class="box-tools pull-right">
             <button class="btn btn-default btn-xs" ng-click="vm.reveal()" ng-if="!vm.m.reveal">
                <i class="fa fas fa-eye"></i>&nbsp;Tiết lộ
            </button>
             <button class="btn btn-default btn-xs" ng-click="vm.reveal()" ng-if="vm.m.reveal">
                <i class="fa fas fa-eye-slash"></i>&nbsp;Không tiết lộ
            </button>
             <a ui-sref="app.hrm0716({ employee_id: vm.m.employee_id,contract_id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a>
        </div>
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Mã</th>
                        <th>Bắt đầu</th>
                        <th>Kết thúc</th>
                        <th>Loại</th>
                        <th>Tiêu đề</th>
                        <th class="text-center">Lương</th>
                        <th class="text-center">Lương căn bản</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat='item in vm.m.list.data'>
                        <td>{{$index + 1}}</td>
                        <td>{{item.contract_no}}</td>
                        <td>{{item.start_date}}</td>
                        <td>{{item.end_date}}</td>
                        <td>
                            <span ng-if="item.contract_type == 'FULL_TIME'">Toàn thời gian</span>
                            <span ng-if="item.contract_type == 'PART_TIME'">Bán thời gian</span>
                            <span ng-if="item.contract_type == 'PROBATION'">Thử việc</span>
                        </td>
                        <td>{{item.title}}</td>
                        <td class="text-right">
                            <span ng-if="!vm.m.reveal">******</span>
                            <span ng-if="vm.m.reveal">{{item.salary | currency:'':0}}</span>
                        </td>
                        <td class="text-right">
                            <span ng-if="!vm.m.reveal">******</span>
                            <span ng-if="vm.m.reveal">{{item.basic_salary | currency:'':0}}</span>
                        </td>
                        <td>
                            <a ui-sref="app.hrm0716({ employee_id: vm.m.employee_id,contract_id: item.id})" class="btn btn-xs btn-info"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row text-right">
            <div class="col-md-12">
                <uib-pagination ng-show="vm.m.list.from > 0"
                    total-items="vm.m.list.total"
                    ng-model="vm.m.list.current_page"
                    items-per-page="vm.m.list.per_page"
                    ng-change="vm.doSearch(vm.m.list.current_page)"
                    class="pagination pagination-sm m-t-none m-b-none">
                </uib-pagination>    
            </div>
        </div>
    </div>
</div>
@stop