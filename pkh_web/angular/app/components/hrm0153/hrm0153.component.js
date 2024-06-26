class Hrm0153Controller{
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
            disableCheckin: true,
            disableCheckout: true,
            list: null,
            dateOptions: {
                viewMode: 'days',
                format: 'YYYY-MM-DD'
            }
        }
    }

    $onInit(){
        // Load previous filter
        let previousSearch = sessionStorage.hrm0153;
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
        // Get list 
        let param = angular.copy(this.m.filter);
        let searchService = this.API.service('search', this.API.all('hrm0153'));
        param.page = page;

        sessionStorage.hrm0153 = angular.toJson(param);

        searchService.post(param)
            .then((response) => {
                this.m.list = response.plain().data.data;

                if(this.m.list.data.length > 0) {
                    let firstItem = this.m.list.data[0];
                    if ( firstItem.event_name == "CHECKIN") {
                        this.m.disableCheckin = true;
                        this.m.disableCheckout = false;
                    } else if ( firstItem.event_name == "CHECKOUT") {
                        this.m.disableCheckin = false;
                        this.m.disableCheckout = true;
                    }
                } else {
                    this.m.disableCheckin = false;
                    this.m.disableCheckout = true;
                }
            });
    }

    checkin() {
        this.API.service('checkin', this.API.all('hrm0153'))
            .post()
            .then((response) => {
                this.$log.info(response.plain().data);
                let result = response.plain().data.data;
                if( result.rtnCd == true ) {
                    this.ClientService.success(result.msg);
                    this.search();
                } else {
                    this.ClientService.error(result.msg);
                }
            });
    }
    
    checkout() {
        this.API.service('checkout', this.API.all('hrm0153'))
            .post()
            .then((response) => {
                this.$log.info(response.plain().data);
                let result = response.plain().data.data;
                if( result.rtnCd == true ) {
                    this.ClientService.success(result.msg);
                    this.search();
                } else {
                    this.ClientService.error(result.msg);
                }
            });
    }
}

export const Hrm0153Component = {
    //templateUrl: './views/app/components/hrm0153/hrm0153.component.html',
    templateUrl: '/views/admin.hrm0153',
    controller: Hrm0153Controller,
    controllerAs: 'vm',
    bindings: {}
}
