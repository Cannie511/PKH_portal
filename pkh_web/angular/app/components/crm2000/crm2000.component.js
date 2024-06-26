class Crm2000Controller {
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
        let previousSearch = sessionStorage.crm2000;

        if (angular.isUndefined(previousSearch)) {
            this.doSearch(1);
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
        let searchService = this.API.service('search', this.API.all('crm2000'));
        let param = angular.copy(this.m.filter);
        param.page = page;
        sessionStorage.crm2000 = angular.toJson(param);
        this.$log.info(searchService);

        searchService.post(param)
            .then((response) => {
                this.$log.info(response);
                this.m.data = response.plain().data;
            });
    }

}

export const Crm2000Component = {
    //templateUrl: './views/app/components/crm2000/crm2000.component.html',
    templateUrl: '/views/admin.crm2000',
    controller: Crm2000Controller,
    controllerAs: 'vm',
    bindings: {}
}