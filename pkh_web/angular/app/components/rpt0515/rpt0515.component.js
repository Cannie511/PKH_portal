class Rpt0515Controller {
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

            filter: {},
            dateOptions: {
                // formatYear: 'yy',
                startingDay: 1
            }
        }
        this.m.filter.promotion_id = 1;
        this.m.filter.start_date = new Date();
        this.m.filter.end_date = new Date();
        this.loadInitData();
    }

    loadInitData() {
        let service = this.API.service('load-promotion', this.API.all('rpt0515'));
        service.post()
            .then((response) => {
                let promotionList = response.data.promotionList;
                if (promotionList != null) {
                    this.m.listPromotion = promotionList;
                }
            });
    }

    resetFilter(promotionId, activeFlag) {
        this.m.filter = {};
    }

    choose(tab) {
        this.m.activeFlag = tab;
    }

    loadDataForSalesman(promotionId) {
        let param = angular.copy(this.m.filter);
        let serviceSalesman = this.API.service('load-salesman', this.API.all('rpt0515'));
        //this.$log.info('ahihi check promotion', param);

        this.m[promotionId][1] = {};
        serviceSalesman.post(param)
            .then((response) => {
                this.m[promotionId][1].data = response.data;
                //this.$log.info('result1', this.m);
            });
    }

    loadDataForArea(promotionId) {
        let param = angular.copy(this.m.filter);
        let serviceArea = this.API.service('load-area', this.API.all('rpt0515'));

        this.m[promotionId][2] = {};
        serviceArea.post(param)
            .then((response) => {
                this.m[promotionId][2].data = response.data;
                //this.$log.info('result1', this.m);
            });
    }



    loadDataForProducts(promotionId) {
        let param = angular.copy(this.m.filter);
        let serviceSalesman = this.API.service('load-product', this.API.all('rpt0515'));
        //this.$log.info('ahihi check promotion', param);

        this.m[promotionId][4] = {};
        serviceSalesman.post(param)
            .then((response) => {
                this.m[promotionId][4].data = response.data;

            });
    }

    loadDataForStores(promotionId) {
        let param = angular.copy(this.m.filter);
        let serviceStore = this.API.service('load-store', this.API.all('rpt0515'));
        //this.$log.info('ahihi check promotion', param);

        this.m[promotionId][5] = {};
        serviceStore.post(param)
            .then((response) => {
                this.m[promotionId][5].data = response.data;

            });
    }

    search(promotionId, activeFlag) {
        if (this.m[promotionId] == null) {
            this.m[promotionId] = {};
        }
        switch (activeFlag) {
            case 1:
                this.loadDataForSalesman(promotionId);
                break;
            case 2:
                this.loadDataForArea(promotionId);
                break;
            case 3:
                this.loadDataForLevel(promotionId);
                break;
            case 4:
                this.loadDataForProducts(promotionId);
                break;
            case 5:
                this.loadDataForStores(promotionId);
                break;
        }
    }

    $onInit() {}
}

export const Rpt0515Component = {
    //templateUrl: './views/app/components/rpt0515/rpt0515.component.html',
    templateUrl: '/views/admin.rpt0515',
    controller: Rpt0515Controller,
    controllerAs: 'vm',
    bindings: {}
}