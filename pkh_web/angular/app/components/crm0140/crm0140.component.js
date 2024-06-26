class Crm0140Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.can = AclService.can;

        this.m = {
            filter: {},
            form: {},
            list: {}
        };

    }

    $onInit() {
        // this.load();
        this.loadInit();
    }

    loadInit() {
        let service = this.API.service('load-init', this.API.all('crm0140'));
        service.post()
            .then((response) => {
                this.m.filter.supplier_id = 1;
                this.m.listSupplier = response.plain().data.listSupplier;
                this.load();
            });
    }

    load() {
        console.log('this.m.form.supplier_id :>> ', this.m.filter.supplier_id);
        let param = {
            supplier_id: this.m.filter.supplier_id
        };
        let service = this.API.service('load', this.API.all('crm0140'));
        service.post(param)
            .then((response) => {
                this.m.list = response.plain().data.listPrice;
                this.m.form = response.plain().data;
                this.$log.info('this.m.list', this.m.list);
                this.$log.info('response:', response.plain().data);
                this.$log.info('this.m.form', this.m.form.crm_price_list);
            });
    }

    save() {
        let service = this.API.service('save', this.API.all('crm0140'));
        var param = this.m.form;
        this.$log.info('param', param);
        param.supplier_id = this.m.filter.supplier_id;
        service.post(param)
            .then((response) => {
                this.m.list = response.plain().data.listPrice;
                this.m.form = response.plain().data;
                this.$log.info('response:', response.plain().data);
                this.$log.info('this.m.list', this.m.list);
                this.$log.info('this.m.form', this.m.form.crm_price_list);
                // this.ClientService.success(this.$translate.instant('MSG_I000003'));
            });
    }

    clickPrint(dir) {
        var param = angular.copy(this.m.list);
        param.dir = dir;
        this.$log.info('param', param);
        let service = this.API.service('print', this.API.all('crm0140'));
        service.post(param)
            .then((res) => {
                if (res.data.rtnCd == true) {
                    window.open(res.data.url);
                } else {
                    this.ClientService.error('Không tải được tập tin.');
                }
            });
    }

    search() {
        this.load();
    }
}

export const Crm0140Component = {
    //templateUrl: './views/app/components/crm0140/crm0140.component.html',
    templateUrl: '/views/admin.crm0140',
    controller: Crm0140Controller,
    controllerAs: 'vm',
    bindings: {}
}