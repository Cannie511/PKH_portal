class Crm2601Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, $stateParams, ClientService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.can = AclService.can;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.$stateParams = $stateParams;

        this.m = {
            store_id: this.$stateParams.store_id
        }
    }

    $onInit(){
        this.m.screen_name = this.$state.current.name.split('.')[1];
        this.loadStore(this.m.store_id);

        this.$scope.$on('crm2601-reload', () => {
            this.loadStore(this.m.store_id);
        });
    }

    loadStore(store_id) {
        let service = this.API.service('load', this.API.all('crm2601'));
        let param = { store_id: this.m.store_id };
        service.post(param)
            .then((response) => {
                let store = response.data.store;

                if (store.review_expired_date && moment(new Date()).isAfter(store.review_expired_date)) {
                    store.is_review_valid = false;
                } else {
                    store.is_review_valid = true;
                }
                this.m.store = store;
            });
    }
}

export const Crm2601Component = {
    //templateUrl: './views/app/components/crm2601/crm2601.component.html',
    templateUrl: '/views/admin.crm2601',
    controller: Crm2601Controller,
    controllerAs: 'vm',
    bindings: {}
}
