class Hrm0130Controller {
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
                year: moment()
            },
            data: null,
            datetimepicker_options: {
                viewMode: 'years',
                format: 'YYYY'
            }
        }
    }
    $onInit() {
        this.init();
    }

    init() {
        let $log = this.$log;
        let searchService = this.API.service('init', this.API.all('hrm0130'));
        searchService.post({})
            .then((response) => {
                this.m.init = response.plain().data;
                this.setInitData(response.data);
                $log.info('this.m.init: ', this.m.init);
                this.search();
            });
    }

    setInitData(data) {
        this.m.init = data;
        if (this.m.init.listYear != null && this.m.init.listYear.length > 0) {
            this.m.filter.year = this.m.init.listYear[0].year;
        } else {
            this.m.filter.year = (new Date()).getFullYear();
        }
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
        let $log = this.$log;
        let searchService = this.API.service('search', this.API.all('hrm0130'));
        let param = angular.copy(this.m.filter);
        param.page = page;
        $log.info('filter', param);
        searchService.post(param)
            .then((response) => {
                // this.m.data = response.plain().data;
                this.m.data = this.convertData(response.data.data_1);
                this.m.data_2 = this.convertData(response.data.data_2);
                this.m.data_3 = this.convertData(response.data.data_3);
                $log.info('this.m.data', this.m.data);
            });
    }

    convertData(data) {
        let result = [];
        angular.forEach(data, function(item, index) {
            let curItem = null;
            for (var i = 0; i < result.length; i++) {
                if (result[i].user_id == item.user_id) {
                    curItem = result[i];
                    break;
                }
            }
            if (curItem == null) {
                curItem = {
                    user_id: item.user_id,
                    user_name: item.user_name,
                    t1: 0,
                    t2: 0,
                    t3: 0,
                    t4: 0,
                    t5: 0,
                    t6: 0,
                    t7: 0,
                    t8: 0,
                    t9: 0,
                    t10: 0,
                    t11: 0,
                    t12: 0,
                    total: 0
                };
                result.push(curItem);
            }
            let monthKey = 't' + item.month;
            curItem[monthKey] = item.amount;
            curItem['total'] = curItem['total'] + curItem[monthKey];
        });

        return result;
    }

}

export const Hrm0130Component = {
    //templateUrl: './views/app/components/hrm0130/hrm0130.component.html',
    templateUrl: '/views/admin.hrm0130',
    controller: Hrm0130Controller,
    controllerAs: 'vm',
    bindings: {}
}