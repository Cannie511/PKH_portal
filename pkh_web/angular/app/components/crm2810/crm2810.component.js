class Crm2810Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, $stateParams, ClientService, RouteService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.can = AclService.can;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.$stateParams = $stateParams;
        this.RouteService = RouteService;

        this.m = {
            init: {
                listMonth: [
                    {id: 1, display: "Tháng 1"},
                    {id: 2, display: "Tháng 2"},
                    {id: 3, display: "Tháng 3"},
                    {id: 4, display: "Tháng 4"},
                    {id: 5, display: "Tháng 5"},
                    {id: 6, display: "Tháng 6"},
                    {id: 7, display: "Tháng 7"},
                    {id: 8, display: "Tháng 8"},
                    {id: 9, display: "Tháng 9"},
                    {id: 10, display: "Tháng 10"},
                    {id: 11, display: "Tháng 11"},
                    {id: 12, display: "Tháng 12"}
                ]
            },
            isInit: true,
            activeFlag: 1,
            store_id: this.$stateParams.store_id,
            filter: {
                month: 1
            },
            kpi: null,
            list: null,
            dateOptions: {
                viewMode: 'days',
                format: 'YYYY-MM-DD'
            }
        }
    }

    $onInit(){
        // Load Init data
        this.loadInit();
    }

    loadInit() {
        let param = {};
        this.API.service('init-data', this.API.all('crm2810'))
            .post(param)
            .then((response) => {
                let responseData = response.plain().data;
                this.m.init.listYear = responseData.listYear;
                this.m.filter.year = this.m.init.listYear[0];
                this.search();
            });
    }

    search() {
        this.m.filter.orderBy = null;
        this.m.filter.orderDirection = null;
        // this.doSearch(1);
        this.getKpi();
    }

    chooseTab(tab) {
        this.m.activeFlag = tab;
    }

    resetFilter() {
        this.m.filter = {
            orderBy: this.m.filter.orderBy,
            orderDirection: this.m.filter.orderDirection
        };
    }

    getKpi() {
        let param = angular.copy(this.m.filter);
        param.store_id = this.m.store_id;

        let searchService = this.API.service('search', this.API.all('crm2810'));
        // sessionStorage.crm2810 = angular.toJson(param);

        searchService.post(param)
            .then((response) => {
                this.m.isInit = false;
                this.$log.info(response.plain());
                let result = response.plain();

                let kpi = result.data.kpi;
                let kpiSummary = {
                    total_target: 0,
                    total_result: 0,
                    percent: 0
                };
                if ( kpi != null ) {
                    for( let i = 1 ; i <= 12; i++) {
                        let propTarget = `month_${i}_target`;
                        let propPercent = `percent_${i}`;
                        let propResult = `month_${i}_result`;
                        if (kpi[propTarget] > 0) {
                            kpi[propPercent] = (parseInt(kpi[propResult]) / parseInt(kpi[propTarget])) * 100;
                        } else {
                            kpi[propPercent] = 0;
                        }

                        kpiSummary.total_target += parseInt(kpi[propTarget]);
                        kpiSummary.total_result += parseInt(kpi[propResult]);
                    }
                }

                if (kpiSummary.total_target > 0) {
                    kpiSummary.percent = kpiSummary.total_result * 100 / kpiSummary.total_target;
                }

                this.m.kpi = kpi;
                this.m.kpiSummary = kpiSummary;
                this.loadMonth();
                this.loadYear();
            });
    }

    createKpi() {
        let param = angular.copy(this.m.filter);
        param.store_id = this.m.store_id;

        let searchService = this.API.service('create-kpi', this.API.all('crm2810'));

        searchService.post(param)
            .then((response) => {
                let result = response.data.data;
                if( result.rtnCd == true ) {
                    this.ClientService.success(result.msg);
                    this.getKpi();
                } else {
                    this.ClientService.error(result.msg);
                }
            });
    }

    loadMonth() {
        if(this.m.kpi == null || this.m.kpi == undefined) {
            return;
        }

        let param = {
            kpi_id: this.m.kpi.id,
            month: this.m.filter.month
        };
        console.log('param :', param);
        let service = this.API.service('load-month', this.API.all('crm2810'));

        service.post(param)
            .then((response) => {
                let res = response.plain();
                console.log('res :', res);
                let monthSummary = {
                    totalPlan: 0,
                    totalActual: 0,
                    percent: 0
                };
                res.data.forEach(item => {
                    item.target_money = item.amount * parseInt(item.selling_price) * (100 - item.discount) / 100;
                    item.percent = item.result_amount / item.amount;
                    monthSummary.totalPlan += item.target_money;
                    monthSummary.totalActual += parseFloat(item.result_money);
                });

                if (monthSummary.totalPlan > 0) {
                    monthSummary.percent = monthSummary.totalActual * 100.0 / monthSummary.totalPlan;
                }

                this.m.kpiMonth = res.data;
                this.m.monthSummary = monthSummary;
            });
    }

    loadYear() {
        if(this.m.kpi == null || this.m.kpi == undefined) {
            return;
        }

        let param = {
            kpi_id: this.m.kpi.id
        };
        console.log('param :', param);
        let service = this.API.service('load-year', this.API.all('crm2810'));

        service.post(param)
            .then((response) => {
                let res = response.plain();
                console.log('res load-year:', res);
                let yearSummary = {
                    totalAmountPlan: 0,
                    totalAmountActual: 0,
                    totalPlan: 0,
                    totalActual: 0,
                    percent: 0
                };
                res.data.forEach(item => {
                    // item.target_money = item.amount * parseInt(item.selling_price) * (100 - item.discount) / 100;
                    if(item.result_amount != null && item.result_amount != undefined) {
                        item.percent = parseInt(item.result_amount) / parseInt(item.amount);
                    } else {
                        item.result_amount = 0;
                        item.percent = 0;
                    }

                    if(item.result_money == null || item.result_money == undefined) {
                        item.result_money = 0;
                    }
                    
                    yearSummary.totalPlan += parseFloat(item.target_money);
                    yearSummary.totalActual += parseFloat(item.result_money);
                    yearSummary.totalAmountPlan += parseFloat(item.amount);
                    yearSummary.totalAmountActual += parseFloat(item.result_amount);
                });

                if (yearSummary.totalAmountPlan > 0) {
                    yearSummary.percent = yearSummary.totalAmountActual * 100.0 / yearSummary.totalAmountPlan;
                }

                this.m.kpiYear = res.data;
                this.m.yearSummary = yearSummary;
            });
    }

    download() {
        let param = {
            year: this.m.filter.year,
            store_id: this.m.store_id
        };
        
        let service = this.API.service('download', this.API.all('crm2810'));
        service.post(param)
            .then((response) => {
                this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }
}

export const Crm2810Component = {
    //templateUrl: './views/app/components/crm2810/crm2810.component.html',
    templateUrl: '/views/admin.crm2810',
    controller: Crm2810Controller,
    controllerAs: 'vm',
    bindings: {}
}
