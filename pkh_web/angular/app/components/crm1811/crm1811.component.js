class Crm1811Controller {
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
        this.m.cost_cat_id = $stateParams.cost_cat_id;
        this.loadInitData();
    }

    $onInit() {}

    checkCondition(form) {
        let ClientService = this.ClientService;
        if (!form.name || form.name == "") {
            ClientService.error("Chưa nhập tên loại chi phí");
            return false;
        }
        if (!form.description || form.description == "") {
            ClientService.error("Chưa nhập mô tả loại chi phí");
            return false;
        }
        return true;
    }

    save() {
        //let $log = this.$log;
        let alerts = this.alerts;
        let RouteService = this.RouteService;
        let ClientService = this.ClientService;
        let saveService = this.API.service('save', this.API.all('crm1811'));
        if (!this.checkCondition(this.m.form)) {
            return;
        }

        let param = angular.copy(this.m.form);

        param.cost_cat_id = this.m.cost_cat_id;

        saveService.post(param)
            .then(function(response) {
                let msg = response.data;
                ClientService.success(msg);
                RouteService.goState('app.crm1810');
            });

    }

    loadInitData() {
        if (!this.m.cost_cat_id) {
            return;
        }
        let param = {
            cost_cat_id: this.m.cost_cat_id
        };
        let service = this.API.service('load-init', this.API.all('crm1811'));
        service.post(param)
            .then((response) => {
                this.m.form = response.data.cost_cat;
            });
    }
}

export const Crm1811Component = {
    //templateUrl: './views/app/components/crm1811/crm1811.component.html',
    templateUrl: '/views/admin.crm1811',
    controller: Crm1811Controller,
    controllerAs: 'vm',
    bindings: {}
}