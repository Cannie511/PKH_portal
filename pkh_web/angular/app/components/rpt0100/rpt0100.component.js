class Rpt0100Controller {
    constructor($scope, $state, $compile, API, $log, AclService, UtilsService, $stateParams) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.API = API;
        this.UtilsService = UtilsService;
        this.can = AclService.can;

        this.m = {
            init: {},
            filter: {},
            data: []
        }
    }

    $onInit() {
        this.loadInitData();
    }

    loadInitData() {
        let self = this;
        let service = this.API.service('init', this.API.all('rpt0100'));
        let param = {};
        service.post(param)
            .then(function(response) {
                self.setInitData(response.data);
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

    search() {
        let self = this;
        let service = this.API.service('search', this.API.all('rpt0100'));
        let param = angular.copy(this.m.filter);

        service.post(param)
            .then(function(response) {
                self.m.data = self.convertData(response.data);
            });
    }

    convertData(data) {
        let self = this;
        let result = [];
        result = self.prepareDataForOrder(data);
        result = self.prepareDataForDelivery(data, result);
        result = self.prepareDataForPayment(data, result);
        return result;
    }

    prepareDataForPayment(data, result) {

        let sumItem = {
            salesman_id: 0,
            name: 'Tổng Cộng G',

            t1_5: 0,
            t2_5: 0,
            t3_5: 0,
            t4_5: 0,
            t5_5: 0,
            t6_5: 0,
            t7_5: 0,
            t8_5: 0,
            t9_5: 0,
            t10_5: 0,
            t11_5: 0,
            t12_5: 0

        };

        angular.forEach(data.listDelivery, function(item) {
            let curItem = null;

            for (var i = 0; i < result.length; i++) {
                if (result[i].salesman_id == item.salesman_id) {
                    curItem = result[i];
                    break;
                }
            }

            if (curItem == null) {
                curItem = {
                    salesman_id: item.salesman_id,
                    name: item.name,

                    t1_5: 0,
                    t2_5: 0,
                    t3_5: 0,
                    t4_5: 0,
                    t5_5: 0,
                    t6_5: 0,
                    t7_5: 0,
                    t8_5: 0,
                    t9_5: 0,
                    t10_5: 0,
                    t11_5: 0,
                    t12_5: 0
                };
                result.push(curItem);
            }

            let monthKey = 't' + item.month + "_5";
            curItem[monthKey] = item.total;
            sumItem[monthKey] = parseInt(sumItem[monthKey]) + parseInt(item.total);


        });
        result.push(sumItem);
        return result;
    }

    prepareDataForDelivery(data, result) {

        let sumItem = {
            salesman_id: 0,
            name: 'Tổng Cộng G',
            t1_3: 0,
            t2_3: 0,
            t3_3: 0,
            t4_3: 0,
            t5_3: 0,
            t6_3: 0,
            t7_3: 0,
            t8_3: 0,
            t9_3: 0,
            t10_3: 0,
            t11_3: 0,
            t12_3: 0,
            t1_4: 0,
            t2_4: 0,
            t3_4: 0,
            t4_4: 0,
            t5_4: 0,
            t6_4: 0,
            t7_4: 0,
            t8_4: 0,
            t9_4: 0,
            t10_4: 0,
            t11_4: 0,
            t12_4: 0
        };

        angular.forEach(data.listDelivery, function(item) {
            let curItem = null;

            for (var i = 0; i < result.length; i++) {
                if (result[i].salesman_id == item.salesman_id) {
                    curItem = result[i];
                    break;
                }
            }

            if (curItem == null) {
                curItem = {
                    salesman_id: item.salesman_id,
                    name: item.name,
                    t1_3: 0,
                    t2_3: 0,
                    t3_3: 0,
                    t4_3: 0,
                    t5_3: 0,
                    t6_3: 0,
                    t7_3: 0,
                    t8_3: 0,
                    t9_3: 0,
                    t10_3: 0,
                    t11_3: 0,
                    t12_3: 0,
                    t1_4: 0,
                    t2_4: 0,
                    t3_4: 0,
                    t4_4: 0,
                    t5_4: 0,
                    t6_4: 0,
                    t7_4: 0,
                    t8_4: 0,
                    t9_4: 0,
                    t10_4: 0,
                    t11_4: 0,
                    t12_4: 0
                };
                result.push(curItem);
            }

            let monthKey = 't' + item.month + "_3";
            curItem[monthKey] = item.total;
            sumItem[monthKey] = parseInt(sumItem[monthKey]) + parseInt(item.total);

            monthKey = 't' + item.month + "_4";
            curItem[monthKey] = item.total_with_discount;
            sumItem[monthKey] = parseInt(sumItem[monthKey]) + parseInt(item.total_with_discount);
        });
        result.push(sumItem);
        return result;
    }

    prepareDataForOrder(data) {
        let result = [];
        let sumItem = {
            salesman_id: 0,
            name: 'Tổng Cộng D',
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
            t1_2: 0,
            t2_2: 0,
            t3_2: 0,
            t4_2: 0,
            t5_2: 0,
            t6_2: 0,
            t7_2: 0,
            t8_2: 0,
            t9_2: 0,
            t10_2: 0,
            t11_2: 0,
            t12_2: 0
        };

        angular.forEach(data.listOrder, function(item) {
            let curItem = null;

            for (var i = 0; i < result.length; i++) {
                if (result[i].salesman_id == item.salesman_id) {
                    curItem = result[i];
                    break;
                }
            }

            if (curItem == null) {
                curItem = {
                    salesman_id: item.salesman_id,
                    name: item.name,
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
                    t1_2: 0,
                    t2_2: 0,
                    t3_2: 0,
                    t4_2: 0,
                    t5_2: 0,
                    t6_2: 0,
                    t7_2: 0,
                    t8_2: 0,
                    t9_2: 0,
                    t10_2: 0,
                    t11_2: 0,
                    t12_2: 0
                };
                result.push(curItem);
            }

            let monthKey = 't' + item.month;
            curItem[monthKey] = item.total;
            sumItem[monthKey] = parseInt(sumItem[monthKey]) + parseInt(item.total);

            monthKey = 't' + item.month + "_2";
            curItem[monthKey] = item.total_with_discount;
            sumItem[monthKey] = parseInt(sumItem[monthKey]) + parseInt(item.total_with_discount);
        });
        result.push(sumItem);
        return result;
    }
}

export const Rpt0100Component = {
    // templateUrl: './views/app/components/rpt0100/rpt0100.component.html',
    templateUrl: '/views/admin.rpt0100',
    controller: Rpt0100Controller,
    controllerAs: 'vm',
    bindings: {}
}