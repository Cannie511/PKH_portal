class Crm2300Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.title = ["Xuất kho","Nhập kho"];

        this.m = {
            init: {},
            1: {
                data: {},
                filter:{}
            },
            2: {
                data: {},
                filter:{}
            },
            datetimepicker_options: {
                viewMode: 'days',
                format: 'YYYY-MM-DD'
            }
        }
    }

    $onInit() {
        let previousSearch = sessionStorage.crm2300;
        this.loadInit();
        if (angular.isUndefined(previousSearch)) {
            this.doSearch(1,1);
            return;
        }

        previousSearch = angular.fromJson(previousSearch);
        var page = previousSearch.page;
        var index = previousSearch.index;

        this.m.activeFlag = index;

        delete previousSearch['page'];
        delete previousSearch['index'];
    
        this.m[index].filter = angular.copy(previousSearch);
        this.doSearch(index,page);
    }

    loadInit(){
         // Get list product 
         let loadService = this.API.service('load-init', this.API.all('crm2300'));
         loadService.post()
             .then((response) => {
                this.m.init = response.plain().data;
             });
    }

    resetFilter(index) {
        if (index < 1 || index > 2) {
            return;
        }
        this.m[index].filter = {
            orderBy:  'updated_at',
            orderDirection: 'desc'
        };
        this.doSearch(index, 1);
    }

    chooseTab(index) {
        if (index < 1 || index > 2) {
            return;
        }
        // this.$log.info('check : ',this.m);
        this.m.activeFlag = index;
        this.doSearch(index,1)
    }


    search() {
        this.doSearch(1,1);
    }

    doSearch(index, page) {
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm2300'));
        let param = angular.copy(this.m[index].filter);
        param.page = page;
        param.index = index;
        sessionStorage.crm2300 = angular.toJson(param);
        searchService.post(param)
            .then((response) => {
                //this.$log.info(response);
                // this.m.data = response.plain().data;
                var data = response.plain().data;
                this.m[index].data = data;

            });
    }


}

export const Crm2300Component = {
    //templateUrl: './views/app/components/crm2300/crm2300.component.html',
    templateUrl: '/views/admin.crm2300.crm2300',
    controller: Crm2300Controller,
    controllerAs: 'vm',
    bindings: {}
}