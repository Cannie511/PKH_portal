class Crm4002Controller {
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
        this.currentDate = new Date();
        this.currentYear = this.currentDate.getFullYear();
        this.currentMonth = this.currentDate.getMonth() + 1;
        this.currentQuarter = Math.floor((this.currentMonth - 1) / 3) + 1;
        this.m = {
            filter: {
                year: this.currentYear,
                quarter: this.currentQuarter,
            },
            data: null,
        }
    }
    
    $onInit() {
        let previousSearch = sessionStorage.crm4002;
        if (angular.isUndefined(previousSearch)) {
            this.loadYears().then(() => {
                this.search();
            });
            return;
        }
        previousSearch = angular.fromJson(previousSearch);
        var page = previousSearch.page;
        delete previousSearch['page'];
        this.m.filter = angular.copy(previousSearch);
        this.loadYears().then(() => {
            this.doSearch(page);
        });
    }
    loadYears() {
        return this.API.all('crm4002').customGET('years')
            .then((response) => {
                this.m.years = response.plain();
                console.log('Loaded years:', this.m.years);
                if (!this.m.filter.year && this.m.years.length > 0) {
                    this.m.filter.year = this.m.years[0].year;
                }
            })
            .catch((error) => {
                this.$log.error('Error loading years:', error);
            });
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
        let searchService = this.API.service('search', this.API.all('crm4002'));
        let param = angular.copy(this.m.filter);
        param.page = page;
        sessionStorage.crm4002 = angular.toJson(param);
        console.log('Initial quarter value:', this.m.filter.quarter);
        this.$log.info('param', param);
        searchService.post(param)
        .then((response) => {
            this.m.data = response.plain().data;
            this.$log.info("check data search: ",this.m.data);
        });
    }
}

export const Crm4002Component = {
    templateUrl: "/views/admin.crm4002",
    controller: Crm4002Controller,
    controllerAs: "vm",
    bindings: {}
};
