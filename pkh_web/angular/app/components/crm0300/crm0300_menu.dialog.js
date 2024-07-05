export class Crm0300MenuDialogController {
    constructor($scope, $uibModalInstance, DialogService, $log, $filter, param) {
        'ngInject';

        this.$scope = $scope;
        this.$log = $log;
        this.DialogService = DialogService;
        this.$uibModalInstance = $uibModalInstance;

        this.m = {
            item: param.item,
            crm0710: param.crm0710,
            crm1630: param.crm1630,
            crm1210: param.crm1210,
            crm3010: param.crm3010
        }
    }
    cancel() {
        this.DialogService.close();
        //this.$log.info("store_id", this.m.item);
    }
}