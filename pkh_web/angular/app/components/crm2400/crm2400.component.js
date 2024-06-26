class Crm2400Controller {
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
        let previousSearch = sessionStorage.crm2400;
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
        let service = this.API.service('load-init', this.API.all('crm2400'));
        service.post()
            .then((response) => {

                let listArea1 = response.data.listArea1;
                let listArea2 = response.data.listArea2;
                let salesmanList = response.data.salesmanList;

                if (salesmanList != null) {
                    this.m.listSalesman = salesmanList;
                }

                if (listArea1 != null) {
                    this.m.listArea1 = listArea1;
                }
                if (listArea2 != null) {
                    this.m.listArea2 = listArea2;
                }

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
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm2400'));
        let param = angular.copy(this.m.filter);
        param.page = page;
        sessionStorage.crm2400 = angular.toJson(param);
        //param.pageSize = $scope.m.paginationInfo.pageSize;
        searchService.post(param)
            .then((response) => {
                var data = response.plain().data;
                this.m.data = data;
                this.$log.info("check data search: ",response.plain().data);
                this.$log.info("models: ",param);
            });
    }
}

export const Crm2400Component = {
    //templateUrl: './views/app/components/crm2400/crm2400.component.html',
    templateUrl: '/views/admin.crm2400',
    controller: Crm2400Controller,
    controllerAs: 'vm',
    bindings: {}
}