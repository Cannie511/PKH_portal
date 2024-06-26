class Crm1900Controller {
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


    }

    $onInit() {
        let previousSearch = sessionStorage.crm1900;
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
        let searchService = this.API.service('search', this.API.all('crm1900'));
        let param = angular.copy(this.m.filter);
        param.page = page;
        sessionStorage.crm1900 = angular.toJson(param);
        searchService.post(param)
            .then((response) => {
                this.m.data = response.plain().data.data;
            });
    }
}

export const Crm1900Component = {
    //templateUrl: './views/app/components/crm1900/crm1900.component.html',
    templateUrl: '/views/admin.crm1900',
    controller: Crm1900Controller,
    controllerAs: 'vm',
    bindings: {}
}