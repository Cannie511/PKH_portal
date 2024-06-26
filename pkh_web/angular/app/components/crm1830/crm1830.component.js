class Crm1830Controller {
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
            init: {},
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
        this.m.filter.department_id = null;
        this.m.filter.cost_cat_id = null;
        this.m.filter.from_date = moment().subtract(15, 'days');
        this.m.filter.to_date = moment();
        let previousSearch = sessionStorage.crm1830;
        this.loadInit();
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
        this.m.filter.department_id = null;
        this.m.filter.cost_cat_id = null;
        this.m.filter.from_date = moment().subtract(15, 'days');
        this.m.filter.to_date = moment();
    }


    search() {
        this.doSearch(1);
    }


    _getSearchFilter() {
        let param = angular.copy(this.m.filter);

        if (param.from_date == null) {
            this.m.filter.from_date = moment().subtract(15, 'days');
            param.from_date = this.m.filter.from_date.format('YYYY-MM-DD');
        } else {
            param.from_date = moment(param.from_date).format('YYYY-MM-DD');
        }

        if (param.to_date == null) {
            this.m.filter.to_date = moment();
            param.to_date = this.m.filter.to_date.format('YYYY-MM-DD');
        } else {
            param.to_date = moment(param.to_date).format('YYYY-MM-DD');
        }

        return param;
    }

    doSearch(page) {
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm1830'));
        let param = this._getSearchFilter();
        this.$log.info(param);
        param.down = 0;
        param.page = page;
        sessionStorage.crm1830 = angular.toJson(param);
        searchService.post(param)
            .then((response) => {
                //this.$log.info(response);
                this.m.data = response.plain().data;
            });
    }

    loadInit() {
        let service = this.API.service('load-init', this.API.all('crm1830'));
        service.post()
            .then((response) => {
                this.m.init = response.data;

            });
    }

    download() {
        let param = angular.copy(this.m.filter);
        let service = this.API.service('download', this.API.all('crm1830'));
        param.down = 1;
        service.post(param)
            .then((response) => {
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }
}

export const Crm1830Component = {
    //templateUrl: './views/app/components/crm1830/crm1830.component.html',
    templateUrl: '/views/admin.crm1830',
    controller: Crm1830Controller,
    controllerAs: 'vm',
    bindings: {}
}