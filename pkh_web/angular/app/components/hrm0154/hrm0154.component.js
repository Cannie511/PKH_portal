class Hrm0154Controller{
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
        this.loadInit();

        // Load previous filter
        let previousSearch = sessionStorage.hrm0154;
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
        let param = {};
        this.API.service('init', this.API.all('hrm0154'))
            .post(param)
            .then((response) => {
                let initData = response.plain().data;

                // initData.listEmployee.forEach(element => {
                //     element.displayName = "[" + element.employee_code + "] " + element.fullname;
                // });
                this.m.init = initData;
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

    sort(orderBy) {
        let orderOption = this.UtilsService.getOrderBy(orderBy, this.m.filter.orderBy, this.m.filter.orderDirection);
        this.m.filter.orderBy = orderOption.orderBy;
        this.m.filter.orderDirection = orderOption.orderDirection;

        this.doSearch(1);
    }

    doSearch(page) {
        // Get list 
        let param = angular.copy(this.m.filter);
        let searchService = this.API.service('search', this.API.all('hrm0154'));
        param.page = page;
        param.start_date = this.UtilsService.momentToStringDate(param.start_date);
        param.end_date = this.UtilsService.momentToStringDate(param.end_date);

        sessionStorage.hrm0154 = angular.toJson(param);

        searchService.post(param)
            .then((response) => {
                this.m.list = response.plain().data.data;
            });
    }
}

export const Hrm0154Component = {
    //templateUrl: './views/app/components/hrm0154/hrm0154.component.html',
    templateUrl: '/views/admin.hrm0154',
    controller: Hrm0154Controller,
    controllerAs: 'vm',
    bindings: {}
}
