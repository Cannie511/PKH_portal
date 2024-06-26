class Crm0121Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, $stateParams, ClientService, RouteService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.RouteService = RouteService;
        this.m = {
            form: {},
            init: {}
        }

        if ($stateParams.product_cat1_id > 0) {
            this.m.form.product_cat1_id = $stateParams.product_cat1_id;
        } else {
            this.m.form.product_cat1_id = 0;
        }

    }

    $onInit() {
        this.loadInitData();
    }

    loadInitData() {

        let thisClass = this;
        thisClass.$log.info('check', thisClass);
        if (this.m.form.product_cat1_id > 0) {
            let service = this.API.service('load', this.API.all('crm0121'));
            let param = { product_cat1_id: this.m.form.product_cat1_id };
            service.post(param)
                .then(function(response) {

                    thisClass.m.form = response.data.product[0];
                    thisClass.setInitValue(response.data.init);
                    thisClass.$log.info('check x', thisClass);
                }, function(response) {

                });
        } else {
            let service = this.API.service('load-init', this.API.all('crm0121'));
            let param = {};
            service.post(param)
                .then(function(response) {

                    thisClass.setInitValue(response.data.init);
                }, function(response) {

                });
        }
    }

    setInitValue(initObj) {
        this.m.init.listSupplier = initObj;
    }

    save(isValid) {

        if (!isValid) {
            return;
        }
        this.m.errors = null;

        let thisClass = this;
        let action = 'create';
        if (this.m.form.product_cat1_id > 0) {
            action = 'update';
        }

        let service = this.API.service(action, this.API.all('crm0121'));

        let param = angular.copy(this.m.form);
        thisClass.$log.info('param', param);
        service.post(param)
            .then((response) => {
                thisClass.$log.info('ok response', response.plain().data);
                this.m.data = response.plain().data;
                let result = response.plain().data;
                if (result.rtnCd) {
                    thisClass.ClientService.success(result.msg);
                    thisClass.RouteService.goState('app.crm0120');
                }
            }, (response) => {
                //thisClass.$log.info('ng response', response);
                this.m.errors = response.data.errors;
            });

    }
}

export const Crm0121Component = {
    //templateUrl: './views/app/components/crm0121/crm0121.component.html',
    templateUrl: '/views/admin.crm0121',
    controller: Crm0121Controller,
    controllerAs: 'vm',
    bindings: {}
}