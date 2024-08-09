import { Crm0300DialogController } from './crm0300.dialog';
import { Crm0300MenuDialogController } from './crm0300_menu.dialog';
class Crm0300Controller {
    constructor($scope, $state, $compile, DTOptionsBuilder, DTColumnBuilder, API, $log, UtilsService, AclService, DialogService, ClientService) {
        'ngInject'
        this.API = API;
        this.$scope = $scope;
        this.$state = $state;
        this.$log = $log;
        this.UtilsService = UtilsService;
        this.DialogService = DialogService;
        this.ClientService = ClientService;
        this.can = AclService.can;
        this.m = {
            init: {},
            filter: {
                salesman: -1,
                inner_type: null
            },
            list: null,
            datetimepicker_options: {
                viewMode: 'months',
                format: 'YYYY-MM'
            }
        }
    }

    $onInit() {
        this.init();
    }

    init() {
        let previousSearch = sessionStorage.crm0300;
        let searchService = this.API.service('init', this.API.all('crm0300'));

        searchService.post({})
            .then((response) => {
                this.m.init = response.plain().data;
                //this.$log.info('check crm0300 init ', this.m.init);
                this.doSearch(page);
            });
        if (angular.isUndefined(previousSearch)) {
            this.search();
            return;
        }

        previousSearch = angular.fromJson(previousSearch);
        var page = previousSearch.page;

        delete previousSearch['page'];
        this.m.filter = angular.copy(previousSearch);

        // Get list product 

    }

    resetFilter() {
        this.m.filter = {
            salesman: -1,
            inner_type: null,
            orderBy: this.m.filter.orderBy,
            orderDirection: this.m.filter.orderDirection
        };
    }

    search() {
        this.m.filter.orderBy = null;
        this.m.filter.orderDirection = null;
        this.doSearch(1);
    }

    sort(orderBy) {
        let orderOption = this.UtilsService.getOrderBy(orderBy, this.m.filter.orderBy, this.m.filter.orderDirection);
        this.m.filter.orderBy = orderOption.orderBy;
        this.m.filter.orderDirection = orderOption.orderDirection;

        this.search(1);
    }

    doSearch(page) {
        let $log = this.$log;

        let searchService = this.API.service('search', this.API.all('crm0300'));
        let param = angular.copy(this.m.filter);

        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;
        
        if (angular.isUndefined(param.month) || param.month == null || param.month == '') {
            param.month = null;
        } else {
            param.month = param.month.format('YYYY-MM');
        }

        sessionStorage.crm0300 = angular.toJson(param);

        searchService.post(param)
            .then((response) => {
                let data = response.plain().data;
                this.$log.info("check data search:", data);
                let now = moment(new Date());
                data.data.forEach(item => {
                    if (item.review_expired_date && now.isAfter(item.review_expired_date)) {
                        item.is_review_valid = false;
                    } else {
                        item.is_review_valid = true;
                    }
                });
                this.m.data = data;
            });
    }

    openAssignForSales(item) {
        let modalOption;
        let that = this;
        let param = {
            item: item,
            salesman: this.m.init.salesman
        };
        //$log.info('sale user', param);    
        modalOption = {
            size: 'dialog-768',
            controller: Crm0300DialogController,
            resolve: {
                param: param
            }
        };
        let DialogClose = this.DialogService.open('crm0300_dialog', modalOption);
        DialogClose.result.then(function(data) {
            let paramUpdate = {
                salesman_id: data.params.chosenSale,
                store_id: item.store_id
            };
            // Get list product 
            let updateService = that.API.service('update-sale', that.API.all('crm0300'));
            updateService.post(paramUpdate)
            .then((response) => {
                that.init();
            });
        });
    }

    openMenu(item) {
        let modalOption;
        let crm0710 = this.can('screen.crm0710');
        let crm1630 = this.can('screen.crm1630');
        let crm1210 = this.can('screen.crm1210');
        let crm3010 = this.can("screen.crm3010");
        let param = {
            item: item,
            crm0710: crm0710,
            crm1630: crm1630,
            crm1210: crm1210,
            crm3010: crm3010
        };
        modalOption = {
            size: 'dialog-768',
            controller: Crm0300MenuDialogController,
            resolve: {
                param: param
            }
        };
        this.$log.info("check data search: ", param.item);
        this.DialogService.open('crm0300_menu', modalOption);
    }

    download() {
        let param = angular.copy(this.m.filter);
        let service = this.API.service('download', this.API.all('crm0300'));
        param.down = 1;
        service.post(param)
        .then((response) => {
            this.$log.info(response.data);
            this.ClientService.downloadFileOneTime(response.data.file);
        });
    }

    updateZalo() {
        console.log('updateZalo :>> ');
        let param = {};
        let service = this.API.service('update-zalo', this.API.all('crm0300'));
        service.post(param)
            .then((response) => {
                // this.$log.info(response.data);
                // this.ClientService.downloadFileOneTime(response.data.file);
                this.ClientService.success("Cập nhật thành công");
            });
    }
}

export const Crm0300Component = {
    // templateUrl: './views/app/components/crm0300/crm0300.component.html',
    templateUrl: '/views/admin.crm0300',
    controller: Crm0300Controller,
    controllerAs: 'vm',
    bindings: {}
}