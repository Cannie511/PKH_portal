import { Crm0321DialogController } from './crm0321.dialog';

class Crm0321Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, $filter, DialogService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.DialogService = DialogService;
        this.$filter = $filter;

        this.m = {
            init: {},
            filter: {
                // month: moment()
            },
            data: {},
            header: [],
            datetimepicker_options: {
                viewMode: 'months',
                format: 'YYYY-MM'
            }
        };
    }

    $onInit() {
        this.init();
    }

    init() {
        // Get list product 
        let searchService = this.API.service('init', this.API.all('crm0321'));

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
        this.$log.info("this.m.filter", angular.copy(this.m.filter));
        let orderOption = this.UtilsService.getOrderBy(orderBy, this.m.filter.orderBy, this.m.filter.orderDirection);
        this.$log.info("orderOption", angular.copy(orderOption));
        this.m.filter.orderBy = orderOption.orderBy;
        this.m.filter.orderDirection = orderOption.orderDirection;

        this.doSearch(1);
    }

    doSearch(page) {
        this.m.showChart = false;

        let thisClass = this;
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm0321'));
        let param = angular.copy(this.m.filter);

        if (param.month != null && param.month != "") {
            param.month = param.month.format('YYYY-MM');
        }

        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;
        this.$log.info('param', param);
        searchService.post(param)
            .then((response) => {
                thisClass.m.data = response.plain().data;

                if (thisClass.m.data.length > 0) {
                    thisClass.m.header = thisClass.m.data[0].items;
                    // thisClass.draw(thisClass.m.data[0]);
                } else {
                    thisClass.m.header = [];
                }

            });
    }

    draw(item) {
        let modalOption = {
            size: 'dialog-1024',
            controller: Crm0321DialogController,
            resolve: {
                item: () => {
                    return item;
                }
            }
        };
        this.DialogService.open('crm0321_chart', modalOption);
    }
}

export const Crm0321Component = {
    //templateUrl: './views/app/components/Crm0321/Crm0321.component.html',
    templateUrl: '/views/admin.crm0321',
    controller: Crm0321Controller,
    controllerAs: 'vm',
    bindings: {}
}