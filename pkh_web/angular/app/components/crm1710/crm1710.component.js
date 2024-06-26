class Crm1710Controller {
    constructor($scope, $state, API, $log, UtilsService, ClientService, $stateParams, RouteService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;

        this.$log = $log;

        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.RouteService = RouteService;
        this.m = {
            filter: {},
            dateOptions: {

                // formatYear: 'yy',
                startingDay: 1
            }
        }

        this.m.promotion_id = $stateParams.promotion_id;
        if (this.m.promotion_id == null) {

            this.m.filter.from_date = new Date();
            this.m.filter.to_date = new Date();
            this.m.filter.promotion_name = null;
            this.m.filter.description = null;
            this.m.filter.promotion_sts = 1;
            this.m.filter.meta_data = null;
        } else {
            this.loadInitData();
        }

    }


    save() {

        let $log = this.$log;
        //$log.info('aihihihihi', this.m.filter);
        let alerts = this.alerts;
        let RouteService = this.RouteService;
        let ClientService = this.ClientService;
        // them check dk
        let saveService = this.API.service('save', this.API.all('crm1710'));
        let param = angular.copy(this.m.filter);

        if (this.m.promotion_id == null) {
            param.promotion_id = null;
        } else {
            param.promotion_id = this.m.promotion_id;
        }


        saveService.post(param)
            .then(function(response) {

                if (param.promotion_id == null) {
                    ClientService.success('Thêm mới chương trình thành công');

                } else {
                    ClientService.success('Cập nhật chương trình thành công');

                }

                RouteService.goState('app.crm1700');
            });

    }

    loadInitData() {
        let param = {

            promotion_id: this.m.promotion_id
        };
        let log = this.$log;
        log.info('param: ', param);
        let service = this.API.service('load-init', this.API.all('crm1710'));
        service.post(param)
            .then((response) => {
                this.m.init = response.data; //initiate list of bank account

                log.info('init: ', this.m.init);
                if (this.m.init.inforPromotion != null) {
                    this.m.filter.from_date = new Date(this.m.init.inforPromotion[0].from_date);
                    this.m.filter.to_date = new Date(this.m.init.inforPromotion[0].to_date);
                    this.m.filter.promotion_name = this.m.init.inforPromotion[0].promotion_name;
                    this.m.filter.description = this.m.init.inforPromotion[0].description;
                    this.m.filter.meta_data = this.m.init.inforPromotion[0].meta_data;
                    this.m.filter.promotion_sts = this.m.init.inforPromotion[0].promotion_sts.toString();
                    this.m.filter.promotion_type = this.m.init.inforPromotion[0].promotion_type.toString();
                }
                log.info('filter: ', this.m.filter);

            });
    }

    $onInit() {}
}

export const Crm1710Component = {
    //templateUrl: './views/app/components/crm1710/crm1710.component.html',
    templateUrl: '/views/admin.crm1710',
    controller: Crm1710Controller,
    controllerAs: 'vm',
    bindings: {}
}