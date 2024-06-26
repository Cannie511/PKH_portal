export class Crm0210PromotionDialogController {
    constructor($scope, $uibModalInstance, DialogService, $log, $filter, param) {
        'ngInject';

        this.$scope = $scope;
        this.$log = $log;
        this.DialogService = DialogService;
        this.$uibModalInstance = $uibModalInstance;

        this.m = {
            promotion: null,
            list: param.list
        }

        // TODO: load list here
    }



    cancel() {
        this.DialogService.close();
    }

    clickApply() {
        this.$log.log(this.m, this.m.promotion.promotion_id)
        if (this.m.promotion != null && this.m.promotion.promotion_id > 0) {
            this.DialogService.close(this.m.promotion);
        }
    }
}