class Crm0220Controller {
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
            init: {},
            filter: {
                search_type: '1',
                month: moment(new Date().toISOString())
            },
            data: {},
            search_type: "1",
            datetimepicker_options: {
                viewMode: 'months',
                format: 'YYYY-MM'
                    // viewDate: 'YYYY-MM'
            }
        }

    }

    $onInit() {
        this.doSearch(1);
    }

    search() {
        this.m.filter.orderBy = null;
        this.m.filter.orderDirection = null;
        this.doSearch(1);
    }

    resetFilter() {
        this.m.filter = {
            search_type: "1",
            orderBy: this.m.filter.orderBy,
            orderDirection: this.m.filter.orderDirection
        };
    }

    doSearch(page) {
        let thisClass = this;
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm0220'));
        let param = angular.copy(this.m.filter);

        if (param.month != null && param.month != "") {
            param.month = param.month.format('YYYY-MM');
        }

        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;
        this.$log.info('param', param);
        searchService.post(param)
            .then((response) => {
                thisClass.$log.info('response', response);
                thisClass.m.data = response.plain().data.data;
                thisClass.m.search_type = param.search_type;
                thisClass.$log.info('this.m.data', thisClass.m.data);
            });
    }

    download() {
        let param = angular.copy(this.m.filter);
        if (param.month != null && param.month != "") {
            param.month = param.month.format('YYYY-MM');
        }
        let service = this.API.service('download', this.API.all('crm0220'));
        service.post(param)
            .then((response) => {
                this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }
}

export const Crm0220Component = {
    //templateUrl: './views/app/components/crm0220/crm0220.component.html',
    templateUrl: '/views/admin.crm0220',
    controller: Crm0220Controller,
    controllerAs: 'vm',
    bindings: {}
}