class Crm0240Controller {
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
            activeFlag: 1,
            1: {
                filter: {},
                data: {}
            },
            2: {
                filter: {},
                data: {}
            },
            3: {
                filter: {},
                data: {}
            },
            4: {
                filter: {},
                data: {}
            }
        }
    }

    resetFilter(index) {
        if (index < 1 || index > 3) {
            return;
        }
        this.m[index].filter = {};
    }

    $onInit() {
        let previousSearch = sessionStorage.crm0240;
        if (angular.isUndefined(previousSearch)) {
            this.doSearch(1, 1);
            return;
        }
        previousSearch = angular.fromJson(previousSearch);
        var page = previousSearch.page;
        var index = previousSearch.index;
        this.m.activeFlag = index;
        delete previousSearch['page'];
        delete previousSearch['index'];
        this.m[index].filter = angular.copy(previousSearch);
        this.doSearch(index, page);
    }

    search() {
        this.m.filter.orderBy = null;
        this.m.filter.orderDirection = null;
        this.doSearch(1);
    }

    doSearch(index, page) {
        let self = this;

        // Get list product 
        let searchService = self.API.service('search', this.API.all('crm0240'));
        let param = angular.copy(this.m[index].filter)

        param.page = page
        param.index = index
        sessionStorage.crm0240 = angular.toJson(param);

        searchService.post(param)
            .then((response) => {
                self.m.init = response.plain().data;
                self.$log.info(response);
                // self.m.order = response.plain().data.order;
                self.m[index].data = self.m.init.data;
            });
    }

    choose(number) {
        this.m.activeFlag = number;
        this.doSearch(number, 1);
    }
}

export const Crm0240Component = {
    //templateUrl: './views/app/components/crm0240/crm0240.component.html',
    templateUrl: '/views/admin.crm0240.crm0240',
    controller: Crm0240Controller,
    controllerAs: 'vm',
    bindings: {}
}