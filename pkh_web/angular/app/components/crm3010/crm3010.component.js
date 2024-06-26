class Crm3010Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, ClientService){
        'ngInject';
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
            data: null
        }
    }
    
    $onInit() {
        let previousSearch = sessionStorage.crm3010;
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
        // Get list 
        let searchService = this.API.service('search', this.API.all('crm3010'));
        let param = angular.copy(this.m.filter);
        param.page = page;
        sessionStorage.crm3010 = angular.toJson(param);
        //this.$log.info('param', param);
        searchService.post(param)
        .then((response) => {
            this.$log.info("check data plain: ",response.plain().data);
            this.m.data = response.plain().data
            // this.$log.info("check data search: ", this.m.data);
            // this.$log.info('model: ',param);
            // this.$log.info('this quarter: ', this.m.quarter);
            // this.$log.info('this year: ', this.m.year);
        });
    }
}

export const Crm3010Component = {
    templateUrl: "/views/admin.crm3010",
    controller: Crm3010Controller,
    controllerAs: "vm",
    bindings: {}
};
