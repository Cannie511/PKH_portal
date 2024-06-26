class Hrm0200Controller{
    constructor($scope, $state, API, $log, UtilsService, ClientService){
        'ngInject';

        this.$scope = this.$scope;
        this.$state = $state;
        this.API = API;
        this.$log = $log;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        
        this.m = {
            filter: {},
            list : null,
            dateOptions : {
                // formatYear: 'yy',
                startingDay: 1
            }
        }

        this.search();
    }

    $onInit(){
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

    sort(orderBy) {
        let orderOption = this.UtilsService.getOrderBy(orderBy, $scope.m.filter.orderBy, $scope.m.filter.orderDirection);
        this.m.filter.orderBy = orderOption.orderBy;
        this.m.filter.orderDirection = orderOption.orderDirection;

        this.doSearch(1);
    }

    doSearch(page) {
        let $log = this.$log;

        // Get list product 
        let searchService = this.API.service('search', this.API.all('hrm0200'));
        let param = angular.copy(this.m.filter);

        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;

        searchService.post(param) 
            .then((response) => {
                this.$log.info(response);
                var data = response.plain().data;
                var list = data.data;

                
                // angular.forEach(list, function(value){
                //     list.check = false;
                // });
                // this.m.list = list;
                this.m.data = data;
            });
    }
}

export const Hrm0200Component = {
    //templateUrl: './views/app/components/hrm0200/hrm0200.component.html',
    templateUrl: '/views/admin.hrm0200', 
    controller: Hrm0200Controller,
    controllerAs: 'vm',
    bindings: {}
}
