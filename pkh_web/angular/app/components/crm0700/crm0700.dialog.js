export class Crm0700DialogController {
    constructor($scope, $uibModalInstance, DialogService, $log, $filter,API, param) {
        'ngInject';

        this.$scope = $scope;
        this.$log = $log;
        this.DialogService = DialogService;
        this.$uibModalInstance = $uibModalInstance;
        this.API = API
        //his.$log.info('dialog param', param);
        this.m = {
            store_id: param.store_id,
            store_name: param.store_name
        }
        // this.API = param.API;
        this.$log.info('check dialog: ', this.m);
    }


    update() {
        let searchService = this.API.service('update-accountant', this.API.all('crm0700'));
        let param = angular.copy(this.m);
        
        searchService.post(param)
            .then((response) => {
                this.DialogService.close();
            });
    }

    cancel(){
        this.DialogService.close();
    }
}