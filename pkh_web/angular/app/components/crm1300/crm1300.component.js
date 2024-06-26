class Crm1300Controller {
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
            datetimepicker_options: {
                // viewMode: 'months',
                format: 'YYYY-MM-DD'
            }
        }
        this.m.filter.end_date = moment();
        this.search();
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
        let $log = this.$log;

        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm1300'));
        let param = angular.copy(this.m.filter);

        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;

        searchService.post(param)
            .then((response) => {

                this.m.list = response.data;
            });
    }

    $onInit() {}
}

export const Crm1300Component = {
    //templateUrl: './views/app/components/crm1300/crm1300.component.html',
    templateUrl: '/views/admin.crm1300',
    controller: Crm1300Controller,
    controllerAs: 'vm',
    bindings: {}
}