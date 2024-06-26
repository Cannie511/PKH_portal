class Hrm0710Controller{
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
            screenMode : null,
            employee_id: this.$stateParams.id
        }

    }

    $onInit(){
        this.m.screen_name = this.$state.current.name.split('.')[1];
        this.m.screenMode = this.$stateParams.screenMode === 'EDIT' ? 'EDIT': 'VIEW';
        this.loadEmployee(this.m.employee_id);
    }

    loadEmployee(employee_id) {
        // let service = this.API.service('load', this.API.all('crm2601'));
        // let param = { store_id: this.m.store_id };
        // let that = this;
        // service.post(param)
        //     .then(function(response) {
        //         that.m.store = response.data.store;
        //     });
    }
}

export const Hrm0710Component = {
    //templateUrl: './views/app/components/hrm0710/hrm0710.component.html',
    templateUrl: '/views/admin.hrm0710',
    controller: Hrm0710Controller,
    controllerAs: 'vm',
    bindings: {}
}
