export class Crm0720DialogController {
    constructor($scope, $uibModalInstance, DialogService, $log, $filter, param) {
        'ngInject';

        this.$scope = $scope;
        this.$log = $log;
        this.DialogService = DialogService;
        this.$uibModalInstance = $uibModalInstance;
        this.$log.info('dialog param', param);
        this.m = {
            item: param.item,
            data: param.data.delivery,
            AVG: param.data.AVG,
            detail: 1
        }

    }

    showDetail() {
        this.m.detail = this.m.detail * -1;
    }

    cancel() {

        this.DialogService.close();
    }
}