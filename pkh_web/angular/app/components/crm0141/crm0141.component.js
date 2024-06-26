class Crm0141Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;

        this.m = {
            form: {},
            list: {}
        };

    }

    $onInit() {
        this.load();
    }

    load() {
        let service = this.API.service('load', this.API.all('crm0140'));
        service.post()
            .then((response) => {
                this.m.list = response.plain().data.listPrice;
                this.m.form = response.plain().data;
                this.$log.info('this.m.list', this.m.list);
                this.$log.info('response:', response.plain().data);
                this.$log.info('this.m.form', this.m.form.crm_price_list);
            });
    }
}

export const Crm0141Component = {
    //templateUrl: './views/app/components/crm0141/crm0141.component.html',
    templateUrl: '/views/admin.crm0141',
    controller: Crm0141Controller,
    controllerAs: 'vm',
    bindings: {}
}