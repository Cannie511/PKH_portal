import { Crm0720DialogController } from './crm0720.dialog';
class Crm0720Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, ClientService, DialogService) {
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
        this.DialogService = DialogService;

        this.m = {
            total: {},
            filter: {
                month: moment()
            },
            list: null,
            // new_list: null,
            // old_list: null,
            datetimepicker_options: {
                viewMode: 'months',
                format: 'YYYY-MM'
            },
            infor: {}
        }

    }

    $onInit() {
        this.loadInit();
        this.search();
    }

    resetFilter() {
        this.m.filter = {
            month: moment(),
            orderBy: this.m.filter.orderBy,
            orderDirection: this.m.filter.orderDirection
        };
    }

    loadInit() {
        let service = this.API.service('load-promotion', this.API.all('crm0720'));
        service.post()
            .then((response) => {
                let salesmanList = response.data.salesmanList;
                if (salesmanList != null) {
                    this.m.listSalesman = salesmanList;
                }
            });
    }

    search() {
        this.m.filter.orderBy = null;
        this.m.filter.orderDirection = null;
        this.doSearch(1);
    }

    doSearch(page) {
        // let $log = this.$log;
        let searchService = this.API.service('search', this.API.all('crm0720'));
        let param = angular.copy(this.m.filter);
        let thisClass = this;

        if (angular.isUndefined(param.month) || param.month == null || param.month == '') {
            param.month = moment().format('YYYY-MM');
        } else {
            param.month = param.month.format('YYYY-MM');
        }

        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;

        searchService.post(param)
            .then((response) => {
                let list = response.plain().data.data;
                list.data.forEach(function(item) {
                    item.remain_lastmonth = parseInt(item.total_with_discount_lastmonth) - parseInt(item.payment_lastmonth);
                    item.edit_thismonth = parseInt(item.payment_plus_thismonth) + parseInt(item.payment_minus_thismonth);
                    item.remain =
                        item.remain_lastmonth +
                        parseInt(item.total_with_discount_thismonth) -
                        parseInt(item.payment_thismonth) -
                        parseInt(item.payment_plus_thismonth) -
                        parseInt(item.payment_minus_thismonth);
                });
                this.m.list = list;

                let resultSummary = response.plain().data.summary;
                resultSummary.payment_lastmonth = parseInt(resultSummary.payment_lastmonth);
                resultSummary.payment_minus_thismonth = parseInt(resultSummary.payment_minus_thismonth);
                resultSummary.payment_plus_thismonth = parseInt(resultSummary.payment_plus_thismonth);
                resultSummary.payment_thismonth = parseInt(resultSummary.payment_thismonth);
                resultSummary.total_lastmonth = parseInt(resultSummary.total_lastmonth);
                resultSummary.total_thismonth = parseInt(resultSummary.total_thismonth);
                resultSummary.total_with_discount_lastmonth = parseInt(resultSummary.total_with_discount_lastmonth);
                resultSummary.total_with_discount_thismonth = parseInt(resultSummary.total_with_discount_thismonth);

                let summary = resultSummary;

                console.log('resultSummary :>> ', resultSummary);
                summary.remain_lastmonth = resultSummary.total_with_discount_lastmonth - resultSummary.payment_lastmonth;
                summary.edit_thismonth = resultSummary.payment_plus_thismonth + resultSummary.payment_minus_thismonth;
                summary.remain = 
                    summary.remain_lastmonth 
                    + resultSummary.total_with_discount_thismonth
                    - resultSummary.payment_thismonth 
                    - resultSummary.payment_plus_thismonth 
                    - resultSummary.payment_minus_thismonth;

                this.m.summary = summary;
                console.log('this.m.summary :>> ', this.m.summary);
                this.reCalculation(list);
            });
    }

    reCalculation(list) {
        let payment = 0;
        let lastmonth = 0;
        let thismonth = 0;
        let discountThismonth = 0;
        let remain = 0;
        list.data.forEach(function(item) {
            payment += parseInt(item.payment_thismonth);
            lastmonth += parseInt(item.remain_lastmonth);
            thismonth += parseInt(item.total_thismonth);
            discountThismonth += parseInt(item.total_with_discount_thismonth);
            remain += parseInt(item.remain);
        });
        this.m.total.payment = payment;
        this.m.total.lastmonth = lastmonth;
        this.m.total.thismonth = thismonth;
        this.m.total.discountThismonth = discountThismonth;
        this.m.total.remain = remain;
    }

    showInfoOfStore(data, item) {
        let $log = this.$log;
        let param = {
            item: item,
            data: data
        };
        $log.info('check', param);
        let modalOption = {
            size: 'dialog-768',
            controller: Crm0720DialogController,
            resolve: {
                param: param
            }
        };

        this.DialogService.open('crm0720_dialog', modalOption);
    }

    detailInfor(item) {
        let modalOption;
        let DialogClose;
        let that = this;
        let param = {
            store_id: item.store_id
        };

        if (this.m.infor[item.store_id] == null) {
            let getInfoService = this.API.service('get-info', this.API.all('crm0720'));
            getInfoService.post(param)
                .then((response) => {
                    if (response.plain().data == null) {
                        return;
                    }
                    this.m.infor[item.store_id] = response.plain().data;
                    this.showInfoOfStore(this.m.infor[item.store_id], item);
                });
        } else {
            this.showInfoOfStore(this.m.infor[item.store_id], item);
        }

    }

    download() {
        let param = angular.copy(this.m.filter);

        if (angular.isUndefined(param.month) || param.month == null || param.month == '') {
            param.month = moment(new Date().toISOString()).format('YYYY-MM');
        } else {
            param.month = param.month.format('YYYY-MM');
        }

        let service = this.API.service('download', this.API.all('crm0720'));
        service.post(param)
            .then((response) => {
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }

}

export const Crm0720Component = {
    //templateUrl: './views/app/components/crm0720/crm0720.component.html',
    templateUrl: '/views/admin.crm0720',
    controller: Crm0720Controller,
    controllerAs: 'vm',
    bindings: {}
}