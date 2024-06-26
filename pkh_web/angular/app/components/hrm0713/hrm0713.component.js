class Hrm0713Controller{
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
                that.m.employee = response.data.data;
            });
    }
    
    sendCode() {
        let service = this.API.service('send-code', this.API.all('hrm0711'));
        let param = { id: this.m.employee_id };
        service.post(param)
            .then((response) => {
                console.log('response.data :>> ', response.data);
                let data = response.data.data;
                if( data.rtnCd == true) {
                    this.ClientService.success(data.msg);
                } else {
                    this.ClientService.error(data.msg);
                }
            });
    }
}

export const Hrm0713Component = {
    //templateUrl: './views/app/components/hrm0713/hrm0713.component.html',
    templateUrl: '/views/admin.hrm0713',
    controller: Hrm0713Controller,
    controllerAs: 'vm',
    bindings: {}
}
