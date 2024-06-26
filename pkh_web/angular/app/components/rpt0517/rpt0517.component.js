class Rpt0517Controller {
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
            filter: {}
        }

    }

    $onInit() {
        let previousSearch = sessionStorage.rpt0517;
        this.loadInit();
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

    loadInit() {
        let service = this.API.service('load-init', this.API.all('rpt0517'));
        service.post()
            .then((response) => {
                let userList = response.data.userList;

                if (userList != null) {
                    this.m.usersList = userList;
                }
            });
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
        let searchService = this.API.service('search', this.API.all('rpt0517'));
        let param = angular.copy(this.m.filter);
        param.page = page;
        sessionStorage.rpt0517 = angular.toJson(param);
        searchService.post(param)
            .then((response) => {
                //this.$log.info(response);
                this.m.data = response.plain().data;
            });
    }

}

export const Rpt0517Component = {
    //templateUrl: './views/app/components/rpt0517/rpt0517.component.html',
    templateUrl: '/views/admin.rpt0517',
    controller: Rpt0517Controller,
    controllerAs: 'vm',
    bindings: {}
}