class Hrm1021Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, $stateParams, ClientService, RouteService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.can = AclService.can;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.$stateParams = $stateParams;
        this.RouteService = RouteService;

        this.m = {
            init: {},
            form: {
                // changed_date: moment(new Date())
            },
            dateOptions: {
                format: 'YYYY-MM-DD'
            }
        }
        // THIS IS DEFAULT TEMPLATE
    }

    $onInit(){
        let id = this.$stateParams.id;
        
        // this.loadInitData();

        this.m.init.id = id > 0 ? id : 0;
        if (this.m.init.id > 0 ) {
            this.load(this.m.init.id);
        } else {
            this.m.form = {
                id : this.m.init.id
            };
        }
    }

    /**
     * Load init data
     */
    // loadInitData() {
    //     let service = this.API.service('init-data', this.API.all('hrm1021'));
    //     service.post({})
    //         .then((response) => {
    //             let id = this.m.init.id;
    //             this.m.init = response.data;
    //             this.m.init.id = id;
    //         });
    // }

    /**
     * Load entity
     * @param {int} id Entity id
     */
    load(id) {
        let service = this.API.service('load', this.API.all('hrm1021'));
        let param = { id: id };
        service.post(param)
            .then((response) => {
                this.m.form = response.data.data;
            });

    }
}

export const Hrm1021Component = {
    //templateUrl: './views/app/components/hrm1021/hrm1021.component.html',
    templateUrl: '/views/admin.hrm1021',
    controller: Hrm1021Controller,
    controllerAs: 'vm',
    bindings: {}
}
