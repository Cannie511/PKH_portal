class Crm0710Controller {
    constructor($scope, $state, API, $log, UtilsService, ClientService, $stateParams, RouteService) {
        'ngInject'

        this.API = API;
        this.$state = $state;
        this.$log = $log;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.RouteService = RouteService;
        this.m = {
            filter: {},
            list: null,
            init: {},
            dateOptions: {
                // formatYear: 'yy',
                startingDay: 1
            }
        }

        this.m.store_id = $stateParams.store_id;
        this.m.cpayment_id = $stateParams.cpayment_id;

        // if (this.m.store_id == null || this.m.store_id <= 0) {
        //     this.ClientService.warning("Vui lòng chọn cửa hàng");
        //     RouteService.goState("app.crm0300");
        //     return;
        // }
        // if (this.m.payment_id == null) {
        //     this.m.filter.payment_date = new Date();
        //     this.m.filter.bank_account_id = null;
        //     this.m.filter.notes = null;
        //     this.m.filter.salesman_id = 0;
        //     this.m.filter.store_id = null;
        // }

        // this.m.filter.payment_date = new Date();
        // this.loadInitData();
        
        // if (this.m.payment_id == null) {
        //     this.m.filter.payment_date = new Date();
        //     this.m.filter.bank_account_id = null;
        //     this.m.filter.notes = null;
        //     this.m.filter.salesman_id = 0;
        //     this.m.filter.store_id = null;
        // }

        // this.m.filter.payment_date = new Date();
        // this.loadInitData();
    }

    $onInit() {
       
    }

    sort(orderBy) {
        let orderOption = this.UtilsService.getOrderBy(orderBy, $scope.m.filter.orderBy, $scope.m.filter.orderDirection);
        this.m.filter.orderBy = orderOption.orderBy;
        this.m.filter.orderDirection = orderOption.orderDirection;

        this.doSearch(1);
    }

    save() {

        let $log = this.$log;
        //$log.info('aihihihihi', this.m.filter);
        let alerts = this.alerts;
        let RouteService = this.RouteService;
        let ClientService = this.ClientService;
        let saveService = this.API.service('save', this.API.all('crm0710'));
        let param = angular.copy(this.m.filter);

        if (this.m.payment_id == null) {
            param.payment_id = null;
        } else {
            param.payment_id = this.m.payment_id;
        }

        // check loi
        if (param.payment_type <= 3 && param.payment_money < 0) {
            swal({
                title: "Lỗi nhập liệu?",
                text: "Số tiền phải lớn hơn 0",
                type: "warning",
                showCancelButton: false,
                // confirmButtonColor: '#DD6B55', 
                confirmButtonText: 'Đồng ý',
                closeOnConfirm: true,
                showLoaderOnConfirm: true,
                html: false
            }, function() {});
            return false;
        } else if (param.payment_type == 4 && param.payment_money > 0) {
            swal({
                title: "Lỗi nhập liệu?",
                text: "Số tiền phải nhỏ hơn 0",
                type: "warning",
                showCancelButton: false,
                // confirmButtonColor: '#DD6B55', 
                confirmButtonText: 'Đồng ý',
                closeOnConfirm: true,
                showLoaderOnConfirm: true,
                html: false
            }, function() {});
            return false;
        }

        saveService.post(param)
            .then(function(response) {
                if (param.payment_id == null) {
                    ClientService.success('Thêm mới chi phí thành công');
                } else {
                    ClientService.success('Cập nhật  chi phí thành công');
                }

                RouteService.goState('app.crm0700');
            });

    }

    loadInitData() {
        let $log = this.$log;
        let param = {
            store_id: this.m.store_id,
            cpayment_id: this.m.cpayment_id
        };
        

        let initService = this.API.service('load-init', this.API.all('crm0210'));
        initService.post(param)
            .then((response) => {
                this.m.init = response.data; //initiate list of bank account
                this.m.payment = response.data.payment;
                // this.m.store = response.data.store;
                this.m.store.store_id = this.m.init.store[0].store_id;

            });
    }
    
}



export const Crm0710Component = {
    // templateUrl: './views/app/components/crm0700/crm0700.component.html',
    templateUrl: '/views/admin.crm0710',
    controller: Crm0710Controller,
    controllerAs: 'vm',
    bindings: {}
}