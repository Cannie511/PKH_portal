class Crm0350Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.can = AclService.can;

        this.m = {
            init: {},
            filter: {

            },
            list: null,
            datetimepicker_options: {
                viewMode: 'months',
                format: 'YYYY-MM'
            }
        }
        this.init();
    }

    $onInit() {}


    init() {
        let previousSearch = sessionStorage.crm0350;
        let searchService = this.API.service('init', this.API.all('crm0350'));

        searchService.post({})
            .then((response) => {
                this.m.init = response.plain().data;
                //this.$log.info('check crm0300 init ', this.m.init);
                this.doSearch(page);
            });
        if (angular.isUndefined(previousSearch)) {
            this.search();
            return;
        }

        previousSearch = angular.fromJson(previousSearch);
        var page = previousSearch.page;

        delete previousSearch['page'];
        this.m.filter = angular.copy(previousSearch);

        // Get list product 

    }

    resetFilter() {
        this.m.filter = {
            orderBy: this.m.filter.orderBy,
            orderDirection: this.m.filter.orderDirection
        };
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

    doSearch(page) {
        let $log = this.$log;

        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm0350'));
        let param = angular.copy(this.m.filter);

        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;

        if (angular.isUndefined(param.month) || param.month == null || param.month == '') {
            param.month = null;
        } else {
            param.month = param.month.format('YYYY-MM');
        }

        sessionStorage.crm0350 = angular.toJson(param);

        searchService.post(param)
            .then((response) => {
                this.m.data = response.plain().data;
                //$log.debug('this.m.data', this.m.data);
            });
    }
}

export const Crm0350Component = {
    //templateUrl: './views/app/components/crm0350/crm0350.component.html',
    templateUrl: '/views/admin.crm0350',
    controller: Crm0350Controller,
    controllerAs: 'vm',
    bindings: {}
}