class Crm1510Controller {
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

        this.m.packing_id = $stateParams.packing_id;
        this.loadInitData();
    }

    save() {
        let RouteService = this.RouteService;
        let ClientService = this.ClientService;
        this.$log.info("this.form", this.m.form);

        let service = this.API.service('save', this.API.all('crm1510'));
        let param = angular.copy(this.m.filter);
        param.packing_id = this.m.packing_id;

        this.$log.info("param", param);

        service.post(param)
            .then((response) => {
                if (this.m.packing_id != null) {
                    this.ClientService.success("Cập nhật packing thành công");
                } else {
                    this.ClientService.success("Thêm packing thành công");
                }
                this.RouteService.goState("app.crm1500");
            });
    }

    loadInitData() {

        if (this.m.packing_id != null) {
            let initService = this.API.service('load-init', this.API.all('crm1510'));
            let param = angular.copy(this.m);
            param.packing_id = this.m.packing_id;
            initService.post(param)
                .then((response) => {
                    this.$log.info(response);
                    this.m.init = response.data;
                    this.m.filter.length = this.m.init[0].length;
                    this.m.filter.width = this.m.init[0].width;
                    this.m.filter.height = this.m.init[0].height;
                });
        }

    }

    $onInit() {}
}

export const Crm1510Component = {
    //templateUrl: './views/app/components/crm1510/crm1510.component.html',
    templateUrl: '/views/admin.crm1510',
    controller: Crm1510Controller,
    controllerAs: 'vm',
    bindings: {}
}