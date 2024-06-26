class MobileController{
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

export const MobileComponent = {
    //templateUrl: './views/app/components/mobile/mobile.component.html',
    templateUrl: '/views/admin.mobile',
    controller: MobileController,
    controllerAs: 'vm',
    bindings: {}
}
