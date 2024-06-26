class Crm2521Controller {
    constructor($scope, $state, $compile, $stateParams, $log, AclService, API, UtilsService, RouteService, ClientService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.RouteService = RouteService;
        this.ClientService = ClientService;

        this.m = {
            filter: {}
        };

        this.m.supplier_id = $stateParams.supplier_id;
        this.loadInitData();
    }

    save() {
        let RouteService = this.RouteService;
        let ClientService = this.ClientService;
        this.$log.info("this.form", this.m.form);

        let service = this.API.service('save', this.API.all('crm2521'));
        let param = angular.copy(this.m.filter);
        param.supplier_id = this.m.supplier_id;

        this.$log.info("param", param);

        service.post(param)
            .then((response) => {
                if (this.m.supplier_id != null) {
                    this.ClientService.success("Cập nhật supplier thành công");
                } else {
                    this.ClientService.success("Thêm supplier thành công");
                }
                this.RouteService.goState("app.crm2520");
            });
    }

    loadInitData() {

        if (this.m.supplier_id != null) {
            let initService = this.API.service('load-init', this.API.all('crm2521'));
            let param = angular.copy(this.m);
            param.supplier_id = this.m.supplier_id;
            initService.post(param)
                .then((response) => {
                    this.$log.info(response);
                    this.m.init = response.data;
                    this.m.filter.name = this.m.init[0].name;
                    this.m.filter.supplier_code = this.m.init[0].supplier_code;
                    this.m.filter.contact_name = this.m.init[0].contact_name;
                    this.m.filter.address = this.m.init[0].address;

                    this.m.filter.contact_email = this.m.init[0].contact_email;
                    this.m.filter.contact_tel = this.m.init[0].contact_tel;

                    
                });
        }

    }

    $onInit() {}
}

export const Crm2521Component = {
    //templateUrl: './views/app/components/crm2521/crm2521.component.html',
    templateUrl: '/views/admin.crm2521',
    controller: Crm2521Controller,
    controllerAs: 'vm',
    bindings: {}
}