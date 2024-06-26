class Crm0910Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, ClientService) {
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
            filter: {
                month: moment()
            },
            list: null,
            datetimepicker_options: {
                viewMode: 'months',
                format: 'YYYY-MM'
            },
            sumWarehouseVol:0,
            sumWarehouse:0, 
            sumWarehouseCart:0
        }

    }

    $onInit() {
        this.loadInit();
        this.search();
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
        let loadService = this.API.service('load-init', this.API.all('crm0910'));
       
        loadService.post()
            .then((response) => {
                // this.$log.info(response);

                this.m.init  = response.plain().data;
            });
    }

    resetFilter() {
        this.m.filter = {
            month: moment(),
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
        let searchService = this.API.service('search', this.API.all('crm0910'));
        let param = angular.copy(this.m.filter);

        if (angular.isUndefined(param.month) || param.month == null || param.month == '') {
            param.month = moment().format('YYYY-MM');
        } else {
            param.month = param.month.format('YYYY-MM');
        }

        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;

        searchService.post(param)
            .then((response) => {
                this.$log.info(response);

                let list = response.plain().data.data;

                // angular.forEach(list, function(item) {
                //     item.end_num = parseInt(item.start_num) - parseInt(item.out_num) - parseInt(item.out_num_edit) + parseInt(item.in_num) + parseInt(item.in_num_edit);
                // });

                this.m.list = list;
                this.calcWarehousePrice();
                this.calcWarehouseVol();
            });
    }

    download() {
        let param = angular.copy(this.m.filter);

        if (angular.isUndefined(param.month) || param.month == null || param.month == '') {
            param.month = moment().format('YYYY-MM');
        } else {
            param.month = param.month.format('YYYY-MM');
        }

        let service = this.API.service('download', this.API.all('crm0910'));
        service.post(param)
            .then((response) => {
                this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }
}

export const Crm0910Component = {
    //templateUrl: './views/app/components/crm0910/crm0910.component.html',
    templateUrl: '/views/admin.crm0910',
    controller: Crm0910Controller,
    controllerAs: 'vm',
    bindings: {}
}