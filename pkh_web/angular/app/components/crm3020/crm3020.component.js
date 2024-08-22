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
            init: {},
            selectedYear: null,  // Lưu trữ năm đã chọn
            totalScoreCard: {}   // Khởi tạo object để lưu trữ dữ liệu score card
        };
        this.m.store_id = $stateParams.store_id;
        this.m.isSaving = false;
    }

    $onInit() {
        this.loadInit();
        this.loadYears();
    }
    
    loadDataForYear() {
        this.loadInit(this.m.selectedYear);
    }

    loadYears() {
        this.API.all('crm3020').customGET('years')
            .then((response) => {
                this.m.years = response.plain();
            })
            .catch((error) => {
                this.$log.error('Error loading years:', error);
            });
    }

    loadInit(selectedYear) {
        let param = {
            store_id: this.m.store_id,
            year: selectedYear
        };
    
        let searchService = this.API.service("search", this.API.all("crm3020"));
        searchService.post(param).then((response) => {
            this.$log.info("m init: ", response.data.data);
            this.$log.info("K init: ", response.data.totalScoreCard);
            this.m.data = response.data.data;
            this.m.TotalSale = response.data.TotalSale;
            this.m.CountOrder = response.data.CountOrder;
            this.m.Retention = response.data.Retention;
            this.m.Dept = response.data.Dept;
            this.m.totalScoreCard = response.data.totalScoreCard; // Gán giá trị từ backend
        });
    }
}

export const Crm3020Component = {
    templateUrl: "/views/admin.crm3020",
    controller: Crm3020Controller,
    controllerAs: "vm",
    bindings: {}
};
