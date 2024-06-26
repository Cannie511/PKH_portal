class Crm1110Controller {
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
        }
        this.m.delivery_vendor_id = $stateParams.delivery_vendor_id;

        this.loadInitData();

    }

    loadInitData() {

        this.m.filter.contact_name = null;
        this.m.filter.contact_email = null;
        this.m.filter.contact_tel = null;
        this.m.filter.contact_mobile1 = null;
        this.m.filter.contact_mobile2 = null;
        this.m.filter.notes = null;
        if (this.m.delivery_vendor_id != null) {
            let initService = this.API.service('load-init', this.API.all('crm1110'));
            let param = angular.copy(this.m);

            initService.post(param)
                .then((response) => {
                    this.$log.info(response);
                    this.m.init = response.plain().data;
                    this.$log.info('vendor', this.m.init.inforVendor);
                    this.m.filter.contact_name = this.m.init.inforVendor[0].contact_name;
                    this.m.filter.delivery_vendor_name = this.m.init.inforVendor[0].delivery_vendor_name;
                    this.m.filter.contact_email = this.m.init.inforVendor[0].contact_email;
                    this.m.filter.contact_tel = this.m.init.inforVendor[0].contact_tel;
                    this.m.filter.contact_mobile1 = this.m.init.inforVendor[0].contact_mobile1;
                    this.m.filter.contact_mobile2 = this.m.init.inforVendor[0].contact_mobile2;
                    this.m.filter.notes = this.m.init.inforVendor[0].notes;
                });
        }

    }

    save() {

        let RouteService = this.RouteService;
        let ClientService = this.ClientService;
        this.$log.info("this.form", this.m.form);

        this.$log.info('vao save dc oy ahihihihihihihihihihihhihihi');
        this.$log.info('filter: ', this.m.filter);

        let service = this.API.service('save', this.API.all('crm1110'));
        let param = angular.copy(this.m.filter);
        param.delivery_vendor_id = this.m.delivery_vendor_id;
        service.post(param)
            .then((response) => {
                if (this.m.delivery_vendor_id != null) {
                    this.ClientService.success("Cập nhật người giao hàng thành công");
                } else {
                    this.ClientService.success("Thêm người giao hàng thành công");
                }
                this.RouteService.goState("app.crm1100");
            });


    }

    $onInit() {}
}

export const Crm1110Component = {
    //templateUrl: './views/app/components/crm1110/crm1110.component.html',
    templateUrl: '/views/admin.crm1110',
    controller: Crm1110Controller,
    controllerAs: 'vm',
    bindings: {}
}