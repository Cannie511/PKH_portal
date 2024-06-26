class Crm1210Controller {

    constructor($scope, $state, $compile, $log, $stateParams, RouteService, ClientService, AclService, API, UtilsService) {
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



        this.m.store_id = $stateParams.store_id;
        this.m.bank_account_id = $stateParams.bank_account_id;

        this.$log.info('this.m.store_id', this.m.store_id);

        if (this.m.store_id == null || this.m.store_id <= 0) {
            $log.info(this.m);
            this.ClientService.warning("Vui lòng chọn cửa hàng");
            RouteService.goState("app.crm0300");
            return;
        }


    }

    $onInit() {
        this.loadInitData();
    }

    loadInitData() {
        let $log = this.$log;

        let param = {
            store_id: this.m.store_id,
            bank_account_id: this.m.bank_account_id

        };
        $log.info('param: ', param);
        let service = this.API.service('load-init', this.API.all('crm1210'));

        service.post(param)
            .then((response) => {
                $log.info('respone: ', response.data);
                if (response.data.store != null) {
                    this.m.store = response.data.store;
                    $log.info('respone: ', this.m.store);
                    this.m.filter.store_id = this.m.store.store_id; // send to insert
                    this.m.filter.address = this.m.store.address; //show on screen 
                    this.m.filter.name = this.m.store.name; //show on screen 
                    this.m.filter.salesman_id = this.m.store.salesman_id; // send to insert
                    this.m.filter.salesman_name = this.m.store.salesman_name; //show on screen 
                }
                if (response.data.bank_account != null) {
                    this.m.bank_account = response.data.bank_account;
                    this.m.filter.bank_name = this.m.bank_account.bank_name;
                    this.m.filter.bank_branch = this.m.bank_account.bank_branch;
                    this.m.filter.bank_account_no = this.m.bank_account.bank_account_no;
                    this.m.filter.bank_account_name = this.m.bank_account.bank_account_name;
                    this.m.filter.notes = this.m.bank_account.notes;
                }
            });
    }

    save() {
        let $log = this.$log;
        let RouteService = this.RouteService;
        let ClientService = this.ClientService;
        let msg = "";
        $log.info('send');
        let crm1210Service = this.API.service('save', this.API.all('crm1210'));
        let $state = this.$state;
        let param = angular.copy(this.m.filter);
        param.bank_account_id = this.m.bank_account_id;
        crm1210Service.post(param)
            .then((response) => {
                if (this.m.bank_account_id == null) {
                    msg = "Thêm tài khoản ngân hàng thành công";
                } else {
                    msg = "Cập nhật khoản ngân hàng thành công";
                }
                $log.info(msg);
                ClientService.success(msg);
                RouteService.goState('app.crm1200');

            });

    }

}

export const Crm1210Component = {
    //templateUrl: './views/app/components/crm1210/crm1210.component.html',
    templateUrl: '/views/admin.crm1210',
    controller: Crm1210Controller,
    controllerAs: 'vm',
    bindings: {}
}