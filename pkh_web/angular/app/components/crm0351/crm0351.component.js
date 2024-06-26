class Crm0351Controller {
    constructor($scope, $state, $compile, $filter, $log, AclService, API, UtilsService, RouteService, ClientService, $stateParams) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.RouteService = RouteService
        this.ClientService = ClientService;
        this.$filter = $filter;

        this.m = {
            form: {},
            init: {}
        }

        // $log.info('$stateParams.store_id', $stateParams.store_id);
        if ($stateParams.chanh_id > 0) {
            this.m.form.chanh_id = $stateParams.chanh_id;
        } else {
            this.m.form.chanh_id = 0;
        }

        if ($stateParams.alerts) {
            this.alerts.push($stateParams.alerts)
        }

        this.loadInitData();

    }

    $onInit() {}

    loadInitData() {

        let $log = this.$log;
        let alerts = this.alerts;
        let RouteService = this.RouteService;
        let ClientService = this.ClientService;
        let m = this.m;

        if (this.m.form.chanh_id > 0) {
            let service = this.API.service('load', this.API.all('crm0351'));
            let $state = this.$state;
            let param = { chanh_id: this.m.form.chanh_id };
            service.post(param)
                .then(function(response) {

                    m.init.area1List = response.data.area1List;
                    m.init.area2List = response.data.area2List;

                    m.form = response.data.item;
                    // m.form.gps_lat = 
                }, function(response) {
                    //ClientService.error('Đã có lỗi xãy ra');
                    // let alert = { type: 'error', 'title': 'Error!', msg: response.data.message }
                    // RouteService.goState('app.supplierlist', { alerts: alert })
                });
        } else {
            let service = this.API.service('init-data', this.API.all('crm0351'));
            service.post()
                .then(function(res) {
                    m.init = res.data;
                });
        }
    }

    save(isValid) {
        this.$log.info(isValid);
        this.$log.info("this.form", this.m.form);

        let $log = this.$log;
        let RouteService = this.RouteService;
        let ClientService = this.ClientService;
        let m = this.m;

        if (this.m.form.area1 == null) {
            ClientService.warning('Vui lòng nhập Tỉnh');
            return;
        }

        var area2List = this.$filter("filter")(this.m.init.area2List, { 'parent_area_id': this.m.form.area1 });
        if (area2List != null && area2List > 0 && this.m.form.area2 == null) {
            ClientService.warning('Vui lòng nhập Quận');
            return;
        }

        if (isValid) {
            $log.info('send');
            let crm0310Service = this.API.service('crm0351');

            crm0310Service.post(this.m.form)
                .then(function() {
                    if (m.form.chanh_id > 0) {
                        ClientService.success('Cập nhật cửa hàng thành công');
                    } else {
                        ClientService.success('Thêm mới cửa hàng thành công');
                    }

                    RouteService.goState('app.crm0350')
                }, function() {});
        } else {
            this.formSubmitted = true
        }
    }

}

export const Crm0351Component = {
    //templateUrl: './views/app/components/crm0351/crm0351.component.html',
    templateUrl: '/views/admin.crm0351',
    controller: Crm0351Controller,
    controllerAs: 'vm',
    bindings: {}
}