class Hrm0700Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, $stateParams, ClientService) {
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

        this.m = {
            init: {},
            filter: {
                is_work: ''
            }
        }
    }

    $onInit(){
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
        this.m.filter  = {};
    }

    sort(orderBy) {
        let orderOption = this.UtilsService.getOrderBy(orderBy, this.m.filter.orderBy, this.m.filter.orderDirection);
        this.m.filter.orderBy = orderOption.orderBy;
        this.m.filter.orderDirection = orderOption.orderDirection;

        this.search(1);
    }

    doSearch(page) {
        // Get list product 
        let searchService = this.API.service('search', this.API.all('hrm0700'));
        let param = angular.copy(this.m.filter);
        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;
        this.$log.info('param', param);
        searchService.post(param)
            .then((response) => {
                this.$log.info('response.plain().data', response.plain().data);
                this.m.list = response.plain().data.data;
            });
    }

}

export const Hrm0700Component = {
    //templateUrl: './views/app/components/hrm0700/hrm0700.component.html',
    templateUrl: '/views/admin.hrm0700',
    controller: Hrm0700Controller,
    controllerAs: 'vm',
    bindings: {}
}
