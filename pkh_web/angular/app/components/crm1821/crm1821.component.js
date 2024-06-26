class Crm1821Controller {
    constructor($scope, $state, $log, API, UtilsService, ClientService, $stateParams, RouteService) {
        'ngInject'
        this.$state = $state;
        this.$log = $log;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.RouteService = RouteService;
        this.m = {
            form: {}
        }
        this.m.department_id = $stateParams.department_id;
        this.loadInitData();
    }

    $onInit() {}

    checkCondition(form) {
        let ClientService = this.ClientService;
        if (!form.name || form.name == "") {
            ClientService.error("Chưa nhập tên phòng ban");
            return false;
        }
        if (!form.description || form.description == "") {
            ClientService.error("Chưa nhập mô tả phòng ban");
            return false;
        }
        return true;
    }

    save() {
        //let $log = this.$log;
        let alerts = this.alerts;
        let RouteService = this.RouteService;
        let ClientService = this.ClientService;
        let saveService = this.API.service('save', this.API.all('crm1821'));
        if (!this.checkCondition(this.m.form)) {
            return;
        }

        let param = angular.copy(this.m.form);

        param.department_id = this.m.department_id;

        saveService.post(param)
            .then(function(response) {
                let msg = response.data;
                ClientService.success(msg);
                RouteService.goState('app.crm1820');
            });

    }

    loadInitData() {
        if (!this.m.department_id) {
            return;
        }
        let param = {
            department_id: this.m.department_id
        };
        let service = this.API.service('load-init', this.API.all('crm1821'));
        service.post(param)
            .then((response) => {
                this.m.form = response.data.department;
            });
    }
}

export const Crm1821Component = {
    //templateUrl: './views/app/components/crm1821/crm1821.component.html',
    templateUrl: '/views/admin.crm1821',
    controller: Crm1821Controller,
    controllerAs: 'vm',
    bindings: {}
}