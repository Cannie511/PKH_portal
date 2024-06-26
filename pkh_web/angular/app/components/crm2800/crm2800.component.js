class Crm2800Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, $stateParams, ClientService, RouteService) {
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
        this.RouteService = RouteService;

        this.m = {
            filter: {},
            list: null,
            dateOptions: {
                viewMode: 'days',
                format: 'YYYY-MM-DD'
            }
        }
    }

    $onInit(){
        // Load Init data
        // this.loadInit();

        // Load previous filter
        let previousSearch = sessionStorage.crm2800;
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

    // loadInit() {
    //     let param = {};
    //     this.API.service('init-data', this.API.all('crm2800'))
    //         .post(param)
    //         .then((response) => {
    //             this.m.init = response.plain().data;
    //         });
    // }

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
        // Get list 
        let param = angular.copy(this.m.filter);
        let searchService = this.API.service('search', this.API.all('crm2800'));
        param.page = page;

        sessionStorage.crm2800 = angular.toJson(param);

        searchService.post(param)
            .then((response) => {
                this.$log.info(response.plain().data);
                let list = response.plain().data.data;
                list.data.forEach(item => {
                    // for(let i = 1; i <=12 ; i++) {
                    //     let targetProp = "month_" + i + "_target";
                    //     let valueTarget = parseInt(item[targetProp]);
                    //     console.log('valueTarget :', valueTarget);
                        
                    //     valueTarget = valueTarget == 0 ? 0 : valueTarget / 1000;
                    //     item[targetProp] = valueTarget;
                    // }

                    item.target_year = parseInt(item.target_year);
                    item.actual_money = parseInt(item.actual_money);
                    if (item.target_year > 0 ) {
                        item.percent_money = item.actual_money * 100.0 / item.target_year;
                    } else {
                        item.percent_money = 0;
                    }

                    item.plan_amount = parseInt(item.plan_amount);
                    item.actual_amount = parseInt(item.actual_amount);
                    if (item.plan_amount > 0 ) {
                        item.percent_amount = item.actual_amount * 100.0 / item.plan_amount;
                    } else {
                        item.percent_amount = 0;
                    }
                });
                this.m.list = list;
                this.$log.info(this.m.list);
            });
    }

    download() {
        let param = angular.copy(this.m.filter);
        let service = this.API.service('download', this.API.all('crm2800'));
        service.post(param)
            .then((response) => {
                this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }
}

export const Crm2800Component = {
    //templateUrl: './views/app/components/crm2800/crm2800.component.html',
    templateUrl: '/views/admin.crm2800',
    controller: Crm2800Controller,
    controllerAs: 'vm',
    bindings: {}
}
