class Crm2530Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, ClientService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.can = AclService.can;
        this.ClientService = ClientService;

        this.m = {
            filter: {
                fromDate: moment().subtract(15, 'days'),
                toDate: moment().add(1, 'days')
            },
            list: null,
            datetimepicker_options: {
                format: 'YYYY-MM-DD'
            }
        }

    }

    $onInit(){
        let previousSearch = sessionStorage.crm2530;

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

    resetFilter() {
        this.m.filter = {
            fromDate: moment().subtract(15, 'days'),
            toDate: moment().add(1, 'days'),
            orderBy: this.m.filter.orderBy,
            orderDirection: this.m.filter.orderDirection
        };
    }

    search() {
        this.m.filter.orderBy = null;
        this.m.filter.orderDirection = null;
        this.doSearch(1);
    }

    doSearch(page) {
        let self = this;
        let searchService = this.API.service('search', this.API.all('crm2530'));
        let param = this._getSearchFilter();
        param.page = page;

        sessionStorage.crm2530 = angular.toJson(param);
        searchService.post(param)
            .then((response) => {
                self.m.list = response.plain().data.data;
            });
    }

    _getSearchFilter() {
        let param = angular.copy(this.m.filter);

        if (param.fromDate == null) {
            this.m.filter.fromDate = moment().subtract(15, 'days');
            param.fromDate = this.m.filter.fromDate.format('YYYY-MM-DD');
        } else if(typeof(param.fromDate) != "string") {
            param.fromDate = param.fromDate.format('YYYY-MM-DD');
        }

        if (param.toDate == null) {
            this.m.filter.toDate = moment();
            param.toDate = this.m.filter.toDate.format('YYYY-MM-DD');
        } else if(typeof(param.toDate) != "string") {
            param.toDate = param.toDate.format('YYYY-MM-DD');
        }

        return param;
    }

    download() {
        let param = this._getSearchFilter();
        let service = this.API.service('download', this.API.all('crm2530'));
        service.post(param)
            .then((response) => {
                this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }
}

export const Crm2530Component = {
    //templateUrl: './views/app/components/crm2530/crm2530.component.html',
    templateUrl: '/views/admin.crm2530',
    controller: Crm2530Controller,
    controllerAs: 'vm',
    bindings: {}
}