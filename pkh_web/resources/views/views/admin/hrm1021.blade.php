<section class="content-header">
    <h1>Xem tin tức nội bộ<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.hrm1020">Tin tức nội bộ</a></li>
        <li class="active">Xem tin tức nội bộ</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{vm.m.form.title}}</h3>
                    <div class="box-tools pull-right">
                        <!-- <a ui-sref="app.hrm1010({ employee_id: vm.m.employee_id,contract_id: 0})" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;{{'COM_BTN_NEW' | translate}}</a> -->
                    </div>
                </div>
                <form class="form" name="form" ng-submit="vm.save(form.$valid, form)" novalidate>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p ng-bind-html="vm.m.form.content"></p>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <p class="form-control-static"><i>{{vm.m.form.updated_at}}</i></p>
                            </div> 
                        </div>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>