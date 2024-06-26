class Crm1600Controller {
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
        this.loadInit();
    }

    loadInit(){
        let loadService = this.API.service('load-init', this.API.all('crm1600'));
        let param = angular.copy(this.m.filter);

        loadService.post(param)
            .then((response) => {
                this.m.init  = response.plain().data;
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

    doSearch(page) {
        let $log = this.$log;

        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm1600'));
        let param = angular.copy(this.m.filter);

        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;

        searchService.post(param)
            .then((response) => {
                //$log.info(response);
                this.m.list = response.data;
            });
    }

    $onInit() {}
}

export const Crm1600Component = {
    //templateUrl: './views/app/components/crm1600/crm1600.component.html',
    templateUrl: '/views/admin.crm1600',
    controller: Crm1600Controller,
    controllerAs: 'vm',
    bindings: {}
}