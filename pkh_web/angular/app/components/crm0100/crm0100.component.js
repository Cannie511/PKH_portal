import { Crm0100SetupPriceController } from '../../../dialogs/crm0100_setup_price/crm0100_setup_price.dialog'

class Crm0100Controller {
    constructor($scope, $state, $compile, API, $log, AclService, UtilsService, DialogService, ClientService) {
        'ngInject'

        this.API = API;
        this.$state = $state;
        this.$log = $log;
        this.UtilsService = UtilsService;
        this.can = AclService.can;
        this.DialogService = DialogService;
        this.ClientService = ClientService;

        this.m = {
            filter: {},
            list: null
        }

        
    }

    $onInit() {
        this.m.filter.orderBy = 'updated_at';
        this.m.filter.orderDirection = 'desc';
        this.init();
    }

    init(){
        let previousSearch = sessionStorage.crm0100;
        this.loadInit();
        if (angular.isUndefined(previousSearch)) {
            this.search();
            return;
        }

        previousSearch = angular.fromJson(previousSearch);
        var page = previousSearch.page;
       

        delete previousSearch['page'];
        this.m.filter = angular.copy(previousSearch);
        this.doSearch(page);
    }

    loadInit(){
        let that  = this;
        let service = this.API.service('load-init', this.API.all('crm0100'));
        service.post()
            .then((response) => {
                that.m.init = response.data;
            });
    }
    

    search() {

        this.doSearch(1);
    }

    resetFilter() {
        this.m.filter = {
            orderBy: this.m.filter.orderBy,
            orderDirection: this.m.filter.orderDirection
        };
    }

    sort(orderBy) {
        let orderOption = this.UtilsService.getOrderBy(orderBy, this.m.filter.orderBy, this.m.filter.orderDirection);
        this.m.filter.orderBy = orderOption.orderBy;
        this.m.filter.orderDirection = orderOption.orderDirection;

        this.search(1);
    }

    doSearch(page) {
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm0100'));
        let param = angular.copy(this.m.filter);
        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;
      
        sessionStorage.crm0100 = angular.toJson(param);

        searchService.post(param)
            .then((response) => {
                this.m.data = response.plain().data.data;
            });
    }

    clickSetupPrice(item) {
        let thisClass = this;

        let modalOption = {
            controller: Crm0100SetupPriceController,
            resolve: {
                params: function() {
                    let result = {
                        "product": item
                    };
                    return result;
                }
            }
        };

        let modalInstance = this.DialogService.open('crm0100_setup_price', modalOption);
        modalInstance.result.then(function(params) {
            // Refresh list after update
            thisClass.search();
        });
    }

    download() {

        let service = this.API.service('download', this.API.all('crm0100'));

        service.post()
            .then((response) => {
                //this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }

    priority() {
        let service = this.API.service('priority', this.API.all('crm0100'));

        service.post()
            .then((response) => {

            });
    }

}

export const Crm0100Component = {
    // templateUrl: './views/app/components/crm0100/crm0100.component.html',
    templateUrl: '/views/admin.crm0100',
    controller: Crm0100Controller,
    controllerAs: 'vm',
    bindings: {}
}