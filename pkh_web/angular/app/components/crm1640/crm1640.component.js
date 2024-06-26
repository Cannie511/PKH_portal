class Crm1640Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, ClientService) {
        'ngInject'
        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.ClientService = ClientService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.m = {
                activeFlag: 1,
                1: {
                    filter: {},
                    data: {}
                },
                2: {
                    filter: {},
                    data: {}
                },
                download: [0, 0]
            }
            //this.loadInit();
    }

    resetFilter(index) {
        if (index < 1 || index > 2) {
            return;
        }
        this.m[index].filter = {};
    }

    doSearch(index, page) {
        let param = angular.copy(this.m[index].filter)

        param.page = page
        param.index = index
        sessionStorage.crm1640 = angular.toJson(param);
        this.m.download[index - 1] = 1;

        // let $log = this.$log;
        // $log.info('check param', param);
        let searchService = this.API.service('search', this.API.all('crm1640'));
        searchService.post(param)
            .then((response) => {
                this.m.init = response.plain().data;
                this.m[this.m.init.index].data = this.m.init.data;
                this.m.warehouseList = this.m.init.warehouseList;
                // $log.info('check response', this.m);
            });
    }

    loadInit(index, page){
        let loadService = this.API.service('load-init', this.API.all('crm1640'));
        let param = angular.copy(this.m.filter);

        loadService.post(param)
            .then((response) => {
                this.m.supplierList  = response.plain().data.supplierList;
                this.doSearch(index, page);
            });
    }

    $onInit() {
        let previousSearch = sessionStorage.crm1640;
        if (angular.isUndefined(previousSearch)) {
            this.doSearch(1, 1);
            return;
        }

        previousSearch = angular.fromJson(previousSearch);
        var page = previousSearch.page;
        var index = previousSearch.index;
        this.m.activeFlag = index;
        delete previousSearch['page'];
        delete previousSearch['index'];
        this.m[index].filter = angular.copy(previousSearch);
        this.loadInit(index, page);
       

    }

    choose(index) {
        let $log = this.$log;
        if (index < 1 || index > 2) {
            return;
        }
        this.m.activeFlag = index;
        //$log.info('check choose outside', this.m.download);
        if (this.m.download[index - 1] == 0) {
            //$log.info('check choose inside', index);
            this.doSearch(index, 1);
        }
    }

    download() {
        let param = angular.copy(this.m[2].filter);
        let service = this.API.service('download', this.API.all('crm1640'));
        service.post(param)
            .then((response) => {
                //this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }
}
export const Crm1640Component = {
    //templateUrl: './views/app/components/crm1640/crm1640.component.html',
    templateUrl: '/views/admin.crm1640',
    controller: Crm1640Controller,
    controllerAs: 'vm',
    bindings: {}
}