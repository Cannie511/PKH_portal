class Hrm0711Controller{
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
            employee: null
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
        let service = this.API.service('load', this.API.all('hrm0711'));
        let param = { id: this.m.employee_id };
        let that = this;
        service.post(param)
            .then(function(response) {
                let data = response.data.data;
                data.count_dependent_person = parseInt(data.count_dependent_person);
                that.m.employee = data;
            });
    }
}

export const Hrm0711Component = {
    //templateUrl: './views/app/components/hrm0711/hrm0711.component.html',
    templateUrl: '/views/admin.hrm0711',
    controller: Hrm0711Controller,
    controllerAs: 'vm',
    bindings: {}
}
