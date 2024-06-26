class Crm0310Controller {
    constructor($scope, $state, API, $log, AclService, $stateParams, RouteService, ClientService, $filter) {

        'ngInject';

        this.$state = $state;
        this.formSubmitted = false;
        this.API = API;
        this.alerts = [];
        this.$log = $log;
        this.AclService = AclService;
        this.can = AclService.can;
        this.RouteService = RouteService;
        this.$filter  = $filter;
        this.ClientService = ClientService;
        this.m = {
            form: {},
            init: {}
        }
        this.m.level = [
            {val : 1, name : "Cấp 1"},
            {val : 2, name : "Cấp 2"},
            {val : 3, name : "Cấp 3"},
            {val : 4, name : "Cấp 4"},
          ];
        // $log.info('$stateParams.store_id', $stateParams.store_id);
        if ($stateParams.store_id > 0) {
            this.m.form.store_id = $stateParams.store_id;
        } else {
            this.m.form.store_id = 0;
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

        if (this.m.form.store_id > 0) {
            let service = this.API.service('load', this.API.all('crm0310'));
            let $state = this.$state;
            let param = { store_id: this.m.form.store_id };
            service.post(param)
                .then(function(response) {

                    m.init.area1List = response.data.area1List;
                    m.init.area2List = response.data.area2List;
                    m.init.chanhList = response.data.chanhList;

                    m.form = response.data.item;
                    m.form.discount = parseInt(m.form.discount);
                    $log.info('check form',m.form)    ;
                }, function(response) {
                    //ClientService.error('Đã có lỗi xãy ra');
                    // let alert = { type: 'error', 'title': 'Error!', msg: response.data.message }
                    // RouteService.goState('app.supplierlist', { alerts: alert })
                });
        } else {
            let service = this.API.service('init-data', this.API.all('crm0310'));
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
        
        var discount = parseInt(this.m.form.discount);
        if (discount<0 || discount>60){
                ClientService.warning('Vui lòng nhập lại chiết khấu');
                return;
            }
        
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
            let crm0310Service = this.API.service('crm0310');

            crm0310Service.post(this.m.form)
                .then(function() {
                    if (m.form.store_id > 0) {
                        ClientService.success('Cập nhật cửa hàng thành công');
                    } else {
                        ClientService.success('Thêm mới cửa hàng thành công');
                    }

                    RouteService.goState('app.crm0300')
                }, function() {});
        } else {
            this.formSubmitted = true
        }
    }

    validation() {

    }

}

export const Crm0310Component = {
    // templateUrl: './views/app/components/crm0310/crm0310.component.html',
    templateUrl: '/views/admin.crm0310',
    controller: Crm0310Controller,
    controllerAs: 'vm',
    bindings: {}
}