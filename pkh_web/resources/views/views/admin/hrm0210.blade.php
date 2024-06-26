<section class="content-header">
    <h1>Bài kiểm tra<small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li class="active">Bài kiểm tra</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{vm.m.data.name}}&nbsp;{{vm.m.min}} phút</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body text-center">
                    <a href="javascript:void(0)" class="btn btn-lg btn-info" ng-click="vm.start()" ng-if="!vm.started">
                        <i class="fa fa-play fa-fw fa-2x"></i> Bắt đầu
                    </a>
                    <h2 ng-if="vm.started">{{vm.m.clockString}}</h2>
                </div>
                <div class="box-body" ng-if="vm.started">
                    <div class="box box-primary" ng-repeat="(keyGroup, group) in vm.m.data.items">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{group.name}}</h3>
                        </div>
                        <div class="box-body form">
                            <ul class="list-group">
                                <li class="list-group-item" ng-repeat="(keySen, sentence) in group.items">
                                    <div class="form-group">
                                        <p class="form-control-static">({{sentence.seq_no}}) {{sentence.no}}. {{sentence.text}}</p>
                                        <textarea class="form-control" rows="5" ng-model="sentence.answer"></textarea>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary btn-lg btn-width-default" ng-click="vm.finish()">
                                <i class="fa fa-send fa-fw"></i>
                                Gửi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
