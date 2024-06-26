class Crm2500Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.can = AclService.can;
        this.API = API;
        this.UtilsService = UtilsService;

        this.m = {
            filter: {},
            list: null
        }

    }

    $onInit() {
        let previousSearch = sessionStorage.crm2500;
        if (angular.isUndefined(previousSearch)) {
            this.search();
            return;
        }
        previousSearch = angular.fromJson(previousSearch);
        var page = previousSearch.page;
        delete previousSearch['page'];
        this.m.filter = angular.copy(previousSearch);
        this.doSearch(page);
    }

    resetFilter() {
        this.m.filter = {

        };
    }

    search() {
        this.doSearch(1);
    }

    doSearch(page) {
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm2500'));
        let param = angular.copy(this.m.filter);
        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;
        sessionStorage.crm2500 = angular.toJson(param);
        searchService.post(param)
            .then((response) => {
                this.m.data = response.plain().data.data;
            });
    }
}

export const Crm2500Component = {
    //templateUrl: './views/app/components/crm2500/crm2500.component.html',
    templateUrl: '/views/admin.crm2500',
    controller: Crm2500Controller,
    controllerAs: 'vm',
    bindings: {}
}
