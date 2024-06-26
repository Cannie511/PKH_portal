// import { DateUtils } from '../../../utils/DateUtils'
class Crm0920Controller {
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
                toDate: moment()
            },
            list: null,
            datetimepicker_options: {
                // viewMode: 'months',
                format: 'YYYY-MM-DD'
            }
        }

    }

    $onInit() {
        let previousSearch = sessionStorage.crm0920;

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
            toDate: moment(),
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
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm0920'));
        let param = this._getSearchFilter();
        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;

        sessionStorage.crm0920 = angular.toJson(param);
        let self = this;
        searchService.post(param)
            .then((response) => {
                // self.$log.info('first-time:', response);

                let list = response.plain().data.data;
                self.m.warehouseList = response.plain().data.warehouseList;
                self.m.supplierList = response.plain().data.supplierList;
                self.m.statusOrderList = response.plain().data.statusOrderList;
                self.m.statusDeliveryList = response.plain().data.statusDeliveryList;
                self.m.data = list;
            });
    }

    _getSearchFilter() {
        let param = angular.copy(this.m.filter);

        if (param.fromDate == null) {
            this.m.filter.fromDate = moment().subtract(15, 'days');
            param.fromDate = this.m.filter.fromDate.format('YYYY-MM-DD');
        } else {
            param.fromDate = moment(param.fromDate).format('YYYY-MM-DD');
        }

        if (param.toDate == null) {
            this.m.filter.toDate = moment();
            param.toDate = this.m.filter.toDate.format('YYYY-MM-DD');
        } else {
            param.toDate = moment(param.toDate).format('YYYY-MM-DD');
        }

        return param;
    }

    download() {
        let param = this._getSearchFilter();
        let service = this.API.service('download', this.API.all('crm0920'));
        service.post(param)
            .then((response) => {
                // this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }
}

export const Crm0920Component = {
    //templateUrl: './views/app/components/crm0920/crm0920.component.html',
    templateUrl: '/views/admin.crm0920',
    controller: Crm0920Controller,
    controllerAs: 'vm',
    bindings: {}
}