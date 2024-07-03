export class Crm0300DialogController {
    constructor($scope, $uibModalInstance, DialogService, $log, $filter, param) {
        'ngInject';

        this.$scope = $scope;
        this.$log = $log;
        this.DialogService = DialogService;
        this.$uibModalInstance = $uibModalInstance;
        this.$log.info('dialog param', param);
        this.m = {
            item: param.item,
            salesman: param.salesman,
            chosenSale: -1
        }
        this.m.chosenSale = this.m.item.salesman_id;
    }

    cancel() {
        let obj = {
            chosenSale: this.m.chosenSale
        };
        this.DialogService.close(obj);
    }
}