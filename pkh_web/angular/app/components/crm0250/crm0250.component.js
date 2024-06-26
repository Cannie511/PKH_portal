class Crm0250Controller{
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
            activeFlag: 1,
            1: {
                filter: {
                    days: 0
                }
                ,data: {}
            },
            2: {
                filter: {},
                data: {}
            },
            3: {
                data: {}
            },
            list: null
        }
    }

    resetFilter(index) {
        if (index < 1 || index > 2) {
            return;
        }
        this.m[index].filter = {};
        this.doSearch(index, 1);
    }

   

    chooseTab(index) {
        if (index < 1 || index > 3) {
            return;
        }
        this.m.activeFlag = index;
        if (index == 3){
            this.loadStats();
        }
        // let param1 = {};
        // param1.tab = tab;
        // sessionStorage.dashboard = angular.toJson(param1);
    }

    loadStats(){
        let self = this;
        // Get list product 
        let searchService = this.API.service('stats', this.API.all('crm0250'));
        let param = [];
        searchService.post(param)
            .then((response) => {
                this.m[3].data = response.plain().data;
                self.$log.info('crm0250111', self.m);
            });
    }

    $onInit() {
        this.loadInit();
        let previousSearch = sessionStorage.crm0250;
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
        this.doSearch(index, page);

    }

    search() {
        this.m.filter.orderBy = null;
        this.m.filter.orderDirection = null;
        this.doSearch(1);
    }

    doSearch(index, page) {
        let self = this;
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm0250'));
        let param = angular.copy(this.m[index].filter);
        param.page = page
        param.index = index
        sessionStorage.crm0250 = angular.toJson(param);

        param.page = page;
        searchService.post(param)
            .then((response) => {
                this.m[index].data = response.plain().data.data;
                self.$log.info('crm0250111', self.m);
            });
    }

    loadInit() {
        let service = this.API.service('init', this.API.all('crm0250'));
        service.post()
            .then((response) => {
                let salesmanList = response.data.salesmanList;
                if (salesmanList != null) {
                    this.m.listSalesman = salesmanList;
                }
            });
    }


    download() {
        let param = angular.copy(this.m.filter);
        let service = this.API.service('download', this.API.all('crm0250'));
        service.post(param)
            .then((response) => {
                this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }

    run() {
        let self = this;
        swal({
            title: "Bạn có muốn tính lại số ngày công nợ không?",
            text: "Quá trình này sẽ mất vài phút",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: true
                // confirmButtonColor: "#DD6B55"
        }, function() {

            let service = self.API.service('exec', self.API.all('crm0250'));
            service.post()
                .then((res) => {
                    self.ClientService.success(res.data.msg);
                });
        });
    }
}

export const Crm0250Component = {
    //templateUrl: './views/app/components/crm0250/crm0250.component.html',
    templateUrl: '/views/admin.crm0250',
    controller: Crm0250Controller,
    controllerAs: 'vm',
    bindings: {}
}
