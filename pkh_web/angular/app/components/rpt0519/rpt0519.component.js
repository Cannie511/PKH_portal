class Rpt0519Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, DialogService, ClientService){
        'ngInject';
        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.DialogService = DialogService;
        //

        this.m = {
            filter: {},
            datetimepicker_options: {
                viewMode: 'days',
                format: 'YYYY-MM-DD'
            }
        };
    }

    $onInit(){
        let previousSearch = sessionStorage.rpt0519;
        
        this.loadInitData();
        if (angular.isUndefined(previousSearch)) {
           
            return;
        }

        previousSearch = angular.fromJson(previousSearch);
        var index = previousSearch.index;

        this.m.activeFlag = index;
        delete previousSearch['index'];
        this.m.filter = angular.copy(previousSearch);

        // this.loadData(index);
    }

    loadInitData() {
        let self = this;
        let service = this.API.service('init', this.API.all('rpt0519'));
        let param = {};
        service.post(param)
            .then(function(response) {
                self.m.init = response.plain().data;
            });
    }

    search() {
        // Get list product 
        let searchService = this.API.service('search', this.API.all('rpt0519'));
        let param = angular.copy(this.m.filter);
        if (param.from_date) {
            param.from_date = moment(param.from_date).format('YYYY-MM-DD');
        }
        if (param.to_date) {
            param.to_date = moment(param.to_date).format('YYYY-MM-DD');
        }
        
        sessionStorage.rpt0519 = angular.toJson(param);
        //param.pageSize = $scope.m.paginationInfo.pageSize;
        searchService.post(param)
            .then((response) => {
                this.$log.info(this.m);
                var data = response.plain().data.data;
                var data2 = response.plain().data.data2;
                var data3 = response.plain().data.data3;
                var data4 = response.plain().data.data4;
                // this.m.list = list;
                this.m.data = data;
                this.m.data2 = data2;
                this.m.data3 = data3;
                this.m.data4 = data4;
                this.m.diff_s = response.plain().data.diff_s;
            });
    }

}

export const Rpt0519Component = {
    templateUrl: '/views/admin.rpt0519',
    controller: Rpt0519Controller,
    controllerAs: 'vm',
    bindings: {}
}
