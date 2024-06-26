export class StoreDialogController {
    constructor($scope, $uibModalInstance, DialogService) {
        'ngInject';

        this.m = {
            msg: 'this is my model  2. StoreDialogController 11 22 33'
        }

        this.DialogService = DialogService;
        this.$uibModalInstance = $uibModalInstance;
    }

    save() {
        //Logic here
        // this.DialogService.hide();
    }

    cancel() {
        // this.DialogService.cancel();
    }
}