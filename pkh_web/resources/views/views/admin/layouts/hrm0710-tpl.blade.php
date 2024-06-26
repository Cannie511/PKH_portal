<?php
// Layout for detail employee
?>
<section class="content-header">
    <h1>Chi tiết nhân viên<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.hrm0700"><span>Nhân viên</span></a></li>
        <li class="active">Chi tiết nhân viên</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12 col-md-3 col-lg-3">
            <hrm0711/>
            <!-- <hrm0712/> -->
        </div>
        <div class="col-xs-12 col-md-9 col-lg-9">
            @yield("content")
            <!-- <div ng-if="vm.m.screenMode === 'VIEW'">
                <hrm0713/>
            </div>
            <div ng-if="vm.m.screenMode === 'EDIT'">
                <hrm0714/>
            </div> -->
        </div>
    </div>
</section>