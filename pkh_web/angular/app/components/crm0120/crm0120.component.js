class Crm0120Controller {
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
            list: null
        }

    }

    $onInit() {
        let previousSearch = sessionStorage.crm0120;
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
        let searchService = this.API.service('search', this.API.all('crm0120'));
        let param = angular.copy(this.m.filter);
        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;
        sessionStorage.crm0120 = angular.toJson(param);
        searchService.post(param)
            .then((response) => {
                this.m.data = response.plain().data.data;
            });
    }
}

export const Crm0120Component = {
    //templateUrl: './views/app/components/crm0120/crm0120.component.html',
    templateUrl: '/views/admin.crm0120',
    controller: Crm0120Controller,
    controllerAs: 'vm',
    bindings: {}
}