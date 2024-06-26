class Cms0300Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, ClientService){
        'ngInject';
        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.m = {
            filter: {},
            data: null,
            dateOptions: {
                // formatYear: 'yy',
                startingDay: 1
            },
            datetimepicker_options: {
                viewMode: 'days',
                format: 'YYYY-MM-DD'
            }
        }
        //
    }



    $onInit(){
    }

    $onInit() {
        let previousSearch = sessionStorage.cms0300;

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

    search() {
        this.m.filter.orderBy = null;
        this.m.filter.orderDirection = null;
        this.doSearch(1);
    }

    resetFilter() {
        this.m.filter = {
            orderBy: this.m.filter.orderBy,
            orderDirection: this.m.filter.orderDirection
        };
    }

    doSearch(page) {
        let thisClass = this;
        // Get list 
        let searchService = this.API.service('search', this.API.all('cms0300'));
        let param = angular.copy(this.m.filter);
        param.page = page;

        sessionStorage.cms0300 = angular.toJson(param);

        thisClass.$log.info('param', param);
        searchService.post(param)
            .then((response) => {
                thisClass.$log.info(response.plain().data);
                thisClass.m.data = response.plain().data.data;
                thisClass.$log.info(thisClass.m.data);
            });
    }

    updateFollowers(){
        let thisClass = this;
        // Get list 
        let searchService = this.API.service('update-followers', this.API.all('cms0300'));
        let param = angular.copy();
        // param.page = page;

        sessionStorage.cms0200 = angular.toJson(param);

        thisClass.$log.info('param', param);
        searchService.post(param)
            .then((response) => {
                // thisClass.$log.info(response.plain().data);
                // thisClass.m.data = response.plain().data.data;
                // thisClass.$log.info(thisClass.m.data);
            });
    }


}

export const Cms0300Component = {
    templateUrl: '/views/admin.cms0300',
    controller: Cms0300Controller,
    controllerAs: 'vm',
    bindings: {}
}
