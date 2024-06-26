class Crm2540Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, $stateParams, ClientService, RouteService) {
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
        this.RouteService = RouteService;

        this.m = {
            init: {},
            form: {
                changed_date: moment(new Date())
            },
            dateOptions: {
                format: 'YYYY-MM-DD'
            }
        }

        this.$log.info( "$stateParams",  $stateParams);
    }

    $onInit(){
        if (this.$stateParams.product_market_his_id > 0) {
            this.m.form.product_market_his_id = this.$stateParams.product_market_his_id;
        } else {
            this.m.form.product_market_his_id = 0;
        }

        this.m.form.warehouse_change_type = this.$stateParams.warehouse_change_type;
        if( !this.m.form.warehouse_change_type ) {
            this.m.form.warehouse_change_type = 1;
        }

        this.loadInit();
    }

    loadInit() {
        let service = this.API.service("init", this.API.all('crm2540'));

        let param = angular.copy(this.m.form);

        service.post(param)
            .then((response) => {
                var data = response.plain().data;

                if( data.form != null) {
                    data.form.type = data.form.type + "";
                    this.m.form = data.form;
                }
                this.m.init.listProduct = data.listProduct;
            }, (response) => {
                this.m.errors = response.data.errors;
            });
    }

    save(isValid) {
        this.$log.info(isValid);
        this.$log.info("this.form", this.m.form);
        if (!isValid) {
            return;
        }
        this.m.errors = null;

        let action = 'create';
        if (this.m.form.product_market_his_id > 0) {
            action = 'update';
        }

        let service = this.API.service(action, this.API.all('crm2540'));

        let param = angular.copy(this.m.form);
        if( param.changed_date) {
            param.changed_date = param.changed_date.format('YYYY-MM-DD');
        }

        service.post(param)
            .then((response) => {
                this.$log.info('ok response', response.plain().data);
                let result = response.plain().data;
                if (result.rtnCd) {
                    this.ClientService.success(result.msg);
                    this.RouteService.goState('app.crm2530');
                }
            }, (response) => {
                this.$log.info('ng response', response);
                this.m.errors = response.data.errors;
            });
    }

    updateStatus(status) {
        let param = {
            product_market_his_id: this.m.form.product_market_his_id,
            description_approve: this.m.form.description_approve,
            status: status
        };

        let service = this.API.service("status", this.API.all('crm2540'));
        service.post(param)
            .then((response) => {
                this.$log.info('ok response', response.plain().data);
                let result = response.plain().data;
                if (result.rtnCd) {
                    this.ClientService.success(result.msg);
                    this.RouteService.goState('app.crm2530');
                }
            }, (response) => {
                this.$log.info('ng response', response);
                this.m.errors = response.data.errors;
            });
    }
}

export const Crm2540Component = {
    //templateUrl: './views/app/components/crm2540/crm2540.component.html',
    templateUrl: '/views/admin.crm2540',
    controller: Crm2540Controller,
    controllerAs: 'vm',
    bindings: {}
}
