class Crm1820Controller {
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
        let previousSearch = sessionStorage.crm1820;
        this.loadInit();
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

    loadInit() {

    }

    search() {
        this.doSearch(1);
    }

    resetFilter() {
        this.m.filter = {};
    }

    doSearch(page) {
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm1820'));
        let param = angular.copy(this.m.filter);
        param.page = page;
        sessionStorage.crm1820 = angular.toJson(param);

        searchService.post(param)
            .then((response) => {
                this.m.data = response.plain().data;
            });
    }

}

export const Crm1820Component = {
    //templateUrl: './views/app/components/crm1820/crm1820.component.html',
    templateUrl: '/views/admin.crm1820',
    controller: Crm1820Controller,
    controllerAs: 'vm',
    bindings: {}
}