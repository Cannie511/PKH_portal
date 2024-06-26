class Crm2602Controller{
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
            screen_name: null,
            store_id: this.$stateParams.store_id
        }
    }

    $onInit(){
        this.loadStore(this.m.store_id);
        this.m.screen_name = this.$state.current.name.split('.')[1];
    }

    loadStore(store_id) {
        // console.log('crm2602 load store', store_id);
    }
}

export const Crm2602Component = {
    //templateUrl: './views/app/components/crm2602/crm2602.component.html',
    templateUrl: '/views/admin.crm2602',
    controller: Crm2602Controller,
    controllerAs: 'vm',
    bindings: {}
}
