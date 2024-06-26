class Crm2900Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, ClientService){
        'ngInject';
        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.m = {
            filter: {},
            data: null,
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
        let previousSearch = sessionStorage.crm2900;
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

    resetFilter() {
        this.m.filter = {
            orderBy: this.m.filter.orderBy,
            orderDirection: this.m.filter.orderDirection
        };
    }

    doSearch(page) {
        let thisClass = this;
        // Get list 
        let searchService = this.API.service('search', this.API.all('crm2900'));
        let param = angular.copy(this.m.filter);
        param.page = page;

        sessionStorage.crm2900 = angular.toJson(param);

        thisClass.$log.info('param', param);
        searchService.post(param)
        .then((response) => {
            thisClass.$log.info("plain: ", response.plain().data);
            thisClass.m.data = response.plain().data.data;
            thisClass.$log.info("data: ",thisClass.m.data);
        });
    }

}

export const Crm2900Component = {
    templateUrl: '/views/admin.crm2900',
    controller: Crm2900Controller,
    controllerAs: 'vm',
    bindings: {}
}
