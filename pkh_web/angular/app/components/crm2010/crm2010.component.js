class Crm2010Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, $stateParams, ClientService, RouteService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.ClientService = ClientService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.RouteService = RouteService;

        this.m = {
            filter: {},
            dateOptions: {
                // formatYear: 'yy',
                startingDay: 1
            }
        }

        this.m.branch_id = $stateParams.branch_id;
        this.m.filter.started_date = new Date();
        //this.$log.info('check ', this.m.branch_id);
        this.loadInitData();
    }

    $onInit() {}

    loadInitData() {
        if (!this.m.branch_id) {
            return;
        }
        let param = {
            branch_id: this.m.branch_id
        };
        let log = this.$log;

        let service = this.API.service('load-init', this.API.all('crm2010'));
        service.post(param)
            .then((response) => {
                this.m.init = response.data; //initiate list of bank account
                log.info('init', this.m.init);
                this.m.filter.started_date = new Date(this.m.init[0].started_date);
                this.m.filter.branch_name = this.m.init[0].branch_name;
                this.m.filter.branch_address = this.m.init[0].branch_address;
                this.m.filter.branch_contact = this.m.init[0].branch_contact;
            });
    }


    save() {

        let $log = this.$log;
        let alerts = this.alerts;
        let RouteService = this.RouteService;
        let ClientService = this.ClientService;
        let saveService = this.API.service('save', this.API.all('crm2010'));
        let param = angular.copy(this.m.filter);
        let data;
        if (this.m.branch_id == null) {
            param.branch_id = null;
        } else {
            param.branch_id = this.m.branch_id;
        }

        saveService.post(param)
            .then(function(response) {
                data = response.plain().data;
                if (data.status) {
                    if (param.branch_id == null) {

                        ClientService.success('Thêm mới chi nhánh thành công');
                    } else {
                        ClientService.success('Cập nhật chi nhánh thành công');
                    }
                } else {
                    ClientService.error('Lưu thất bại');
                }
                RouteService.goState('app.crm2000');
            });

    }
}

export const Crm2010Component = {
    //templateUrl: './views/app/components/crm2010/crm2010.component.html',
    templateUrl: '/views/admin.crm2010',
    controller: Crm2010Controller,
    controllerAs: 'vm',
    bindings: {}
}