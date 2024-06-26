class Crm1620Controller {
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
            filter: {},
            init: {}
        }
        // this.search();
        this.loadInit();
    }

    search() {
        this.m.filter.orderBy = null;
        this.m.filter.orderDirection = null;
        this.doSearch(1);
    }

    loadInit(){
        let loadService = this.API.service('load-init', this.API.all('crm1620'));
        let param = angular.copy(this.m.filter);

        loadService.post(param)
            .then((response) => {
                this.m.init  = response.plain().data;
                this.search();
            });
    }

    doSearch(page) {
        let $log = this.$log;

        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm1620'));
        let param = angular.copy(this.m.filter);

        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;

        searchService.post(param)
            .then((response) => {
                $log.info(response);
                this.m.list = response.data;
            });
    }

    $onInit() {}
}

export const Crm1620Component = {
    //templateUrl: './views/app/components/crm1620/crm1620.component.html',
    templateUrl: '/views/admin.crm1620',
    controller: Crm1620Controller,
    controllerAs: 'vm',
    bindings: {}
}