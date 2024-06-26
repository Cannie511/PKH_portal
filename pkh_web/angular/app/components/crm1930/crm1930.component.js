class Crm1930Controller{
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

export const Crm1930Component = {
    //templateUrl: './views/app/components/crm1930/crm1930.component.html',
    templateUrl: '/views/admin.crm1930',
    controller: Crm1930Controller,
    controllerAs: 'vm',
    bindings: {}
}
