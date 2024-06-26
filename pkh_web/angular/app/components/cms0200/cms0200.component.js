class Cms0200Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, ClientService) {
        'ngInject'

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
        let previousSearch = sessionStorage.cms0200;

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

    sort(orderBy) {
        let orderOption = this.UtilsService.getOrderBy(orderBy, this.m.filter.orderBy, this.m.filter.orderDirection);
        this.m.filter.orderBy = orderOption.orderBy;
        this.m.filter.orderDirection = orderOption.orderDirection;

        this.doSearch(1);
    }

    doSearch(page) {
        let thisClass = this;
        // Get list 
        let searchService = this.API.service('search', this.API.all('cms0200'));
        let param = angular.copy(this.m.filter);
        param.page = page;

        sessionStorage.cms0200 = angular.toJson(param);

        thisClass.$log.info('param', param);
        searchService.post(param)
            .then((response) => {
                thisClass.$log.info(response.plain().data);
                thisClass.m.data = response.plain().data.data;
                thisClass.$log.info(thisClass.m.data);
            });
    }

    updateShow(id, show_flg) {
        let thisClass = this;
        // Get list 
        let searchService = this.API.service('edit', this.API.all('cms0200'));
        let param = {
            id : id,
            show_flg : show_flg
        };

        searchService.post(param)
            .then((response) => {
                let resData = response.plain().data.data;
                if (resData.rtnCd) {
                    thisClass.doSearch(thisClass.m.filter.page);
                    thisClass.ClientService.success(resData.msg);
                } else {
                    thisClass.ClientService.error(resData.msg);
                }
            });
    }

}

export const Cms0200Component = {
    //templateUrl: './views/app/components/cms0200/cms0200.component.html',
    templateUrl: '/views/admin.cms0200',
    controller: Cms0200Controller,
    controllerAs: 'vm',
    bindings: {}
}