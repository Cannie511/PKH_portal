class Crm0130Controller {
    constructor($scope, $state, $compile, DTOptionsBuilder, DTColumnBuilder, API, $log, UtilsService) {
        'ngInject'

        this.API = API;
        this.$state = $state;
        this.$log = $log;
        this.UtilsService = UtilsService
        this.m = {
            filter: {},
            list: null
        }

        this.search();
    }

    search() {
        this.m.filter.orderBy = null;
        this.m.filter.orderDirection = null;
        this.doSearch(1);
    }

    resetFilter() {
        /* this.m.filter = {
             orderBy: this.m.filter.orderBy,
             orderDirection: this.m.filter.orderDirection
         };*/
    }

    sort(orderBy) {
        let orderOption = this.UtilsService.getOrderBy(orderBy, this.m.filter.orderBy, this.m.filter.orderDirection);
        this.m.filter.orderBy = orderOption.orderBy;
        this.m.filter.orderDirection = orderOption.orderDirection;

        this.search(1);
    }

    doSearch(page) {
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm0130'));
        let param = angular.copy(this.m.filter);
        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;
        this.$log.info('param', param);
        searchService.post(param)
            .then((response) => {
                this.$log.info('response.plain().data.list', response.plain().data.list);
                this.m.list = response.plain().data.list;
            });
    }

    $onInit() {}
}

export const Crm0130Component = {
    // templateUrl: './views/app/components/crm0130/crm0130.component.html',
    templateUrl: '/views/admin.crm0130',
    controller: Crm0130Controller,
    controllerAs: 'vm',
    bindings: {}
}