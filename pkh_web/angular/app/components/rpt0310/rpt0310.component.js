class Rpt0310Controller{
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

export const Rpt0310Component = {
    //templateUrl: './views/app/components/rpt0310/rpt0310.component.html',
    templateUrl: '/views/admin.rpt0310',
    controller: Rpt0310Controller,
    controllerAs: 'vm',
    bindings: {}
}
