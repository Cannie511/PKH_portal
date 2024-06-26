class Crm1000Controller {
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
            dateOptions: {
                // formatYear: 'yy',
                startingDay: 1
            }
        }

        this.search();
        //
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

    resetFilter() {

        this.m.filter = {
            orderBy: this.m.filter.orderBy,
            orderDirection: this.m.filter.orderDirection
        };
        this.m.filter.delivery_start_date = null;
        this.m.filter.delivery_end_date = null;
        this.m.filter.delivery_vendor_name = null;

    }

    doSearch(page) {
        let $log = this.$log;

        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm1000'));
        let param = angular.copy(this.m.filter);

        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;
        param.down = 0;
        searchService.post(param)
            .then((response) => {
                this.$log.info(response);
                this.m.list = response.plain().data;
            });
    }


    download() {
        let param = angular.copy(this.m.filter);
        let service = this.API.service('download', this.API.all('crm1000'));
        param.down = 1;
        service.post(param)
            .then((response) => {
                this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }

    $onInit() {}
}

export const Crm1000Component = {
    templateUrl: './views/admin.crm1000',
    controller: Crm1000Controller,
    controllerAs: 'vm',
    bindings: {}
}