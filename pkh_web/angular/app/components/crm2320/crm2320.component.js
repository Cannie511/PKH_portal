class Crm2320Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;

        this.m = {
        }

    }

    $onInit(){
    }
}

export const Crm2320Component = {
    //templateUrl: './views/app/components/crm2320/crm2320.component.html',
    templateUrl: '/views/admin.crm2320',
    controller: Crm2320Controller,
    controllerAs: 'vm',
    bindings: {}
}
