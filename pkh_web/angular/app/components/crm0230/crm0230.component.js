class Crm0230Controller {
    constructor($scope, $state, $compile, API, $log, UtilsService, AclService, ClientService, $stateParams) {
        'ngInject'

        this.API = API;
        this.$scope = $scope;
        this.$state = $state;
        this.$log = $log;
        this.UtilsService = UtilsService;
        this.can = AclService.can;
        this.$compile = $compile;
        this.ClientService = ClientService;
        this.$stateParams = $stateParams;
        this.m = {
            init: {},
            filter: {},
            list: null,
            datetimepicker_options: {
                viewMode: 'days',
                format: 'YYYY-MM-DD'
            }
        }
    }

    $onInit() {
        this.init();
    }

    init() {
        
        // Get list product 
        let searchService = this.API.service('init', this.API.all('crm0230'));

        searchService.post({})
            .then((response) => {
                this.m.init = response.plain().data;
                
                if (this.$stateParams.store_id != null) {
                    this.m.filter.storeId = this.$stateParams.store_id;
                    this.search();
                } else {
                    let previousSearch = sessionStorage.crm0230;
                    
                    if (angular.isDefined(previousSearch)) {
                        previousSearch = angular.fromJson(previousSearch);
                        var page = previousSearch.page;
                        delete previousSearch['page'];
                        this.m.filter = angular.copy(previousSearch);
                        this.doSearch(page);
                    }
                }
            });
    }

    resetFilter() {
        this.m.filter = {
            orderBy: this.m.filter.orderBy,
            orderDirection: this.m.filter.orderDirection
        };
    }

    search() {
        this.m.filter.orderBy = null;
        this.m.filter.orderDirection = null;
        this.doSearch(1);
    }

    sort(orderBy) {
        let orderOption = this.UtilsService.getOrderBy(orderBy, this.m.filter.orderBy, this.m.filter.orderDirection);
        this.m.filter.orderBy = orderOption.orderBy;
        this.m.filter.orderDirection = orderOption.orderDirection;

        this.search(1);
    }

    doSearch(page) {
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm0230'));
        let param = angular.copy(this.m.filter);

        if (param.start_date) {
            param.start_date = moment(param.start_date).format('YYYY-MM-DD');
        }

        if (param.end_date) {
            param.end_date = moment(param.end_date).format('YYYY-MM-DD');
        }

        param.page = page;
        sessionStorage.crm0230 = angular.toJson(param);

        searchService.post(param)
            .then((response) => {
                this.m.data = response.plain().data;
            });
    }

    download() {
        let service = this.API.service('download', this.API.all('crm0230'));
        let param = angular.copy(this.m.filter);
        service.post(param)
            .then((response) => {
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }

}

export const Crm0230Component = {
    //templateUrl: './views/app/components/crm0230/crm0230.component.html',
    templateUrl: '/views/admin.crm0230',
    controller: Crm0230Controller,
    controllerAs: 'vm',
    bindings: {}
}