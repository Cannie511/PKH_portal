class Crm1200Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, ClientService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;

        this.m = {
            filter: {},
            data: {}
        }
        this.doSearch(1);
    }

    $onInit() {

    }

    resetFilter() {
        this.m.filter.store_name = "";
        this.m.filter.bank_name = "";
        this.m.filter.bank_account_no = "";
    }

    search() {
        this.doSearch(1);
    }

    doSearch(page) {
        let $log = this.$log;
        let searchService = this.API.service('search', this.API.all('crm1200'));
        let param = angular.copy(this.m.filter);
        param.down = 0;
        param.page = page;
        searchService.post(param)
            .then((response) => {
                this.m.data = response.plain().data;
                $log.info('this.m.data', this.m.data);
            });
    }

    download() {
        let param = angular.copy(this.m.filter);
        let service = this.API.service('download', this.API.all('crm1200'));
        param.down = 1;
        service.post(param)
            .then((response) => {
                this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }
}

export const Crm1200Component = {
    //templateUrl: './views/app/components/crm1200/crm1200.component.html',
    templateUrl: '/views/admin.crm1200',
    controller: Crm1200Controller,
    controllerAs: 'vm',
    bindings: {}
}