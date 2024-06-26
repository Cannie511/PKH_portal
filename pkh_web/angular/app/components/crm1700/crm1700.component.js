class Crm1700Controller {
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
            filter: {},

        }

    }

    $onInit() {
        let previousSearch = sessionStorage.crm1700;
        if (angular.isUndefined(previousSearch)) {
            this.search();
            return;
        }

        previousSearch = angular.fromJson(previousSearch);
        var page = previousSearch.page;

        delete previousSearch['page'];
        this.m.filter = angular.copy(previousSearch);
        this.doSearch(1);

    }

    search() {
        this.m.filter.orderBy = null;
        this.m.filter.orderDirection = null;
        this.doSearch(1);
    }

    resetFilter() {
        this.m.filter = {
            orderBy: this.m.filter.orderBy,
            orderDirection: this.m.filter.orderDirection
        };
    }

    doSearch(page) {
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm1700'));
        let param = angular.copy(this.m.filter);
        //param.down = 0;
        param.page = page;

        sessionStorage.crm1700 = angular.toJson(param);

        searchService.post(param)
            .then((response) => {
                this.$log.info(this.m.filter);
                this.m.data = response.plain().data;
            });
    }

}

export const Crm1700Component = {
    //templateUrl: './views/app/components/crm1700/crm1700.component.html',
    templateUrl: '/views/admin.crm1700',
    controller: Crm1700Controller,
    controllerAs: 'vm',
    bindings: {}
}