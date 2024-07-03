class Crm3000Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, ClientService){
        'ngInject';
        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.currentDate  = new Date();
        this.currentYear = this.currentDate.getFullYear();
        this.currentMonth = this.currentDate.getMonth() + 1
        this.currentQuarter = Math.floor((this.currentMonth - 1) / 3);
        this.m = {
            filter: {},
            data: null,
            quarter: this.currentQuarter,
            year: this.currentYear
        }
    }
    
    $onInit() {
        let previousSearch = sessionStorage.crm3000;
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
    getTotalScore(sale, retention, order_frequency, payment_history){
        sale = Number(sale);
        retention = Number(retention);
        order_frequency = Number(order_frequency);
        let sale_score = 0;
        let retention_score = 0;
        let order_frequency_score = 0;
        let payment_score = 0;
        let total_score = 0;

        if(sale > +this.m.data.avg_sale){
            sale_score = 25;
        }
        else sale_score = 10;

        if (retention >= 3) {
            retention_score = 25;
        } else retention_score = 10;

        if(order_frequency >= this.m.data.avg_OD)
            order_frequency_score = 25;
        else order_frequency_score = 10;

        if (payment_history)
            payment_score = 25;
        else payment_score = 15;
        total_score =
            sale_score +
            retention_score +
            order_frequency_score +
            payment_score;
        return total_score;
    }
    doSearch(page) {
        let searchService = this.API.service('search', this.API.all('crm3000'));
        let param = angular.copy(this.m.filter);
        param.page = page;
        sessionStorage.crm3000 = angular.toJson(param);
        this.$log.info('param', param);
        searchService.post(param)
        .then((response) => {
            //this.$log.info("check data plain: ",response.plain().data);
            this.m.data = response.plain().data;
            this.$log.info("check data search: ",this.m.data);
            // this.$log.info('model: ',param);
            // this.$log.info('this quarter: ', this.m.quarter);
            // this.$log.info('this year: ', this.m.year);
        });
    }
}

export const Crm3000Component = {
    templateUrl: "/views/admin.crm3000",
    controller: Crm3000Controller,
    controllerAs: "vm",
    bindings: {}
};
