class Hrm0140Controller {
    constructor($scope, $state, API, $log, UtilsService, ClientService) {
        'ngInject';

        this.API = API;
        this.$state = $state;
        this.$log = $log;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.m = {
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
        let searchService = this.API.service('init', this.API.all('hrm0140'));

        searchService.post({})
            .then((response) => {
                this.m.init = response.plain().data;
                this.search();
            });
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
        let $log = this.$log;
        let searchService = this.API.service('search', this.API.all('hrm0140'));
        let param = angular.copy(this.m.filter);

        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;

        searchService.post(param)
            .then((response) => {
                this.$log.info("RESPONSE", response);
                this.m.list = response.plain().data;
            });
    }

    download() {
        let param = angular.copy(this.m.filter);
        let service = this.API.service('download', this.API.all('hrm0140'));

        service.post(param)
            .then((response) => {
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }


}

export const Hrm0140Component = {
    //templateUrl: './views/app/components/hrm0140/hrm0140.component.html',
    templateUrl: '/views/admin.hrm0140',
    controller: Hrm0140Controller,
    controllerAs: 'vm',
    bindings: {}
}