class Hrm0715Controller{
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
            employee_id: this.$stateParams.id,
            reveal: false,
        }

    }

    $onInit(){
        this.loadList();
    }

    loadList() {
        let param = { employee_id: this.m.employee_id };
        let service = this.API.service('search', this.API.all('hrm0715'));
        service.post(param)
            .then((response) => {
                this.m.list = response.data.data;
            });
    }

    reveal() {
        this.m.reveal = !this.m.reveal;
    }
}

export const Hrm0715Component = {
    //templateUrl: './views/app/components/hrm0715/hrm0715.component.html',
    templateUrl: '/views/admin.hrm0715',
    controller: Hrm0715Controller,
    controllerAs: 'vm',
    bindings: {}
}
