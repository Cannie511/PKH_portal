class Hrm0712Controller{
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
            employee_id: this.$stateParams.id
            // init: {},
            // form: {
            //     changed_date: moment(new Date())
            // },
            // dateOptions: {
            //     format: 'YYYY-MM-DD'
            // }
        }

    }

    $onInit(){
        this.m.screen_name = this.$state.current.name.split('.')[1];
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

export const Hrm0712Component = {
    //templateUrl: './views/app/components/hrm0712/hrm0712.component.html',
    templateUrl: '/views/admin.hrm0712',
    controller: Hrm0712Controller,
    controllerAs: 'vm',
    bindings: {}
}
