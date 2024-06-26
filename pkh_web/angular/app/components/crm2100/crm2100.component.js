class Crm2100Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, ClientService) {
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
            filter: {}
        }

    }

    $onInit() {
        let previousSearch = sessionStorage.crm2100;
        this.loadInit();
        if (angular.isUndefined(previousSearch)) {
            this.doSearch(1);
            return;
        }

        previousSearch = angular.fromJson(previousSearch);
        var page = previousSearch.page;

        delete previousSearch['page'];
        this.m.filter = angular.copy(previousSearch);

        this.doSearch(page);

    }

    loadInit() {
        let service = this.API.service('load-init', this.API.all('crm2100'));
        service.post()
            .then((response) => {
                let groupList = response.data.groupList;
                let salesmanList = response.data.salesmanList;

                if (groupList != null) {
                    this.m.groupList = groupList;
                }
                if (salesmanList != null) {
                    this.m.salesmanList = salesmanList;
                }
                // this.$log.info('check :', this.m);
            });
    }

    resetFilter() {
        this.m.filter = {

        };
    }

    search() {
        this.doSearch(1);
    }

    doSearch(page) {
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm2100'));
        let param = angular.copy(this.m.filter);
        param.page = page;
        sessionStorage.crm2100 = angular.toJson(param);
        searchService.post(param)
            .then((response) => {
                //this.$log.info(response);
                this.m.data = response.plain().data;
            });
    }

    assign() {
        // Get list product 
        let searchService = this.API.service('assign', this.API.all('crm2100'));
        let param = angular.copy(this.m.filter);
        searchService.post(param)
            .then((response) => {
                this.ClientService.success("Phân công nhân viên bán hàng thành công");
            });
    }
}

export const Crm2100Component = {
    //templateUrl: './views/app/components/crm2100/crm2100.component.html',
    templateUrl: '/views/admin.crm2100',
    controller: Crm2100Controller,
    controllerAs: 'vm',
    bindings: {}
}