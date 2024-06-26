class Crm0340Controller {
    constructor($scope, $state, $compile, $log, AclService, ClientService, API, UtilsService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.m = {
            init: {},
            form: {},
            cart: {},
            result: {}
        }

        this.loadInitData();
    }

    loadInitData() {
        this.init();
        let $log = this.$log;
        let service = this.API.service('load', this.API.all('crm0340'));
        // let $state = this.$state;
        let param = {

        };
        let that = this;
        service.post(param)
            .then(function(response) {
                that.m.init = response.data; // init area1List, area2List and userList
                $log.info('check load init', that.m.init)
            });
    }

    init() {
        this.m.form.saleman_id = null;
        this.m.form.start_date = null;
        this.m.form.end_date = null;
        this.m.form.area1 = null;
        this.m.form.area2 = null;
        this.m.form.store_list = null;
        // 1: close, -1: open
        this.m.openTable1 = 1; // init table 1 close
        this.m.openTable2 = 1; // init table 2 close
        //this.m.error.table2 = "";
        this.m.form.store_type = 3;
        this.m.form.assignment_status = 2;
    }

    choose(type) {
        // if opening table 1 then closing table 2 and opposite
        if (type == 1) {
            this.m.openTable1 = this.m.openTable1 * -1;
            this.m.openTable2 = 1;
        } else
        if (type == 2) {
            this.m.openTable2 = this.m.openTable2 * -1;
            this.m.openTable1 = 1;
        }
    }

    assignUser() {
        let $log = this.$log;
        if (this.m.cart == {}) {
            return;
        }
        let assignService = this.API.service('assign', this.API.all('crm0340'));
        let param = {
            saleman_id: this.m.form.saleman_id,
            cart: this.m.cart,
            store_list: this.m.form.store_list,
            openTable1: this.m.openTable1,
            openTable2: this.m.openTable2
        };

        //$log.info('param assignUser', param);
        let that = this;
        assignService.post(param)
            .then(function(response) {
                let data = response.data;
                that.m.result = data;
                //$log.info('result assignUser', data);
                if (data.status == 1) {
                    that.ClientService.success('Thay đổi nhân viên thành công.');
                } else {
                    that.ClientService.error('Thay đổi nhân viên không thành công. Vui lòng kiểm tra lại.');
                }

            });
    }

    mergeStore() {
        if (!this.m.form.store_id_valid || !this.m.form.store_id_fake) {
            return;
        }
        let assignService = this.API.service('merge', this.API.all('crm0340'));
        let param = {
            store_valid: this.m.form.store_id_valid,
            store_fake: this.m.form.store_id_fake
        };
        let that = this;
        assignService.post(param)
            .then(function(response) {
                let data = response.data;
                if (data.status == 1) {
                    that.ClientService.success('Merge thành công.');
                } else {
                    that.ClientService.error('Merge không thành công. Vui lòng kiểm tra lại.');
                }
            });
    }

    addProvince() {
        let id = this.m.form.area1;
        let listArea = this.m.init.areaList;
        let cart = this.m.cart;
        //this.$log.info('check cart', cart);
        angular.forEach(listArea, function(value, key) {
            if (value.area_id == id) {
                cart[id] = value;
            }
        });
        this.m.cart = cart;
        //this.$log.info('check', this.m.cart);
    }

    emptyProvince() {
        this.m.cart = {};
    }

    $onInit() {}
}

export const Crm0340Component = {
    //templateUrl: './views/app/components/crm0340/crm0340.component.html',
    templateUrl: '/views/admin.crm0340',
    controller: Crm0340Controller,
    controllerAs: 'vm',
    bindings: {}
}