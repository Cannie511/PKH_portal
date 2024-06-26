class Crm2550Controller{
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
            filter: {
                toDate: moment()
            },
            list: null,
            datetimepicker_options: {
                format: 'YYYY-MM-DD'
            }
        }

    }

    $onInit(){
        let previousSearch = sessionStorage.crm2550;

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
            toDate: moment(),
            orderBy: null,
            orderDirection: null
        };
    }

    search() {
        this.m.filter.orderBy = null;
        this.m.filter.orderDirection = null;
        this.doSearch(1);
    }

    doSearch(page) {
        let searchService = this.API.service('search', this.API.all('crm2550'));
        let param = this._getSearchFilter();
        param.page = page;

        sessionStorage.crm2550 = angular.toJson(param);
        searchService.post(param)
            .then((response) => {
                this.m.list = response.plain().data.data;
            });
    }

    _getSearchFilter() {
        let param = angular.copy(this.m.filter);

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
        let service = this.API.service('download', this.API.all('crm2550'));
        service.post(param)
            .then((response) => {
                this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }
}

export const Crm2550Component = {
    //templateUrl: './views/app/components/crm2550/crm2550.component.html',
    templateUrl: '/views/admin.crm2550',
    controller: Crm2550Controller,
    controllerAs: 'vm',
    bindings: {}
}
