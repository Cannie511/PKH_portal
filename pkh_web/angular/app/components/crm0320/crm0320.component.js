class Crm0320Controller {
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
            init: {},
            filter: {
                month: moment()
            },
            data: {},
            datetimepicker_options: {
                viewMode: 'months',
                format: 'YYYY-MM'
            }
        }

    }

    $onInit() {
        // this.doSearch(1);
        this.init();
    }

    init() {
        // Get list product 
        let searchService = this.API.service('init', this.API.all('crm0320'));

        searchService.post({})
            .then((response) => {
                this.m.init = response.plain().data;
                this.search();
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
        this.$log.info("this.m.filter", angular.copy(this.m.filter));
        let orderOption = this.UtilsService.getOrderBy(orderBy, this.m.filter.orderBy, this.m.filter.orderDirection);
        this.$log.info("orderOption", angular.copy(orderOption));
        this.m.filter.orderBy = orderOption.orderBy;
        this.m.filter.orderDirection = orderOption.orderDirection;

        this.doSearch(1);
    }

    doSearch(page) {
        let thisClass = this;
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm0320'));
        let param = angular.copy(this.m.filter);

        if (param.month != null && param.month != "") {
            param.month = param.month.format('YYYY-MM');
        }

        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;
        this.$log.info('param', param);
        searchService.post(param)
            .then((response) => {
                thisClass.$log.info('response', response);
                thisClass.m.data = response.plain().data;
                thisClass.$log.info('this.m.data', thisClass.m.data);
            });
    }
}

export const Crm0320Component = {
    //templateUrl: './views/app/components/crm0320/crm0320.component.html',
    templateUrl: '/views/admin.crm0320',
    controller: Crm0320Controller,
    controllerAs: 'vm',
    bindings: {}
}