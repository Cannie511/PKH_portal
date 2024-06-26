class Crm0330Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, $filter, $stateParams) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.$filter = $filter;
        this.$stateParams = $stateParams;

        this.m = {
            filter: {
                // month: moment()
            },
            data: {},
            datetimepicker_options: {
                viewMode: 'months',
                format: 'YYYY-MM'
            }
        };
    }

    $onInit() {
        if( this.$stateParams.store_id != null) {
            this.m.filter.store_id = this.$stateParams.store_id;
        } else {
            let previousSearch = sessionStorage.crm0330;
            if (angular.isDefined(previousSearch)) {
                previousSearch = angular.fromJson(previousSearch);
                this.m.filter = previousSearch;
            }
        }

        this.init();
    }

    init() {
        // Get list product 
        let searchService = this.API.service('init', this.API.all('crm0330'));

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

    doSearch(page) {
        let thisClass = this;
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm0330'));
        let param = angular.copy(this.m.filter);

        param.page = page;
        sessionStorage.crm0330 = angular.toJson(param);
        searchService.post(param)
            .then((response) => {
                thisClass.m.data = response.plain().data;
            });
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

}

export const Crm0330Component = {
    //templateUrl: './views/app/components/crm0330/crm0330.component.html',
    templateUrl: '/views/admin.crm0330',
    controller: Crm0330Controller,
    controllerAs: 'vm',
    bindings: {}
}