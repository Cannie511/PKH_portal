class Crm0800Controller {
    constructor($scope, $state, API, $log, UtilsService, ClientService) {
        'ngInject';
        this.API = API;
        this.$state = $state;
        this.$log = $log;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.m = {
            filter: {},
            list: null,
            dateOptions: {
                // formatYear: 'yy',
                startingDay: 1
            },
            datetimepicker_options: {
                viewMode: 'days',
                format: 'YYYY-MM-DD'
            }
        }
    }

    $onInit() {
        let previousSearch = sessionStorage.crm0800;

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

    sort(orderBy) {
        let orderOption = this.UtilsService.getOrderBy(orderBy, this.m.filter.orderBy, this.m.filter.orderDirection);
        this.m.filter.orderBy = orderOption.orderBy;
        this.m.filter.orderDirection = orderOption.orderDirection;

        this.search(1);
    }

    resetFilter() {

        this.m.filter = {
            orderBy: this.m.filter.orderBy,
            orderDirection: this.m.filter.orderDirection
        };
    }

    doSearch(page) {
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm0800'));
        let param = angular.copy(this.m.filter);

        // this.$log.info('param.delivery_start_date', param.delivery_start_date);
        // this.$log.info('param.delivery_end_date', param.delivery_end_date);

        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;
        sessionStorage.crm0800 = angular.toJson(param);
        searchService.post(param)
            .then((response) => {
                this.$log.info("RESPONSE", response);
                this.m.list = response.plain().data.list;
                this.m.warehouseList = response.plain().data.warehouseList;
            });
    }

}

export const Crm0800Component = {
    templateUrl: './views/admin.crm0800',
    controller: Crm0800Controller,
    controllerAs: 'vm',
    bindings: {}
}