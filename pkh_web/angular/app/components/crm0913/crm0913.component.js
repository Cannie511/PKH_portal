class Crm0913Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, ClientService, $stateParams) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.can = AclService.can;
        this.ClientService = ClientService;

        this.m = {
            is_check: false,
            filter: {
                check_date: moment()
            },
            list: null,
            datetimepicker_options: {
                viewMode: 'days',
                format: 'YYYY-MM-DD'
            },
            mode: 0, // 0: watch, 1: confirm
            title: "Watch mode",
            warehouseCheck : {}
        }
        this.m.isConfirm = false;
        // if ($stateParams.checkingDate != null) {
        //     this.m.filter.check_date = moment($stateParams.checkingDate).format('YYYY-MM-DD');
        //     this.m.filter.check_id = $stateParams.checkingId;
        // }
        if ($stateParams.check_warehouse_id != null){
            this.m.filter.check_warehouse_id = $stateParams.check_warehouse_id;
            this.m.mode = 1;
        }
        if (this.m.mode == 1){
            this.m.title = "Comfirming mode"
        } 
        this.onInit();
    }

    onInit() {
        this.loadInit();
       
    }

    calcWarehousePrice() {
        let sum = 0;    
        if (this.m.list != null) {
            angular.forEach(this.m.list, function(item) {
                //this.m.count.warehouse++;
                if (item.end_num > 0) {
                    sum += parseInt(item.selling_price) * parseInt(item.end_num);
                }          
            });
        }
        this.m.sumWarehouse = sum;
    }



    calcWarehouseVol() {
        let sum = 0;
        let sum_cart = 0;
       
        //this.m.count.warehouse = 0;
        if (this.m.list != null) {
            angular.forEach(this.m.list, function(item) {
                //this.m.count.warehouse++;
                if (item.end_num > 0) {
                    sum += parseFloat(item.volume) * parseFloat(item.end_num)/parseFloat(item.standard_packing);
                    sum_cart +=  parseFloat(item.end_num)/parseFloat(item.standard_packing);
                }
            });
        }

        this.m.sumWarehouseVol = parseFloat(sum);
        this.m.sumWarehouseCart = parseFloat(sum_cart);
    }


    loadInit(){
        let loadService = this.API.service('load-init', this.API.all('crm0913'));
        let param = angular.copy(this.m.filter);

        loadService.post(param)
            .then((response) => {
                this.$log.info(response);
                this.m.init  = response.plain().data;
                this.m.init.warehouseCheck = response.plain().data.warehouseCheck[0];
                if (this.m.init.warehouseCheck){
                    this.m.filter.check_date = moment(this.m.init.warehouseCheck.check_date).format('YYYY-MM-DD');
                    this.m.filter.warehouse_id  = this.m.init.warehouseCheck.warehouse_id;
                    // this.$log.info('check ',this.m);
                }
               
                this.search();
            });
    }

    resetFilter() {
        this.m.filter = {
            check_date: moment(new Date().toISOString()),
            orderBy: this.m.filter.orderBy,
            orderDirection: this.m.filter.orderDirection
        };
    }

    search() {
        this.m.filter.orderBy = null;
        this.m.filter.orderDirection = null;
        this.doSearch(1);
    }

    doSearch(page) {
        // let $log = this.$log;

        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm0913'));
        let param = angular.copy(this.m.filter);
        this.$log.info('filter:',this.m.filter); 
        this.$log.info('param 1:',param); 
        this.$log.info('this m:',this.m); 
       
        if (angular.isUndefined(param.check_date) || param.check_date == null || param.check_date == '') {
            param.check_date = moment(new Date().toISOString()).format('YYYY-MM-DD');
            this.$log.info('yes',this.m.mode); 
        } else {
            param.check_date = moment(param.check_date).format('YYYY-MM-DD');
            this.$log.info('no',this.m.mode); 
        }

        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;
        // this.$log.info('param 2:',param); 

        searchService.post(param)
            .then((response) => {
                this.$log.info(response);
                let list = response.plain().data.data;
                // angular.forEach(list, function(item) {
                //     item.end_num = parseInt(item.start_num) - parseInt(item.out_num) - parseInt(item.out_num_edit) + parseInt(item.in_num) + parseInt(item.in_num_edit);
                // });
                this.m.is_check = response.plain().data.is_check;
                this.$log.info("check", this.m.is_check);
                this.m.list = list;
                this.calcWarehouseVol();
                this.calcWarehousePrice();
            });
    }

    save() {
        let $log = this.$log;
        let ClientService = this.ClientService;
        let self = this;

        $log.info('send');
        let crm0913Service = this.API.service('save', this.API.all('crm0913'));
        // let param = [];
        // angular.forEach(self.m.list, function(item) {
        //     param.push({
        //         notes: item.notes
        //     });
        // });

        let param = [];
        angular.forEach(self.m.list, function(item) {
            param.push({
                check_id: item.check_id,
                product_id: item.product_id,
                notes: item.notes
            });
        });

        $log.info('param', param);
        crm0913Service.post(param)
            .then(function() {
                // if (self.m.checkWarehouseId > 0) {
                ClientService.success('Lưu ghi chú thành công');
                // } else {
                //     ClientService.success('Lưu ghi chi thất bại');
                // }
            });

    }

    confirmWarehouse() {

            if (this.m.mode != 1){
                return ;
            }

            var self = this;
            this.m.canEdit = false;
            swal({
                title: "Bạn có muốn xác nhận lần kiểm kho này?",
                text: "Sau khi xác nhận hệ thống sẽ tự động điều chỉnh chênh lệch cho kho tương ứng.",
                type: "warning",
                showCancelButton: true,
                // confirmButtonColor: '#DD6B55', 
                confirmButtonText: 'Đồng ý',
                closeOnConfirm: true,
                showLoaderOnConfirm: true,
                html: false
            }, function() {
                if (self.m.isConfirm) {
                    self.ClientService.warning('đang xử lý');
                    return;
                }
                self.m.isConfirm = true;
                //this.$log.info('check confirm');
                let param = angular.copy(self.m.filter);
                param.check_date = param.check_date.format('YYYY-MM-DD');
                let service = self.API.service('confirm-warehouse', self.API.all('crm0913'));
                service.post(param)
                    .then((response) => {
                        if (response.data.status) {
                            self.ClientService.success('Xác nhận tồn kho thành công' + response.data.num + ' sự thay đổi');
                        } else {
                            self.ClientService.error(response.data.msg);
                        }
                        self.search();
                        self.m.isConfirm = false;
        
                    });
            });
    }

}

export const Crm0913Component = {
    //templateUrl: './views/app/components/crm0913/crm0913.component.html',
    templateUrl: '/views/admin.crm0913',
    controller: Crm0913Controller,
    controllerAs: 'vm',
    bindings: {}
}