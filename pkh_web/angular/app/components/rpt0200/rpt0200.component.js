class Rpt0200Controller {
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
        let thisClass = this;
        let service = this.API.service('init', this.API.all('rpt0200'));
        let param = {};
        service.post(param)
            .then(function(response) {
                thisClass.$log.info('response', response);
                thisClass.setInitData(response.data);
            }, function(response) {});
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
        let thisClass = this;
        let service = this.API.service('search', this.API.all('rpt0200'));
        let param = angular.copy(this.m.filter);
        thisClass.$log.info('filter', param);
        service.post(param)
            .then(function(response) {
                thisClass.$log.info('response', response);
                thisClass.m.data = thisClass.convertData(response.data);
                thisClass.m.dataSum = thisClass.getDataSum(thisClass.m.data);
            });
    }

    convertData(data) {
        let self = this;
        
        let result = [];
        let space = self.getYearObj('');
        angular.forEach(data.listSpecialOrder, function(item) {
            let monthKey = 't' + item.month;
            space[monthKey] = ' ';
        });

        let sumSpecial = self.getYearObj('DH (mẫu, BH)');
        angular.forEach(data.listSpecialOrder, function(item) {
            let monthKey = 't' + item.month;
            sumSpecial[monthKey] = parseInt(sumSpecial[monthKey]) + parseInt(item.total);
        });
        result.push(sumSpecial);

        let sumItem1 = self.getYearObj('DH (Trước CK)');
        let sumItem2 = self.getYearObj('DH (Sau CK)');
        angular.forEach(data.listOrder, function(item) {
            let monthKey = 't' + item.month;
            sumItem1[monthKey] = parseInt(sumItem1[monthKey]) + parseInt(item.total);
            sumItem2[monthKey] = parseInt(sumItem2[monthKey]) + parseInt(item.total_with_discount);
        });
        let sumCancle = self.getYearObj('DH (hủy)');
        angular.forEach(data.listCancleOrder, function(item) {
            let monthKey = 't' + item.month;
            sumCancle[monthKey] = parseInt(sumCancle[monthKey]) + parseInt(item.total);
        });
        let sumCancleRemain = self.getYearObj('DH (hủy còn lại)');
        angular.forEach(data.listCancleRemainOrder, function(item) {
            let monthKey = 't' + item.month;
            sumCancleRemain[monthKey] = parseInt(sumCancleRemain[monthKey]) + parseInt(item.total);
        });

        result.push(sumItem1);
        result.push(sumItem2);
        result.push(sumCancle);
        result.push(sumCancleRemain);
        result.push(space);

        let sumSpecial2 = self.getYearObj('GH (mẫu, BH)');
        angular.forEach(data.listSpecialDelivery, function(item) {
            let monthKey = 't' + item.month;
            sumSpecial2[monthKey] = parseInt(sumSpecial2[monthKey]) + parseInt(item.total);
        });
        result.push(sumSpecial2);

        let sumItem3 = self.getYearObj('GH (Trước CK)');
        let sumItem4 = self.getYearObj('GH (Sau CK)');
        angular.forEach(data.listDelivery, function(item) {
            let monthKey = 't' + item.month;
            sumItem3[monthKey] = parseInt(sumItem3[monthKey]) + parseInt(item.total);
            sumItem4[monthKey] = parseInt(sumItem4[monthKey]) + parseInt(item.total_with_discount);
        });
        let sumCancleDelivery = self.getYearObj('GH (Hủy)');
        angular.forEach(data.listCancleDelivery, function(item) {
            let monthKey = 't' + item.month;
            sumCancleDelivery[monthKey] = parseInt(sumCancleDelivery[monthKey]) + parseInt(item.total);

        });

        result.push(sumItem3);
        result.push(sumItem4);
        result.push(sumCancleDelivery);
        //result.push(space);
        // for payment
        let sumItem5 = self.getYearObj('Thanh toán');
        angular.forEach(data.listPayment, function(item) {
            let monthKey = 't' + item.month;
            sumItem5[monthKey] = parseInt(sumItem5[monthKey]) + parseInt(item.total);
        });
        result.push(sumItem5);

        // Import
        let sumItem6 = self.getYearObj('Giá vốn');
        angular.forEach(data.listImport, function(item) {
            let monthKey = 't' + item.month;
            sumItem6[monthKey] = parseInt(sumItem6[monthKey]) + parseInt(item.total);
        });
        result.push(sumItem6);

        // Transit
        let sumItem7 = self.getYearObj('Phí giao hàng');
        angular.forEach(data.listCostTransit, function(item) {
            let monthKey = 't' + item.month;
            sumItem7[monthKey] = parseInt(sumItem7[monthKey]) + parseInt(item.total);
        });
        result.push(sumItem7);

        // cost
        let sumItem8 = self.getYearObj('Chi phí');
        angular.forEach(data.listCost, function(item) {
            let monthKey = 't' + item.month;
            sumItem8[monthKey] = parseInt(sumItem8[monthKey]) + parseInt(item.total);
        });
        result.push(sumItem8);

        //profit
        let sumItem9 = self.getYearObj('Profit');
        for (var i = 0; i < 12; i++) {
            let monthKey = 't' + (i + 1);
            sumItem9[monthKey] = parseInt(sumItem4[monthKey]) - parseInt(sumItem6[monthKey]) - parseInt(sumItem8[monthKey]);
        }
        result.push(sumItem9);
        // self.$log.info('purc', data.listPurchasing);
        // Số cont 
        let sumItem10 = self.getYearObj('Số cont nhập');
        angular.forEach(data.listPurchasing, function(item) {
            let monthKey = 't' + item.month;
            sumItem10[monthKey] = parseInt(sumItem10[monthKey]) + parseInt(item.count)*1000;

        });
        result.push(sumItem10);

         // Amount 
         let sumItem11 = self.getYearObj('Doanh số nhập');
         angular.forEach(data.listPurchasing, function(item) {
             let monthKey = 't' + item.month;
             sumItem11[monthKey] = parseInt(sumItem11[monthKey]) + parseInt(item.total)*1000;
 
         });
         result.push(sumItem11);

        return result;
    }

    getYearObj(title) {
        return {
            name: title,
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
            t12: 0
        };
    }

    getDataSum(data) {
        let self = this;
        let result = [];

        angular.forEach(data, function(list) {
            var newList = angular.copy(list);
            result.push(newList);

            self.$log.info(newList);
            var sum = 0;
            for (var i = 1; i <= 12; i++) {
                let monthKey = 't' + i;
                newList[monthKey] = sum + parseInt(newList[monthKey]);
                sum = newList[monthKey];
            }
        })

        return result;
    }
}

export const Rpt0200Component = {
    // templateUrl: './views/app/components/rpt0200/rpt0200.component.html',
    templateUrl: '/views/admin.rpt0200',
    controller: Rpt0200Controller,
    controllerAs: 'vm',
    bindings: {}
}