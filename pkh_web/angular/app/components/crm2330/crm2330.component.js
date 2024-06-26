class Crm2330Controller {
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
                viewMode: 'days',
                format: 'YYYY-MM-DD'
            }
        }

    }


    $onInit() {
        let previousSearch = sessionStorage.crm2330;
        //this.loadInit();
        if (angular.isUndefined(previousSearch)) {
            this.doSearch(1);
            return;
        }

        previousSearch = angular.fromJson(previousSearch);
        var page = previousSearch.page;

        delete previousSearch['page'];
        this.m.filter = angular.copy(previousSearch);

        this.doSearch(page);
    }

    resetFilter() {
        this.m.filter = {

        };
    }

    search() {
        this.doSearch(1);
    }

    doSearch(page) {
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm2330'));
        let param = angular.copy(this.m.filter);
        param.page = page;
        sessionStorage.crm2330 = angular.toJson(param);
        searchService.post(param)
            .then((response) => {
                //this.$log.info(response);
                this.m.data = response.plain().data;
            });
    }

}

export const Crm2330Component = {
    //templateUrl: './views/app/components/crm2330/crm2330.component.html',
    templateUrl: '/views/admin.crm2330',
    controller: Crm2330Controller,
    controllerAs: 'vm',
    bindings: {}
}