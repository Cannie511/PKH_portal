class Crm0911Controller{
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

export const Crm0911Component = {
    //templateUrl: './views/app/components/crm0911/crm0911.component.html',
    templateUrl: '/views/admin.crm0911',
    controller: Crm0911Controller,
    controllerAs: 'vm',
    bindings: {}
}
