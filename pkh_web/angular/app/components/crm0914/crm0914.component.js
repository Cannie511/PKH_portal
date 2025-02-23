class Crm0914Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, $stateParams, ClientService, RouteService) {
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
        this.RouteService = RouteService;

        this.m = {
            filter: {},
            list: null,
            dateOptions: {
                viewMode: 'days',
                format: 'YYYY-MM-DD'
            }
        }
    }

    $onInit(){
        // Load Init data
        // this.loadInit();

        // Load previous filter
        let previousSearch = sessionStorage.crm0914;
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

    // loadInit() {
    //     let param = {};
    //     this.API.service('init', this.API.all('crm0914'))
    //         .post(param)
    //         .then((response) => {
    //             this.m.init = response.plain().data;
    //         });
    // }

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

    sort(orderBy) {
        let orderOption = this.UtilsService.getOrderBy(orderBy, this.m.filter.orderBy, this.m.filter.orderDirection);
        this.m.filter.orderBy = orderOption.orderBy;
        this.m.filter.orderDirection = orderOption.orderDirection;

        this.doSearch(1);
    }

    doSearch(page) {
        // Get list 
        let param = angular.copy(this.m.filter);
        let searchService = this.API.service('search', this.API.all('crm0914'));
        param.page = page;

        sessionStorage.crm0914 = angular.toJson(param);

        searchService.post(param)
            .then((response) => {
                this.$log.info(response.plain().data);
                this.m.list = response.plain().data.data;
                this.$log.info(this.m.list);
            });
    }
}

export const Crm0914Component = {
    //templateUrl: './views/app/components/crm0914/crm0914.component.html',
    templateUrl: '/views/admin.crm0914',
    controller: Crm0914Controller,
    controllerAs: 'vm',
    bindings: {}
}
