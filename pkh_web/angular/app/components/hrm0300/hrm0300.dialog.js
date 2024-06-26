export class Hrm0300DialogController {
    constructor($scope, $uibModalInstance, DialogService, $log, $filter,API, param) {
        'ngInject';

        this.$scope = $scope;
        this.$log = $log;
        this.DialogService = DialogService;
        this.$uibModalInstance = $uibModalInstance;
        this.API = API
        //his.$log.info('dialog param', param);
        this.m = {
            task: param.task
        }
        // this.API = param.API;
        this.$log.info('check dialog: ', this.m);
    }

    cancel(){
        this.DialogService.close();
    }
}