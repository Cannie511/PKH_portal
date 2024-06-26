class Crm1650Controller {
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
        this.m = {}
        this.loadInit();
    }

    loadInit() {
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm1650'));
        let $log = this.$log;
        searchService.post({})
            .then((response) => {
                let list = response.plain().data;


                this.m.list = list;
                //$log.info('list ahihi', this.m);
            });
    }

    download() {
        let param = {
            data: this.m.list
        }
        let service = this.API.service('download', this.API.all('crm1650'));
        service.post(param)
            .then((response) => {
                //this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }

    $onInit() {}
}

export const Crm1650Component = {
    //templateUrl: './views/app/components/crm1650/crm1650.component.html',
    templateUrl: '/views/admin.crm1650',
    controller: Crm1650Controller,
    controllerAs: 'vm',
    bindings: {}
}