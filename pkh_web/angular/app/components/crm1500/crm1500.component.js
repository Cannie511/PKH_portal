class Crm1500Controller {
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
            filter: {}
        }
        this.doSearch(1);
    }

    resetFilter() {
        this.m.filter = {
            orderBy: this.m.filter.orderBy,
            orderDirection: this.m.filter.orderDirection
        };
    }

    doSearch(page) {
        let $log = this.$log;

        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm1500'));
        let param = angular.copy(this.m.filter);

        param.page = page;

        searchService.post(param)
            .then((response) => {
                this.$log.info(response);
                this.m.list = response.data;
            });
    }

    $onInit() {}
}

export const Crm1500Component = {
    //templateUrl: './views/app/components/crm1500/crm1500.component.html',
    templateUrl: '/views/admin.crm1500',
    controller: Crm1500Controller,
    controllerAs: 'vm',
    bindings: {}
}