class Crm3020Controller {
    constructor(
        $scope,
        $state,
        $log,
        API,
        UtilsService,
        ClientService,
        $stateParams,
        RouteService,
        AclService
    ) {
        "ngInject";
        this.$state = $state;
        this.$log = $log;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.RouteService = RouteService;
        this.can = AclService.can;
        this.m = {
            data: {},
            init: {}
        };
        this.m.store_id = $stateParams.store_id;
        this.m.isSaving = false;
    }

    $onInit() {
        this.loadInit();
    }
    loadInit() {
        let param = {
            store_id: this.m.store_id
        };
        let searchService = this.API.service("search", this.API.all("crm3020"));
        searchService.post(param).then((response) => {
            this.$log.info("m init: ", response.data.data);
            this.m.data = response.data.data;
        });
    }
}

export const Crm3020Component = {
    templateUrl: "/views/admin.crm3020",
    controller: Crm3020Controller,
    controllerAs: "vm",
    bindings: {}
};
