@extends('views.admin.layouts.hrm0710-tpl')

@section('content')
<div ng-if="vm.m.screenMode === 'VIEW'">
    <hrm0713/>
</div>
<div ng-if="vm.m.screenMode === 'EDIT'">
    <hrm0714/>
</div>
@stop