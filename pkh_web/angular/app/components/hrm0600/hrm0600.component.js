class Hrm0600Controller{
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
            init: {},
            form: {
                changed_date: moment(new Date())
            },
            dateOptions: {
                format: 'YYYY-MM-DD'
            }
        }

    }

    $onInit(){
    }
}

export const Hrm0600Component = {
    //templateUrl: './views/app/components/hrm0600/hrm0600.component.html',
    templateUrl: '/views/admin.hrm0600',
    controller: Hrm0600Controller,
    controllerAs: 'vm',
    bindings: {}
}
