class Crm2110Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, $stateParams, ClientService, RouteService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.RouteService = RouteService;
        this.ClientService = ClientService;
        this.m = {
            filter: {}
        }
        this.m.area_id = $stateParams.area_id;
        this.loadInitData();
    }

    $onInit() {}

    loadInitData() {

        let param = {
            area_id: this.m.area_id
        };
        let log = this.$log;

        let service = this.API.service('load-init', this.API.all('crm2110'));
        service.post(param)
            .then((response) => {
                this.m.init = response.data; //initiate list of bank account
                log.info('init', this.m.init);
                if (this.m.init.area != null) {
                    this.m.filter = this.m.init.area[0];
                }

                let groupList = response.data.groupList;
                let salesmanList = response.data.salesmanList;

                if (groupList != null) {
                    this.m.groupList = groupList;
                }
                if (salesmanList != null) {
                    this.m.salesmanList = salesmanList;
                }
            });
    }


    save() {

        let $log = this.$log;
        let alerts = this.alerts;
        let RouteService = this.RouteService;
        let ClientService = this.ClientService;
        let saveService = this.API.service('save', this.API.all('crm2110'));
        let param = angular.copy(this.m.filter);
        let data;

        if (param.area_group_id == null) {
            ClientService.error('Vui lòng chọn vùng');
            return;
        }

        if (param.salesman_id == null) {
            ClientService.error('Vui lòng salesman');
            return;
        }

        param.area_id = this.m.area_id;


        saveService.post(param)
            .then(function(response) {
                data = response.plain().data;
                if (data.status) {
                    if (param.area_id == null) {

                        ClientService.success('Thêm mới khu vực thành công');
                    } else {
                        ClientService.success('Cập nhật khu vực thành công');
                    }
                } else {
                    ClientService.error('Lưu thất bại');
                }
                RouteService.goState('app.crm2100');
            });

    }

}

export const Crm2110Component = {
    //templateUrl: './views/app/components/crm2110/crm2110.component.html',
    templateUrl: '/views/admin.crm2110',
    controller: Crm2110Controller,
    controllerAs: 'vm',
    bindings: {}
}