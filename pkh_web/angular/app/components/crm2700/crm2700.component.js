class Crm2700Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, $stateParams, ClientService) {
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

        this.m = {
            init: {},
            filter: {},
            list: null,
            form: {
                changed_date: moment(new Date())
            },
            dateOptions: {
                format: 'YYYY-MM-DD'
            }
        }

    }

    $onInit(){
        this.search();
    }

    resetFilter() {

        this.m.filter = {};
    }

    search() {
        this.m.filter.orderBy = null;
        this.m.filter.orderDirection = null;
        this.doSearch(1);
    }

    doSearch(page) {
        let $log = this.$log;

        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm2700'));
        let param = angular.copy(this.m.filter);
        param.page = page;

        searchService.post(param)
            .then((response) => {
                this.$log.info(response.plain().data);
                this.m.list = response.plain().data;
            });
    }

    download() {
        let param = angular.copy(this.m.filter);
        let service = this.API.service('download', this.API.all('crm2700'));
        service.post(param)
            .then((response) => {
                this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }
}

export const Crm2700Component = {
    //templateUrl: './views/app/components/crm2700/crm2700.component.html',
    templateUrl: '/views/admin.crm2700',
    controller: Crm2700Controller,
    controllerAs: 'vm',
    bindings: {}
}
