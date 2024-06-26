class Hrm0714Controller{
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
            employee_id: this.$stateParams.id,
            form: {
                changed_date: moment(new Date())
            },
            dateOptions: {
                viewMode: 'days',
                format: 'YYYY-MM-DD'
            }
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
                that.m.form = response.data.data;
            });
    }

    save(isValid, form) {
        if (isValid) {
            let param = angular.copy(this.m.form);
            param.id = this.m.employee_id;

            // convert moment to date 'YYYY-MM-DD'
            let dateFields = ["dob", "start_date", "end_date", "probation_start_date", "probation_end_date", "card_id_issue_on"];
            dateFields.forEach((item) => {
                if (param[item] != null ) {
                    param[item] = param[item].format('YYYY-MM-DD');
                }
            });

            let service = this.API.service('save', this.API.all('hrm0714'));
            let that = this;
            service.post(param)
                .then(function(response) {
                    let res = response.data;
                    if( res.rtnCd ) {
                        that.ClientService.success(res.msg);
                    } else {
                        that.ClientService.error(res.msg);
                    }
                });
        } else {
            this.formSubmitted = true
        }
    }
}

export const Hrm0714Component = {
    //templateUrl: './views/app/components/hrm0714/hrm0714.component.html',
    templateUrl: '/views/admin.hrm0714',
    controller: Hrm0714Controller,
    controllerAs: 'vm',
    bindings: {}
}
