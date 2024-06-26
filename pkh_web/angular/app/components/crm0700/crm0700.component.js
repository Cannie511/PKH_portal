import { Crm0700DialogController } from './crm0700.dialog';
class Crm0700Controller {
    constructor($scope, $state, API, $log, UtilsService, ClientService,DialogService) {
        'ngInject'

        this.API = API;
        this.$state = $state;
        this.$log = $log;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.DialogService = DialogService;
        this.m = {
            activeFlag: 1,
           
            list: null,
            dateOptions: {
                // formatYear: 'yy',
                startingDay: 1
            },
            datetimepicker_options: {
                viewMode: 'days',
                format: 'YYYY-MM-DD'
            },
            1:{
                filter:{},
                data:{}
            },
            2: {
                filter:{},
                data: {}
            }
        }
    }

    $onInit() {
        this.init();
    }

    init(){
        let previousSearch = sessionStorage.crm0700;
        this.loadInit();
        if (angular.isUndefined(previousSearch)) {
            this.search();
            return;
        }

        previousSearch = angular.fromJson(previousSearch);
        var page = previousSearch.page;
        var index = previousSearch.index;
        this.m.activeFlag = index;

        delete previousSearch['page'];
        delete previousSearch['index'];
        this.m[index].filter = angular.copy(previousSearch);
        this.doSearch(index, page);
    }

    loadInit() {
        let service = this.API.service('load-promotion', this.API.all('crm0700'));
        service.post()
            .then((response) => {
                let salesmanList = response.data.salesmanList;
                if (salesmanList != null) {
                    this.m.listSalesman = salesmanList;
                }
            });
    }

    search() {
       
        this.doSearch(1,1);
    }

   

    resetFilter(index) {
        if (index < 1 || index > 2) {
            return;
        }
        this.m[index].filter = {
            // orderBy: this.m.filter.orderBy,
            // orderDirection: this.m.filter.orderDirection
        };
        this.doSearch(index, 1);
    }

   
    
    chooseTab(index) {
        if (index < 1 || index > 3) {
            return;
        }
        this.m.activeFlag = index;
       
    }

    doSearch(index,page) {
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm0700'));
        let param = angular.copy(this.m[index].filter);
        param.down = 0;
        param.page = page;
        param.index = index
        sessionStorage.crm0700 = angular.toJson(param);

        searchService.post(param)
            .then((response) => {
                
                this.m[index].data = response.plain().data.data;
                this.$log.info(this.m);
                // this.m.data = response.plain().data;
            });
    }

    download() {
        let param = angular.copy(this.m[1].filter);
        let service = this.API.service('download', this.API.all('crm0700'));
        param.down = 1;
        service.post(param)
            .then((response) => {
                this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }

    notifyZalo(item){
        var self = this; 
        // this.m.canEdit = false;
        // this.$log.info('check print packing');
        swal({
            title: "Bạn có muốn thông báo thanh toán tới khách hàng qua ZALO?",
            text: "Sau khi bấm tài khoản zalo của khách hàng sẽ nhận được thông báo",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            var param = {
                payment_id: item.payment_id,
                item: item
            };

            let service = self.API.service('notify-zalo', self.API.all('crm0700'));
            service.post(param)
                .then((res) => {

                    self.ClientService.warning(res.data.errorMsg);
                    self.init();
                });
        });
    }

    update_accountant(store_id, store_name) {
        let modalOption;
        let DialogClose;
        let that = this;
       
        let param = {
            store_id: store_id,
            store_name: store_name,
            // API: that.API
        };
        // that.$log.info('sale user', param);
        modalOption = {
            size: 'dialog-768',
            controller: Crm0700DialogController,
            resolve: {
                param: param
            }
        };
        DialogClose = this.DialogService.open('crm0700_dialog', modalOption);
        DialogClose.result.then(function(data) {
            that.doSearch(1,1);
        });
    }

}

export const Crm0700Component = {
    // templateUrl: './views/app/components/crm0700/crm0700.component.html',
    templateUrl: '/views/admin.crm0700',
    controller: Crm0700Controller,
    controllerAs: 'vm',
    bindings: {}
}