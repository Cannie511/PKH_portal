class Crm1010Controller {
    constructor($scope, $state, API, $log, $stateParams, RouteService, ClientService) {
        'ngInject';

        this.$state = $state
        this.formSubmitted = false
        this.API = API
        this.alerts = []
        this.$log = $log
        this.RouteService = RouteService
        this.ClientService = ClientService

        this.m = {
            filter: {},
            init: {}
        }

        this.m.delivery_id = $stateParams.delivery_id;
        this.loadInitData();
    }

    $onInit() {}

    loadInitData() {
        this.m.filter.notes = null;
        this.m.filter.delivery_date = new Date();

        let initService = this.API.service('load-init', this.API.all('crm1010'));
        let param = angular.copy(this.m.filter);

        if (this.m.delivery_id == null) {
            param.delivery_id = null;
        } else {
            param.delivery_id = this.m.delivery_id;
        }

        initService.post(param)
            .then((response) => {
                this.$log.info(response);
                this.m.init = response.plain().data;
                if (this.m.delivery_id != null) {
                    this.$log.info('edit', this.m.init.infordelivery[0]);
                    this.m.filter.delivery_date = new Date(this.m.init.infordelivery[0].delivery_date);
                    this.m.filter.price = parseInt(this.m.init.infordelivery[0].price);
                    this.m.filter.delivery_vendor_id = this.m.init.infordelivery[0].delivery_vendor_id;
                    this.m.filter.notes = this.m.init.infordelivery[0].notes;
                }
            });
    }

    save() {

        let $log = this.$log;
        $log.info('aihihihihi', this.m.filter);
        let alerts = this.alerts;
        let RouteService = this.RouteService;
        let ClientService = this.ClientService;
        let saveService = this.API.service('save', this.API.all('crm1010'));
        let param = angular.copy(this.m.filter);
        if (this.m.delivery_id == null) {
            param.delivery_id = null;
        } else {
            param.delivery_id = this.m.delivery_id;
        }
        saveService.post(param)
            .then(function(response) {

                if (param.delivery_id == null) {
                    ClientService.success('Thêm mới chi phí thành công');
                    RouteService.goState('app.crm0400');
                } else {
                    ClientService.success('Cập nhật  chi phí thành công');
                    RouteService.goState('app.crm1000');
                }


            });

    }

    validation() {

    }
}

export const Crm1010Component = {
    templateUrl: './views/admin.crm1010',
    controller: Crm1010Controller,
    controllerAs: 'vm',
    bindings: {}
}